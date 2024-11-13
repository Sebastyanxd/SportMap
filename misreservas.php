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
        /* Estilo de la tarjeta de cada reserva */
        .reserva-card {
            background-color: grey;
            border: 1px solid #e3e3e3;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            transition: transform 0.2s;
            width: 100%;
            font-size: 1.20rem;
        }

        .reserva-card:hover {
            transform: translateY(-5px);
        }

        /* Encabezado de la tarjeta */
        .reserva-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
            color: #000;
        }

        .estado-reserva {
            padding: 5px 10px;
            border-radius: 5px;
            font-weight: bold;
        }

        .estado-pendiente {
            background-color: #ffcc00;
            color: #000;
        }

        .estado-confirmada {
            background-color: #28a745;
            color: #fff;
        }

        .estado-cancelada {
            background-color: #dc3545;
            color: #fff;
        }

        .estado-completada {
            background-color: #17a2b8;
            color: #fff;
        }

        /* Estilo de los detalles de la reserva */
        .reserva-detalles {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 10px;
        }

        /* Footer de la tarjeta */
        .reserva-footer {
            margin-top: 15px;
            padding-top: 15px;
            border-top: 1px solid #eee;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        /* Contenedor de la página */
        .container {
            max-width: 95%;
            margin: 120px auto 50px auto;
            padding: 20px;
            background-color: #343a40;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        /* Título principal */
        .page-title {
            text-align: center;
            margin-bottom: 30px;
            color: #333;
        }

        /* Mensaje para cuando no hay reservas */
        .no-reservas {
            text-align: center;
            padding: 40px;
            background-color: grey;
            border-radius: 10px;
            margin: 20px auto;
            max-width: 600px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            font-size: 2rem;
        }

        /* Botón de volver */
        .volver-btn {
            display: inline-block;
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            margin-bottom: 20px;
            transition: background-color 0.3s;
        }

        .volver-btn:hover {
            background-color: #0056b3;
        }

        /* Estilo de la marca de tiempo */
        .timestamp {
            font-size: 0.85em;
            color: blue;
        }

        /* Título de la página */
        .titulo { 
            font-size: 8rem; 
            text-align: center; 
            margin: 5rem 0; 
        }

        /* Estilo para el contenedor del botón de pago */
        .payment-button {
            margin-top: 15px;
            padding-top: 15px;
            border-top: 1px solid #eee;
            display: flex;
            justify-content: flex-end;
        }
    </style>
</head>
<body>
    <header class="header">
        <a href="index.php" class="logo">Sport<span>Maps</span></a>
        <i class='bx bx-menu' id="menu-icon"></i>
        <nav class="navbar">
            <a href="index.php" class="active">Home</a>
            <a href="index.php">Servicios</a>
            <a href="index.php">Contacto</a>
            <a href="agendar.php">Agendar</a>
            <a href="misreservas.php">Mis reservas</a>
            <a href="logout.php">Cerrar sesion</a>
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

                    <?php if ($reserva['EstadoReserva'] !== 'cancelada' && $reserva['MetodoPago'] !== 'MercadoPago'): ?>
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