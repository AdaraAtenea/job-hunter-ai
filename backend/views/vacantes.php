<?php
require_once __DIR__ . '/../controllers/VacantesController.php';
require_once __DIR__ . '/../layouts/header.php';
require_once __DIR__ . '/../layouts/sidebar.php';

$controller = new VacantesController();
$vacantes = $controller->listar();
$metricas = $controller->obtenerMetricas();

?>

<!-- CONTENIDO DE LA PAGINA -->
<div class="container mt-4">
    <h1>Vacantes Registradas</h1>
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card text-center border-primary">
                <div class="card-body">
                    <h2><?= $metricas['total'] ?></h2>
                    <p>Total Vacantes</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-center border-info">
                <div class="card-body">
                    <h2><?= $metricas['nuevas'] ?></h2>
                    <p>Nuevas</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-center border-info">
                <div class="card-body">
                    <h2><?= $metricas['revisadas'] ?></h2>
                    <p>Revisadas</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-center border-success">
                <div class="card-body">
                    <h2><?= $metricas['aplicadas'] ?></h2>
                    <p>Aplicadas</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-center border-danger">
                <div class="card-body">
                    <h2><?= $metricas['descartadas'] ?></h2>
                    <p>Descartadas</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-center border-warning">
                <div class="card-body">
                    <h2><?= $metricas['entrevistas'] ?></h2>
                    <p>Entrevistas</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-center border-secondary">
                <div class="card-body">
                    <h2><?= $metricas['ofertas'] ?></h2>
                    <p>Ofertas</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-center border-dark">
                <div class="card-body">
                    <h2><?= $metricas['contratados'] ?></h2>
                    <p>Contratados</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-center border-primary">
                <div class="card-body">
                    <h2><?= $metricas['remotas'] ?></h2>
                    <p>Remotas</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-center border-success">
                <div class="card-body">
                    <h2>$<?= number_format($metricas['salario_promedio']) ?></h2>
                    <p>Salario Promedio</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-center border-success">
                <div class="card-body">
                    <h2><?= number_format($metricas['compatibilidad_promedio']) ?>%</h2>
                    <p>Compatibilidad Promedio</p>
                </div>
            </div>
        </div>
    </div>

    <div class="alert alert-info">
        Total de vacantes:
        <strong><?= count($vacantes) ?></strong>
    </div>
    <a href="nueva_vacante.php" class="btn btn-success mb-3">+ Nueva Vacante</a>
    <a href="../export/exportar_excel.php" class="btn btn-success mb-3">📊 Exportar Excel</a>
    <div class="table-responsive">
        <table class="table table-bordered table-hover">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Estado</th>
                    <th>Puesto</th>
                    <th>Empresa</th>
                    <th>Ubicación</th>
                    <th>Modalidad</th>
                    <th>Salario</th>
                    <th>Acciones</th>
                    <th>Experiencia</th>
                    <th>Compatibilidad</th>
                    <th>Fuente</th>
                    <th>Vacante</th>
                </tr>
            </thead>

            <tbody>
                <?php foreach($vacantes as $vacante): ?>
                <tr>
                    <td><?= $vacante['id'] ?></td>
                    <td><?php $estado = $vacante['estado_revision'] ?? 'Nueva';
                        $colorEstado = 'secondary';
                        switch($estado){
                        case 'Nueva':
                            $colorEstado = 'primary';
                        break;
                        case 'Revisada':
                            $colorEstado = 'info';
                        break;
                        case 'Aplicada':
                            $colorEstado = 'success';
                        break;
                        case 'Entrevista':
                            $colorEstado = 'warning';
                        break;
                        case 'Oferta':
                            $colorEstado = 'secondary';
                        break;
                        case 'Contratado':
                            $colorEstado = 'dark';
                        break;
                        case 'Descartada':
                            $colorEstado = 'danger';
                        break;
                    }?>
                        <span class="badge bg-<?= $colorEstado ?>"><?= $estado ?></span>
                    </td>
                    <td><?= $vacante['titulo'] ?></td>
                    <td><?= $vacante['empresa'] ?></td>
                    <td><?= $vacante['ubicacion'] ?></td>
                    <td><?= $vacante['modalidad'] ?></td>
                    <td>$<?= $vacante['salario'] ?></td>
                    <td>
                        <a href="editar_vacante.php?id=<?= $vacante['id'] ?>" class="btn btn-warning btn-sm">Editar</a>
                        <a href="cambiar_estado.php?id=<?= $vacante['id'] ?>" class="btn btn-sm btn-warning">Estado</a>
                    </td>
                    <td><?= $vacante['experiencia_requerida'] ?> años</td>
                    <td><?php $color = 'danger';
                            if($vacante['compatibilidad'] >= 80){
                                $color = 'success';
                            }
                            elseif($vacante['compatibilidad'] >= 60){
                                $color = 'warning';
                            }
                        ?>
                        <span class="badge bg-<?= $color ?>"><?= $vacante['compatibilidad'] ?>%</span>
                        <?php if($vacante['compatibilidad'] >= 80): ?>
                            ⭐
                        <?php endif; ?>
                    </td>
                    <td><?= $vacante['fuentes'] ?></td>
                    <td>
                        <?php if(!empty($vacante['url_vacante'])): ?>
                            <a href="<?= $vacante['url_vacante'] ?>" target="_blank" class="btn btn-sm btn-primary">Ver Vacante</a>
                        <?php else: ?>
                            -
                        <?php endif; ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<?php
require_once __DIR__ . '/../layouts/footer.php';
?>