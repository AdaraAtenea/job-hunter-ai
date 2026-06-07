<?php

require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../models/Vacante.php';

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

    //Funcion para guardar nuevas vancantes
    public function guardar(){
        global $conexion;
        $vacante = new Vacante($conexion);
        return $vacante->guardar(
            $_POST['titulo'],
            $_POST['empresa'],
            $_POST['ubicacion'],
            $_POST['modalidad'],
            $_POST['salario'],
            $_POST['descripcion']
        );
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller = new VacantesController();
    if(isset($_POST['actualizar'])){
        $resultado = $controller->actualizar();
    }else{
        $resultado = $controller->guardar();
    }
    if($resultado){
        header('Location: ../views/vacantes.php');
        exit;
    }else{
        echo "Error en la operación";
    }
}