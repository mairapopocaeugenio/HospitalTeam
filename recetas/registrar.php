<?php include '../config/db.php'; ?>
<?php include '../includes/header.php'; ?>
<?php include '../includes/sidebar.php'; ?>

<main class="main-content">
    <?php include '../includes/topbar.php'; ?>

    <div class="container-fluid">
        <h2 class="mb-4">📋 Nueva Receta Médica</h2>

        <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $paciente_id = $_POST['paciente_id'];
            $doctor_id = $_POST['doctor_id'];
            $medicamento = $_POST['medicamento'];
            $dosis = $_POST['dosis'];
            $sintomas = $_POST['sintomas'];
            $duracion_dias = $_POST['duracion_dias'];

            $sql = "INSERT INTO recetas (paciente_id, doctor_id, medicamento, dosis, sintomas, duracion_dias) 
                    VALUES ('$paciente_id', '$doctor_id', '$medicamento', '$dosis', '$sintomas', '$duracion_dias')";

            if ($conn->query($sql) === TRUE) {
                echo "<div class='alert alert-success'>✅ Receta registrada correctamente.</div>";
            } else {
                echo "<div class='alert alert-danger'>❌ Error: " . $conn->error . "</div>";
            }
        }
        ?>

        <form method="POST" class="needs-validation" novalidate>
            <div class="mb-3">
                <label for="paciente_id" class="form-label">Paciente</label>
                <select name="paciente_id" id="paciente_id" class="form-select" required>
                    <option value="">-- Seleccione paciente --</option>
                    <?php
                    $pacientes = $conn->query("SELECT id, nombre, apellido FROM pacientes ORDER BY apellido");
                    while($p = $pacientes->fetch_assoc()) {
                        echo "<option value='{$p['id']}'>{$p['nombre']} {$p['apellido']}</option>";
                    }
                    ?>
                </select>
            </div>

            <div class="mb-3">
                <label for="doctor_id" class="form-label">Doctor</label>
                <select name="doctor_id" id="doctor_id" class="form-select" required>
                    <option value="">-- Seleccione doctor --</option>
                    <?php
                    $doctores = $conn->query("SELECT id, nombre, apellido, especialidad FROM doctores ORDER BY apellido");
                    while($d = $doctores->fetch_assoc()) {
                        echo "<option value='{$d['id']}'>{$d['nombre']} {$d['apellido']} - {$d['especialidad']}</option>";
                    }
                    ?>
                </select>
            </div>

            <div class="mb-3">
                <label for="medicamento" class="form-label">Medicamento</label>
                <input type="text" name="medicamento" id="medicamento" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="dosis" class="form-label">Dosis</label>
                <input type="text" name="dosis" id="dosis" class="form-control" placeholder="Ej: 500mg cada 8 horas" required>
            </div>

            <div class="mb-3">
                <label for="sintomas" class="form-label">Síntomas / Diagnóstico</label>
                <textarea name="sintomas" id="sintomas" rows="4" class="form-control" required></textarea>
            </div>

            <div class="mb-3">
                <label for="duracion_dias" class="form-label">Duración (días)</label>
                <input type="number" name="duracion_dias" id="duracion_dias" class="form-control" min="1" max="365" required>
            </div>

            <button type="submit" class="btn btn-primary">Guardar Receta</button>
            <a href="listar.php" class="btn btn-secondary">Ver listado</a>
        </form>
    </div>
</main>

<?php include '../includes/footer.php'; ?>