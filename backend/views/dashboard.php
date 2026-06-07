<?php
require_once __DIR__ . '/../controllers/DashboardController.php';

$controller = new DashboardController();
$metricas = $controller->obtenerMetricas();
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Dashboard</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body>
        <div class="container mt-4">
            <h1 class="mb-4">Job Hunter IA</h1>
            <div class="row">
                <div class="col-md-3">
                    <div class="card text-center">
                        <div class="card-body">
                            <h5>Vacantes</h5>
                            <h2><?= $metricas['vacantes'] ?></h2>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card text-center">
                        <div class="card-body">
                            <h5>Aplicaciones</h5>
                            <h2><?= $metricas['aplicaciones'] ?></h2>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card text-center">
                        <div class="card-body">
                            <h5>Entrevistas</h5>
                            <h2><?= $metricas['entrevistas'] ?></h2>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card text-center">
                        <div class="card-body">
                            <h5>Ofertas</h5>
                            <h2><?= $metricas['ofertas'] ?></h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>