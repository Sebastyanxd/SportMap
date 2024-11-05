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
    $fechaReserva = $_POST['fechaReserva']; // Obtener la fecha de reserva desde el formulario

    // Validar la fecha de reserva
$fechaActual = new DateTime(); // Fecha y hora actual
$fechaReservaObj = wq($fechaReserva); // Crear objeto DateTime para la fecha de reserva

if ($fechaReservaObj < $fechaActual) {
    echo "
        <script>
            alert('Error: No se puede reservar para una fecha pasada.');
            window.history.back();
        </script>
    ";
    exit();
}

// Verificar si la reserva es para el mismo día
if ($fechaReservaObj->format('Y-m-d') === $fechaActual->format('Y-m-d')) {
    // Obtener la hora de inicio del horario seleccionado
    $sql_horario = "SELECT HoraInicio FROM Horario WHERE HorarioID = ? AND CanchaID = ?";
    $stmt_horario = $conexion->prepare($sql_horario);
    $stmt_horario->bind_param("ii", $horarioID, $canchaID);
    $stmt_horario->execute();
    $resultado_horario = $stmt_horario->get_result();

    if ($resultado_horario->num_rows > 0) {
        $fila_horario = $resultado_horario->fetch_assoc();
        $horaInicioReserva = new DateTime($fila_horario['HoraInicio']); // Guardar hora de inicio como objeto DateTime
        // Comparar la hora de inicio con la hora actual
        if ($horaInicioReserva <= $fechaActual) {
            echo "
                <script>
                    alert('Error: El horario seleccionado debe ser posterior a la hora actual para reservas el mismo día.');
                    window.history.back();
                </script>
            ";
            exit();
        }
    } else {
        echo "
            <script>
                alert('Horario no encontrado. Verifique que los datos son correctos: HorarioID: $horarioID, CanchaID: $canchaID.');
                window.history.back();
            </script>
        ";
        exit();
    }
}


    // Verificar el número de reservas del usuario
    $sql_verificar_limite = "SELECT COUNT(*) as total FROM Reservas WHERE UsuarioID = ?";
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
    $sql_cancha = "SELECT Numero FROM Canchas WHERE CanchaID = ?";
    $stmt_cancha = $conexion->prepare($sql_cancha);
    $stmt_cancha->bind_param("i", $canchaID);
    $stmt_cancha->execute();
    $resultado_cancha = $stmt_cancha->get_result();

    if ($resultado_cancha->num_rows > 0) {
        $fila_cancha = $resultado_cancha->fetch_assoc();
        $nombreCancha = $fila_cancha['Numero']; // Guardando el nombre de la cancha
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
    $sql_usuario = "SELECT Nombre FROM Usuario WHERE UserID = ?";
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
    $sql_horario = "SELECT HoraInicio, HoraFin FROM Horario WHERE HorarioID = ? AND CanchaID = ?";
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

    // Verificar si ya existe una reserva para la misma cancha y horario en la fecha seleccionada
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
        // Ya existe una reserva para la misma cancha y horario
        echo "
            <script>
                alert('Ya existe una reserva para esta cancha en ese horario y fecha. Por favor, elija otro horario disponible.');
                window.history.back();
            </script>
        ";
    } else {
        // Obtener el precio por hora de la cancha seleccionada
        $sql_precio = "SELECT PrecioPorHora FROM Canchas WHERE CanchaID = ?";
        $stmt_precio = $conexion->prepare($sql_precio);
        $stmt_precio->bind_param("i", $canchaID);
        $stmt_precio->execute();
        $stmt_precio->bind_result($precioPorHora);
        $stmt_precio->fetch();
        $stmt_precio->close();

        // Calcular la duración de la reserva en horas
        $horaInicio = new DateTime($horaInicioReserva);
        $horaFin = new DateTime($horaFinReserva);
        $intervalo = $horaInicio->diff($horaFin);
        $duracionHoras = $intervalo->h + ($intervalo->i / 60); // Conversión de minutos a horas

        // Calcular el monto total
        $montoTotal = number_format($duracionHoras * $precioPorHora, 2, '.', ''); // Formatear a dos decimales

        // Generar un código de reserva único
        $codigoReserva = uniqid('RES-'); // Ejemplo de código único

        // Estado de la reserva (por defecto: 'pendiente')
        $estadoReserva = 'pendiente';

        // Verifica que el método de pago esté definido
        $metodoPago = isset($_POST['metodoPago']) ? $_POST['metodoPago'] : ''; 

        // Inserta la reserva con los campos correctos
        $sql_reserva = "
            INSERT INTO Reservas (CodigoReserva, UsuarioID, CanchaID, HorarioID, FechaReserva, HoraInicioReserva, HoraFinReserva, EstadoReserva, MontoTotal, MetodoPago) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
        ";

        $stmt = $conexion->prepare($sql_reserva);

        // Asegúrate de que el prepared statement se creó correctamente
        if ($stmt === false) {
            die("Error en la preparación de la consulta: " . $conexion->error);
        }

        // Asegúrate de que todas las variables tengan valores válidos
        if (empty($codigoReserva) || !isset($usuarioID) || !isset($canchaID) || !isset($horarioID) || !isset($fechaReserva) || !isset($horaInicioReserva) || !isset($horaFinReserva) || empty($estadoReserva) || empty($montoTotal) || empty($metodoPago)) {
            die("Error: algunos datos son inválidos.");
        }

        // Cambiar el tipo de dato de 'i' para canchaID y asegurarte que todos los tipos son correctos
        $stmt->bind_param("siisssssss", $codigoReserva, $usuarioID, $canchaID, $horarioID, $fechaReserva, $horaInicioReserva, $horaFinReserva, $estadoReserva, $montoTotal, $metodoPago);

        if ($stmt->execute()) {
            echo "
                <script>
                    alert('Reserva realizada con éxito. Código de reserva: $codigoReserva');
                    window.location.href = 'index.php';
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
    }
}

$conexion->close();
?>

