<?php 
// Verificar si ya hay una sesión iniciada
if (session_status() === PHP_SESSION_NONE) {
    session_start(); // Iniciar sesión solo si no está iniciada
}

include("conexion.php");

if (!empty($_POST["login"])) {
    if (empty($_POST["email"]) || empty($_POST["password"])) {
        echo 'Por favor, complete todos los campos.';
    } else {
        $email = trim($_POST["email"]);
        $password = trim($_POST["password"]);

        // Consulta para obtener los datos del usuario por email
        $stmt = $conexion->prepare("SELECT * FROM usuarios WHERE Email = ?"); // Cambié 'sportmap' por 'usuarios'
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        // Verificar si se encontró el usuario
        if ($result->num_rows > 0) {
            $datos = $result->fetch_object();

            // Verificar la contraseña hasheada
            if (password_verify($password, $datos->Contrasena)) { // Asegúrate que el nombre de la columna coincida
                $_SESSION['usuarioID'] = $datos->UserID; // Almacenar el ID del usuario
                echo "Usuario ID guardado en sesión: " . $_SESSION['usuarioID']; // Depuración
                header("Location: index.php");
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





