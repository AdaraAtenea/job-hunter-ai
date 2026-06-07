<?php

require_once __DIR__ . '/../controllers/AplicacionesController.php';

$controller = new AplicacionesController();

$aplicaciones = $controller->listar();

?>

<!DOCTYPE html>
<html>
<head>

<meta charset="UTF-8">

<title>Aplicaciones</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>
<div class="container mt-4">
    <h1>Aplicaciones Enviadas</h1>

    <div class="alert alert-info">
        Total aplicaciones:
        <strong><?= count($aplicaciones) ?></strong>
    </div>

    <table class="table table-bordered table-hover">
        <thead class="table-dark">
            <tr>
                <th>Vacante</th>
                <th>Empresa</th>
                <th>Estado</th>
                <th>Fecha</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($aplicaciones as $aplicacion): ?>
                <tr>
                    <td><?= $aplicacion['titulo'] ?></td>
                    <td><?= $aplicacion['empresa'] ?></td>
                    <!--Actualizacion en colores para los eatsdos-->
                    <td>
                        <?php
                            $clase = 'secondary';
                            switch($aplicacion['estado']){
                                case 'Pendiente':
                                    $clase = 'warning';
                                    break;
                                case 'Aplicado':
                                    $clase = 'primary';
                                    break;
                                case 'Entrevista':
                                    $clase = 'info';
                                    break;
                                case 'Oferta':
                                    $clase = 'success';
                                    break;
                                case 'Contratado':
                                    $clase = 'success';
                                    break;
                                case 'Rechazado':
                                    $clase = 'danger';
                                    break;
                            }
                        ?>
                        <span class="badge bg-<?= $clase ?>">
                            <?= $aplicacion['estado'] ?>
                        </span>
                    </td>
                    
                    <td><?= date('d/m/Y', strtotime($aplicacion['fecha_aplicacion'])) ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

</body>
</html>