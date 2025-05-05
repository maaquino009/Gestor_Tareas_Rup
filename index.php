<?php include 'conexion.php'; ?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Tareas </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container py-5">
        <h1 class="mb-4 text-center">Gestión de Tareas</h1>

        <!-- Formulario para agregar -->
        <form action="agregar.php" method="POST" class="mb-4">
            <div class="input-group">
                <input type="text" name="descripcion" class="form-control" placeholder="Nueva tarea" required>
                <button type="submit" class="btn btn-primary">Agregar</button>
            </div>
        </form>

        <!-- Mostrar tareas -->
        <ul class="list-group">
            <?php
            $resultado = $conn->query("SELECT * FROM tareas");
            while ($tarea = $resultado->fetch_assoc()):
            ?>
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <span class="<?php echo $tarea['completado'] ? 'text-decoration-line-through text-muted' : ''; ?>">
                    <?php echo htmlspecialchars($tarea['descripcion']); ?>
                </span>
                <div>
                    <?php if (!$tarea['completado']): ?>
                        <a href="completar.php?id=<?php echo $tarea['id']; ?>" class="btn btn-success btn-sm">Completar</a>
                    <?php endif; ?>
                    <a href="eliminar.php?id=<?php echo $tarea['id']; ?>" class="btn btn-danger btn-sm">Eliminar</a>
                </div>
            </li>
            <?php endwhile; ?>
        </ul>
    </div>
</body>
</html>

