<?php
session_start(); // Iniciar sesión

// Verificar si la sesión está activa
if (!isset($_SESSION['usuarioID'])) {
    header("Location: login.php"); // Redirigir a login.php si no está autenticado
    exit();
}
include('conexion.php'); // Asegúrate de que este archivo define $conexion

// Obtener las comunas
$sql_comunas = "SELECT DISTINCT Comuna FROM centrosdeportivos ORDER BY Comuna";
$result_comunas = $conexion->query($sql_comunas);

// Obtener los centros deportivos
$sql_centros = "SELECT CentroID, Nombre FROM centrosdeportivos";
$result_centros = $conexion->query($sql_centros);

// Obtener canchas
$sql_canchas = "SELECT CanchaID, Numero, PrecioPorHora FROM Canchas";
$result_canchas = $conexion->query($sql_canchas);

// Obtener los horarios disponibles para una cancha en una fecha específica
$sql_horarios_disponibles = "
    SELECT H.HorarioID, H.HoraInicio, H.HoraFin
    FROM Horario H
    LEFT JOIN Reservas R ON H.HorarioID = R.HorarioID AND R.FechaReserva = ?
    WHERE H.CanchaID = ? AND R.HorarioID IS NULL
";
?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agendar Hora</title>
    <link rel="stylesheet" href="style3.css">
    <style>
    /* Estilos CSS */
    body { font-family: Arial, sans-serif; background-color: #f4f4f4; display: flex; justify-content: center; align-items: center; height: 100vh; margin: 0; font-size: 18px; } 
    form { background-color: #333; padding: 30px; border-radius: 12px; box-shadow: 0 0 20px rgba(0,0,0,0.2); width: 100%; max-width: 600px; margin-left: 50px; } 
    .input-group { display: flex; flex-wrap: wrap; justify-content: space-between; margin-bottom: 30px; } .input-box { width: 100%; margin-bottom: 20px; } 
    select, input[type="date"], input[type="submit"] { width: 100%; padding: 15px; margin-bottom: 15px; border: 1px solid #ddd; border-radius: 6px; box-sizing: border-box; font-size: 16px; } 
    input[type="submit"] { background-color: #4CAF50; color: white; border: none; cursor: pointer; font-size: 18px; padding: 15px 20px; } input[type="submit"]
    :hover { background-color: #45a049; } 
    label { display: block; margin-bottom: 10px; font-weight: bold; font-size: 18px; color: #fff; } 
    .titulo { font-size: 8rem; text-align: center; margin: 5rem 0; margin-top: 400px; } 
    </style>
    
    <script>
    function cargarCentros() {
        const comuna = document.getElementById('comuna').value;
        const centroSelect = document.getElementById('centroID');
        
        // Limpiar centros, canchas y horarios existentes
        centroSelect.innerHTML = "<option value=''>Seleccione un Centro Deportivo</option>";
        document.getElementById('canchaID').innerHTML = "<option value=''>Seleccione una Cancha</option>";
        document.getElementById('horarioID').innerHTML = "<option value=''>Seleccione un Horario</option>";
        document.getElementById('precioPorHora').textContent = "0.00"; // Limpiar el precio por hora

        if (comuna) {
            fetch(`obtener_centros.php?comuna=${comuna}`)
                .then(response => response.json())
                .then(data => {
                    data.forEach(centro => {
                        const option = document.createElement('option');
                        option.value = centro.CentroID;
                        option.textContent = centro.Nombre;
                        centroSelect.appendChild(option);
                    });
                })
                .catch(error => console.error('Error:', error));
        }
    }

    function cargarCanchas() {
    const centroID = document.getElementById('centroID').value;
    const canchaSelect = document.getElementById('canchaID');

    // Limpiar las opciones actuales
    canchaSelect.innerHTML = "<option value=''>Seleccione una Cancha</option>";
    document.getElementById('horarioID').innerHTML = "<option value=''>Seleccione un Horario</option>";
    document.getElementById('precioPorHora').textContent = "0.00"; // Limpiar el precio por hora

    if (centroID) {
        fetch(`obtener_canchas.php?centroID=${centroID}`)
            .then(response => response.json())
            .then(data => {
                if (data.length > 0) {
                    data.forEach(cancha => {
                        const option = document.createElement('option');
                        option.value = cancha.CanchaID;
                        option.textContent = `${cancha.Numero}`; // Solo muestra el número de la cancha
                        canchaSelect.appendChild(option);
                    });
                } else {
                    canchaSelect.innerHTML = "<option value=''>No hay canchas disponibles</option>";
                }
            })
            .catch(error => console.error('Error al cargar canchas:', error));
    }
}

    function cargarHorarios() {
        const canchaID = document.getElementById('canchaID').value;
        const horarioSelect = document.getElementById('horarioID');

        // Limpiar las opciones actuales
        horarioSelect.innerHTML = "<option value=''>Seleccione un Horario</option>";

        if (canchaID) {
            fetch(`obtener_horarios.php?canchaID=${canchaID}`)
                .then(response => response.json())
                .then(data => {
                    if (data.length > 0) {
                        data.forEach(horario => {
                            const option = document.createElement('option');
                            option.value = horario.HorarioID;
                            option.textContent = `${horario.HoraInicio} a ${horario.HoraFin}`;
                            horarioSelect.appendChild(option);
                        });
                    } else {
                        horarioSelect.innerHTML = "<option value=''>No hay horarios disponibles</option>";
                    }
                })
                .catch(error => console.error('Error al cargar horarios:', error));
        }
    }

    function mostrarPrecio() {
        const canchaID = document.getElementById('canchaID').value;
        const precioElement = document.getElementById('precioPorHora');

        // Buscar el precio de la cancha seleccionada
        <?php
        if ($result_canchas->num_rows > 0) {
            while ($row = $result_canchas->fetch_assoc()) {
                echo "if (canchaID == " . $row['CanchaID'] . ") {
                    precioElement.textContent = '$" . $row['PrecioPorHora'] . "';
                }";
            }
        }
        ?>
    }
    </script>
    <link rel="stylesheet" href="style3.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>


<header class="header">
    <a href="index.php" class="logo"> Sport<span>Maps</span></a>
    <i class='bx bx-menu' id="menu-icon"></i>
    <nav class="navbar">
        <a href="index.php" class="active">Home</a>
        <a href="index.php">Servicios</a>
        <a href="index.php">Contacto</a>
        <a href="agendar.php">Agendar</a>
        <a href="logout.php">Cerrar sesion</a>
    </nav>
</header>

<section class="agendar" id="agendar">
    <h2 class="titulo">Agendar <span>Cancha</span></h2> 

    <div style="display: flex;">
        <!-- Mapa -->
        <div style="margin-right: 20px;">
            <iframe src="https://www.google.com/maps/d/u/0/embed?mid=1E4F6XPg1q4FUiPmHeiCKJBQ0Spoir8A&ehbc=2E312F" width="640" height="650" style="border: none;"></iframe>
        </div>

        <form method="post" action="reservar.php">
            
            <div class="input-group">
            <div class="input-box">
                    <label for="comuna">Comuna:</label>
                    <select name="comuna" id="comuna" onchange="cargarCentros()" required>
                        <option value="">Seleccione una Comuna</option>
                        <?php
                        if ($result_comunas->num_rows > 0) {
                            while ($row = $result_comunas->fetch_assoc()) {
                                echo "<option value='" . $row['Comuna'] . "'>" . $row['Comuna'] . "</option>";
                            }
                        }
                        ?>
                    </select>
                </div>
            <div class="input-box">
                    <label for="centroID">Centro Deportivo:</label>
                    <select name="centroID" id="centroID" onchange="cargarCanchas()" required>
                        <option value="">Seleccione un Centro</option>
                    </select>
                </div>
                <div class="input-box">
                    <label for="canchaID">Cancha:</label>
                    <select name="canchaID" id="canchaID" onchange="cargarHorarios(); mostrarPrecio();" required>
                        <option value="">Seleccione una Cancha</option>
                    </select>
                </div>
                <div class="input-box">
                    <label for="fechaReserva">Fecha de Reserva:</label>
                    <input type="date" id="fechaReserva" name="fechaReserva" required>
                </div>
                <div class="input-box">
                    <label for="horarioID">Horario:</label>
                    <select name="horarioID" id="horarioID" required>
                        <option value="">Seleccione un Horario</option>
                        <!-- Aquí irán las opciones de horarios -->
                    </select>
                </div>
                <div class="input-box">
                    <label for="precioPorHora">Precio por Hora:</label>
                    <span id="precioPorHora">0.00</span>
                </div>
            </div>
            
                
                
            <div class="input-group">
                <div class="input-box">
                    <label for="metodoPago">Método de Pago:</label>
                    <select name="metodoPago" id="metodoPago" required>
                        <option value="">Seleccione un Método de Pago</option>
                        <option value="efectivo">Efectivo</option>
                        <option value="tarjeta">Tarjeta de Crédito/Débito</option>
                    </select>
                </div>
            </div>

            <input type="submit" value="Reservar">
        </form>
    </div>
</section>

</body>
</html>

