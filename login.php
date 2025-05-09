<?php
session_start();
include 'conexion.php';

$mensaje = '';

// Generar pregunta matemática si no existe
if (!isset($_SESSION['pregunta'])) {
    $a = rand(1, 10);
    $b = rand(1, 10);
    $_SESSION['pregunta'] = "¿Cuánto es $a + $b?";
    $_SESSION['respuesta_correcta'] = $a + $b;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario = $_POST['usuario'];
    $contrasena = $_POST['contrasena'];
    $respuesta_seguridad = $_POST['respuesta_seguridad'];

    $sql = "SELECT * FROM usuarios WHERE usuario='$usuario'";
    $resultado = $conn->query($sql);

    if ($resultado->num_rows === 1) {
        $usuario_data = $resultado->fetch_assoc();

        if (
            $contrasena === $usuario_data['contrasena'] &&
            intval($respuesta_seguridad) === $_SESSION['respuesta_correcta']
        ) {
            $_SESSION['usuario'] = $usuario;
            unset($_SESSION['pregunta']);
            unset($_SESSION['respuesta_correcta']);
            header("Location: dashboard.php");
            exit;
        } else {
            $mensaje = 'Credenciales incorrectas o respuesta errónea.';
        }
    } else {
        $mensaje = 'Usuario no encontrado.';
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="container mt-5">
    <h2>Iniciar sesión</h2>
    <?php if ($mensaje): ?>
        <div class="alert alert-danger"><?php echo $mensaje; ?></div>
    <?php endif; ?>
    <form method="post">
        <div class="mb-3">
            <label>Usuario</label>
            <input type="text" name="usuario" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Contraseña</label>
            <input type="password" name="contrasena" class="form-control" required>
        </div>
        <div class="mb-3">
            <label><?php echo $_SESSION['pregunta']; ?></label>
            <input type="number" name="respuesta_seguridad" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Entrar</button>
    </form>
</body>
</html>
