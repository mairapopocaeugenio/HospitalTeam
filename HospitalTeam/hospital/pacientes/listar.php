<?php include '../config/db.php'; ?>
<?php include '../includes/header.php'; ?>

<div class="dashboard">

<?php include '../includes/sidebar.php'; ?>

<main class="main-content">

<?php include '../includes/topbar.php'; ?>

<div class="table-container">

    <div class="table-header">

        <h2>Pacientes Registrados</h2>

        <a href="registrar.php" class="btn-primary">
            + Nuevo Paciente
        </a>

    </div>

    <table>

        <thead>

            <tr>

                <th>ID</th>
                <th>Paciente</th>
                <th>Fecha Nac.</th>
                <th>Teléfono</th>
                <th>Email</th>
                <th>Acciones</th>

            </tr>

        </thead>

        <tbody>

        <?php

        $result = $conn->query("
        SELECT * FROM pacientes
        ORDER BY id DESC");

        while ($row = $result->fetch_assoc()) {

        ?>

        <tr>

            <td><?= $row['id'] ?></td>

            <td>

                <div class="patient-info">

                    <div class="avatar">
                        <?= strtoupper(substr($row['nombre'],0,1)) ?>
                    </div>

                    <div>

                        <strong>
                            <?= $row['nombre'] ?>
                            <?= $row['apellido'] ?>
                        </strong>

                    </div>

                </div>

            </td>

            <td><?= $row['fecha_nac'] ?></td>

            <td><?= $row['telefono'] ?></td>

            <td><?= $row['email'] ?></td>

            <td>

                <a class="btn-edit"
                href="editar.php?id=<?= $row['id'] ?>">
                    Editar
                </a>

                <a class="btn-delete"
                href="eliminar.php?id=<?= $row['id'] ?>"
                onclick="return confirm('¿Eliminar paciente?')">

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