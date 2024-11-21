<?php
session_start();
require 'conexion.php';

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
    $usuarioID = $_SESSION['usuarioID'];
    $canchaID = $_POST['canchaID'];
    $horarioID = $_POST['horarioID'];
    $comuna = $_POST['comuna'];
    $centroID = $_POST['centroID'];
    $fechaReserva = $_POST['fechaReserva'];

    // Validar la fecha de reserva
    $fechaActual = new DateTime(); // Fecha y hora actual
    $fechaReservaObj = new DateTime($fechaReserva); // Crear objeto DateTime para la fecha de reserva

    // Establecer las horas, minutos y segundos a 00:00:00 para comparar solo las fechas
    $fechaSoloActual = new DateTime($fechaActual->format('Y-m-d'));
    $fechaSoloReserva = new DateTime($fechaReservaObj->format('Y-m-d'));

    // Verificar que la fecha no sea anterior a hoy
    if ($fechaSoloReserva < $fechaSoloActual) {
        echo "
            <script>
                alert('Error: No se puede reservar para una fecha pasada.');
                window.history.back();
            </script>
        ";
        exit();
    }

    // Obtener la hora de inicio del horario seleccionado
    $sql_horario = "SELECT HoraInicio FROM Horario WHERE HorarioID = ? AND CanchaID = ?";
    $stmt_horario = $conexion->prepare($sql_horario);
    $stmt_horario->bind_param("ii", $horarioID, $canchaID);
    $stmt_horario->execute();
    $resultado_horario = $stmt_horario->get_result();

    if ($resultado_horario->num_rows > 0) {
        $fila_horario = $resultado_horario->fetch_assoc();
        
        // Crear DateTime combinando la fecha de reserva con la hora de inicio
        $fechaHoraReserva = new DateTime($fechaReserva . ' ' . $fila_horario['HoraInicio']);
        
        // Si es el mismo día, verificar que la hora de inicio sea posterior a la hora actual
        if ($fechaSoloReserva == $fechaSoloActual) {
            if ($fechaHoraReserva <= $fechaActual) {
                echo "
                    <script>
                        alert('Error: Para reservas en el día actual, el horario debe ser posterior a la hora actual.');
                        window.history.back();
                    </script>
                ";
                exit();
            }
        }
    } else {
        echo "
            <script>
                alert('Horario no encontrado.');
                window.history.back();
            </script>
        ";
        exit();
    }
        
    } else {
        echo "
            <script>
                alert('Horario no encontrado.');
                window.history.back();
            </script>
        ";
        exit();
    }

    // El resto del código permanece igual
    $sql_verificar_limite = "SELECT COUNT(*) as total FROM Reservas WHERE UsuarioID = ? AND Estadoreserva = 'pendiente'";
    $stmt_verificar_limite = $conexion->prepare($sql_verificar_limite);
    $stmt_verificar_limite->bind_param("i", $usuarioID);
    $stmt_verificar_limite->execute();
    $resultado_verificar_limite = $stmt_verificar_limite->get_result();
    $fila_limite = $resultado_verificar_limite->fetch_assoc();

    if ($fila_limite['total'] >= 3) {
        echo "
            <script>
                alert('Ya has alcanzado el límite de 3 reservas. No puedes hacer más reservas en este momento.');
                window.history.back();
            </script>
        ";
        exit();
    }

    // Continuar con la obtención del nombre del centro deportivo
    $sql_centro = "SELECT Nombre FROM CentrosDeportivos WHERE CentroID = ?";
    $stmt_centro = $conexion->prepare($sql_centro);
    $stmt_centro->bind_param("i", $centroID);
    $stmt_centro->execute();
    $resultado_centro = $stmt_centro->get_result();

    if ($resultado_centro->num_rows > 0) {
        $fila_centro = $resultado_centro->fetch_assoc();
        $nombreCentro = $fila_centro['Nombre'];
    } else {
        echo "
            <script>
                alert('Centro deportivo no encontrado.');
                window.history.back();
            </script>
        ";
        exit();
    }

    // Obtener información de la cancha
    $sql_cancha = "SELECT Numero FROM Canchas WHERE CanchaID = ?";
    $stmt_cancha = $conexion->prepare($sql_cancha);
    $stmt_cancha->bind_param("i", $canchaID);
    $stmt_cancha->execute();
    $resultado_cancha = $stmt_cancha->get_result();

    if ($resultado_cancha->num_rows > 0) {
        $fila_cancha = $resultado_cancha->fetch_assoc();
        $nombreCancha = $fila_cancha['Numero'];
    } else {
        echo "
            <script>
                alert('Cancha no encontrada.');
                window.history.back();
            </script>
        ";
        exit();
    }

    // Obtener información del usuario
    $sql_usuario = "SELECT Nombre FROM Usuario WHERE UserID = ?";
    $stmt_usuario = $conexion->prepare($sql_usuario);
    $stmt_usuario->bind_param("i", $usuarioID);
    $stmt_usuario->execute();
    $resultado_usuario = $stmt_usuario->get_result();

    if ($resultado_usuario->num_rows > 0) {
        $fila_usuario = $resultado_usuario->fetch_assoc();
        $nombreUsuario = $fila_usuario['Nombre'];
    } else {
        echo "
            <script>
                alert('Usuario no encontrado.');
                window.history.back();
            </script>
        ";
        exit();
    }

    // Obtener horario completo
    $sql_horario = "SELECT HoraInicio, HoraFin FROM Horario WHERE HorarioID = ? AND CanchaID = ?";
    $stmt_horario = $conexion->prepare($sql_horario);
    $stmt_horario->bind_param("ii", $horarioID, $canchaID);
    $stmt_horario->execute();
    $resultado_horario = $stmt_horario->get_result();

    if ($resultado_horario->num_rows > 0) {
        $fila_horario = $resultado_horario->fetch_assoc();
        $horaInicioReserva = $fila_horario['HoraInicio'];
        $horaFinReserva = $fila_horario['HoraFin'];
    } else {
        echo "
            <script>
                alert('Horario no encontrado.');
                window.history.back();
            </script>
        ";
        exit();
    }

    // Verificar disponibilidad
    $sql_verificar = "
        SELECT COUNT(*) as total
        FROM Reservas
        WHERE CanchaID = ? 
        AND HorarioID = ? 
        AND FechaReserva = ?
    ";

    $stmt_verificar = $conexion->prepare($sql_verificar);
    $stmt_verificar->bind_param("iis", $canchaID, $horarioID, $fechaReserva);
    $stmt_verificar->execute();
    $resultado_verificar = $stmt_verificar->get_result();
    $fila = $resultado_verificar->fetch_assoc();

    if ($fila['total'] > 0) {
        echo "
            <script>
                alert('Ya existe una reserva para esta cancha en ese horario y fecha.');
                window.history.back();
            </script>
        ";
        exit();
    }

    // Calcular precio y monto total
    $sql_precio = "SELECT PrecioPorHora FROM Canchas WHERE CanchaID = ?";
    $stmt_precio = $conexion->prepare($sql_precio);
    $stmt_precio->bind_param("i", $canchaID);
    $stmt_precio->execute();
    $stmt_precio->bind_result($precioPorHora);
    $stmt_precio->fetch();
    $stmt_precio->close();

    $horaInicio = new DateTime($horaInicioReserva);
    $horaFin = new DateTime($horaFinReserva);
    $intervalo = $horaInicio->diff($horaFin);
    $duracionHoras = $intervalo->h + ($intervalo->i / 60);
    $montoTotal = number_format($duracionHoras * $precioPorHora, 2, '.', '');

    // Generar código de reserva
    $codigoReserva = uniqid('RES-');
    $estadoReserva = 'pendiente';
    $metodoPago = isset($_POST['metodoPago']) ? $_POST['metodoPago'] : '';

    // Insertar la reserva
    $sql_reserva = "
        INSERT INTO Reservas (CodigoReserva, UsuarioID, CanchaID, HorarioID, FechaReserva, HoraInicioReserva, HoraFinReserva, EstadoReserva, MontoTotal, MetodoPago) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
    ";

    $stmt = $conexion->prepare($sql_reserva);

    if ($stmt === false) {
        die("Error en la preparación de la consulta: " . $conexion->error);
    }

    $stmt->bind_param("siisssssss", $codigoReserva, $usuarioID, $canchaID, $horarioID, $fechaReserva, $horaInicioReserva, $horaFinReserva, $estadoReserva, $montoTotal, $metodoPago);

    if ($stmt->execute()) {
        echo "
            <script>
                alert('Reserva realizada con éxito. Código de reserva: $codigoReserva');
                window.location.href = 'misreservas.php';
            </script>
        ";
    } else {
        echo "
            <script>
                alert('Error al realizar la reserva: " . $stmt->error . "');
                window.history.back();
            </script>
        ";
    }

    $stmt->close();


$conexion->close();
?>
