<?php include '../config/db.php'; ?>
<?php include '../includes/header.php'; ?>

<div class="dashboard">

<?php include '../includes/sidebar.php'; ?>

<main class="main-content">

<?php include '../includes/topbar.php'; ?>

<div class="table-container">

    <div class="table-header">

        <h2>Citas Agendadas</h2>

        <a href="registrar.php" class="btn-primary">
            + Nueva Cita
        </a>

    </div>

    <table>

        <thead>
            <tr>
                <th>ID</th>
                <th>Paciente</th>
                <th>Doctor</th>
                <th>Fecha y hora</th>
                <th>Motivo</th>
                <th>Acciones</th>
            </tr>
        </thead>

        <tbody>

        <?php

        $sql = "
            SELECT c.id,
                   CONCAT(p.nombre, ' ', p.apellido) AS paciente,
                   CONCAT(d.nombre, ' ', d.apellido, ' (', d.especialidad, ')') AS doctor,
                   c.fecha_hora,
                   c.motivo
            FROM citas c
            JOIN pacientes p ON c.paciente_id = p.id
            JOIN doctores d ON c.doctor_id = d.id
            ORDER BY c.fecha_hora DESC
        ";

        $result = $conn->query($sql);

        while ($row = $result->fetch_assoc()) {
        ?>

        <tr>

            <td><?= $row['id'] ?></td>

            <td><?= $row['paciente'] ?></td>

            <td><?= $row['doctor'] ?></td>

            <td><?= $row['fecha_hora'] ?></td>

            <td><?= $row['motivo'] ?></td>

            <td>

                <a class="btn-edit"
                   href="editar.php?id=<?= $row['id'] ?>">
                    Editar
                </a>

                <a class="btn-delete"
                   href="eliminar.php?id=<?= $row['id'] ?>"
                   onclick="return confirm('¿Eliminar cita?')">
                    Eliminar
                </a>

            </td>

        </tr>

        <?php } ?>

        </tbody>

    </table>

</div>

</main>
</div>

<?php include '../includes/footer.php'; ?>