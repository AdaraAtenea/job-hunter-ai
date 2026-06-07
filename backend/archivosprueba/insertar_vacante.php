<?php

require_once __DIR__ . '/../../config/database.php';

$sql = "INSERT INTO vacantes
(
    titulo,
    empresa,
    ubicacion,
    modalidad,
    salario,
    descripcion,
    fuentes
)
VALUES
(
    :titulo,
    :empresa,
    :ubicacion,
    :modalidad,
    :salario,
    :descripcion,
    :fuentes
)";

$stmt = $conexion->prepare($sql);

$stmt->execute([
    ':titulo' => 'Desarrollador WEB Jr',
    ':empresa' => 'Empresa Demo',
    ':ubicacion' => 'CDMX',
    ':modalidad' => 'Remoto',
    ':salario' => '$20,000',
    ':descripcion' => 'Vacante de prueba para Job Hunter AI',
    ':fuentes' => 'Manual'
]);

echo "Vacante guardada correctamente";