def calcular_compatibilidad(
    tecnologias_perfil,
    descripcion
):

    perfil = [
        t.strip().lower()
        for t in tecnologias_perfil.split(',')
    ]

    descripcion = descripcion.lower()

    coincidencias = 0

    for tecnologia in perfil:

        if tecnologia in descripcion:
            coincidencias += 1

    if len(perfil) == 0:
        return 0

    return round(
        (coincidencias / len(perfil)) * 100
    )


tecnologias = """
PHP,
MySQL,
JavaScript,
Bootstrap,
Git,
HTML,
CSS
"""

descripcion = """
Buscamos desarrollador PHP
con experiencia en MySQL,
HTML, CSS y JavaScript.
"""

resultado = calcular_compatibilidad(
    tecnologias,
    descripcion
)

print(resultado)