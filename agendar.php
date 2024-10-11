<?php
session_start(); // Iniciar sesión

// Verificar si la sesión está activa
if (!isset($_SESSION['usuarioID'])) {
    header("Location: login.php"); // Redirigir a login.php si no está autenticado
    exit();
}
include('conexion.php'); // Asegúrate de que este archivo define $conexion

// Obtener los centros deportivos
$sql_centros = "SELECT CentroID, Nombre FROM centrosdeportivos";
$result_centros = $conexion->query($sql_centros);

// Obtener canchas
$sql_canchas = "SELECT CanchaID, Nombre FROM Canchas";
$result_canchas = $conexion->query($sql_canchas);

// Verificar si se ha enviado el formulario de reserva
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuarioID = $_POST['usuarioID'];
    $canchaID = $_POST['canchaID'];
    $horarioID = $_POST['horarioID'];
    $fechaReserva = $_POST['fechaReserva'];

    // Insertar la reserva en la base de datos
    $sql_reserva = "INSERT INTO Reservas (UsuarioID, CanchaID, HorarioID, FechaReserva) VALUES ('$usuarioID', '$canchaID', '$horarioID', '$fechaReserva')";
    
    if ($conexion->query($sql_reserva) === TRUE) {
        echo "¡Reserva realizada con éxito!";
    } else {
        echo "Error: " . $conexion->error;
    }
}
?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agendar Hora</title>
    <style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f4f4f4;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        margin: 0;
        font-size: 18px; /* Aumentado el tamaño de fuente base */
    }
    form {
        background-color: #333; /* Cambiado a un color oscuro específico */
        padding: 30px; /* Aumentado el padding */
        border-radius: 12px; /* Aumentado el radio de borde */
        box-shadow: 0 0 20px rgba(0,0,0,0.2);
        width: 100%;
        max-width: 600px; /* Aumentado el ancho máximo */
        margin-left: 50px; /* Añadido margen izquierdo */
    }
    .input-group {
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;
        margin-bottom: 30px; /* Aumentado el margen inferior */
    }
    .input-box {
        width: 100%; /* Cambiado a 100% para que ocupe todo el ancho */
        margin-bottom: 20px; /* Añadido margen inferior */
    }
    select, input[type="date"], input[type="submit"] {
        width: 100%;
        padding: 15px; /* Aumentado el padding */
        margin-bottom: 15px;
        border: 1px solid #ddd;
        border-radius: 6px; /* Aumentado el radio de borde */
        box-sizing: border-box;
        font-size: 16px; /* Aumentado el tamaño de fuente */
    }
    input[type="submit"] {
        background-color: #4CAF50;
        color: white;
        border: none;
        cursor: pointer;
        font-size: 18px;
        padding: 15px 20px; /* Aumentado el padding */
    }
    input[type="submit"]:hover {
        background-color: #45a049;
    }
    label {
        display: block;
        margin-bottom: 10px;
        font-weight: bold;
        font-size: 18px; /* Aumentado el tamaño de fuente */
        color: #fff; /* Cambiado el color del texto a blanco para que se vea en el fondo oscuro */
    }
    .titulo{

    font-size: 8rem;
    text-align: center;
    margin: 5rem 0;
    margin-top: 80px; /* Ajusta el valor según sea necesario */
}

</style>
    <script>
    function cargarCanchas() {
        const centroID = document.getElementById('centroID').value;
        const canchaSelect = document.getElementById('canchaID');
        
        // Limpiar canchas y horarios existentes
        canchaSelect.innerHTML = "<option value=''>Seleccione una Cancha</option>";
        document.getElementById('horarioID').innerHTML = "<option value=''>Seleccione un Horario</option>";

        if (centroID) {
            fetch(`obtener_canchas.php?centroID=${centroID}`)
                .then(response => response.json())
                .then(data => {
                    data.forEach(cancha => {
                        const option = document.createElement('option');
                        option.value = cancha.CanchaID;
                        option.textContent = cancha.Nombre;
                        canchaSelect.appendChild(option);
                    });
                })
                .catch(error => console.error('Error:', error));
        }
    }

    function cargarHorarios() {
        const canchaID = document.getElementById('canchaID').value;
        const horarioSelect = document.getElementById('horarioID');

        // Limpiar horarios existentes
        horarioSelect.innerHTML = "<option value=''>Seleccione un Horario</option>";

        if (canchaID) {
            fetch(`obtener_horarios.php?canchaID=${canchaID}`)
                .then(response => response.json())
                .then(data => {
                    data.forEach(horario => {
                        const option = document.createElement('option');
                        option.value = horario.HorarioID;
                        option.textContent = `${horario.HoraInicio} - ${horario.HoraFin}`;
                        horarioSelect.appendChild(option);
                    });
                })
                .catch(error => console.error('Error:', error));
        }
    }
    </script>
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
            <a href="#contac">Contacto</a>
            <a href="agendar.php">Agendar</a>
            <a href="logout.php">Cerrar sesion</a>
            
        </nav>
    </header>

    <section class="agendar" id="agendar">
    <h2 class="titulo">Agendar <span>Cancha</span></h2> 

    <form method="post" action="reservar.php">
        <div class="input-group">
            <div class="input-box">
                <label for="centroID">Centro Deportivo:</label>
                <select name="centroID" id="centroID" onchange="cargarCanchas()" required>
                    <option value="">Seleccione un Centro</option>
                    <?php
                    if ($result_centros->num_rows > 0) {
                        while ($row = $result_centros->fetch_assoc()) {
                            echo "<option value='" . $row['CentroID'] . "'>" . $row['Nombre'] . "</option>";
                        }
                    }
                    ?>
                </select>
            </div>
            <div class="input-box">
                <label for="canchaID">Cancha:</label>
                <select name="canchaID" id="canchaID" onchange="cargarHorarios()" required>
                    <option value="">Seleccione una Cancha</option>
                </select>
            </div>
        </div>
        <div class="input-group">
            <div class="input-box">
                <label for="horarioID">Horario:</label>
                <select name="horarioID" id="horarioID" required>
                    <option value="">Seleccione un Horario</option>
                </select>
            </div>
            <div class="input-box">
                <label for="fechaReserva">Fecha de Reserva:</label>
                <input type="date" name="fechaReserva" id="fechaReserva" required>
            </div>
        </div>
        <input type="submit" value="Reservar">
    </form>


</section>


</body>
</html>
