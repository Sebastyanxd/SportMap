<?php
session_start(); // Iniciar sesión

// Verificar si la sesión está activa
if (!isset($_SESSION['email'])) {
    header("Location: login.php"); // Redirigir a login.php si no está autenticado
    exit();
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SportMaps</title>
    <link rel="stylesheet" href="style3.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
  <body>
  <header class="header">
        <a href="index.php" class="logo"> Sport
            <span>Maps</span></a>

        <i class='bx bx-menu' id="menu-icon"></i>

        <nav class="navbar">
            <a href="index.php" class="active">Home</a>
            <a href="#servicios">Servicios</a>
            <a href="mapa.php">Mapa</a>
            <a href="index.php">Contacto</a>
            <a href="agendar.php">Agendar</a>
            <a href="logout.php">Cerrar sesion</a>
        </nav>
    </header>


    <div style="display: flex; justify-content: center; margin: 150px 0 20px 0;">
    <iframe src="https://www.google.com/maps/d/u/0/embed?mid=1E4F6XPg1q4FUiPmHeiCKJBQ0Spoir8A&ehbc=2E312F" width="640" height="480" style="border: none; margin-left: 20px;"></iframe>
    
    <div style=" margin-left: 20px; display: flex; flex-direction: column;">
        <h2 style="margin-top: 20px;">Sport Park Malloco</h2>
        <hr style="margin: 5px 0;"> <!-- Línea separadora -->
        <p style="margin: 0;">Descripción del contenido que se encuentra en el mapa. Aquí puedes agregar información relevante sobre lo que se está mostrando.</p>
        <h2 style="margin-top: 20px;">Canchas San Javier</h2>
        <hr style="margin: 5px 0;"> <!-- Línea separadora -->
        <p style="margin: 0;">Descripción del contenido que se encuentra en el mapa. Aquí puedes agregar información relevante sobre lo que se está mostrando.</p>
        <h2 style="margin-top: 20px;">Club del Valle del Sol</h2>
        <hr style="margin: 5px 0;"> <!-- Línea separadora -->
        <p style="margin: 0;">Descripción del contenido que se encuentra en el mapa. Aquí puedes agregar información relevante sobre lo que se está mostrando.</p>
        <h2 style="margin-top: 20px;">Título</h2>
        <hr style="margin: 5px 0;"> <!-- Línea separadora -->
        <p style="margin: 0;">Descripción del contenido que se encuentra en el mapa. Aquí puedes agregar información relevante sobre lo que se está mostrando.</p>
        <h2 style="margin-top: 20px;">Título</h2>
        <hr style="margin: 5px 0;"> <!-- Línea separadora -->
        <p style="margin: 0;">Descripción del contenido que se encuentra en el mapa. Aquí puedes agregar información relevante sobre lo que se está mostrando.</p>
    </div>
</div>





  

  </body>
</html>
