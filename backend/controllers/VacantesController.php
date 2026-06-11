<?php

require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../models/Vacante.php';
require_once __DIR__ . '/../models/PerfilUsuario.php';

class VacantesController
{
    public function listar()
    {
        global $conexion;
        $vacanteModel = new Vacante($conexion);
        return $vacanteModel->obtenerTodas();
    }

    //Funcion obtener por ID de la vacante
    public function obtenerPorId($id)
    {
        global $conexion;
        $vacante = new Vacante($conexion);
        return $vacante->obtenerPorId($id);
    }

    //Funcion que actualiza los datos de la vacante
    public function actualizar(){
        global $conexion;
        $vacante = new Vacante($conexion);
        return $vacante->actualizar(
            $_POST['id'],
            $_POST['titulo'],
            $_POST['empresa']
        );
    }

    //Funcion para actualizar el estado de la vacante
    public function actualizarEstado(){
        global $conexion;
        $vacante = new Vacante($conexion);
        return $vacante->actualizarEstado(
            $_POST['id'],
            $_POST['estado_revision']
        );
    }

    //Funcion para guardar nuevas vancantes
    public function guardar(){
        global $conexion;
        $vacante = new Vacante($conexion);
        $perfilModel = new PerfilUsuario($conexion);
        $perfil = $perfilModel->obtener();
        $compatibilidad = $vacante->calcularCompatibilidad(
            $perfil['tecnologias'],
            $_POST['descripcion']
        );
       return $vacante->guardar(
            $_POST['titulo'],
            $_POST['empresa'],
            $_POST['ubicacion'],
            $_POST['modalidad'],
            $_POST['salario'],
            $_POST['descripcion'],
            $compatibilidad,
            $_POST['experiencia_requerida'],
            $_POST['fuente'],
            $_POST['url_vacante']);
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller = new VacantesController();
    if(isset($_POST['actualizar_estado'])){
        $resultado = $controller->actualizarEstado();
    }
    elseif(isset($_POST['actualizar'])){
        $resultado = $controller->actualizar();
    }
    else{
        $resultado = $controller->guardar();
    }
    if($resultado){
        header('Location: ../views/vacantes.php');
        exit;
    }else{
        echo "Error en la operación";
    }
}