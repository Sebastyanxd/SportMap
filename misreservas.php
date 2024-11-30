<?php
session_start();
require 'conexion.php';
require 'vendor/autoload.php';

// Verificar si el usuario está logueado
if (!isset($_SESSION['usuarioID'])) {
    header('Location: login.php');
    exit();
}

$usuarioID = $_SESSION['usuarioID'];

// Configurar MercadoPago
MercadoPago\SDK::setAccessToken('APP_USR-3266153888801856-110616-779c897f38d32005ff0fe18286309a96-526639783');

// Consulta para obtener las reservas del usuario con información detallada
$sql = "
    SELECT 
        r.ReservaID,
        r.CodigoReserva,
        r.FechaReserva,
        r.HoraInicioReserva,
        r.HoraFinReserva,
        r.EstadoReserva,
        r.MontoTotal,
        r.MetodoPago,
        r.FechaCreacion,
        r.UltimaModificacion,
        c.Numero as NumeroCancha,
        cd.Nombre as NombreCentro,
        cd.Comuna as ComunaCentro
    FROM Reservas r
    INNER JOIN Canchas c ON r.CanchaID = c.CanchaID
    INNER JOIN CentrosDeportivos cd ON c.CentroID = cd.CentroID
    WHERE r.UsuarioID = ?
    ORDER BY r.FechaReserva DESC, r.HoraInicioReserva ASC
";

$stmt = $conexion->prepare($sql);
$stmt->bind_param("i", $usuarioID);
$stmt->execute();
$resultado = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mis Reservas</title>
    <link rel="stylesheet" href="style3.css">
    <script src="https://sdk.mercadopago.com/js/v2"></script>
    
    <style>
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
            height: 60px; /* Adjust the height as needed */
            margin-left: 10px; /* Adds some space between text and logo */
        }
        .titulo {
            font-size: 5rem;
            font-weight: 600;
            color: #white;
            margin-bottom: 15px;
            text-align: center;
            margin-top:00px
        }
    </style>

<script>
function cancelarReserva(reservaID) {
    if (!confirm('¿Estás seguro de que deseas cancelar esta reserva?')) {
        return;
    }

    fetch('cancelar_reserva.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: 'reservaID=' + reservaID
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert(data.message);
            location.reload();
        } else {
            alert(data.message);
        }
    })
    .catch(error => {
        alert('Error al procesar la solicitud');
        console.error('Error:', error);
    });
}
</script>
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
        <a href="#services">Servicios</a>
        <a href="#contact">Contacto</a>
        <a href="agendar.php">Agendar</a>
        <a href="misreservas.php" class="active">Mis reservas</a>
        
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

    <div class="container">
    <h2 class="titulo">Mis <span>Reservas</span></h2>

    <?php if ($resultado->num_rows > 0): ?>
        <?php while ($reserva = $resultado->fetch_assoc()): 
            // Crear preferencia de pago para cada reserva
            $preference = new MercadoPago\Preference();
            
            $item = new MercadoPago\Item();
            $item->id = $reserva['ReservaID'];
            $item->title = "Reserva " . $reserva['CodigoReserva'] . " - " . $reserva['NombreCentro'];
            $item->quantity = 1;
            $item->unit_price = (float)$reserva['MontoTotal'];
            $item->currency_id = "CLP";

            $preference->items = array($item);
            $preference->save();
        ?>
                <div class="reserva-card">
                    <div class="reserva-header">
                        <h2>Reserva: <?php echo htmlspecialchars($reserva['CodigoReserva']); ?></h2>
                        <span class="estado-reserva estado-<?php echo strtolower($reserva['EstadoReserva']); ?>">
                            <?php echo ucfirst(htmlspecialchars($reserva['EstadoReserva'])); ?>
                        </span>
                    </div>

                    <div class="reserva-detalles">
                        <div>
                            <h2><strong>Centro Deportivo:</strong> <?php echo htmlspecialchars($reserva['NombreCentro']); ?></h2>
                            <h2><strong>Dirección:</strong> <?php echo htmlspecialchars($reserva['ComunaCentro']); ?></h2>
                            <h2><strong>Cancha:</strong> <?php echo htmlspecialchars($reserva['NumeroCancha']); ?></h2>
                        </div>
                        <div>
                            <p><strong>Fecha:</strong> <?php echo date('d/m/Y', strtotime($reserva['FechaReserva'])); ?></p>
                            <p><strong>Horario:</strong> <?php echo substr($reserva['HoraInicioReserva'], 0, 5); ?> - <?php echo substr($reserva['HoraFinReserva'], 0, 5); ?></p>
                            <p><strong>Método de Pago:</strong> <?php echo $reserva['MetodoPago'] ? htmlspecialchars($reserva['MetodoPago']) : 'No especificado'; ?></p>
                        </div>
                    </div>

                    <div class="reserva-footer">
                        <div class="timestamp">
                            <h2><small>Creada: <?php echo date('d/m/Y H:i', strtotime($reserva['FechaCreacion'])); ?></small></h2>
                            <?php if ($reserva['UltimaModificacion'] != $reserva['FechaCreacion']): ?>
                                <p><small>Última modificación: <?php echo date('d/m/Y H:i', strtotime($reserva['UltimaModificacion'])); ?></small></p>
                            <?php endif; ?>
                        </div>
                        <div>
                            <p><strong>Monto Total:</strong> $<?php echo number_format((int)$reserva['MontoTotal'], 0, ',', '.'); ?></p>
                        </div>

                        
                    </div>
                    

                    <?php if ($reserva['EstadoReserva'] !== 'cancelada' && $reserva['EstadoReserva'] !== 'completada' && $reserva['MetodoPago'] !== 'MercadoPago'): ?>
<div class="payment-button">
    <div id="checkout-btn-<?php echo $reserva['ReservaID']; ?>"></div>
    <script>
        const mp_<?php echo $reserva['ReservaID']; ?> = new MercadoPago('APP_USR-9545fb7d-408f-4d69-932e-dcf43beb6e9c', {
            locale: 'es-CL'
        });
    
        mp_<?php echo $reserva['ReservaID']; ?>.checkout({
            preference: {
                id: '<?php echo $preference->id; ?>'
            },
            render: {
                container: '#checkout-btn-<?php echo $reserva['ReservaID']; ?>',
                label: 'Pagar con Mercado Pago'
            }
        });
    </script>
                        
                    </div>
                    <button 
                class="cancelar-btn" 
                onclick="cancelarReserva(<?php echo $reserva['ReservaID']; ?>)"
            >
                Cancelar Reserva
            </button>
                    <?php endif; ?>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <div class="no-reservas">
                <h2>No tienes reservas activas</h2>
                <p>¡Realiza tu primera reserva ahora!</p>
                <a href="index.php" class="volver-btn">Hacer una Reserva</a>
            </div>
        <?php endif; ?>
    </div>

    
</body>
</html>