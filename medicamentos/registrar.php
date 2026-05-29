<?php include '../config/db.php'; ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registrar Medicamento</title>
    <link rel="stylesheet" href="../css/estilo.css">
</head>
<body>
<div class="container">
    <h2>💊 Registrar nuevo medicamento</h2>
    <a href="../index.php">⬅ Volver al inicio</a> | <a href="listar.php">📋 Ver medicamentos</a>

    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $nombre = $_POST['nombre'];
        $descripcion = $_POST['descripcion'];
        $presentacion = $_POST['presentacion'];
        $precio = !empty($_POST['precio']) ? $_POST['precio'] : 'NULL';

        $sql = "INSERT INTO medicamentos (nombre, descripcion, presentacion, precio) 
                VALUES ('$nombre', '$descripcion', '$presentacion', $precio)";

        if ($conn->query($sql) === TRUE) {
            echo "<p class='success'>✅ Medicamento registrado correctamente.</p>";
        } else {
            echo "<p class='error'>❌ Error: " . $conn->error . "</p>";
        }
    }
    ?>

    <form method="POST">
        <label>Nombre del medicamento:</label> <input type="text" name="nombre" required><br>
        <label>Descripción:</label> <textarea name="descripcion" rows="2" cols="40"></textarea><br>
        <label>Presentación:</label> <input type="text" name="presentacion" value="Tabletas"><br>
        <label>Precio (opcional):</label> <input type="number" step="0.01" name="precio"><br>
        <button type="submit">Guardar medicamento</button>
    </form>
</div>
</body>
</html>