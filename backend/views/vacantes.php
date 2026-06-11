<?php
require_once __DIR__ . '/../controllers/VacantesController.php';
$controller = new VacantesController();
$vacantes = $controller->listar();

require_once __DIR__ . '/../layouts/header.php';
require_once __DIR__ . '/../layouts/sidebar.php';
?>

<!-- CONTENIDO DE LA PAGINA -->
<div class="container mt-4">
    <h1>Vacantes Registradas</h1>
    <div class="alert alert-info">
        Total de vacantes:
        <strong><?= count($vacantes) ?></strong>
    </div>
    <a href="nueva_vacante.php" class="btn btn-success mb-3">+ Nueva Vacante</a>
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