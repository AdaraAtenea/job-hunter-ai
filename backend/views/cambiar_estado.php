<?php
require_once __DIR__ . '/../layouts/header.php';
require_once __DIR__ . '/../layouts/sidebar.php';
$id = $_GET['id'];
?>

<div class="container mt-4">
    <h2>Cambiar Estado de Vacante</h2>
    <form method="POST" action="../controllers/VacantesController.php">
        <input type="hidden" name="id" value="<?= $id ?>">
            <div class="mb-3">
                <label class="form-label">Estado</label>
                <select name="estado_revision" class="form-select">
                    <option value="Nueva">Nueva</option>
                    <option value="Revisada">Revisada</option>
                    <option value="Aplicada">Aplicada</option>
                    <option value="Descartada">Descartada</option>
                </select>
            </div>
            <button type="submit" name="actualizar_estado" class="btn btn-success">Guardar Estado</button>
    </form>
</div>

<?php
require_once __DIR__ . '/../layouts/footer.php';
?>