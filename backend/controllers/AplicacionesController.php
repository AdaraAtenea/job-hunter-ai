<?php

require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../models/Aplicacion.php';

class AplicacionesController
{
    public function listar()
    {
        global $conexion;

        $aplicacionModel = new Aplicacion($conexion);

        return $aplicacionModel->obtenerTodas();
    }
}