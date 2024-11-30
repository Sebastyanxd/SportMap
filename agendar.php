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

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agendar Hora</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <style>
        :root {
            --primary-color:#2e8131;
            --background-dark: #1A1D21;
            --card-background: #282C34;
            --text-light: #ffffff;
            --text-gray: #8A8F98;
            --border-radius: 12px;
            --spacing-sm: 10px;
            --spacing-md: 20px;
            --spacing-lg: 30px;
            --pending-yellow: #FFD700;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background-color: var(--background-dark);
            margin: 0;
            padding: 0;
            min-height: 100vh;
            color: var(--text-light);
        }

        .header {
            background: var(--background-dark);
            padding: 15px 5%;
            position: fixed;
            top: 0;
            left: 0;
            width: 90%;
            z-index: 100;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .logout-icon {
            width: 24px;
            height: 24px;
            margin-left: 15px;
            vertical-align: middle;
        }

        .logo {
            display: flex;
            align-items: center;
        }

        .logo-image {
            height: 55px; /* Adjust the height as needed */
            margin-left: 10px; /* Adds some space between text and logo */
        }

        .logo span {
            color: var(--primary-color);
        }

        .navbar a {
            color: var(--text-light);
            text-decoration: none;
            margin-left: var(--spacing-md);
            transition: color 0.3s;
            font-size: 0.9rem;
        }

        .navbar a:hover,
        .navbar a.active {
            color: var(--primary-color);
        }

        .agendar {
            padding-top: 100px;
            max-width: 1400px;
            margin: 0 auto;
            padding: 100px 20px 20px;
        }

        .titulo {
            font-size: 5rem;
            font-weight: 600;
            color: var(--text-light);
            margin-bottom: var(--spacing-lg);
            text-align: center;
            margin-top:25px
        }

        .titulo span {
            color: var(--primary-color);
        }

        .booking-container {
            display: flex;
            gap: var(--spacing-lg);
            padding: var(--spacing-lg);
        }

        .map-container {
            flex: 1;
            border-radius: var(--border-radius);
            overflow: hidden;
            background: var(--card-background);
        }

        .map-container iframe {
            width: 100%;
            height: 650px;
            border: none;
        }

        .form-container {
            flex: 1;
            background: var(--card-background);
            padding: var(--spacing-lg);
            border-radius: var(--border-radius);
            border-left: 3px solid var(--primary-color);
        }

        .form-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: var(--spacing-md);
        }

        .input-box {
            margin-bottom: var(--spacing-md);
        }

        .input-box label {
            display: block;
            color: var(--primary-color);
            margin-bottom: var(--spacing-sm);
            font-size: 2rem;
            font-weight: 500;
        }

        .input-box select,
        .input-box input {
            width: 100%;
            padding: 12px;
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 6px;
            background: rgba(255, 255, 255, 0.05);
            color: var(--text-light);
            font-size: 1.2rem;
            transition: all 0.3s;
        }

        .input-box select option {
            background: var(--card-background);
            color: var(--text-light);
        }

        .input-box select:focus,
        .input-box input:focus {
            border-color: var(--primary-color);
            outline: none;
            background: rgba(255, 255, 255, 0.1);
        }

        .price-display {
            grid-column: 1 / -1;
            background: rgba(255, 255, 255, 0.05);
            padding: var(--spacing-md);
            border-radius: var(--border-radius);
            margin: var(--spacing-md) 0;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .price-display label {
            color: var(--primary-color);
            font-size: 1.5rem;
        }

        #precioPorHora {
            color: var(--text-light);
            font-size: 2rem;
            font-weight: 600;
        }

        .submit-button {
            grid-column: 1 / -1;
            background-color: var(--primary-color);
            color: var(--background-dark);
            border: none;
            padding: 15px;
            border-radius: var(--border-radius);
            font-size: 2rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            width: 100%;
        }

        .submit-button:hover {
            opacity: 0.9;
            transform: translateY(-1px);
        }

        @media (max-width: 1200px) {
            .booking-container {
                flex-direction: column;
            }
            
            .form-grid {
                grid-template-columns: 1fr;
            }
        }

        /* Status badge styles */
        .status-badge {
            background: var(--pending-yellow);
            color: var(--background-dark);
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
            text-transform: uppercase;
        }

        /* Created date style */
        .created-date {
            color: var(--text-gray);
            font-size: 0.8rem;
            margin-top: var(--spacing-md);
        }
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
    <a href="index.php" class="logo"> 
        Sport 
        <span>Maps</span>
        <img src="images/logo.png" alt="SportMaps Logo" class="logo-image">
    </a>
            
    <i class='bx bx-menu' id="menu-icon"></i>

    <nav class="navbar">
        <a href="index.php" >Home</a>
        <a href="index.php">Servicios</a>
        <a href="index.php">Contacto</a>
        <a href="agendar.php" class="active">Agendar</a>
        <a href="misreservas.php" >Mis reservas</a>
        
        <?php 
        // Verificar si hay un usuario con sesión iniciada
        if(isset($_SESSION['usuarioID'])) {
            echo '<a href="miperfil.php">Mi Perfil</a>';
            echo '<a href="logout.php">Cerrar sesion';
            echo '<img src="images/cerrar-sesion.png" alt="Logout" class="logout-icon">';
            echo '</a>';
        } else {
            echo '<a href="login.php">Iniciar sesion</a>';
        }
        ?>
    </nav>
</header>

    <section class="agendar">
        <h2 class="titulo" style="color: black;" >HACER UNA <span>RESERVA</span></h2> 

        <div class="booking-container">
            <div class="map-container">
                <iframe src="https://www.google.com/maps/d/u/0/embed?mid=1E4F6XPg1q4FUiPmHeiCKJBQ0Spoir8A&ehbc=2E312F"></iframe>
            </div>

        <form method="post" action="reservar.php" class="form-container">
            
            <div class="form-grid">
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
                        </select>
                    </div>

                    <div class="input-box">
                        <label for="metodoPago">Método de Pago:</label>
                        <select name="metodoPago" id="metodoPago" required>
                            <option value="tarjeta">Tarjeta de Crédito/Débito</option>
                        </select>
                    </div>

                    <div class="price-display">
                        <label for="precioPorHora">Precio por Hora:</label>
                        <div id="precioPorHora">$0.00</div>
                    </div>

                    <button type="submit" class="submit-button">Reservar Ahora</button>
                </div>
            </form>
        </div>
    </section>
</body>
</html>

