<?php
session_start();
require 'conexion.php'; // Asegúrate de que la conexión a la base de datos esté bien configurada

if (!isset($_SESSION['usuarioID'])) {
    echo "
        <script>
            alert('Por favor, inicie sesión para realizar una reserva.');
            window.location.href = 'login.php';
        </script>
    ";
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuarioID = $_SESSION['usuarioID']; // ID del usuario que está realizando la reserva
    $canchaID = $_POST['canchaID'];
    $horarioID = $_POST['horarioID'];
    $comuna = $_POST['comuna']; // Obteniendo la comuna seleccionada
    $centroID = $_POST['centroID']; // Obteniendo el ID del centro deportivo

    // Obtener el nombre del centro deportivo usando su ID
    $sql_centro = "SELECT Nombre FROM CentrosDeportivos WHERE CentroID = ?";
    $stmt_centro = $conexion->prepare($sql_centro);
    $stmt_centro->bind_param("i", $centroID);
    $stmt_centro->execute();
    $resultado_centro = $stmt_centro->get_result();

    if ($resultado_centro->num_rows > 0) {
        $fila_centro = $resultado_centro->fetch_assoc();
        $nombreCentro = $fila_centro['Nombre']; // Guardando el nombre del centro
    } else {
        echo "
            <script>
                alert('Centro deportivo no encontrado.');
                window.history.back();
            </script>
        ";
        exit();
    }

    // Obtener el nombre de la cancha usando su ID
    $sql_cancha = "SELECT Nombre FROM Canchas WHERE CanchaID = ?";
    $stmt_cancha = $conexion->prepare($sql_cancha);
    $stmt_cancha->bind_param("i", $canchaID);
    $stmt_cancha->execute();
    $resultado_cancha = $stmt_cancha->get_result();

    if ($resultado_cancha->num_rows > 0) {
        $fila_cancha = $resultado_cancha->fetch_assoc();
        $nombreCancha = $fila_cancha['Nombre']; // Guardando el nombre de la cancha
    } else {
        echo "
            <script>
                alert('Cancha no encontrada.');
                window.history.back();
            </script>
        ";
        exit();
    }

    // Obtener el nombre del usuario usando su ID
    $sql_usuario = "SELECT Nombre FROM Usuarios WHERE UserID = ?";
    $stmt_usuario = $conexion->prepare($sql_usuario);
    $stmt_usuario->bind_param("i", $usuarioID);
    $stmt_usuario->execute();
    $resultado_usuario = $stmt_usuario->get_result();

    if ($resultado_usuario->num_rows > 0) {
        $fila_usuario = $resultado_usuario->fetch_assoc();
        $nombreUsuario = $fila_usuario['Nombre']; // Guardando el nombre del usuario
    } else {
        echo "
            <script>
                alert('Usuario no encontrado.');
                window.history.back();
            </script>
        ";
        exit();
    }

    // Obtener la hora de inicio y fin usando el HorarioID y CanchaID
    $sql_horario = "SELECT HoraInicio, HoraFin FROM Horarios WHERE HorarioID = ? AND CanchaID = ?";
    $stmt_horario = $conexion->prepare($sql_horario);
    $stmt_horario->bind_param("ii", $horarioID, $canchaID);
    $stmt_horario->execute();
    $resultado_horario = $stmt_horario->get_result();

    if ($resultado_horario->num_rows > 0) {
        $fila_horario = $resultado_horario->fetch_assoc();
        $horaInicioReserva = $fila_horario['HoraInicio']; // Guardar hora de inicio
        $horaFinReserva = $fila_horario['HoraFin']; // Guardar hora de fin
    } else {
        echo "
            <script>
                alert('Horario no encontrado. Verifique que los datos son correctos: HorarioID: $horarioID, CanchaID: $canchaID.');
                window.history.back();
            </script>
        ";
        exit();
    }

    // Verificar si ya existe una reserva para la misma cancha y horario
    $sql_verificar = "
        SELECT COUNT(*) as total
        FROM Reservas
        WHERE CanchaID = ? 
        AND HorarioID = ?
    ";

    $stmt_verificar = $conexion->prepare($sql_verificar);
    $stmt_verificar->bind_param("ii", $canchaID, $horarioID);
    $stmt_verificar->execute();
    $resultado_verificar = $stmt_verificar->get_result();
    $fila = $resultado_verificar->fetch_assoc();

    if ($fila['total'] > 0) {
        // Ya existe una reserva para la misma cancha y horario
        echo "
            <script>
                alert('Ya existe una reserva para esta cancha en ese horario. Por favor, elija otro horario disponible.');
                window.history.back();
            </script>
        ";
    } else {
        // Inserta la reserva
$sql_reserva = "
INSERT INTO Reservas 
(UsuarioID, CanchaID, NombreCentro, Comuna, HorarioID, FechaReserva, HoraReserva, HoraInicioReserva, HoraFinReserva, NombreCancha, NombreUsuario) 
VALUES (?, ?, ?, ?, ?, CURDATE(), CURTIME(), ?, ?, ?, ?)
";
$stmt = $conexion->prepare($sql_reserva);

// Verifica que el prepared statement se creó correctamente
if ($stmt === false) {
die("Error en la preparación de la consulta: " . $conexion->error);
}

$stmt->bind_param("iississss", $usuarioID, $canchaID, $nombreCentro, $comuna, $horarioID, $horaInicioReserva, $horaFinReserva, $nombreCancha, $nombreUsuario);

try {
$stmt->execute();
echo "
    <script>
        alert('Reserva realizada con éxito.');
        window.location.href = 'index.php'; // Redirige a la página de reservas del usuario
    </script>
";
} catch (mysqli_sql_exception $e) {
echo "Error en la reserva: " . $e->getMessage(); // Muestra el error específico
}

    }
}

















