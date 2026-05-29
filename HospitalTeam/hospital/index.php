<?php include 'config/db.php'; ?>

<?php include 'includes/header.php'; ?>

<div class="dashboard">

    <?php include 'includes/sidebar.php'; ?>

    <main class="main-content">

        <?php include 'includes/topbar.php'; ?>

        <section class="stats">

            <div class="card">

                <div class="icon blue">
                    <i class="fa-solid fa-user-injured"></i>
                </div>

                <div>

                    <h3>Pacientes</h3>

                    <span>

                    <?php
                    $result = $conn->query("
                    SELECT COUNT(*) as total
                    FROM pacientes");

                    $row = $result->fetch_assoc();

                    echo $row['total'];
                    ?>

                    </span>

                </div>

            </div>

            <div class="card">

                <div class="icon green">
                    <i class="fa-solid fa-user-doctor"></i>
                </div>

                <div>

                    <h3>Doctores</h3>

                    <span>

                    <?php
                    $result = $conn->query("
                    SELECT COUNT(*) as total
                    FROM doctores");

                    $row = $result->fetch_assoc();

                    echo $row['total'];
                    ?>

                    </span>

                </div>

            </div>

            <div class="card">

                <div class="icon orange">
                    <i class="fa-solid fa-calendar-check"></i>
                </div>

                <div>

                    <h3>Citas</h3>

                    <span>

                    <?php
                    $result = $conn->query("
                    SELECT COUNT(*) as total
                    FROM citas");

                    $row = $result->fetch_assoc();

                    echo $row['total'];
                    ?>

                    </span>

                </div>

            </div>

        </section>

    </main>

</div>

<?php include 'includes/footer.php'; ?>