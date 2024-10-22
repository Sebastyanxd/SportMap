<?php
$host = "localhost";    // El servidor de la base de datos
$username = "root";     // El usuario de la base de datos
$password = "";         // La contraseña de la base de datos
$database = "sportmaps"; // El nombre de tu base de datos

// Crear la conexión
$conexion = new mysqli($host, $username, $password, $database);

// Verificar la conexión
if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}
?>
