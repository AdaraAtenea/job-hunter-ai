<?php
require_once __DIR__ . '/../../config/database.php';

class DashboardController
{
    public function obtenerMetricas()
    {
        global $conexion;

        $vacantes = $conexion
            ->query("SELECT COUNT(*) FROM vacantes")
            ->fetchColumn();

        $aplicaciones = $conexion
            ->query("SELECT COUNT(*) FROM aplicaciones")
            ->fetchColumn();

        $entrevistas = $conexion
            ->query("SELECT COUNT(*) FROM aplicaciones WHERE estado='Entrevista'")
            ->fetchColumn();

        $ofertas = $conexion
            ->query("SELECT COUNT(*) FROM aplicaciones WHERE estado='Oferta'")
            ->fetchColumn();

        return [
            'vacantes' => $vacantes,
            'aplicaciones' => $aplicaciones,
            'entrevistas' => $entrevistas,
            'ofertas' => $ofertas
        ];
    }
}