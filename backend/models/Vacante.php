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

    //Obtiene por ID de la vacante
    public function obtenerPorId($id){
        $sql = "SELECT * FROM vacantes WHERE id = :id";
        $stmt = $this->conexion->prepare($sql);
        $stmt->execute([
            ':id' => $id
        ]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
   
    //Actualiza los datos de la Vacante
    public function actualizar(
        $id,
        $titulo,
        $empresa
    )
    {   $sql = "UPDATE vacantes SET titulo = :titulo, empresa = :empresa WHERE id = :id";
        $stmt = $this->conexion->prepare($sql);

        return $stmt->execute([
            ':id' => $id,
            ':titulo' => $titulo,
            ':empresa' => $empresa
        ]);
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
        $sql = "INSERT INTO vacantes
            (   titulo,
                empresa,
                ubicacion,
                modalidad,
                salario,
                descripcion
            )
            VALUES
            (   :titulo,
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