<?php
include('conexion.php');

$centroID = $_GET['centroID'];

// Consulta para obtener las canchas del centro deportivo seleccionado
$sql_canchas = "SELECT CanchaID, Numero, TipoCancha FROM Canchas WHERE CentroID = ?";
$stmt = $conexion->prepare($sql_canchas);
$stmt->bind_param("i", $centroID);
$stmt->execute();
$result = $stmt->get_result();

$canchas = [];
while ($row = $result->fetch_assoc()) {
    $canchas[] = $row;
}

// Devolver los resultados en formato JSON
echo json_encode($canchas);

$stmt->close();
$conexion->close();
?>

