<?php include '../config/db.php'; ?>

<?php

$id = $_GET['id'];

$result = $conn->query("
    SELECT * FROM doctores
    WHERE id = $id
");

$doctor = $result->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $especialidad = $_POST['especialidad'];
    $telefono = $_POST['telefono'];
    $email = $_POST['email'];

    $sql = "
        UPDATE doctores SET
            nombre='$nombre',
            apellido='$apellido',
            especialidad='$especialidad',
            telefono='$telefono',
            email='$email'
        WHERE id=$id
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

    <h2>Editar Doctor</h2>

    <form method="POST">

        <div class="form-group">
            <label>Nombre</label>
            <input type="text" name="nombre" value="<?= $doctor['nombre'] ?>" required>
        </div>

        <div class="form-group">
            <label>Apellido</label>
            <input type="text" name="apellido" value="<?= $doctor['apellido'] ?>" required>
        </div>

        <div class="form-group">
            <label>Especialidad</label>
            <input type="text" name="especialidad" value="<?= $doctor['especialidad'] ?>" required>
        </div>

        <div class="form-group">
            <label>Teléfono</label>
            <input type="text" name="telefono" value="<?= $doctor['telefono'] ?>">
        </div>

        <div class="form-group">
            <label>Email</label>
            <input type="email" name="email" value="<?= $doctor['email'] ?>">
        </div>

        <button type="submit" class="btn-primary">
            Actualizar Doctor
        </button>

    </form>

</div>

</main>
</div>

<?php include '../includes/footer.php'; ?>