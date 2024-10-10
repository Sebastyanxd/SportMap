<?php
$servername = "localhost";  // Cambia si tu servidor es distinto
$username = "root";  // Cambia si tu usuario es distinto
$password = "";  // Pon la contraseña de tu base de datos si existe
$dbname = "sportmap";  // Asegúrate de que sea el nombre correcto de tu base de datos

// Crear la conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
?>
