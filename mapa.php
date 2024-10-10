<<<<<<< HEAD
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
        <a href="#home" class="logo"> Sport
            <span>Maps</span></a>

        <i class='bx bx-menu' id="menu-icon"></i>

        <nav class="navbar">
            <a href="index.php" class="active">Home</a>
            <a href="#servicios">Servicios</a>
            <a href="mapa.php">Mapa</a>
            <a href="#contac">Contacto</a>
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





=======
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SportMap</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>
  <body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
      <div class="container-fluid">
        <a class="navbar-brand" href="index.html">SportMap</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link" href="mapa.php">Mapa</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Reservas</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Agendar Hora</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>


    <iframe src="https://www.google.com/maps/d/u/0/embed?mid=1E4F6XPg1q4FUiPmHeiCKJBQ0Spoir8A&ehbc=2E312F" width="640" height="480"></iframe>
>>>>>>> cb92de49df88d15104747bdb27b2c752c67092a0
  

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>
