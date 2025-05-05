<?php
include 'conexion.php';

if (isset($_POST['descripcion'])) {
    $descripcion = $conn->real_escape_string($_POST['descripcion']);
    $conn->query("INSERT INTO tareas (descripcion) VALUES ('$descripcion')");
}

header("Location: index.php");
exit;
?>

