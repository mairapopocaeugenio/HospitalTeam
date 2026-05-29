<?php include '../config/db.php'; ?>
<?php include '../includes/header.php'; ?>
<?php include '../includes/sidebar.php'; ?>

<main class="main-content">
    <?php include '../includes/topbar.php'; ?>

    <div class="container-fluid">
        <h2 class="mb-4">📄 Listado de Recetas</h2>
        <a href="registrar.php" class="btn btn-success mb-3">➕ Nueva receta</a>

        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Paciente</th>
                        <th>Doctor</th>
                        <th>Medicamento</th>
                        <th>Dosis</th>
                        <th>Síntomas</th>
                        <th>Duración (días)</th>
                        <th>Fecha receta</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                $sql = "SELECT r.*, 
                               CONCAT(p.nombre, ' ', p.apellido) AS paciente_nombre,
                               CONCAT(d.nombre, ' ', d.apellido) AS doctor_nombre
                        FROM recetas r
                        JOIN pacientes p ON r.paciente_id = p.id
                        JOIN doctores d ON r.doctor_id = d.id
                        ORDER BY r.fecha_receta DESC";
                $result = $conn->query($sql);
                while ($row = $result->fetch_assoc()):
                ?>
                <tr>
                    <td><?= $row['id'] ?></td>
                    <td><?= $row['paciente_nombre'] ?></td>
                    <td><?= $row['doctor_nombre'] ?></td>
                    <td><?= $row['medicamento'] ?></td>
                    <td><?= $row['dosis'] ?></td>
                    <td><?= nl2br(htmlspecialchars($row['sintomas'])) ?></td>
                    <td><?= $row['duracion_dias'] ?></td>
                    <td><?= date('d/m/Y H:i', strtotime($row['fecha_receta'])) ?></td>
                    <td>
                        <a href="editar.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-primary">✏️ Editar</a>
                        <a href="eliminar.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('¿Eliminar esta receta?')">🗑️ Eliminar</a>
                    </td>
                </tr>
                <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
</main>

<?php include '../includes/footer.php'; ?>