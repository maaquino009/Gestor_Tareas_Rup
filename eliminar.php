<?php
include 'conexion.php';
$id = $_GET['id'];
$conn->query("DELETE FROM tareas WHERE id=$id");
header("Location: dashboard.php");
?>
