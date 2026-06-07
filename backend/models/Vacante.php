<?php

class Vacante
{
    private $conexion;

    public function __construct($conexion)
    {
        $this->conexion = $conexion;
    }

    public function obtenerTodas()
    {
        $sql = "SELECT * FROM vacantes ORDER BY id DESC";

        $stmt = $this->conexion->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    //Para guardar las vacantes nuevas
    public function guardar(
        $titulo,
        $empresa,
        $ubicacion,
        $modalidad,
        $salario,
        $descripcion
    )
    {
        $sql = "
            INSERT INTO vacantes
            (
                titulo,
                empresa,
                ubicacion,
                modalidad,
                salario,
                descripcion
            )
            VALUES
            (
                :titulo,
                :empresa,
                :ubicacion,
                :modalidad,
                :salario,
                :descripcion
            )
        ";
        $stmt = $this->conexion->prepare($sql);
        return $stmt->execute([
            ':titulo' => $titulo,
            ':empresa' => $empresa,
            ':ubicacion' => $ubicacion,
            ':modalidad' => $modalidad,
            ':salario' => $salario,
            ':descripcion' => $descripcion
        ]);
    }
}