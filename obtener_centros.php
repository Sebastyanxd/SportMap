<?php
include('conexion.php'); // Asegúrate de incluir tu archivo de conexión

// Verifica que la comuna se haya enviado
if (isset($_GET['comuna'])) {
    $comuna = $_GET['comuna'];

    // Obtener los centros deportivos de la comuna seleccionada
    $sql = "SELECT CentroID, Nombre FROM centrosdeportivos WHERE Comuna = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("s", $comuna); // 's' indica que es un string
    $stmt->execute();
    $result = $stmt->get_result();

    $centros = array();
    while ($row = $result->fetch_assoc()) {
        $centros[] = $row; // Agregar cada centro al array
    }

    // Retornar los datos en formato JSON
    echo json_encode($centros);
}
?>