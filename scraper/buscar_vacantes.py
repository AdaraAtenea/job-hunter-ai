import requests

url = "https://remoteok.com/api"

response = requests.get(
    url,
    headers={
        "User-Agent": "Mozilla/5.0"
    }
)

data = response.json()

print("Total registros recibidos:", len(data))

palabras_clave = [
    "developer",
    "software",
    "backend",
    "frontend",
    "full stack",
    "web",
    "php",
    "javascript"
]

for vacantes in data[1:]:

    puesto = str(
        vacantes.get("position", "")
    ).lower()

    coincide = False

    for palabra in palabras_clave:

        if palabra in puesto:
            coincide = True
            break

    if coincide:

        print("\n===================================")
        print("Puesto:", vacantes.get("position"))
        print("Empresa:", vacantes.get("company"))
        print("Ubicación:", vacantes.get("location"))
        print("Tecnologías:", vacantes.get("tags"))
        print("===================================")