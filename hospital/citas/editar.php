<?php include '../config/db.php'; ?>

<?php

$id = $_GET['id'];

$result = $conn->query("
    SELECT * FROM citas
    WHERE id = $id
");

$cita = $result->fetch_assoc();

if (!$cita) {
    die("Cita no encontrada.");
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $paciente_id = $_POST['paciente_id'];
    $doctor_id = $_POST['doctor_id'];
    $fecha_hora = $_POST['fecha_hora'];
    $motivo = $_POST['motivo'];

    $sql = "
        UPDATE citas SET
            paciente_id='$paciente_id',
            doctor_id='$doctor_id',
            fecha_hora='$fecha_hora',
            motivo='$motivo'
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

    <h2>Editar Cita</h2>

    <a href="listar.php">⬅ Volver a citas</a>

    <form method="POST">

        <div class="form-group">

            <label>Paciente</label>

            <select name="paciente_id" required>

                <?php
                $pacientes = $conn->query("
                    SELECT id, nombre, apellido
                    FROM pacientes
                    ORDER BY apellido
                ");

                while ($p = $pacientes->fetch_assoc()) {

                    $selected = ($p['id'] == $cita['paciente_id']) ? 'selected' : '';

                    echo "<option value='{$p['id']}' $selected>
                            {$p['nombre']} {$p['apellido']}
                          </option>";
                }
                ?>

            </select>

        </div>

        <div class="form-group">

            <label>Doctor</label>

            <select name="doctor_id" required>

                <?php
                $doctores = $conn->query("
                    SELECT id, nombre, apellido, especialidad
                    FROM doctores
                    ORDER BY apellido
                ");

                while ($d = $doctores->fetch_assoc()) {

                    $selected = ($d['id'] == $cita['doctor_id']) ? 'selected' : '';

                    echo "<option value='{$d['id']}' $selected>
                            {$d['nombre']} {$d['apellido']} - {$d['especialidad']}
                          </option>";
                }
                ?>

            </select>

        </div>

        <div class="form-group">

            <label>Fecha y hora</label>

            <input type="datetime-local"
                   name="fecha_hora"
                   value="<?= date('Y-m-d\TH:i', strtotime($cita['fecha_hora'])) ?>"
                   required>

        </div>

        <div class="form-group">

            <label>Motivo</label>

            <textarea name="motivo" rows="3"><?= htmlspecialchars($cita['motivo']) ?></textarea>

        </div>

        <button type="submit" class="btn-primary">
            Actualizar cita
        </button>

    </form>

</div>

</main>
</div>

<?php include '../includes/footer.php'; ?>