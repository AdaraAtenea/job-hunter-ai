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

    <a href="nueva_vacante.php" class="btn btn-success mb-3">
        + Nueva Vacante
    </a>

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
                    <th>Acciones</th>
                    <th>Compatibilidad</th>
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
                    <td>$<?= $vacante['salario'] ?></td>
                    <td>
                        <a href="editar_vacante.php?id=<?= $vacante['id'] ?>" class="btn btn-warning btn-sm">Editar</a>
                    </td>
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
                        <?php endif; ?></span>
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