import mysql.connector

conexion = mysql.connector.connect( host="localhost", user="root", password="", database="jobhunter_ai" )

cursor = conexion.cursor()

vacantes = [
    (   "PHP Developer Jr",
        "Tech Solutions",
        "CDMX",
        "Remoto",
        18000,
        "PHP MySQL JavaScript Bootstrap",
        80),
    (   "Frontend Developer",
        "Digital Agency",
        "CDMX",
        "Hibrido",
        17000,
        "HTML CSS JavaScript React",
        75),
    (   "Backend Developer",
        "Software House",
        "Guadalajara",
        "Remoto",
        22000,
        "PHP Laravel MySQL APIs",
        90),
    (   "Full Stack Developer",
        "Startup MX",
        "Remoto",
        "Remoto",
        25000,
        "PHP JavaScript React MySQL",
        95)
]

sql = """ 
INSERT INTO vacantes( titulo, empresa, ubicacion, modalidad, salario, descripcion, compatibilidad)

VALUES
( %s,%s,%s,%s,%s,%s,%s )
"""
cursor.executemany(sql, vacantes)

conexion.commit()

print(f"{cursor.rowcount} vacantes insertadas")

cursor.close()
conexion.close()