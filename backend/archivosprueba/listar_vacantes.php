<?php

require_once '../config/database.php';

$sql = "SELECT * FROM vacantes ORDER BY id DESC";

$stmt = $conexion->prepare($sql);
$stmt->execute();

$vacantes = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Vacantes Job Hunter IA</title>

    <style>
        body{
            font-family: Arial;
            margin:40px;
        }
        table{
            width:100%;
            border-collapse:collapse;
        }
        th, td{
            border:1px solid #ccc;
            padding:10px;
            text-align:left;
        }
        th{
            background:#f2f2f2;
        }
    </style>
</head>

<body>
    <h1>Vacantes Registradas</h1>
    
    <table>
        <tr>
            <th>ID</th>
            <th>Puesto</th>
            <th>Empresa</th>
            <th>Ubicación</th>
            <th>Modalidad</th>
            <th>Salario</th>
            <th>Descripción</th>
        </tr>

        <?php foreach($vacantes as $vacante): ?>

            <tr>
                <td><?= $vacante['id'] ?></td>
                <td><?= $vacante['titulo'] ?></td>
                <td><?= $vacante['empresa'] ?></td>
                <td><?= $vacante['ubicacion'] ?></td>
                <td><?= $vacante['modalidad'] ?></td>
                <td><?= $vacante['salario'] ?></td>
                <td><?= $vacante['descripcion'] ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>