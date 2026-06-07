<?php

require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../models/Aplicacion.php';

$aplicacion = new Aplicacion($conexion);

$resultado = $aplicacion->guardar(
    1,
    'Aplicado',
    'Aplicacion enviada desde Job Hunter AI'
);

if($resultado){
    echo "Aplicacion registrada correctamente";
}else{
    echo "Error al registrar";
}