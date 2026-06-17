from notifications.enviar_correo import enviar_correo
import requests
import mysql.connector
# API RemoteOK
url = "https://remoteok.com/api"

response = requests.get(
    url,
    headers={
        "User-Agent": "Mozilla/5.0"
    }
)

data = response.json()

# CONEXIÓN MYSQL
conexion = mysql.connector.connect(
    host="localhost",
    user="root",
    password="",
    database="jobhunter_ai"
)

cursor = conexion.cursor()

print("Total registros recibidos:", len(data))

contador = 0

# FILTRO DE PUESTOS

palabras_permitidas = [
    "developer",
    "backend",
    "frontend",
    "full stack",
    "software engineer",
    "software developer",
    "web developer",
    "php developer",
    "javascript developer"
]

# TECNOLOGÍAS DE TU PERFIL

tecnologias_usuario = [
    "php",
    "mysql",
    "javascript",
    "html",
    "css",
    "bootstrap",
    "react",
    "git",
    "python"
]


def calcular_compatibilidad(
    tecnologias_usuario,
    puesto,
    descripcion,
    tags
):

    texto = (
        puesto + " " +
        descripcion + " " +
        " ".join(tags)
    ).lower()

    coincidencias = 0

    for tecnologia in tecnologias_usuario:

        if tecnologia.lower() in texto:
            coincidencias += 1

    return int(
        (coincidencias / len(tecnologias_usuario))
        * 100
    )


def calcular_score(
    compatibilidad,
    puesto,
    descripcion
):

    texto = (
        puesto + " " + descripcion
    ).lower()

    score = compatibilidad

    # Junior
    if "junior" in texto or "jr" in texto:
        score += 15

    # PHP
    if "php" in texto:
        score += 15

    # JavaScript
    if "javascript" in texto:
        score += 10

    # MySQL
    if "mysql" in texto:
        score += 10

    # Remoto
    score += 10

    if score > 100:
        score = 100

    return score

for vacante in data[1:]:

    puesto = str(
        vacante.get("position", "")
    ).lower()

    coincide = False

    for palabra in palabras_permitidas:

        if palabra in puesto:
            coincide = True
            break

    if not coincide:
        continue

    contador += 1

    # VERIFICAR DUPLICADOS

    sql_verificar = """
    SELECT 1
    FROM vacantes
    WHERE titulo = %s
    AND empresa = %s
    LIMIT 1
    """

    cursor.execute(
        sql_verificar,
        (
            vacante.get("position"),
            vacante.get("company")
        )
    )

    resultado = cursor.fetchone()

    print("\n-----")
    print("Puesto:", vacante.get("position"))
    print("URL:", vacante.get("url"))

    #import json
    #print(
    #   json.dumps(
    #      vacante,
    #   indent=4,
    #        ensure_ascii=False
    #    )
    #)

    if resultado:

        print(
            "Ya existe:",
            vacante.get("position"),
            "-",
            vacante.get("company")
        )

        continue

    # CALCULAR COMPATIBILIDAD
    compatibilidad = calcular_compatibilidad(
        tecnologias_usuario,
        vacante.get("position", ""),
        vacante.get("description", ""),
        vacante.get("tags", [])
    )

    # CALCULAR SCORE
    score = calcular_score(
        compatibilidad,
        vacante.get("position", ""),
        vacante.get("description", "")
    )

    #Salario
    salario = ""
    if vacante.get("salary_min", 0) > 0:
        salario = (
            f"{vacante.get('salary_min')} - "
            f"{vacante.get('salary_max')}"
        )

    print("Compatibilidad:", compatibilidad, "%")
    print("Score:", score)
    print("Tags:", vacante.get("tags"))

    # FILTRO TEMPORAL PARA PRUEBAS

    if compatibilidad < 10:
        continue

    # INSERTAR VACANTE

    sql = """
    INSERT INTO vacantes
    (
        titulo,
        empresa,
        ubicacion,
        modalidad,
        salario,
        descripcion,
        url_vacante,
        fecha_publicacion,
        compatibilidad,
        score,
        fuentes
    )
    VALUES
    (
        %s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s
    )
    """

    cursor.execute(
        sql,
        (
            vacante.get("position"),
            vacante.get("company"),
            vacante.get("location"),
            "Remoto",
            salario,
            vacante.get("description", "")[:1000],
            vacante.get("apply_url") or vacante.get("url"),
            vacante.get("date", "")[:10],
            compatibilidad,
            score,
            "RemoteOK"
        )
    )

    # ENVIAR CORREO SOLO SI SCORE ES ALTO
    if score >= 55:
        enviar_correo(
            vacante.get("position"),
            vacante.get("company"),
            compatibilidad,
            score,
            vacante.get("apply_url") or vacante.get("url")
        )

    print("\n===================================")
    print("Nueva vacante guardada")
    print("Puesto:", vacante.get("position"))
    print("Empresa:", vacante.get("company"))
    print("Compatibilidad:", compatibilidad, "%")
    print("Score:", score)
    print("URL:", vacante.get("url"))
    print("===================================")

print("\n===================================")
print("Total vacantes filtradas:", contador)
print("===================================")

conexion.commit()

cursor.close()
conexion.close()