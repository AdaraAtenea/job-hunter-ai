<?php

require_once __DIR__ . '/../controllers/AplicacionesController.php';

$controller = new AplicacionesController();

$aplicaciones = $controller->listar();

require_once __DIR__ . '/../layouts/header.php';
require_once __DIR__ . '/../layouts/sidebar.php';

?>

<div class="container-fluid">
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
                <td>
                    <?= date('d/m/Y', strtotime($aplicacion['fecha_aplicacion'])) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php
require_once __DIR__ . '/../layouts/footer.php';
?>