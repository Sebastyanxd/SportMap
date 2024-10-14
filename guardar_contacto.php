<?php
// Iniciar la sesión si no está iniciada
session_start();

// Verificar si el usuario está autenticado
if (isset($_SESSION['usuarioID'])) {
    $usuarioID = $_SESSION['usuarioID']; // Obtener el usuarioID desde la sesión
} else {
    // Si no está autenticado, redirigir a la página de inicio de sesión o mostrar un mensaje
    echo "Debes estar autenticado para enviar un mensaje.";
    exit();
}

include('conexion.php'); // Asegúrate de que este archivo define $conexion


// Recibir los datos del formulario
$nombre = $_POST['nombre'];
$email = $_POST['email'];
$telefono = $_POST['telefono'];
$asunto = $_POST['asunto'];
$mensaje = $_POST['mensaje'];

// Insertar los datos en la tabla contactos
$sql = "INSERT INTO contactos (userID, nombre_completo, email, telefono, asunto, mensaje) 
        VALUES (?, ?, ?, ?, ?, ?)";

$stmt = $conexion->prepare($sql);
$stmt->bind_param("isssss", $usuarioID, $nombre, $email, $telefono, $asunto, $mensaje);

try {
    $stmt->execute();
    echo "<script>
        alert('¡Mensaje enviado con éxito.!');
        window.location.href = 'index.php';
    </script>";
} catch (mysqli_sql_exception $e) {
    echo "Error en la reserva: " . $e->getMessage(); // Muestra el error específico
}
// Cerrar la conexión
$stmt->close();
$conexion->close();
?>
