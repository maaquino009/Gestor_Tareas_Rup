<?php
include 'conexion.php';
$id = $_GET['id'];
$tarea = $conn->query("SELECT * FROM tareas WHERE id=$id")->fetch_assoc();

if ($_POST) {
    $descripcion = $_POST['descripcion'];
    $estado = $_POST['estado'];
    $conn->query("UPDATE tareas SET descripcion='$descripcion', estado='$estado' WHERE id=$id");
    header("Location: dashboard.php");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Editar Tarea</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="container mt-5">
    <h2>Editar Tarea</h2>
    <form method="post">
        <div class="mb-3">
            <label>Descripción</label>
            <input type="text" name="descripcion" class="form-control" value="<?php echo $tarea['descripcion']; ?>" required>
        </div>
        <div class="mb-3">
            <label>Estado</label>
            <select name="estado" class="form-control">
                <option value="pendiente" <?php if($tarea['estado']=='pendiente') echo 'selected'; ?>>Pendiente</option>
                <option value="en progreso" <?php if($tarea['estado']=='en progreso') echo 'selected'; ?>>En progreso</option>
                <option value="completado" <?php if($tarea['estado']=='completado') echo 'selected'; ?>>Completado</option>
            </select>
        </div>
        <button class="btn btn-primary">Actualizar</button>
    </form>
</body>
</html>
