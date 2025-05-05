<?php
include 'conexion.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $conn->query("UPDATE tareas SET completado = 1 WHERE id = $id");
}

header("Location: index.php");
exit;
?>

