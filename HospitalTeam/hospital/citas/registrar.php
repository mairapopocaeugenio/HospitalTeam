<?php include '../config/db.php'; ?>

<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $paciente_id = $_POST['paciente_id'];
    $doctor_id = $_POST['doctor_id'];
    $fecha_hora = $_POST['fecha_hora'];
    $motivo = $_POST['motivo'];

    $sql = "
        INSERT INTO citas (paciente_id, doctor_id, fecha_hora, motivo)
        VALUES ('$paciente_id', '$doctor_id', '$fecha_hora', '$motivo')
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

    <h2>Nueva Cita</h2>

    <form method="POST">

        <div class="form-group">

            <label>Paciente</label>

            <select name="paciente_id" required>

                <?php
                $pacientes = $conn->query("SELECT * FROM pacientes");

                while ($p = $pacientes->fetch_assoc()) {
                    echo "
                        <option value='{$p['id']}'>
                            {$p['nombre']} {$p['apellido']}
                        </option>
                    ";
                }
                ?>

            </select>

        </div>

        <div class="form-group">

            <label>Doctor</label>

            <select name="doctor_id" required>

                <?php
                $doctores = $conn->query("SELECT * FROM doctores");

                while ($d = $doctores->fetch_assoc()) {
                    echo "
                        <option value='{$d['id']}'>
                            {$d['nombre']} {$d['apellido']}
                        </option>
                    ";
                }
                ?>

            </select>

        </div>

        <div class="form-group">

            <label>Fecha y hora</label>

            <input type="datetime-local"
                   name="fecha_hora"
                   required>

        </div>

        <div class="form-group">

            <label>Motivo</label>

            <textarea name="motivo"></textarea>

        </div>

        <button type="submit" class="btn-primary">
            Guardar Cita
        </button>

    </form>

</div>

</main>
</div>

<?php include '../includes/footer.php'; ?>