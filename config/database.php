<?php

$host = "localhost";
$dbname = "jobhunter_ai";
$user = "root";
$password = "";

try {

    $conexion = new PDO(
        "mysql:host=$host;dbname=$dbname;charset=utf8",
        $user,
        $password
    );

    $conexion->setAttribute(
        PDO::ATTR_ERRMODE,
        PDO::ERRMODE_EXCEPTION
    );

    echo "Conexion exitosa";

} catch(PDOException $e) {

    echo "Error: " . $e->getMessage();

}