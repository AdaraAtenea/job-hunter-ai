<?php
require_once __DIR__ . '/../layouts/header.php';
require_once __DIR__ . '/../layouts/sidebar.php';
?>

<h1>Nueva Vacante</h1>
    <form method="POST" action="../controllers/VacantesController.php">
        <div class="mb-3">
            <label class="form-label">Título</label>
            <input type="text" name="titulo" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Empresa</label>
            <input type="text" name="empresa" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Ubicación</label>
            <input type="text" name="ubicacion" class="form-control">
        </div>
        <div class="mb-3">
            <label class="form-label">Modalidad</label>
            <select name="modalidad" class="form-select">
                <option value="Presencial">Presencial</option>
                <option value="Remoto">Remoto</option>
                <option value="Hibrido">Híbrido</option>
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label">Salario</label>
            <input type="text" name="salario" class="form-control">
        </div>
        <div class="mb-3">
            <label class="form-label">Descripción</label>
            <textarea name="descripcion" class="form-control" rows="4"></textarea>
        </div>
        <button type="submit" class="btn btn-success">Guardar Vacante</button>
    </form>

<?php
require_once __DIR__ . '/../layouts/footer.php';
?>