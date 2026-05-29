<?php include '../config/db.php';
$id = $_GET['id'];
$result = $conn->query("SELECT * FROM medicamentos WHERE id=$id");
$med = $result->fetch_assoc();
if (!$med) { die("Medicamento no encontrado"); }

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $presentacion = $_POST['presentacion'];
    $precio = !empty($_POST['precio']) ? $_POST['precio'] : 'NULL';
    $sql = "UPDATE medicamentos SET nombre='$nombre', descripcion='$descripcion', presentacion='$presentacion', precio=$precio WHERE id=$id";
    if ($conn->query($sql)) {
        header("Location: listar.php");
        exit;
    } else { echo "Error: " . $conn->error; }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Medicamento</title>
    <link rel="stylesheet" href="../css/estilo.css">
</head>
<body>
<div class="container">
    <h2>✏️ Editar medicamento</h2>
    <a href="listar.php">⬅ Volver al listado</a>
    <form method="POST">
        <label>Nombre:</label> <input type="text" name="nombre" value="<?= htmlspecialchars($med['nombre']) ?>" required><br>
        <label>Descripción:</label> <textarea name="descripcion" rows="2"><?= htmlspecialchars($med['descripcion']) ?></textarea><br>
        <label>Presentación:</label> <input type="text" name="presentacion" value="<?= htmlspecialchars($med['presentacion']) ?>"><br>
        <label>Precio:</label> <input type="number" step="0.01" name="precio" value="<?= $med['precio'] ?>"><br>
        <button type="submit">Actualizar</button>
        <a href="listar.php" class="btn btn-cancel">Cancelar</a>
    </form>
</div>
</body>
</html>