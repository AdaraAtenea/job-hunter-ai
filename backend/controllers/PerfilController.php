<?php
require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../models/PerfilUsuario.php';

class PerfilController
{
    public function obtener()
    {
        global $conexion;
        $perfil = new PerfilUsuario($conexion);
        return $perfil->obtener();
    }
}