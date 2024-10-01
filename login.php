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

    <h2>Hola</h2>
    <?php
        include("controladorLogin.php");
        include("conexion.php");
    ?>
    <p>Inicia session</p>

   <div class="input-wrapper">
        <input type="email" name="email" placeholder="Email">
        <img class="input-icon" src="images/email.svg" alt="">
    </div>

    <div class="input-wrapper">
        <input type="password" name="password" placeholder="Contrasena">
        <img class="input-icon" src="images/password.svg" alt="">
    </div>

    <div class="input-wrapper">
        <a href="">Olvide mi contrasena</a>
    </div>

    <input class="btn" type="submit" name="login" value="INICIAR SESION">
    </form>

    


    
</body>
</html>