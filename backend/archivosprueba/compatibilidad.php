<?php

require_once __DIR__ . '/../../config/database.php';

require_once __DIR__ . '/../models/Vacante.php';
require_once __DIR__ . '/../models/PerfilUsuario.php';

$perfilModel = new PerfilUsuario($conexion);

$vacanteModel = new Vacante($conexion);

$perfil = $perfilModel->obtener();

$compatibilidad = $vacanteModel->calcularCompatibilidad(
    $perfil['tecnologias'],
    'PHP MySQL JavaScript Laravel'
);

echo "Compatibilidad: " . $compatibilidad . "%";