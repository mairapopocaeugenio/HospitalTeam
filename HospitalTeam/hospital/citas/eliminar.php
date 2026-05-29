<?php include '../config/db.php'; ?>

<?php

$id = $_GET['id'];

$conn->query("
    DELETE FROM citas
    WHERE id = $id
");

header("Location: listar.php");
exit;

?>