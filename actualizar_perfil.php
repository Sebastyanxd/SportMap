<?php
session_start();
require 'conexion.php';

// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Verify user is logged in
if (!isset($_SESSION['usuarioID'])) {
    echo json_encode([
        'success' => false, 
        'message' => 'No autorizado',
        'debug' => 'No user ID in session'
    ]);
    exit();
}

$usuarioID = $_SESSION['usuarioID'];

// Validate and sanitize inputs
$nombre = filter_input(INPUT_POST, 'nombre', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
$telefono = filter_input(INPUT_POST, 'telefono', FILTER_SANITIZE_FULL_SPECIAL_CHARS) ?: null;
$direccion = filter_input(INPUT_POST, 'direccion', FILTER_SANITIZE_FULL_SPECIAL_CHARS) ?: null;
$nuevaContrasena = $_POST['nuevaContrasena'] ?? '';

// Validate email
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo json_encode([
        'success' => false, 
        'message' => 'Correo electrónico inválido'
    ]);
    exit();
}

// Prepare SQL update
$sql = "UPDATE Usuario SET Nombre = ?, Email = ?, Telefono = ?, Direccion = ?";
$params = [&$nombre, &$email, &$telefono, &$direccion];
$types = 'ssss';

// Handle password update if provided
if (!empty($nuevaContrasena)) {
    $hashedPassword = password_hash($nuevaContrasena, PASSWORD_DEFAULT);
    $sql .= ", Contrasena = ?";
    $params[] = &$hashedPassword;
    $types .= 's';
}

$sql .= " WHERE UserID = ?";
$params[] = &$usuarioID;
$types .= 'i';

// Prepare statement
$stmt = $conexion->prepare($sql);

if ($stmt === false) {
    echo json_encode([
        'success' => false, 
        'message' => 'Error en la preparación de la consulta',
        'debug' => $conexion->error
    ]);
    exit();
}

try {
    // Bind parameters
    $bindParams = array_merge([$stmt, $types], $params);
    $bindResult = call_user_func_array('mysqli_stmt_bind_param', $bindParams);

    if ($bindResult === false) {
        echo json_encode([
            'success' => false, 
            'message' => 'Error al vincular parámetros',
            'debug' => $stmt->error
        ]);
        exit();
    }

    $executeResult = $stmt->execute();

    if ($executeResult) {
        echo json_encode([
            'success' => true, 
            'message' => 'Perfil actualizado correctamente',
             'redirect' => 'miperfil.php'
        ]);
    } else {
        echo json_encode([
            'success' => false, 
            'message' => 'Error al actualizar el perfil',
            'debug' => $stmt->error
        ]);
    }
} catch (Exception $e) {
    echo json_encode([
        'success' => false, 
        'message' => 'Excepción al actualizar',
        'debug' => $e->getMessage()
    ]);
}

$stmt->close();
$conexion->close();
?>