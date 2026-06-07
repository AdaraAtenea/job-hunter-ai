<?php
require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../models/PerfilUsuario.php';

class PerfilController
{
    public function obtener()
    {
        global $conexion;
        $perfil = new PerfilUsuario($conexion);
        return $perfil->obtener();
    }
    //Guardar los datos del perfil del usuario
    public function guardar(){
        global $conexion;
        $perfil = new PerfilUsuario($conexion);
        return $perfil->guardar(
            $_POST['nombre_profesional'],
            $_POST['experiencia_anios'],
            $_POST['salario_minimo'],
            $_POST['salario_ideal'],
            $_POST['ubicaciones'],
            $_POST['tecnologias']
        );
    }
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $controller = new PerfilController();

    $resultado = $controller->guardar();

    if($resultado){

        header('Location: ../views/perfil.php');
        exit;

    }else{

        echo "Error al guardar perfil";

    }
}