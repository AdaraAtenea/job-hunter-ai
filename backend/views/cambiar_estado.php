<?php
require_once __DIR__ . '/../layouts/header.php';
require_once __DIR__ . '/../layouts/sidebar.php';
require_once __DIR__ . '/../controllers/VacantesController.php';

$controller = new VacantesController();
$id = $_GET['id'];
$vacante = $controller->obtenerPorId($id);

?>

<div class="container mt-4">
    <h2>Cambiar Estado de Vacante</h2>
    <div class="alert alert-info">
        <strong><?= $vacante['titulo'] ?></strong>
        <br>
        <?= $vacante['empresa'] ?>
    </div>
    <form method="POST" action="../controllers/VacantesController.php">
        <input type="hidden" name="id" value="<?= $id ?>">
            <div class="mb-3">
                <label class="form-label">Estado</label>
                <select name="estado_revision" class="form-select">
                    <option value="Nueva"
                        <?= $vacante['estado_revision'] == 'Nueva' ? 'selected' : '' ?>>✨ Nueva
                    </option>
                    <option value="Revisada"
                        <?= $vacante['estado_revision'] == 'Revisada' ? 'selected' : '' ?>>👁️ Revisada
                    </option>
                    <option value="Aplicada"
                        <?= $vacante['estado_revision'] == 'Aplicada' ? 'selected' : '' ?>>✅ Aplicada
                    </option>
                    <option value="Entrevista"
                        <?= $vacante['estado_revision'] == 'Entrevista' ? 'selected' : '' ?>>📅 Entrevista
                    </option>
                    <option value="Oferta"
                        <?= $vacante['estado_revision'] == 'Oferta' ? 'selected' : '' ?>>🤝 Oferta
                    </option>
                    <option value="Contratado"
                        <?= $vacante['estado_revision'] == 'Contratado' ? 'selected' : '' ?>>🎉 Contratado
                    </option>
                    <option value="Descartada"
                        <?= $vacante['estado_revision'] == 'Descartada' ? 'selected' : '' ?>>❌ Descartada
                    </option>
                </select>
            </div>
            <button type="submit" name="actualizar_estado" class="btn btn-success">Guardar Estado</button>
    </form>
</div>

<?php
require_once __DIR__ . '/../layouts/footer.php';
?>