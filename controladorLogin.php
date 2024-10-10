<?php 
include("conexion.php");

if (!empty($_POST["login"])) {
    if (empty($_POST["email"]) || empty($_POST["password"])) {
        echo 'Por favor, complete todos los campos.';
    } else {
        $email = trim($_POST["email"]);
        $password = trim($_POST["password"]);

        // Consulta para obtener los datos del usuario por email
        $stmt = $conexion->prepare("SELECT * FROM datos WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        // Verificar si se encontró el usuario
        if ($result->num_rows > 0) {
            $datos = $result->fetch_object();

            // Verificar la contraseña hasheada
            if (password_verify($password, $datos->contrasena)) {
                header("Location: inicio.php");
                exit();
            } else {
                echo 'La contraseña es incorrecta.';
            }
        } else {
            echo 'El usuario no existe.';
        }

        $stmt->close();
    }
}
?>

