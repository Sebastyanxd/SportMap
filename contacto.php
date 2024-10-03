<?php
// Inicializar variables para manejar errores y éxito
$error = '';
$success = '';

// Verificar si se envió el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validar los campos del formulario
    $nombre = trim($_POST["nombre"]);
    $email = trim($_POST["email"]);
    $mensaje = trim($_POST["mensaje"]);

    if (empty($nombre) || empty($email) || empty($mensaje)) {
        $error = 'Por favor, complete todos los campos.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = 'Por favor, ingrese un email válido.';
    } else {
        // Aquí puedes enviar el correo electrónico
        $to = 'tu-email@ejemplo.com'; // Cambia esto por tu dirección de correo
        $subject = 'Nuevo mensaje de contacto';
        $body = "Nombre: $nombre\nEmail: $email\nMensaje:\n$mensaje";
        $headers = "From: $email";

        if (mail($to, $subject, $body, $headers)) {
            $success = 'Mensaje enviado con éxito. Nos pondremos en contacto contigo pronto.';
        } else {
            $error = 'Lo siento, hubo un problema al enviar el mensaje.';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contacto</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 50px auto;
            background-color: white;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
        }
        .error {
            color: red;
        }
        .success {
            color: green;
        }
        label {
            display: block;
            margin: 10px 0 5px;
        }
        input[type="text"],
        input[type="email"],
        textarea {
            width: calc(100% - 20px); /* Ajustar el ancho para dejar espacio para el padding */
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-left: 10px; /* Margen a la izquierda */
            margin-right: 10px; /* Margen a la derecha */
        }
        input[type="submit"] {
            background-color: #2980b9;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            margin-left: 10px; /* Margen a la izquierda */
            margin-right: 10px; /* Margen a la derecha */
        }
        input[type="submit"]:hover {
            background-color: #3498db;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Contacto</h2>

    <?php if (!empty($error)): ?>
        <div class="error"><?php echo $error; ?></div>
    <?php endif; ?>

    <?php if (!empty($success)): ?>
        <div class="success"><?php echo $success; ?></div>
    <?php endif; ?>

    <form method="post" action="">
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" required>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>

        <label for="mensaje">Mensaje:</label>
        <textarea id="mensaje" name="mensaje" rows="5" required></textarea>

        <input type="submit" value="Enviar">
    </form>
</div>

</body>
</html>
