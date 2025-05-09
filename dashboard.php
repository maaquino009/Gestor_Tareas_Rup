<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit;
}

include 'conexion.php';

if ($_POST) {
    $descripcion = $_POST['descripcion'];
    $conn->query("INSERT INTO tareas (descripcion) VALUES ('$descripcion')");
    header("Location: dashboard.php");
}

$tareas = $conn->query("SELECT * FROM tareas");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Panel de Tareas</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="container mt-5">
    <h2>Bienvenido, <?php echo $_SESSION['usuario']; ?> | <a href='logout.php'>Cerrar sesión</a></h2>

    <form method="post" class="mb-4">
        <label>Nueva tarea</label>
        <input type="text" name="descripcion" class="form-control mb-2" required>
        <button class="btn btn-success">Agregar</button>
    </form>

    <table class="table table-bordered">
        <tr><th>ID</th><th>Descripción</th><th>Estado</th><th>Acciones</th></tr>
        <?php while ($t = $tareas->fetch_assoc()): ?>
            <tr>
                <td><?php echo $t['id']; ?></td>
                <td><?php echo $t['descripcion']; ?></td>
                <td><?php echo $t['estado']; ?></td>
                <td>
                    <a href="editar.php?id=<?php echo $t['id']; ?>" class="btn btn-primary btn-sm">Editar</a>
                    <a href="eliminar.php?id=<?php echo $t['id']; ?>" class="btn btn-danger btn-sm">Eliminar</a>
                </td>
            </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>
