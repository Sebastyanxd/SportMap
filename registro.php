<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <form method="post" >

<<<<<<< HEAD
    <h2>Regístrate</h2>
=======
    <h2>Registrate</h2>
>>>>>>> cb92de49df88d15104747bdb27b2c752c67092a0
    <p>Inicia tu registro</p>

    <div class="input-wrapper">
        <input type="text" name="Nombre" placeholder="Nombre" required>
        <img class="input-icon" src="images/name.svg" alt="">
    </div>

    <div class="input-wrapper">
        <input type="email" name="Email" placeholder="Email" required>
        <img class="input-icon" src="images/email.svg" alt="">
    </div>

    <div class="input-wrapper">
        <input type="text" name="Direccion" placeholder="Dirección" required>
        <img class="input-icon" src="images/direction.svg" alt="">
    </div>

    <div class="input-wrapper">
        <input type="tel" name="Telefono" placeholder="Teléfono" required>
        <img class="input-icon" src="images/phone.svg" alt="">
    </div>

    <div class="input-wrapper">
        <input type="password" name="Contrasena" placeholder="Contraseña" required>
        <img class="input-icon" src="images/password.svg" alt="">
    </div>

    <input class="btn" type="submit" name="register" value="Enviar">
    </form>

    <?php
        include("registrar.php");
    ?>
    
</body>
</html>
