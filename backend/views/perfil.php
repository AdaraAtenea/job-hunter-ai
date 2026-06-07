<?php
require_once __DIR__ . '/../layouts/header.php';
require_once __DIR__ . '/../layouts/sidebar.php';
?>

<h1>Mi Perfil Profesional</h1>
    <form method="POST" action="../controllers/PerfilController.php">
        <div class="mb-3">
            <label>Nombre Profesional</label>
            <input type="text" name="nombre_profesional" class="form-control" value="Desarrollador Web">
        </div>
    
        <div class="mb-3">
            <label>Años de Experiencia</label>
            <input type="number" step="0.1" name="experiencia_anios" class="form-control" value="1.5">
        </div>
    
        <div class="mb-3">
            <label>Salario Mínimo</label>
            <input type="number" name="salario_minimo" class="form-control" value="14500">
        </div>
        
        <div class="mb-3">
            <label>Salario Ideal</label>
            <input type="number" name="salario_ideal" class="form-control" value="17500">
        </div>
        
        <div class="mb-3">
            <label>Ubicaciones</label>
            <textarea name="ubicaciones" class="form-control" rows="3">CDMX, Remoto, Remoto Internacional</textarea>
        </div>

        <div class="mb-3">
            <label>Tecnologías</label>
            <textarea name="tecnologias" class="form-control" rows="5">PHP, MySQL, JavaScript, Bootstrap, Git, GitHub, HTML, CSS</textarea>
        </div>
        
        <button type="submit" class="btn btn-success">Guardar Perfil</button>
    </form>

<?php
require_once __DIR__ . '/../layouts/footer.php';
?>