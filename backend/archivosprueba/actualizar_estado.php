<?php
require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../models/Aplicacion.php';

$aplicacion = new Aplicacion($conexion);

$resultado = $aplicacion->actualizarEstado(
    1,
    'Entrevista'
);

echo $resultado
    ? 'Estado actualizado'
    : 'Error';