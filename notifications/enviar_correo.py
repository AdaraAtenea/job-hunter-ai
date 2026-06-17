import smtplib

from email.mime.text import MIMEText
from email.mime.multipart import MIMEMultipart

def enviar_correo(
    titulo,
    empresa,
    compatibilidad,
    score,
    url_vacante
):

    # CORREO EMISOR
    correo_emisor = "jobhunterai.alerts@gmail.com"
    # APP PASSWORD "jbqa mdpt fenz nzvd"
    password = "jbqa mdpt fenz nzvd"
    # DESTINO
    correo_receptor = "ramiresmzhey12@gmail.com"
    # CREAR MENSAJE
    mensaje = MIMEMultipart()

    mensaje["From"] = correo_emisor
    mensaje["To"] = correo_receptor
    mensaje["Subject"] = (
        f"🚀 Nueva vacante: {titulo}"
    )

    contenido = f"""
Nueva vacante encontrada 🚀

Puesto:
{titulo}

Empresa:
{empresa}

Compatibilidad:
{compatibilidad}%

Score:
{score}

Aplicar aquí:
{url_vacante}
"""

    mensaje.attach(
        MIMEText(contenido, "plain")
    )

    try:

        servidor = smtplib.SMTP(
            "smtp.gmail.com",
            587
        )

        servidor.starttls()

        servidor.login(
            correo_emisor,
            password
        )

        servidor.sendmail(
            correo_emisor,
            correo_receptor,
            mensaje.as_string()
        )

        servidor.quit()

        print(
            "✅ Correo enviado:",
            titulo
        )

    except Exception as e:

        print(
            "❌ Error al enviar correo:"
        )

        print(e)