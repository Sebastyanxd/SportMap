// cancelar_reserva.php
<?php
session_start();
require 'conexion.php';

if (!isset($_SESSION['usuarioID']) || !isset($_POST['reservaID'])) {
    $response = [
        'success' => false,
        'message' => 'Acceso no autorizado o datos faltantes'
    ];
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
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    $response = [
        'success' => false,
        'message' => 'Reserva no encontrada o no autorizada'
    ];
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
$sql = "UPDATE Reservas SET EstadoReserva = 'cancelada' WHERE ReservaID = ? AND UsuarioID = ?";
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
        'message' => 'Error al cancelar la reserva'
    ];
}

echo json_encode($response);