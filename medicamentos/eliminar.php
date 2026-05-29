<?php
include '../config/db.php';
$id = $_GET['id'];
$conn->query("DELETE FROM medicamentos WHERE id=$id");
header("Location: listar.php");
exit;
?>