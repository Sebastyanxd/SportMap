<?php
session_start(); // Iniciar sesión

// Verificar si la sesión está activa
if (isset($_SESSION['email'])) {
    header("Location: index.php"); // Redirigir a index.php si ya está autenticado
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <form method="post" >

    <div class="header" style="display: flex; justify-content: space-between; align-items: center;">
    <h2 style="font-size: 25px; color: #0D0D0D; margin-right: 20px;">Bienvenido a <span>SportMap</span></h2>
    <img src="images/logo.jpg" alt="Logo" class="logo" style="height: 200px; width: auto; margin-left: 20px;">
</div>


    <?php
        include("controladorLogin.php");
        include("conexion.php");
    ?>
    <p>Inicia sesión</p>

   <div class="input-wrapper">
        <input type="email" name="email" placeholder="Email" required>
        <img class="input-icon" src="images/email.svg" alt="">
    </div>

    <div class="input-wrapper">
        <input type="password" name="password" placeholder="Contraseña" required>
        <img class="input-icon" src="images/password.svg" alt="">
    </div>

    <div class="input-wrapper">
        <a href="recuperar.html">Olvidé mi contraseña</a>
        <a href="registro.php">No tienes cuenta?</a>
    </div>

    <input class="btn" type="submit" name="login" value="INICIAR SESION">
    </form>

</body>
</html>
