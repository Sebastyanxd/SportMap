<?php
session_start();
require 'conexion.php';

// Verify user is logged in
if (!isset($_SESSION['usuarioID'])) {
    header('Location: login.php');
    exit();
}

$usuarioID = $_SESSION['usuarioID'];

// Fetch user details
$sql = "SELECT * FROM Usuario WHERE UserID = ?";
$stmt = $conexion->prepare($sql);
$stmt->bind_param("i", $usuarioID);
$stmt->execute();
$resultado = $stmt->get_result();
$usuario = $resultado->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style> /* Existing styles from previous profile page */
            
               * {
                margin: 0;
                padding: 0;
                box-sizing: border-box;
                font-family: Arial, sans-serif;
            }
    
            body {
                background-color: #1f242d;
                color: #fff;
                line-height: 1.6;
            }
    
            .header {
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                padding: 20px 10%;
                background: #323946;
                display: flex;
                justify-content: space-between;
                align-items: center;
                z-index: 100;
            }
    
            .logo {
                font-size: 25px;
                color: #fff;
                text-decoration: none;
                font-weight: 600;
            }
    
            .logo span {
                color: #22ad27;
            }
    
            .navbar a {
                font-size: 18px;
                color: #fff;
                text-decoration: none;
                margin-left: 20px;
                transition: .3s;
            }
    
            .navbar a:hover,
            .navbar a.active {
                color: #22ad27;
            }
    
            .container {
                max-width: 1200px;
                margin: 120px auto 50px auto;
                padding: 20px;
                background-color: #1f242d;
                border-radius: 15px;
                box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
            }
    
            .titulo {
                font-size: 4rem;
                text-align: center;
                margin: 3rem 0;
                color: #fff;
                text-transform: uppercase;
                letter-spacing: 2px;
            }
    
            .titulo span {
                color: #22ad27;
            }
    
            .profile-card {
                background: linear-gradient(145deg, #2a303c, #242832);
                border: 1px solid #363d4a;
                border-radius: 15px;
                padding: 25px;
                margin-bottom: 25px;
                box-shadow: 0 4px 15px rgba(0,0,0,0.15);
            }
    
            .profile-details {
                display: grid;
                grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
                gap: 25px;
                margin: 20px 0;
                color: #fff;
            }
    
            .profile-details div {
                padding: 15px;
                background-color: #2a303c;
                border-radius: 10px;
                border: 1px solid #363d4a;
            }
    
            .form-group {
                margin-bottom: 15px;
            }
    
            .form-group label {
                display: block;
                color: #22ad27;
                margin-bottom: 5px;
            }
    
            .form-control {
                width: 100%;
                padding: 10px;
                background-color: #2a303c;
                border: 1px solid #363d4a;
                border-radius: 5px;
                color: #fff;
            }
    
            .btn {
                display: inline-block;
                padding: 12px 30px;
                background-color: #22ad27;
                color: #1f242d;
                text-decoration: none;
                border-radius: 25px;
                font-weight: 600;
                transition: all 0.3s ease;
                border: none;
                cursor: pointer;
            }
    
            .btn:hover {
                background-color: #22ad27;
                transform: translateY(-2px);
            }
    
            .btn-danger {
                background-color: #dc3545;
                color: white;
            }
    
            .btn-danger:hover {
                background-color: #c82333;
            }
    
            .tipo-usuario {
                background-color: #2a303c;
                padding: 10px;
                border-radius: 5px;
                margin-bottom: 15px;
            }
    
            @media (max-width: 768px) {
                .container {
                    margin: 100px 15px 30px 15px;
                }
    
                .titulo {
                    font-size: 3rem;
                }
    
                .profile-details {
                    grid-template-columns: 1fr;
                }
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
            height: 60px; /* Adjust the height as needed */
            margin-left: 10px; /* Adds some space between text and logo */
        }
            </style>

    <title>Perfil de Usuario - SportMaps</title>
    
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
        <a href="misreservas.php">Mis reservas</a>
        
        <?php 
        // Verificar si hay un usuario con sesión iniciada
        if(isset($_SESSION['usuarioID'])) {
            echo '<a href="miperfil.php" class="active">Mi Perfil</a>';
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
        <h2 class="titulo">Mi <span>Perfil</span></h2>

        <div class="profile-card">
            <form id="profileForm"  method="POST" action="actualizar_perfil.php">
                <div class="tipo-usuario">
                    <strong>Tipo de Usuario:</strong> <?php echo htmlspecialchars($usuario['TipoUsuario']); ?>
                    <strong>Fecha de Registro:</strong> <?php echo date('d/m/Y', strtotime($usuario['FechaRegistro'])); ?>
                </div>

                <div class="profile-details">
                    <div>
                        <div class="form-group">
                            <label for="nombre">Nombre Completo</label>
                            <input type="text" id="nombre" name="nombre" class="form-control" 
                                   value="<?php echo htmlspecialchars($usuario['Nombre']); ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Correo Electrónico</label>
                            <input type="email" id="email" name="email" class="form-control" 
                                   value="<?php echo htmlspecialchars($usuario['Email']); ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="telefono">Teléfono</label>
                            <input type="tel" id="telefono" name="telefono" class="form-control" 
                                   value="<?php echo htmlspecialchars($usuario['Telefono'] ?? ''); ?>">
                        </div>
                    </div>
                    <div>
                        <div class="form-group">
                            <label for="direccion">Dirección</label>
                            <input type="text" id="direccion" name="direccion" class="form-control" 
                                   value="<?php echo htmlspecialchars($usuario['Direccion'] ?? ''); ?>">
                        </div>
                        <div class="form-group">
                            <label for="nuevaContrasena">Nueva Contraseña</label>
                            <input type="password" id="nuevaContrasena" name="nuevaContrasena" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="confirmarContrasena">Confirmar Nueva Contraseña</label>
                            <input type="password" id="confirmarContrasena" name="confirmarContrasena" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="text-right">
                    <button type="submit" class="btn">Guardar Cambios</button>
                    <button type="button" class="btn btn-danger" onclick="window.location.reload()">Cancelar</button>
                </div>
            </form>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="js/actualizar_perfil.js"></script>
</body>
</html>