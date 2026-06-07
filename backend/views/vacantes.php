<?php

require_once '../controllers/VacantesController.php';

$controller = new VacantesController();

$vacantes = $controller->listar();

echo "<pre>";
print_r($vacantes);
echo "</pre>";