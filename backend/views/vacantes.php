<?php

require_once __DIR__ . '/../controllers/VacantesController.php';

$controller = new VacantesController();

$vacantes = $controller->listar();

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Vacantes Job Hunter IA</title>

    <style>
        body{
            font-family: Arial;
            margin:40px;
        }
        table{
            width:100%;
            border-collapse:collapse;
        }
        th, td{
            border:1px solid #ccc;
            padding:10px;
            text-align:left;
        }
        th{
            background:#f2f2f2;
        }
    </style>
</head>

<body>
    <div class="container mt-4">
        <h1 class="mb-4">Job Hunter IA</h1>
    </div>

    <h1>Vacantes Registradas</h1>
    <div class="alert alert-info">
        Total de vacantes: <strong><?= count ($vacantes) ?></strong>
    </div>

    <a href="#" class="btn btn-success mb-3">Nueva Vacante</a>
    
    <div class="table-responsive">
        <table class="table table-bordered table-hover">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Puesto</th>
                    <th>Empresa</th>
                    <th>Ubicación</th>
                    <th>Modalidad</th>
                    <th>Salario</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($vacantes as $vacante): ?>
                <tr>
                    <td><?= $vacante['id'] ?></td>
                    <td><?= $vacante['titulo'] ?></td>
                    <td><?= $vacante['empresa'] ?></td>
                    <td><?= $vacante['ubicacion'] ?></td>
                    <td><?= $vacante['modalidad'] ?></td>
                    <td><?= $vacante['salario'] ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>