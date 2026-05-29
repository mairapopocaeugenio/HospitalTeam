<?php include '../config/db.php'; ?>
<?php include '../includes/header.php'; ?>
<?php include '../includes/sidebar.php'; ?>

<main class="main-content">
    <?php include '../includes/topbar.php'; ?>

    <div class="container-fluid">
        <h2 class="mb-4">✏️ Editar Receta</h2>

        <?php
        $id = $_GET['id'];
        $result = $conn->query("SELECT * FROM recetas WHERE id = $id");
        $receta = $result->fetch_assoc();
        if (!$receta) {
            echo "<div class='alert alert-danger'>Receta no encontrada</div>";
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $paciente_id = $_POST['paciente_id'];
            $doctor_id = $_POST['doctor_id'];
            $medicamento = $_POST['medicamento'];
            $dosis = $_POST['dosis'];
            $sintomas = $_POST['sintomas'];
            $duracion_dias = $_POST['duracion_dias'];

            $sql = "UPDATE recetas SET 
                    paciente_id = '$paciente_id',
                    doctor_id = '$doctor_id',
                    medicamento = '$medicamento',
                    dosis = '$dosis',
                    sintomas = '$sintomas',
                    duracion_dias = '$duracion_dias'
                    WHERE id = $id";

            if ($conn->query($sql) === TRUE) {
                echo "<div class='alert alert-success'>✅ Receta actualizada correctamente.</div>";
                // Redirigir después de 2 segundos
                header("refresh:2;url=listar.php");
            } else {
                echo "<div class='alert alert-danger'>❌ Error: " . $conn->error . "</div>";
            }
        }
        ?>

        <form method="POST">
            <div class="mb-3">
                <label class="form-label">Paciente</label>
                <select name="paciente_id" class="form-select" required>
                    <?php
                    $pacientes = $conn->query("SELECT id, nombre, apellido FROM pacientes ORDER BY apellido");
                    while($p = $pacientes->fetch_assoc()) {
                        $selected = ($p['id'] == $receta['paciente_id']) ? 'selected' : '';
                        echo "<option value='{$p['id']}' $selected>{$p['nombre']} {$p['apellido']}</option>";
                    }
                    ?>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Doctor</label>
                <select name="doctor_id" class="form-select" required>
                    <?php
                    $doctores = $conn->query("SELECT id, nombre, apellido, especialidad FROM doctores ORDER BY apellido");
                    while($d = $doctores->fetch_assoc()) {
                        $selected = ($d['id'] == $receta['doctor_id']) ? 'selected' : '';
                        echo "<option value='{$d['id']}' $selected>{$d['nombre']} {$d['apellido']} - {$d['especialidad']}</option>";
                    }
                    ?>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Medicamento</label>
                <input type="text" name="medicamento" class="form-control" value="<?= $receta['medicamento'] ?>" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Dosis</label>
                <input type="text" name="dosis" class="form-control" value="<?= $receta['dosis'] ?>" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Síntomas / Diagnóstico</label>
                <textarea name="sintomas" rows="4" class="form-control" required><?= $receta['sintomas'] ?></textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Duración (días)</label>
                <input type="number" name="duracion_dias" class="form-control" value="<?= $receta['duracion_dias'] ?>" min="1" max="365" required>
            </div>

            <button type="submit" class="btn btn-primary">Actualizar</button>
            <a href="listar.php" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
</main>

<?php include '../includes/footer.php'; ?>