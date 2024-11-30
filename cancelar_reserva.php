<?php
session_start();
require 'conexion.php';

// Añadir manejo de errores
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Log de errores
function logError($message) {
    file_put_contents('error_log.txt', date('[Y-m-d H:i:s] ') . $message . "\n", FILE_APPEND);
}

if (!isset($_SESSION['usuarioID']) || !isset($_POST['reservaID'])) {
    $response = [
        'success' => false,
        'message' => 'Acceso no autorizado o datos faltantes'
    ];
    logError('Acceso no autorizado: ' . print_r($_POST, true));
    echo json_encode($response);
    exit();
}

$reservaID = $_POST['reservaID'];
$usuarioID = $_SESSION['usuarioID'];

// Verificar que la reserva pertenece al usuario
$sql = "SELECT EstadoReserva, FechaReserva, HoraInicioReserva 
        FROM Reservas 
        WHERE ReservaID = ? AND UsuarioID = ?";
$stmt = $conexion->prepare($sql);
$stmt->bind_param("ii", $reservaID, $usuarioID);

try {
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 0) {
        $response = [
            'success' => false,
            'message' => 'Reserva no encontrada o no autorizada'
        ];
        logError('Reserva no encontrada: ReservaID ' . $reservaID . ', UsuarioID ' . $usuarioID);
        echo json_encode($response);
        exit();
    }

    $reserva = $result->fetch_assoc();

    // Verificar si la reserva ya está cancelada
    if ($reserva['EstadoReserva'] === 'cancelada') {
        $response = [
            'success' => false,
            'message' => 'La reserva ya está cancelada'
        ];
        echo json_encode($response);
        exit();
    }

    // Verificar si la reserva es para una fecha futura
    $fechaHoraReserva = $reserva['FechaReserva'] . ' ' . $reserva['HoraInicioReserva'];
    if (strtotime($fechaHoraReserva) <= time()) {
        $response = [
            'success' => false,
            'message' => 'No se pueden cancelar reservas pasadas o en curso'
        ];
        echo json_encode($response);
        exit();
    }

    // Actualizar el estado de la reserva a 'cancelada'
    $sql = "UPDATE Reservas SET EstadoReserva = 'cancelada', UltimaModificacion = NOW() WHERE ReservaID = ? AND UsuarioID = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("ii", $reservaID, $usuarioID);

    if ($stmt->execute()) {
        $response = [
            'success' => true,
            'message' => 'Reserva cancelada exitosamente'
        ];
    } else {
        $response = [
            'success' => false,
            'message' => 'Error al cancelar la reserva: ' . $stmt->error
        ];
        logError('Error de base de datos: ' . $stmt->error);
    }
} catch (Exception $e) {
    $response = [
        'success' => false,
        'message' => 'Error inesperado: ' . $e->getMessage()
    ];
    logError('Excepción capturada: ' . $e->getMessage());
}

echo json_encode($response);