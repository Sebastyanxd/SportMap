<?php
include('conexion.php'); // Asegúrate de incluir tu archivo de conexión

// Verifica que el centroID se haya enviado
if (isset($_GET['centroID'])) {
    $centroID = $_GET['centroID'];

    // Obtener las canchas del centro deportivo seleccionado
    $sql = "SELECT CanchaID, Nombre FROM Canchas WHERE CentroID = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("i", $centroID); // 'i' indica que es un entero
    $stmt->execute();
    $result = $stmt->get_result();

    $canchas = array();
    while ($row = $result->fetch_assoc()) {
        $canchas[] = $row; // Agregar cada cancha al array
    }

    // Retornar los datos en formato JSON
    echo json_encode($canchas);
}
?>
