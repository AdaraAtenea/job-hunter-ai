<?php
require_once __DIR__ . '/../controllers/DashboardController.php';

$controller = new DashboardController();
$metricas = $controller->obtenerMetricas();

require_once __DIR__ . '/../layouts/header.php';
require_once __DIR__ . '/../layouts/sidebar.php';

?>

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

<?php
require_once __DIR__ . '/../layouts/footer.php';
?>