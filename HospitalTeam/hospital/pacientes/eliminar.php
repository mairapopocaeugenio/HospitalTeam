<?php

include '../config/db.php';

$id = $_GET['id'];

$conn->query("
DELETE FROM pacientes
WHERE id = $id");

header("Location: listar.php");

exit;

?>