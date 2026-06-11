import mysql.connector

conexion = mysql.connector.connect( host="localhost", user="root", password="", database="jobhunter_ai" )

cursor = conexion.cursor()

sql = """
INSERT INTO vacantes
(titulo, empresa, ubicacion, modalidad, salario, descripcion, compatibilidad)
VALUES
( %s,%s,%s,%s,%s,%s,%s )
"""
datos = (
    "Python Developer Jr",
    "Empresa Python",
    "CDMX",
    "Remoto",
    20000,
    "Python, MySQL, APIs",
    90
)

cursor.execute(sql, datos)

conexion.commit()

print("Vacante insertada correctamente")

cursor.close()
conexion.close()