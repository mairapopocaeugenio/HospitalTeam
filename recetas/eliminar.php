<?php
include '../config/db.php';
$id = $_GET['id'];
$conn->query("DELETE FROM recetas WHERE id = $id");
header("Location: listar.php");
exit;
?>