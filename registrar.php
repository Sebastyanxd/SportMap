<?php 

// Asegúrate de incluir correctamente el archivo de conexión
include("conexion.php");

if (isset($_POST['register'])) {

    // Verificar que los datos han sido recibidos correctamente desde el formulario
    if (
        isset($_POST['Nombre']) && strlen($_POST['Nombre']) >= 1 &&
        isset($_POST['Email']) && strlen($_POST['Email']) >= 1 &&
        isset($_POST['Direccion']) && strlen($_POST['Direccion']) >= 0 &&
        isset($_POST['Telefono']) && strlen($_POST['Telefono']) >= 1 &&
        isset($_POST['Contrasena']) && strlen($_POST['Contrasena']) >= 1 
    ) {
        $name = trim($_POST['Nombre']);
        $email = trim($_POST['Email']);
        $direction = trim($_POST['Direccion']);
        $phone = trim($_POST['Telefono']);
        $password = trim($_POST['Contrasena']);

        // Verificar si el email ya existe en la base de datos
        $consulta_email = $conexion->prepare("SELECT * FROM usuario WHERE Email = ?");
        $consulta_email->bind_param("s", $email);
        $consulta_email->execute();
        $resultado_email = $consulta_email->get_result();

        if ($resultado_email->num_rows > 0) {
            echo '<h3 class="error">Este correo ya se encuentra registrado, prueba con otro.</h3>';
        } else {
            // Hashear la contraseña antes de guardarla
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            $fecha = date("Y-m-d");

            // Guardar la contraseña hasheada en la base de datos
            $consulta = $conexion->prepare("INSERT INTO usuario (Nombre, Email, Direccion, Telefono, Contrasena, FechaRegistro) VALUES (?, ?, ?, ?, ?, ?)");
            $consulta->bind_param("ssssss", $name, $email, $direction, $phone, $hashed_password, $fecha);

            if ($consulta->execute()) {
                // Mensaje de éxito
                echo '<h3 class="success">Tu registro se ha completado con éxito, espera mientras te redireccionamos al login.</h3>';
                // Redirigir después de 3 segundos
                echo '<script>
                        setTimeout(function() {
                            window.location.href = "login.php";
                        }, 3000); // 3000 milisegundos = 3 segundos
                      </script>';
            } else {
                echo '<h3 class="error">Ocurrió un error al registrar los datos.</h3>';
            }

            $consulta->close();
        }

        $consulta_email->close();
    } else {
        echo '<h3 class="error">Llena todos los campos.</h3>';
    }
}
?>
