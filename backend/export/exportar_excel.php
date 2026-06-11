<?php

require_once __DIR__ . '/../../config/database.php';

header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=vacantes.xls");

echo "ID\t";
echo "Estado\t";
echo "Puesto\t";
echo "Empresa\t";
echo "Ubicación\t";
echo "Modalidad\t";
echo "Salario\t";
echo "Compatibilidad\t";
echo "Fuentes\t";
echo "\n";

$sql = "SELECT * FROM vacantes";

$stmt = $conexion->prepare($sql);
$stmt->execute();

while($vacante = $stmt->fetch(PDO::FETCH_ASSOC))
{
    echo $vacante['id'] . "\t";
    echo $vacante['estado_revision'] . "\t";
    echo $vacante['titulo'] . "\t";
    echo $vacante['empresa'] . "\t";
    echo $vacante['ubicacion'] . "\t";
    echo $vacante['modalidad'] . "\t";
    echo $vacante['salario'] . "\t";
    echo $vacante['compatibilidad'] . "%\t";
    echo $vacante['fuentes'] . "\t";
    echo "\n";
}