<?php
include('conexion.php'); // Asegúrate de incluir tu archivo de conexión

// Verifica que el canchaID se haya enviado
if (isset($_GET['canchaID'])) {
    $canchaID = $_GET['canchaID'];

    // Obtener los horarios de la cancha seleccionada
    $sql = "SELECT HorarioID, HoraInicio, HoraFin FROM horarios WHERE CanchaID = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("i", $canchaID); // 'i' indica que es un entero
    $stmt->execute();
    $result = $stmt->get_result();

    $horarios = array();
    while ($row = $result->fetch_assoc()) {
        $horarios[] = $row; // Agregar cada horario al array
    }

    // Retornar los datos en formato JSON
    echo json_encode($horarios);
}
?>
