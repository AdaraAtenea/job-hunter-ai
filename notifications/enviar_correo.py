import smtplib

from email.mime.text import MIMEText
from email.mime.multipart import MIMEMultipart

# CORREO EMISOR
correo_emisor = "jobhunterai.alerts@gmail.com"

# APP PASSWORD DE GOOGLE
password = "jbqa mdpt fenz nzvd"

# CORREO DESTINO
correo_receptor = "ramiresmzhey12@gmail.com"

# CREAR MENSAJE
mensaje = MIMEMultipart()

mensaje["From"] = correo_emisor
mensaje["To"] = correo_receptor
mensaje["Subject"] = "🚀 Prueba Job Hunter AI"

contenido = """
Hola.

Este es el primer correo automático enviado
desde Job Hunter AI usando Python SMTP.

Sprint 9 iniciado correctamente 🚀
"""

mensaje.attach(
    MIMEText(contenido, "plain")
)

try:

    # CONECTAR CON GMAIL SMTP
    servidor = smtplib.SMTP(
        "smtp.gmail.com",
        587
    )

    servidor.starttls()

    # LOGIN
    servidor.login(
        correo_emisor,
        password
    )

    # ENVIAR
    servidor.sendmail(
        correo_emisor,
        correo_receptor,
        mensaje.as_string()
    )

    print("\n✅ Correo enviado correctamente")

    servidor.quit()

except Exception as e:

    print("\n❌ Error al enviar correo:")
    print(e)
