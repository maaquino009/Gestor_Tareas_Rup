
<?php
$host = "localhost";
$user = "root";
$pass = "";
$db = "restaurante";

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
} else {
    echo "Conectado correctamente a la base de datos.";
}
?>
