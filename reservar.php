<?php
session_start(); // Iniciar sesión

include('conexion.php');

// Verificar si el usuario está logueado
if (!isset($_SESSION['usuarioID'])) {
    echo "<script>
        alert('Por favor, inicie sesión para realizar una reserva.');
        window.location.href = 'login.php';
    </script>";
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuarioID = $_SESSION['usuarioID']; // Aquí tomas el ID del usuario
    $canchaID = $_POST['canchaID'];
    $horarioID = $_POST['horarioID'];
    $fechaReserva = $_POST['fechaReserva'];

    // Validar que el usuarioID es un número
    if (!is_numeric($usuarioID)) {
        die("Error: El UsuarioID debe ser un número.");
    }

    // Insertar la reserva en la base de datos
    $sql_reserva = "INSERT INTO Reservas (UsuarioID, CanchaID, HorarioID, FechaReserva) VALUES (?, ?, ?, ?)";
    
    $stmt = $conexion->prepare($sql_reserva);
    $stmt->bind_param("iiis", $usuarioID, $canchaID, $horarioID, $fechaReserva);
    
    try {
        $stmt->execute();
        echo "<script>
            alert('¡Reserva realizada con éxito!');
            window.location.href = 'index.php';
        </script>";
    } catch (mysqli_sql_exception $e) {
        echo "Error en la reserva: " . $e->getMessage(); // Muestra el error específico
    }
}
?>

