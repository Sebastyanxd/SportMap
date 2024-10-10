<?php
include('conexion.php');

// Consultar las reservas
$sql_reservas = "SELECT Reservas.ReservaID, Usuarios.Nombre AS Usuario, Canchas.Nombre AS Cancha, Horarios.HoraInicio, Horarios.HoraFin, Reservas.FechaReserva
                 FROM Reservas
                 JOIN Usuarios ON Reservas.UsuarioID = Usuarios.UserID
                 JOIN Canchas ON Reservas.CanchaID = Canchas.CanchaID
                 JOIN Horarios ON Reservas.HorarioID = Horarios.HorarioID";
$result_reservas = $conn->query($sql_reservas);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de Reservas</title>
</head>
<body>

<h2>Reservas Realizadas</h2>

<table border="1">
    <tr>
        <th>ID Reserva</th>
        <th>Usuario</th>
        <th>Cancha</th>
        <th>Hora Inicio</th>
        <th>Hora Fin</th>
        <th>Fecha de Reserva</th>
    </tr>
    <?php
    if ($result_reservas->num_rows > 0) {
        while($row = $result_reservas->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row['ReservaID'] . "</td>";
            echo "<td>" . $row['Usuario'] . "</td>";
            echo "<td>" . $row['Cancha'] . "</td>";
            echo "<td>" . $row['HoraInicio'] . "</td>";
            echo "<td>" . $row['HoraFin'] . "</td>";
            echo "<td>" . $row['FechaReserva'] . "</td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='6'>No hay reservas.</td></tr>";
    }
    ?>
</table>

</body>
</html>
