<?php include '../config/db.php'; ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Lista de Medicamentos</title>
    <link rel="stylesheet" href="../css/estilo.css">
</head>
<body>
<div class="container">
    <h2>📋 Lista de medicamentos</h2>
    <a href="../index.php">⬅ Volver al inicio</a> | <a href="registrar.php">➕ Nuevo medicamento</a>

    <div class="table-responsive">
        <table>
            <thead>
                <tr><th>ID</th><th>Nombre</th><th>Descripción</th><th>Presentación</th><th>Precio</th><th>Acciones</th></tr>
            </thead>
            <tbody>
            <?php
            $result = $conn->query("SELECT * FROM medicamentos ORDER BY nombre");
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>{$row['id']}</td>
                        <td>{$row['nombre']}</td>
                        <td>{$row['descripcion']}</td>
                        <td>{$row['presentacion']}</td>
                        <td>" . ($row['precio'] ? '$' . $row['precio'] : '-') . "</td>
                        <td>
                            <a href='editar.php?id={$row['id']}' class='btn' style='background:#3b82f6; padding:4px 12px;'>✏️ Editar</a>
                            <a href='eliminar.php?id={$row['id']}' class='btn btn-danger' style='padding:4px 12px;' onclick='return confirm(\"¿Eliminar este medicamento?\")'>🗑️ Eliminar</a>
                        </td>
                      </tr>";
            }
            ?>
            </tbody>
        </table>
    </div>
</div>
</body>
</html>