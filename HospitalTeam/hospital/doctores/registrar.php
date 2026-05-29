<?php include '../config/db.php'; ?>

<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $especialidad = $_POST['especialidad'];
    $telefono = $_POST['telefono'];
    $email = $_POST['email'];

    $sql = "
        INSERT INTO doctores (nombre, apellido, especialidad, telefono, email)
        VALUES ('$nombre', '$apellido', '$especialidad', '$telefono', '$email')
    ";

    if ($conn->query($sql) === TRUE) {
        header("Location: listar.php");
        exit;
    } else {
        echo "Error: " . $conn->error;
    }
}

?>

<?php include '../includes/header.php'; ?>

<div class="dashboard">

<?php include '../includes/sidebar.php'; ?>

<main class="main-content">

<?php include '../includes/topbar.php'; ?>

<div class="form-box">

    <h2>Registrar Doctor</h2>

    <form method="POST">

        <div class="form-group">
            <label>Nombre</label>
            <input type="text" name="nombre">
        </div>

        <div class="form-group">
            <label>Apellido</label>
            <input type="text" name="apellido">
        </div>

        <div class="form-group">
            <label>Especialidad</label>
            <input type="text" name="especialidad">
        </div>

        <div class="form-group">
            <label>Teléfono</label>
            <input type="text" name="telefono">
        </div>

        <div class="form-group">
            <label>Email</label>
            <input type="email" name="email">
        </div>

        <button type="submit" class="btn-primary">
            Guardar Doctor
        </button>

    </form>

</div>

</main>
</div>

<?php include '../includes/footer.php'; ?>