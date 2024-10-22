<?php
include('conexion.php');

$canchaID = $_GET['canchaID'];

// Consulta para obtener los horarios de la cancha seleccionada
$sql_horarios = "SELECT HorarioID, Fecha, HoraInicio, HoraFin 
                 FROM Horario 
                 WHERE CanchaID = ? AND Disponible = 1";
$stmt = $conexion->prepare($sql_horarios);
$stmt->bind_param("i", $canchaID);
$stmt->execute();
$result = $stmt->get_result();

$horarios = [];
while ($row = $result->fetch_assoc()) {
    $horarios[] = $row;
}

// Devolver los resultados en formato JSON
echo json_encode($horarios);

$stmt->close();
$conexion->close();
?>
