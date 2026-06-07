<?php

require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../models/Vacante.php';

class VacantesController
{
    public function listar()
    {
        global $conexion;

        $vacanteModel = new Vacante($conexion);

        return $vacanteModel->obtenerTodas();
    }
}