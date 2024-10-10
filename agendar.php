<?php
include('conexion.php');

// Obtener canchas
$sql_canchas = "SELECT CanchaID, Nombre FROM Canchas";
$result_canchas = $conn->query($sql_canchas);

// Verificar si se ha enviado el formulario de reserva
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuarioID = $_POST['usuarioID'];
    $canchaID = $_POST['canchaID'];
    $horarioID = $_POST['horarioID'];
    $fechaReserva = $_POST['fechaReserva'];

    // Insertar la reserva en la base de datos
    $sql_reserva = "INSERT INTO Reservas (UsuarioID, CanchaID, HorarioID, FechaReserva) VALUES ('$usuarioID', '$canchaID', '$horarioID', '$fechaReserva')";
    
    if ($conn->query($sql_reserva) === TRUE) {
        echo "¡Reserva realizada con éxito!";
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agendar Hora</title>
    <link rel="stylesheet" href="style3.css">
</head>
<body>

<h2>Agendar Hora</h2>

<form method="post" action="agendar.php">
    <!-- Ingresar ID de usuario (puedes mejorarlo con un login) -->
    <label for="usuarioID">ID Usuario:</label>
    <input type="text" name="usuarioID" required><br><br>

    <!-- Seleccionar cancha -->
    <label for="canchaID">Seleccionar Cancha:</label>
    <select name="canchaID" required>
        <option value="">Seleccione una cancha</option>
        <?php
        if ($result_canchas->num_rows > 0) {
            while($row = $result_canchas->fetch_assoc()) {
                echo "<option value='" . $row['CanchaID'] . "'>" . $row['Nombre'] . "</option>";
            }
        }
        ?>
    </select><br><br>

    <!-- Seleccionar horario -->
    <label for="horarioID">Seleccionar Horario:</label>
    <select name="horarioID" required>
        <!-- Los horarios disponibles se actualizarán según la cancha seleccionada -->
        <?php
        // Obtener los horarios disponibles
        $sql_horarios = "SELECT HorarioID, HoraInicio, HoraFin FROM Horarios WHERE Disponible = 1";
        $result_horarios = $conn->query($sql_horarios);

        if ($result_horarios->num_rows > 0) {
            while($row = $result_horarios->fetch_assoc()) {
                echo "<option value='" . $row['HorarioID'] . "'>" . $row['HoraInicio'] . " - " . $row['HoraFin'] . "</option>";
            }
        }
        ?>
    </select><br><br>

    <!-- Ingresar fecha -->
    <label for="fechaReserva">Fecha de Reserva:</label>
    <input type="date" name="fechaReserva" required><br><br>

    <input type="submit" value="Agendar">
</form>

</body>
</html>
