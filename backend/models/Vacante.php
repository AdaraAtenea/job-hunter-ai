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
        $sql = "SELECT * FROM vacantes ORDER BY compatibilidad DESC";

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

    //Funcion para la compatibilidad de la vacante con el perfil del usuario
    public function calcularCompatibilidad($tecnologiasPerfil, $descripcionVacante){
        $perfil = explode(',', strtolower($tecnologiasPerfil));

        $coincidencias = 0;
        foreach($perfil as $tecnologia){
            $tecnologia = trim($tecnologia);
            if(
                strpos(
                    strtolower($descripcionVacante),
                    $tecnologia
                ) !== false
            ){
                $coincidencias++;
            }
        }
        if(count($perfil) == 0){
            return 0;
        }
        return round(
            ($coincidencias / count($perfil)) * 100
        );
    }

    //Para guardar las vacantes nuevas
   public function guardar(
    $titulo,
    $empresa,
    $ubicacion,
    $modalidad,
    $salario,
    $descripcion,
    $compatibilidad,
    $experiencia_requerida,
    $fuente,
    $url_vacante
)
{
    $sql = "INSERT INTO vacantes
    (
        titulo,
        empresa,
        ubicacion,
        modalidad,
        salario,
        descripcion,
        compatibilidad,
        experiencia_requerida,
        fuentes,
        url_vacante
    )
    VALUES
    (
        :titulo,
    :empresa,
    :ubicacion,
    :modalidad,
    :salario,
    :descripcion,
    :compatibilidad,
    :experiencia_requerida,
    :fuentes,
    :url_vacante
    )";

    $stmt = $this->conexion->prepare($sql);

    return $stmt->execute([
        ':titulo' => $titulo,
    ':empresa' => $empresa,
    ':ubicacion' => $ubicacion,
    ':modalidad' => $modalidad,
    ':salario' => $salario,
    ':descripcion' => $descripcion,
    ':compatibilidad' => $compatibilidad,
    ':experiencia_requerida' => $experiencia_requerida,
    ':fuentes' => $fuente,
    ':url_vacante' => $url_vacante
    ]);
}

//Para cambiar el estado de la vacante
public function actualizarEstado(
    $id,
    $estado
)
{
    $sql = "
        UPDATE vacantes
        SET estado_revision = :estado
        WHERE id = :id
    ";

    $stmt = $this->conexion->prepare($sql);

    return $stmt->execute([
        ':estado' => $estado,
        ':id' => $id
    ]);
}
}