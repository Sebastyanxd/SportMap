<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <form method="post" onsubmit="return validarContrasena()">

    <div class="logo-text-container">
            <img src="images/logo.jpg" alt="SportMap Logo" class="logo">
            <h2>Crear Cuenta</h2>
            </div>

    <div class="input-wrapper">
        <input type="text" name="Nombre" placeholder="Nombre" required>
        <img class="input-icon" src="images/name.svg" alt="">
    </div>

    <div class="input-wrapper">
        <input type="email" name="Email" placeholder="Email" required>
        <img class="input-icon" src="images/email.svg" alt="">
    </div>

    <div class="input-wrapper">
    <input type="text" name="Direccion" placeholder="Dirección (Opcional)">
    <img class="input-icon" src="images/direction.svg" alt="">
    </div>

    <div class="input-wrapper">
        <input type="tel" name="Telefono" placeholder="Teléfono" pattern="^\569[0-9]{8}$" required>
        <img class="input-icon" src="images/phone.svg" alt="">
    </div>

    <div class="input-wrapper">
        <input type="password" id="Contrasena" name="Contrasena" placeholder="Contraseña" required>
        <img class="input-icon" src="images/password.svg" alt="">
    </div>

    <div class="input-wrapper">
        <input type="password" id="ConfirmarContrasena" name="ConfirmarContrasena" placeholder="Confirmar Contraseña" required>
        <img class="input-icon" src="images/password.svg" alt="">
    </div>

    <input class="btn" type="submit" name="register" value="Enviar">
</form>

<script>
function validarContrasena() {
    var contrasena = document.getElementById("Contrasena").value;
    var confirmarContrasena = document.getElementById("ConfirmarContrasena").value;
    
    if (contrasena !== confirmarContrasena) {
        alert("Las contraseñas no coinciden.");
        return false; // Impide que el formulario se envíe
    }
    return true; // Permite el envío del formulario
}
</script>


    <?php
        include("registrar.php");
    ?>
    
</body>
</html>
