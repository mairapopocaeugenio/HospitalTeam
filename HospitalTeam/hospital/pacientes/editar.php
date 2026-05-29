<?php include '../config/db.php'; ?>

<?php

$id = $_GET['id'];

$result = $conn->query("
SELECT * FROM pacientes
WHERE id = $id");

$paciente = $result->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $fecha_nac = $_POST['fecha_nac'];
    $telefono = $_POST['telefono'];
    $email = $_POST['email'];

    $sql = "UPDATE pacientes SET

    nombre='$nombre',
    apellido='$apellido',
    fecha_nac='$fecha_nac',
    telefono='$telefono',
    email='$email'

    WHERE id=$id";

    if ($conn->query($sql) === TRUE) {

        header("Location: listar.php");
        exit;
    }
}

?>

<?php include '../includes/header.php'; ?>

<div class="dashboard">

<?php include '../includes/sidebar.php'; ?>

<main class="main-content">

<?php include '../includes/topbar.php'; ?>

<div class="form-box">

    <h2>Editar Paciente</h2>

    <form method="POST">

        <div class="form-group">

            <label>Nombre</label>

            <input type="text"
            name="nombre"
            value="<?= $paciente['nombre'] ?>"
            required>

        </div>

        <div class="form-group">

            <label>Apellido</label>

            <input type="text"
            name="apellido"
            value="<?= $paciente['apellido'] ?>"
            required>

        </div>

        <div class="form-group">

            <label>Fecha de nacimiento</label>

            <input type="date"
            name="fecha_nac"
            value="<?= $paciente['fecha_nac'] ?>"
            required>

        </div>

        <div class="form-group">

            <label>Teléfono</label>

            <input type="text"
            name="telefono"
            value="<?= $paciente['telefono'] ?>">

        </div>

        <div class="form-group">

            <label>Email</label>

            <input type="email"
            name="email"
            value="<?= $paciente['email'] ?>">

        </div>

        <button type="submit"
        class="btn-primary">

            Actualizar Paciente

        </button>

    </form>

</div>

</main>
</div>

<?php include '../includes/footer.php'; ?>