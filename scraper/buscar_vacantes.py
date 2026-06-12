import requests
import mysql.connector

url = "https://remoteok.com/api"

response = requests.get(url, headers={ "User-Agent": "Mozilla/5.0"})

data = response.json()

conexion = mysql.connector.connect(host="localhost",user="root",password="",database="jobhunter_ai")

cursor = conexion.cursor()

print("Total registros recibidos:", len(data))

contador = 0

palabras_permitidas = [
    "developer",
    "backend",
    "frontend",
    "full stack",
    "software",
    "web",
    "php",
    "javascript",
    "engineer"
]

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

    # VERIFICAR SI YA EXISTE

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
    print("Apply URL:", vacante.get("apply_url"))

    if resultado:

        print(
            "Ya existe:",
            vacante.get("position"),
            "-",
            vacante.get("company")
        )

        continue

    sql = """
    INSERT INTO vacantes
    (
        titulo,
        empresa,
        ubicacion,
        modalidad,
        salario,
        descripcion,
        compatibilidad,
        fuentes
    )
    VALUES
    (
        %s,%s,%s,%s,%s,%s,%s,%s
    )
    """

    cursor.execute(
        sql,
        (
            vacante.get("position"),
            vacante.get("company"),
            vacante.get("location"),
            "Remoto",
            0,
            vacante.get("description", "")[:1000],
            0,
            "RemoteOK"
        )
    )

    print("\n===================================")
    print("Nueva vacante guardada")
    print("Puesto:", vacante.get("position"))
    print("Empresa:", vacante.get("company"))
    print("URL:", vacante.get("url"))
    print("===================================")

print("\n===================================")
print("Total vacantes filtradas:", contador)
print("===================================")

conexion.commit()

cursor.close()
conexion.close()