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

    $resultado = $controller->guardar();

    if($resultado){
        header('Location: ../views/vacantes.php');
        exit;
    }else{
        echo "Error al guardar la vacante";
    }
}