<?php

require_once '../../config/database.php';
require_once '../models/Vacante.php';

class VacantesController
{
    public function listar()
    {
        global $conexion;

        $vacante = new Vacante($conexion);

        return $vacante->obtenerTodas();
    }
}