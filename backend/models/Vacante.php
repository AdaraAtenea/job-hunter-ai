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
    public function actualizar($id, $titulo,$empresa){
        $sql = "UPDATE vacantes SET titulo = :titulo, empresa = :empresa WHERE id = :id";
        $stmt = $this->conexion->prepare($sql);
        return $stmt->execute([
            ':id' => $id,
            ':titulo' => $titulo,
            ':empresa' => $empresa
        ]);
    }

    //Funcion para la compatibilidad de la vacante con el perfil del usuario
    public function calcularCompatibilidad($perfil, $descripcionVacante, $salarioVacante, $experienciaVacante, $modalidadVacante){
        $compatibilidad = 0;
        // TECNOLOGIAS (60%)
        $tecnologias = explode(
            ',',
            strtolower($perfil['tecnologias']));
        $coincidencias = 0;
        foreach($tecnologias as $tecnologia){
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
        if(count($tecnologias) > 0){
            $compatibilidad += (($coincidencias / count($tecnologias))* 60);
        }
        // SALARIO (20%)
        if($salarioVacante >= $perfil['salario_minimo']){
            $compatibilidad += 20;
        }
        // EXPERIENCIA (10%)
        if($experienciaVacante <=  $perfil['experiencia_anios']){
            $compatibilidad += 10;
        }
        // MODALIDAD (10%)
        if( strtolower($modalidadVacante) == strtolower( $perfil['modalidad_preferida'])){
            $compatibilidad += 10;
        }
        return round($compatibilidad);
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
        $url_vacante){
            $sql = "INSERT INTO vacantes(
                titulo,
                empresa,
                ubicacion,
                modalidad,
                salario,
                descripcion,
                compatibilidad,
                experiencia_requerida,
                fuentes,
                url_vacante)
                VALUES(
                    :titulo,
                    :empresa,
                    :ubicacion,
                    :modalidad,
                    :salario,
                    :descripcion,
                    :compatibilidad,
                    :experiencia_requerida,
                    :fuentes,
                    :url_vacante)";
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
                    ':url_vacante' => $url_vacante]);
        }

        //Para cambiar el estado de la vacante
        public function actualizarEstado($id, $estado){
            $sql = "UPDATE vacantes SET estado_revision = :estado WHERE id = :id";
            $stmt = $this->conexion->prepare($sql);
            return $stmt->execute([
                ':estado' => $estado,
                ':id' => $id
            ]);
        }

        //Obtiene métricas del dashboard
        public function obtenerMetricas(){
            $sql = "SELECT COUNT(*) as total,
                SUM(CASE WHEN estado_revision='Nueva'
                    THEN 1 ELSE 0 END) as nuevas,
                SUM(CASE WHEN estado_revision='Revisada'
                    THEN 1 ELSE 0 END) as revisadas,
                SUM(CASE WHEN estado_revision='Aplicada'
                    THEN 1 ELSE 0 END) as aplicadas,
                SUM(CASE WHEN estado_revision='Entrevista'
                    THEN 1 ELSE 0 END) as entrevistas,
                SUM(CASE WHEN estado_revision='Oferta'
                    THEN 1 ELSE 0 END) as ofertas,
                SUM(CASE WHEN estado_revision='Contratado'
                    THEN 1 ELSE 0 END) as contratados,
                SUM(CASE WHEN estado_revision='Descartada'
                    THEN 1 ELSE 0 END) as descartadas
                FROM vacantes";
            $stmt = $this->conexion->prepare($sql);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }
}