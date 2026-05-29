<?php include '../config/db.php'; ?>
<?php include '../includes/header.php'; ?>

<div class="dashboard">

<?php include '../includes/sidebar.php'; ?>

<main class="main-content">

<?php include '../includes/topbar.php'; ?>

<div class="form-box">

    <h2>Registrar Paciente</h2>

    <?php

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        $nombre = $_POST['nombre'];
        $apellido = $_POST['apellido'];
        $fecha_nac = $_POST['fecha_nac'];
        $telefono = $_POST['telefono'];
        $email = $_POST['email'];

        $sql = "INSERT INTO pacientes
        (nombre, apellido, fecha_nac, telefono, email)

        VALUES
        ('$nombre','$apellido','$fecha_nac','$telefono','$email')";

        if($conn->query($sql) === TRUE){

            echo "
            <div class='success'>
                Paciente registrado correctamente
            </div>";
        }
    }

    ?>

    <form method="POST">

        <div class="form-group">
            <label>Nombre</label>
            <input type="text" name="nombre" required>
        </div>

        <div class="form-group">
            <label>Apellido</label>
            <input type="text" name="apellido" required>
        </div>

        <div class="form-group">
            <label>Fecha de nacimiento</label>
            <input type="date" name="fecha_nac" required>
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
            Guardar Paciente
        </button>

    </form>

</div>

</main>
</div>

<?php include '../includes/footer.php'; ?>