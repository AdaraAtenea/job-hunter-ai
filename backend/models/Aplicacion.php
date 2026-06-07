<?php

class Aplicacion
{
    private $conexion;

    public function __construct($conexion)
    {
        $this->conexion = $conexion;
    }

    public function obtenerTodas()
    {
        $sql = "
            SELECT
                a.*,
                v.titulo,
                v.empresa
            FROM aplicaciones a
            INNER JOIN vacantes v
                ON a.vacante_id = v.id
            ORDER BY a.id DESC
        ";

        $stmt = $this->conexion->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}