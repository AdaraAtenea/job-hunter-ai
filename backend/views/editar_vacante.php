<?php
require_once __DIR__ . '/../controllers/VacantesController.php';

$controller = new VacantesController();
$id = $_GET['id'];
$vacante = $controller->obtenerPorId($id);

require_once __DIR__ . '/../layouts/header.php';
require_once __DIR__ . '/../layouts/sidebar.php';
?>

<h1>Editar Vacante</h1>
    <form method="POST">
        <input type="hidden" name="actualizar" value="1">
        <input type="hidden" name="id" value="<?= $vacante['id'] ?>">
        <div class="mb-3">    
            <label>Título</label>
            <input type="text" name="titulo" class="form-control" value="<?= $vacante['titulo'] ?>" >
        </div>
        <div class="mb-3">
            <label>Empresa</label>
            <input type="text" name="empresa" class="form-control" value="<?= $vacante['empresa'] ?>" >
        </div>
        <button type="submit" class="btn btn-primary">Guardar Cambios</button>
    </form>

<?php
require_once __DIR__ . '/../layouts/footer.php';
?>