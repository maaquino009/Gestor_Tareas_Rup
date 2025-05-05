<?php
include 'conexion.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $conn->query("DELETE FROM tareas WHERE id = $id");
}

header("Location: index.php");
exit;
?>

