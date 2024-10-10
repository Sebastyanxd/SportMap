<?php
session_start(); // Iniciar sesión

// Verificar si la sesión está activa
if (!isset($_SESSION['email'])) {
    header("Location: login.php"); // Redirigir a login.php si no está autenticado
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio - Mundo Deportivo</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f0f0f0;
        }

        header {
            background-color: #2c3e50;
            color: white;
            padding: 20px 0;
            text-align: center;
        }

        header h1 {
            margin: 0;
            font-size: 2.5em;
        }

        nav {
            margin: 20px 0;
            text-align: center;
        }

        nav a {
            text-decoration: none;
            color: #2980b9;
            margin: 0 15px;
            font-size: 1.2em;
        }

        nav a:hover {
            color: #3498db;
        }

        .hero {
            background-image: url('deporte.jpg');
            background-size: cover;
            background-position: center;
            height: 400px;
            display: flex;
            justify-content: center;
            align-items: center;
            color: white;
        }

        .hero h2 {
            background-color: rgba(0, 0, 0, 0.5);
            padding: 10px 20px;
            font-size: 3em;
        }

        .content {
            padding: 20px;
            text-align: center;
        }

        .content h2 {
            font-size: 2.2em;
            margin-bottom: 20px;
        }

        .content p {
            font-size: 1.2em;
            line-height: 1.5;
            color: #555;
        }

        footer {
            background-color: #2c3e50;
            color: white;
            padding: 20px 0;
            text-align: center;
            position: absolute;
            width: 100%;
            bottom: 0;
        }
    </style>
</head>
<body>

    <header>
        <h1>Mundo Deportivo</h1>
        <nav>
            <a href="index.php">Inicio</a>
            <a href="mapa.php">Mapa</a>
            <a href="#">Agendar</a>
            <a href="contacto.php">Contacto</a>
            <a href="logout.php">Cerrar sesión</a>

<<<<<<< Updated upstream
=======
    <header class="header">
        <a href="#home" class="logo"> Sport
            <span>Maps</span></a>

        <i class='bx bx-menu' id="menu-icon"></i>

        <nav class="navbar">
            <a href="#home" class="active">Home</a>
            <a href="#canchas">Canchas</a>
            <a href="#servicios">Servicios</a>
            <a href="#mapa">Mapa</a>
            <a href="#contac">Contacto</a>
            <a href="agendar.php">Agendar</a>
            <a href="logout.php">Cerrar Sesion</a>
>>>>>>> Stashed changes
        </nav>
    </header>

    <section class="hero">
        <h2>Vive la Pasión del Deporte</h2>
    </section>

    <section class="content">
        <h2>Bienvenido a Mundo Deportivo</h2>
        <p>En nuestra página, encontrarás las últimas noticias, eventos y actualizaciones del mundo del deporte. Ya seas aficionado al fútbol, baloncesto, atletismo, o cualquier otro deporte, aquí tienes todo lo que necesitas para estar al tanto de tus deportes favoritos.</p>
    </section>

    <footer>
        <p>&copy; 2024 Mundo Deportivo. Todos los derechos reservados.</p>
    </footer>

</body>
</html>






