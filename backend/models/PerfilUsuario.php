<?php

class PerfilUsuario
{
    private $conexion;
    public function __construct($conexion)
    {
        $this->conexion = $conexion;
    }

    public function obtener()
    {
        $sql = "SELECT * FROM perfil_usuario LIMIT 1";
        $stmt = $this->conexion->prepare($sql);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function guardar(
        $nombreProfesional,
        $experiencia,
        $salarioMinimo,
        $salarioIdeal,
        $ubicaciones,
        $tecnologias
    )
    {
        $sql = "INSERT INTO perfil_usuario
            (   nombre_profesional,
                experiencia_anios,
                salario_minimo,
                salario_ideal,
                ubicaciones,
                tecnologias
            )
            VALUES
            (   :nombre_profesional,
                :experiencia_anios,
                :salario_minimo,
                :salario_ideal,
                :ubicaciones,
                :tecnologias
            )";

        $stmt = $this->conexion->prepare($sql);

        return $stmt->execute([
            ':nombre_profesional' => $nombreProfesional,
            ':experiencia_anios' => $experiencia,
            ':salario_minimo' => $salarioMinimo,
            ':salario_ideal' => $salarioIdeal,
            ':ubicaciones' => $ubicaciones,
            ':tecnologias' => $tecnologias
        ]);
    }
}