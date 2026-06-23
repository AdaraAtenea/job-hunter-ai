import pandas as pd
import mysql.connector

# =========================
# CONEXIÓN MYSQL
# =========================
conexion = mysql.connector.connect(
    host="localhost",
    user="root",
    password="",
    database="jobhunter_ai"
)

# =========================
# CONSULTA PRINCIPAL
# =========================
query = """
SELECT
    id,
    titulo,
    empresa,
    ubicacion,
    modalidad,
    compatibilidad,
    score,
    estado_revision,
    fecha_publicacion,
    fuentes
FROM vacantes
"""

df = pd.read_sql(query, conexion)

# =========================
# EXPORT EXCEL
# =========================
writer = pd.ExcelWriter(
    "exports/vacantes_dashboard.xlsx",
    engine="xlsxwriter"
)

df.to_excel(writer, sheet_name="Vacantes", index=False)

workbook = writer.book
worksheet = writer.sheets["Vacantes"]

# =========================
# ESTILOS
# =========================
header_format = workbook.add_format({
    "bold": True,
    "font_color": "white",
    "bg_color": "#1F4E78",
    "border": 1,
    "align": "center"
})

green_format = workbook.add_format({
    "bg_color": "#C6EFCE",
    "font_color": "#006100"
})

yellow_format = workbook.add_format({
    "bg_color": "#FFEB9C",
    "font_color": "#9C6500"
})

red_format = workbook.add_format({
    "bg_color": "#FFC7CE",
    "font_color": "#9C0006"
})

# =========================
# FORMATO HEADERS
# =========================
for col_num, value in enumerate(df.columns.values):
    worksheet.write(0, col_num, value, header_format)

# =========================
# AJUSTE COLUMNAS
# =========================
worksheet.set_column("A:A", 8)
worksheet.set_column("B:B", 30)
worksheet.set_column("C:C", 25)
worksheet.set_column("D:D", 25)
worksheet.set_column("E:E", 15)
worksheet.set_column("F:G", 15)
worksheet.set_column("H:H", 20)
worksheet.set_column("I:I", 18)
worksheet.set_column("J:J", 15)

# =========================
# FILTROS
# =========================
worksheet.autofilter(0, 0, len(df), len(df.columns) - 1)

# =========================
# FORMATO SCORE
# =========================
worksheet.conditional_format(
    f"F2:F{len(df)+1}",
    {"type": "cell", "criteria": ">=", "value": 70, "format": green_format}
)

worksheet.conditional_format(
    f"F2:F{len(df)+1}",
    {"type": "cell", "criteria": "between", "minimum": 40, "maximum": 69, "format": yellow_format}
)

worksheet.conditional_format(
    f"F2:F{len(df)+1}",
    {"type": "cell", "criteria": "<", "value": 40, "format": red_format}
)

# =====================================================
# HOJA RESUMEN (POWER BI STYLE)
# =====================================================
resumen = workbook.add_worksheet("Resumen")

# =========================
# TOP EMPRESAS
# =========================
top_empresas = df["empresa"].value_counts().head(10).reset_index()
top_empresas.columns = ["empresa", "total"]

resumen.write(0, 0, "Empresa", header_format)
resumen.write(0, 1, "Total", header_format)

for i, row in top_empresas.iterrows():
    resumen.write(i + 1, 0, row["empresa"])
    resumen.write(i + 1, 1, row["total"])

chart_empresas = workbook.add_chart({"type": "column"})

chart_empresas.add_series({
    "name": "Top Empresas",
    "categories": ["Resumen", 1, 0, len(top_empresas), 0],
    "values": ["Resumen", 1, 1, len(top_empresas), 1],
})

chart_empresas.set_title({"name": "Top Empresas"})
chart_empresas.set_x_axis({"name": "Empresa"})
chart_empresas.set_y_axis({"name": "Vacantes"})
chart_empresas.set_style(10)

resumen.insert_chart("D2", chart_empresas)

# =========================
# MODALIDAD (REMOTO / PRESENCIAL)
# =========================
modalidad = df["modalidad"].value_counts().reset_index()
modalidad.columns = ["modalidad", "total"]

resumen.write(0, 4, "Modalidad", header_format)
resumen.write(0, 5, "Total", header_format)

for i, row in modalidad.iterrows():
    resumen.write(i + 1, 4, row["modalidad"])
    resumen.write(i + 1, 5, row["total"])

chart_modalidad = workbook.add_chart({"type": "pie"})

chart_modalidad.add_series({
    "name": "Modalidad",
    "categories": ["Resumen", 1, 4, len(modalidad), 4],
    "values": ["Resumen", 1, 5, len(modalidad), 5],
})

chart_modalidad.set_title({"name": "Distribución de Modalidad"})

resumen.insert_chart("D20", chart_modalidad)

# =========================
# SCORE DISTRIBUTION
# =========================
def rango_score(x):
    if x >= 80:
        return "80-100"
    elif x >= 60:
        return "60-79"
    elif x >= 40:
        return "40-59"
    else:
        return "0-39"

df["rango_score"] = df["score"].apply(rango_score)

score_dist = df["rango_score"].value_counts().reset_index()
score_dist.columns = ["rango", "total"]

resumen.write(0, 7, "Rango Score", header_format)
resumen.write(0, 8, "Total", header_format)

for i, row in score_dist.iterrows():
    resumen.write(i + 1, 7, row["rango"])
    resumen.write(i + 1, 8, row["total"])

chart_score = workbook.add_chart({"type": "column"})

chart_score.add_series({
    "name": "Score",
    "categories": ["Resumen", 1, 7, len(score_dist), 7],
    "values": ["Resumen", 1, 8, len(score_dist), 8],
})

chart_score.set_title({"name": "Vacantes por Score"})

resumen.insert_chart("D35", chart_score)

# =========================
# GUARDAR
# =========================
writer.close()

print("===================================")
print("DASHBOARD EXCEL GENERADO")
print("===================================")

conexion.close()