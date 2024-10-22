-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 22-10-2024 a las 23:52:35
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `sportmaps`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `canchas`
--

CREATE TABLE `canchas` (
  `CanchaID` int(11) NOT NULL,
  `CentroID` int(11) NOT NULL,
  `Numero` varchar(20) NOT NULL,
  `TipoCancha` varchar(50) NOT NULL,
  `Capacidad` int(11) DEFAULT NULL,
  `PrecioPorHora` decimal(10,2) NOT NULL,
  `Caracteristicas` text DEFAULT NULL,
  `EstadoActivo` tinyint(1) DEFAULT 1,
  `FechaCreacion` datetime DEFAULT current_timestamp(),
  `UltimaModificacion` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `canchas`
--

INSERT INTO `canchas` (`CanchaID`, `CentroID`, `Numero`, `TipoCancha`, `Capacidad`, `PrecioPorHora`, `Caracteristicas`, `EstadoActivo`, `FechaCreacion`, `UltimaModificacion`) VALUES
(1, 1, 'C1', 'Fútbol', 22, 100.00, NULL, 1, '2024-10-22 14:07:51', '2024-10-22 14:07:51'),
(2, 1, 'C2', 'Tenis', 4, 50.00, NULL, 1, '2024-10-22 14:07:51', '2024-10-22 14:07:51'),
(3, 2, 'C1', 'Básquetbol', 10, 75.00, NULL, 1, '2024-10-22 14:07:51', '2024-10-22 14:07:51'),
(4, 3, 'C1', 'Fútbol Sala', 12, 80.00, NULL, 1, '2024-10-22 14:07:51', '2024-10-22 14:07:51');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `centrosdeportivos`
--

CREATE TABLE `centrosdeportivos` (
  `CentroID` int(11) NOT NULL,
  `Nombre` varchar(100) NOT NULL,
  `Ubicacion` varchar(255) NOT NULL,
  `Telefono` varchar(20) DEFAULT NULL,
  `Email` varchar(100) DEFAULT NULL,
  `Descripcion` text DEFAULT NULL,
  `TipoCentro` varchar(50) DEFAULT NULL,
  `Activo` tinyint(1) DEFAULT 1,
  `FechaCreacion` datetime DEFAULT current_timestamp(),
  `UltimaModificacion` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `Comuna` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `centrosdeportivos`
--

INSERT INTO `centrosdeportivos` (`CentroID`, `Nombre`, `Ubicacion`, `Telefono`, `Email`, `Descripcion`, `TipoCentro`, `Activo`, `FechaCreacion`, `UltimaModificacion`, `Comuna`) VALUES
(1, 'SportCenter Elite', 'Av. Principal 123', '555-0101', 'info@sportelite.com', 'Centro deportivo de primera clase', 'Premium', 1, '2024-10-22 14:07:51', '2024-10-22 14:24:56', 'Comuna A'),
(2, 'Campo Alegre', 'Calle 45 #789', '555-0102', 'campo@alegre.com', 'Instalaciones familiares', 'Familiar', 1, '2024-10-22 14:07:51', '2024-10-22 14:24:56', 'Comuna B'),
(3, 'Urban Sports', 'Plaza Central 456', '555-0103', 'urban@sports.com', 'Deportes urbanos', 'Urbano', 1, '2024-10-22 14:07:51', '2024-10-22 14:24:56', 'Comuna C'),
(4, 'Club Deportivo Norte', 'Av. Norte 789', '555-0104', 'club@norte.com', 'Centro deportivo completo', 'Premium', 1, '2024-10-22 14:07:51', '2024-10-22 14:24:56', 'Comuna D');

--
-- Disparadores `centrosdeportivos`
--
DELIMITER $$
CREATE TRIGGER `after_centro_deportivo_insert` AFTER INSERT ON `centrosdeportivos` FOR EACH ROW BEGIN
    INSERT INTO LogsAuditoria (TipoOperacion, TablaAfectada, RegistroID, Detalles)
    VALUES ('INSERT', 'CentrosDeportivos', NEW.CentroID, CONCAT('Nuevo centro deportivo: ', NEW.Nombre));
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `equipamiento`
--

CREATE TABLE `equipamiento` (
  `EquipamientoID` int(11) NOT NULL,
  `CanchaID` int(11) NOT NULL,
  `Nombre` varchar(100) NOT NULL,
  `Descripcion` text DEFAULT NULL,
  `Cantidad` int(11) NOT NULL DEFAULT 1,
  `Estado` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `equipamiento`
--

INSERT INTO `equipamiento` (`EquipamientoID`, `CanchaID`, `Nombre`, `Descripcion`, `Cantidad`, `Estado`) VALUES
(1, 1, 'Balón Fútbol', 'Balón oficial tamaño 5', 5, 'Bueno'),
(2, 1, 'Red', 'Red de portería', 2, 'Excelente'),
(3, 2, 'Raquetas', 'Raquetas de tenis', 4, 'Bueno'),
(4, 2, 'Pelotas Tenis', 'Tubo de pelotas', 12, 'Nuevo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `horario`
--

CREATE TABLE `horario` (
  `HorarioID` int(11) NOT NULL,
  `CanchaID` int(11) NOT NULL,
  `Fecha` date NOT NULL,
  `HoraInicio` time NOT NULL,
  `HoraFin` time NOT NULL,
  `Disponible` tinyint(1) DEFAULT 1,
  `EstadoHorario` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `horario`
--

INSERT INTO `horario` (`HorarioID`, `CanchaID`, `Fecha`, `HoraInicio`, `HoraFin`, `Disponible`, `EstadoHorario`) VALUES
(1, 1, '2024-10-22', '08:00:00', '09:00:00', 1, NULL),
(2, 1, '2024-10-22', '09:00:00', '10:00:00', 1, NULL),
(3, 2, '2024-10-22', '08:00:00', '09:00:00', 1, NULL),
(4, 2, '2024-10-22', '09:00:00', '10:00:00', 0, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `horariooperacion`
--

CREATE TABLE `horariooperacion` (
  `HorarioOpID` int(11) NOT NULL,
  `CentroID` int(11) NOT NULL,
  `DiaSemana` varchar(20) NOT NULL,
  `HoraApertura` time NOT NULL,
  `HoraCierre` time NOT NULL,
  `EsFeriado` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `horariooperacion`
--

INSERT INTO `horariooperacion` (`HorarioOpID`, `CentroID`, `DiaSemana`, `HoraApertura`, `HoraCierre`, `EsFeriado`) VALUES
(1, 1, 'Lunes', '06:00:00', '23:00:00', 0),
(2, 1, 'Martes', '06:00:00', '23:00:00', 0),
(3, 1, 'Miércoles', '06:00:00', '23:00:00', 0),
(4, 2, 'Lunes', '07:00:00', '22:00:00', 0),
(5, 2, 'Martes', '07:00:00', '22:00:00', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `logsauditoria`
--

CREATE TABLE `logsauditoria` (
  `LogID` int(11) NOT NULL,
  `TipoOperacion` varchar(50) NOT NULL,
  `TablaAfectada` varchar(50) NOT NULL,
  `RegistroID` int(11) NOT NULL,
  `Detalles` text DEFAULT NULL,
  `UsuarioID` int(11) DEFAULT NULL,
  `FechaOperacion` datetime DEFAULT current_timestamp(),
  `DireccionIP` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `logsauditoria`
--

INSERT INTO `logsauditoria` (`LogID`, `TipoOperacion`, `TablaAfectada`, `RegistroID`, `Detalles`, `UsuarioID`, `FechaOperacion`, `DireccionIP`) VALUES
(1, 'INSERT', 'CentrosDeportivos', 1, 'Nuevo centro deportivo: SportCenter Elite', NULL, '2024-10-22 14:07:51', NULL),
(2, 'INSERT', 'CentrosDeportivos', 2, 'Nuevo centro deportivo: Campo Alegre', NULL, '2024-10-22 14:07:51', NULL),
(3, 'INSERT', 'CentrosDeportivos', 3, 'Nuevo centro deportivo: Urban Sports', NULL, '2024-10-22 14:07:51', NULL),
(4, 'INSERT', 'CentrosDeportivos', 4, 'Nuevo centro deportivo: Club Deportivo Norte', NULL, '2024-10-22 14:07:51', NULL),
(5, 'INSERT', 'CentrosDeportivos', 5, 'Nuevo centro deportivo: SportCenter Elite', NULL, '2024-10-22 14:09:40', NULL),
(6, 'INSERT', 'CentrosDeportivos', 6, 'Nuevo centro deportivo: Campo Alegre', NULL, '2024-10-22 14:09:40', NULL),
(7, 'INSERT', 'CentrosDeportivos', 7, 'Nuevo centro deportivo: Urban Sports', NULL, '2024-10-22 14:09:40', NULL),
(8, 'INSERT', 'CentrosDeportivos', 8, 'Nuevo centro deportivo: Club Deportivo Norte', NULL, '2024-10-22 14:09:40', NULL),
(9, 'INSERT', 'Reservas', 5, 'Nueva reserva: RES-6717f3a471219', 11, '2024-10-22 14:49:08', NULL),
(10, 'INSERT', 'Reservas', 6, 'Nueva reserva: RES-6717f47f57404', 11, '2024-10-22 14:52:47', NULL),
(11, 'INSERT', 'Reservas', 7, 'Nueva reserva: RES-6717f52d6f055', 11, '2024-10-22 14:55:41', NULL),
(12, 'INSERT', 'Reservas', 8, 'Nueva reserva: RES-671801326b1a0', 11, '2024-10-22 15:46:58', NULL),
(13, 'INSERT', 'Reservas', 9, 'Nueva reserva: RES-671801ae0aac2', 11, '2024-10-22 15:49:02', NULL),
(14, 'INSERT', 'Reservas', 10, 'Nueva reserva: RES-671801c5491ff', 11, '2024-10-22 15:49:25', NULL),
(15, 'INSERT', 'Reservas', 11, 'Nueva reserva: RES-671801f582dad', 11, '2024-10-22 15:50:13', NULL),
(16, 'INSERT', 'Reservas', 12, 'Nueva reserva: RES-671802757d7fe', 11, '2024-10-22 15:52:21', NULL),
(17, 'INSERT', 'Reservas', 13, 'Nueva reserva: RES-671805dea6cba', 11, '2024-10-22 16:06:54', NULL),
(18, 'INSERT', 'Reservas', 14, 'Nueva reserva: RES-671806bd8f336', 11, '2024-10-22 16:10:37', NULL),
(19, 'INSERT', 'Reservas', 15, 'Nueva reserva: RES-67180bda57ed6', 11, '2024-10-22 16:32:26', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `promociones`
--

CREATE TABLE `promociones` (
  `PromocionID` int(11) NOT NULL,
  `CentroID` int(11) NOT NULL,
  `Codigo` varchar(50) NOT NULL,
  `Descripcion` text DEFAULT NULL,
  `Descuento` decimal(5,2) NOT NULL,
  `FechaInicio` datetime NOT NULL,
  `FechaFin` datetime NOT NULL,
  `Activa` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `resenas`
--

CREATE TABLE `resenas` (
  `ResenaID` int(11) NOT NULL,
  `UsuarioID` int(11) NOT NULL,
  `CanchaID` int(11) NOT NULL,
  `Calificacion` int(11) NOT NULL CHECK (`Calificacion` between 1 and 5),
  `Comentario` text DEFAULT NULL,
  `FechaResena` datetime DEFAULT current_timestamp(),
  `Aprobada` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reservas`
--

CREATE TABLE `reservas` (
  `ReservaID` int(11) NOT NULL,
  `CodigoReserva` varchar(20) NOT NULL,
  `UsuarioID` int(11) NOT NULL,
  `CanchaID` int(11) NOT NULL,
  `HorarioID` int(11) NOT NULL,
  `FechaReserva` date NOT NULL,
  `HoraInicioReserva` time NOT NULL,
  `HoraFinReserva` time NOT NULL,
  `EstadoReserva` enum('pendiente','confirmada','cancelada','completada') NOT NULL,
  `MontoTotal` varchar(20) NOT NULL,
  `MetodoPago` varchar(50) DEFAULT NULL,
  `FechaCreacion` datetime DEFAULT current_timestamp(),
  `UltimaModificacion` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `reservas`
--

INSERT INTO `reservas` (`ReservaID`, `CodigoReserva`, `UsuarioID`, `CanchaID`, `HorarioID`, `FechaReserva`, `HoraInicioReserva`, `HoraFinReserva`, `EstadoReserva`, `MontoTotal`, `MetodoPago`, `FechaCreacion`, `UltimaModificacion`) VALUES
(14, 'RES-671806bd8f336', 11, 1, 1, '2024-10-25', '08:00:00', '09:00:00', 'pendiente', '100.00', 'debito', '2024-10-22 16:10:37', '2024-10-22 16:10:37'),
(15, 'RES-67180bda57ed6', 11, 1, 1, '2024-10-30', '08:00:00', '09:00:00', 'pendiente', '100.00', 'efectivo', '2024-10-22 16:32:26', '2024-10-22 16:32:26');

--
-- Disparadores `reservas`
--
DELIMITER $$
CREATE TRIGGER `after_reserva_insert` AFTER INSERT ON `reservas` FOR EACH ROW BEGIN
    INSERT INTO LogsAuditoria (TipoOperacion, TablaAfectada, RegistroID, UsuarioID, Detalles)
    VALUES ('INSERT', 'Reservas', NEW.ReservaID, NEW.UsuarioID, 
            CONCAT('Nueva reserva: ', NEW.CodigoReserva));
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `servicios`
--

CREATE TABLE `servicios` (
  `ServicioID` int(11) NOT NULL,
  `CentroID` int(11) NOT NULL,
  `Nombre` varchar(100) NOT NULL,
  `Descripcion` text DEFAULT NULL,
  `Precio` decimal(10,2) DEFAULT NULL,
  `Disponible` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `servicios`
--

INSERT INTO `servicios` (`ServicioID`, `CentroID`, `Nombre`, `Descripcion`, `Precio`, `Disponible`) VALUES
(1, 1, 'Vestidores Premium', 'Vestidores con casilleros electrónicos', 25.00, 1),
(2, 1, 'Estacionamiento', 'Estacionamiento techado', 15.00, 1),
(3, 2, 'Cafetería', 'Servicio de cafetería y snacks', 0.00, 1),
(4, 3, 'Instructor Personal', 'Servicio de instructor personal', 45.00, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `transacciones`
--

CREATE TABLE `transacciones` (
  `TransaccionID` int(11) NOT NULL,
  `ReservaID` int(11) NOT NULL,
  `Monto` decimal(10,2) NOT NULL,
  `FechaTransaccion` datetime DEFAULT current_timestamp(),
  `Estado` enum('pendiente','completada','fallida','reembolsada') NOT NULL,
  `NumeroReferencia` varchar(100) DEFAULT NULL,
  `MetodoPago` varchar(50) NOT NULL,
  `DetallesPago` text DEFAULT NULL,
  `TipoTransaccion` enum('pago','reembolso','cargo adicional') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Disparadores `transacciones`
--
DELIMITER $$
CREATE TRIGGER `after_transaccion_insert` AFTER INSERT ON `transacciones` FOR EACH ROW BEGIN
    INSERT INTO LogsAuditoria (TipoOperacion, TablaAfectada, RegistroID, Detalles)
    VALUES ('INSERT', 'Transacciones', NEW.TransaccionID, 
            CONCAT('Nueva transacción: ', NEW.NumeroReferencia));
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `UserID` int(11) NOT NULL,
  `Nombre` varchar(100) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Contrasena` varchar(255) NOT NULL,
  `Telefono` varchar(20) DEFAULT NULL,
  `TipoUsuario` enum('normal','admin') DEFAULT 'normal',
  `EstadoActivo` tinyint(1) DEFAULT 1,
  `FechaRegistro` datetime DEFAULT current_timestamp(),
  `UltimaModificacion` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `Direccion` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`UserID`, `Nombre`, `Email`, `Contrasena`, `Telefono`, `TipoUsuario`, `EstadoActivo`, `FechaRegistro`, `UltimaModificacion`, `Direccion`) VALUES
(2, 'Juan Pérez', 'juan@email.com', 'ef92b778bafe771e89245b89ecbc08a44a4e166c06659911881f383d4473e94f', '555-1001', 'normal', 1, '2024-10-22 14:07:51', '2024-10-22 14:07:51', ''),
(3, 'María García', 'maria@email.com', 'c6ba91b90d922e159893f46c387e5dc1b3dc5c101a5a4522f03b987177a24a91', '555-1002', 'admin', 1, '2024-10-22 14:07:51', '2024-10-22 14:07:51', ''),
(4, 'Carlos López', 'carlos@email.com', '5efc2b017da4f7736d192a74dde5891369e0685d4d38f2a455b6fcdab282df9c', '555-1003', 'normal', 1, '2024-10-22 14:07:51', '2024-10-22 14:07:51', ''),
(5, 'Ana Martínez', 'ana@email.com', '6733b7ffeace4887c3b31258079c780d8db3018db9cbc05c500df3521f968df8', '555-1004', 'normal', 1, '2024-10-22 14:07:51', '2024-10-22 14:07:51', ''),
(10, 'sebastian', 'sebas.200294@gmail.com', '$2y$10$1A/WThttcJ9M.UtSP8pIie4iNY1RQzoVz48UZnn9fU4FmYHlpmaKW', '1231231', 'normal', 1, '2024-10-22 00:00:00', '2024-10-22 14:41:37', 'test'),
(11, 'sebastian', 'KEVINQLO@GMAIL.COM', '$2y$10$7kaRarnBLQfRLYQ3fr2EAOboGKIhH0JQFnUlNMoyD1FbVMM1vFOiS', '1231231', 'normal', 1, '2024-10-22 00:00:00', '2024-10-22 14:42:14', 'test');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `canchas`
--
ALTER TABLE `canchas`
  ADD PRIMARY KEY (`CanchaID`),
  ADD UNIQUE KEY `idx_centro_numero` (`CentroID`,`Numero`);

--
-- Indices de la tabla `centrosdeportivos`
--
ALTER TABLE `centrosdeportivos`
  ADD PRIMARY KEY (`CentroID`),
  ADD KEY `idx_nombre` (`Nombre`),
  ADD KEY `idx_ubicacion` (`Ubicacion`);

--
-- Indices de la tabla `equipamiento`
--
ALTER TABLE `equipamiento`
  ADD PRIMARY KEY (`EquipamientoID`),
  ADD KEY `CanchaID` (`CanchaID`);

--
-- Indices de la tabla `horario`
--
ALTER TABLE `horario`
  ADD PRIMARY KEY (`HorarioID`),
  ADD KEY `CanchaID` (`CanchaID`),
  ADD KEY `idx_fecha` (`Fecha`),
  ADD KEY `idx_disponibilidad` (`Disponible`);

--
-- Indices de la tabla `horariooperacion`
--
ALTER TABLE `horariooperacion`
  ADD PRIMARY KEY (`HorarioOpID`),
  ADD KEY `CentroID` (`CentroID`);

--
-- Indices de la tabla `logsauditoria`
--
ALTER TABLE `logsauditoria`
  ADD PRIMARY KEY (`LogID`),
  ADD KEY `UsuarioID` (`UsuarioID`),
  ADD KEY `idx_fecha_operacion` (`FechaOperacion`);

--
-- Indices de la tabla `promociones`
--
ALTER TABLE `promociones`
  ADD PRIMARY KEY (`PromocionID`),
  ADD UNIQUE KEY `Codigo` (`Codigo`),
  ADD KEY `CentroID` (`CentroID`),
  ADD KEY `idx_codigo` (`Codigo`),
  ADD KEY `idx_fechas` (`FechaInicio`,`FechaFin`);

--
-- Indices de la tabla `resenas`
--
ALTER TABLE `resenas`
  ADD PRIMARY KEY (`ResenaID`),
  ADD KEY `UsuarioID` (`UsuarioID`),
  ADD KEY `CanchaID` (`CanchaID`),
  ADD KEY `idx_calificacion` (`Calificacion`);

--
-- Indices de la tabla `reservas`
--
ALTER TABLE `reservas`
  ADD PRIMARY KEY (`ReservaID`),
  ADD UNIQUE KEY `CodigoReserva` (`CodigoReserva`),
  ADD KEY `UsuarioID` (`UsuarioID`),
  ADD KEY `CanchaID` (`CanchaID`),
  ADD KEY `HorarioID` (`HorarioID`),
  ADD KEY `idx_codigo` (`CodigoReserva`),
  ADD KEY `idx_fecha_reserva` (`FechaReserva`);

--
-- Indices de la tabla `servicios`
--
ALTER TABLE `servicios`
  ADD PRIMARY KEY (`ServicioID`),
  ADD KEY `CentroID` (`CentroID`);

--
-- Indices de la tabla `transacciones`
--
ALTER TABLE `transacciones`
  ADD PRIMARY KEY (`TransaccionID`),
  ADD KEY `ReservaID` (`ReservaID`),
  ADD KEY `idx_fecha_transaccion` (`FechaTransaccion`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`UserID`),
  ADD UNIQUE KEY `idx_email` (`Email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `canchas`
--
ALTER TABLE `canchas`
  MODIFY `CanchaID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `centrosdeportivos`
--
ALTER TABLE `centrosdeportivos`
  MODIFY `CentroID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `equipamiento`
--
ALTER TABLE `equipamiento`
  MODIFY `EquipamientoID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `horario`
--
ALTER TABLE `horario`
  MODIFY `HorarioID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `horariooperacion`
--
ALTER TABLE `horariooperacion`
  MODIFY `HorarioOpID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `logsauditoria`
--
ALTER TABLE `logsauditoria`
  MODIFY `LogID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de la tabla `promociones`
--
ALTER TABLE `promociones`
  MODIFY `PromocionID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `resenas`
--
ALTER TABLE `resenas`
  MODIFY `ResenaID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `reservas`
--
ALTER TABLE `reservas`
  MODIFY `ReservaID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `servicios`
--
ALTER TABLE `servicios`
  MODIFY `ServicioID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `transacciones`
--
ALTER TABLE `transacciones`
  MODIFY `TransaccionID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `canchas`
--
ALTER TABLE `canchas`
  ADD CONSTRAINT `canchas_ibfk_1` FOREIGN KEY (`CentroID`) REFERENCES `centrosdeportivos` (`CentroID`) ON DELETE CASCADE;

--
-- Filtros para la tabla `equipamiento`
--
ALTER TABLE `equipamiento`
  ADD CONSTRAINT `equipamiento_ibfk_1` FOREIGN KEY (`CanchaID`) REFERENCES `canchas` (`CanchaID`) ON DELETE CASCADE;

--
-- Filtros para la tabla `horario`
--
ALTER TABLE `horario`
  ADD CONSTRAINT `horario_ibfk_1` FOREIGN KEY (`CanchaID`) REFERENCES `canchas` (`CanchaID`) ON DELETE CASCADE;

--
-- Filtros para la tabla `horariooperacion`
--
ALTER TABLE `horariooperacion`
  ADD CONSTRAINT `horariooperacion_ibfk_1` FOREIGN KEY (`CentroID`) REFERENCES `centrosdeportivos` (`CentroID`) ON DELETE CASCADE;

--
-- Filtros para la tabla `logsauditoria`
--
ALTER TABLE `logsauditoria`
  ADD CONSTRAINT `logsauditoria_ibfk_1` FOREIGN KEY (`UsuarioID`) REFERENCES `usuario` (`UserID`);

--
-- Filtros para la tabla `promociones`
--
ALTER TABLE `promociones`
  ADD CONSTRAINT `promociones_ibfk_1` FOREIGN KEY (`CentroID`) REFERENCES `centrosdeportivos` (`CentroID`);

--
-- Filtros para la tabla `resenas`
--
ALTER TABLE `resenas`
  ADD CONSTRAINT `resenas_ibfk_1` FOREIGN KEY (`UsuarioID`) REFERENCES `usuario` (`UserID`),
  ADD CONSTRAINT `resenas_ibfk_2` FOREIGN KEY (`CanchaID`) REFERENCES `canchas` (`CanchaID`);

--
-- Filtros para la tabla `reservas`
--
ALTER TABLE `reservas`
  ADD CONSTRAINT `reservas_ibfk_1` FOREIGN KEY (`UsuarioID`) REFERENCES `usuario` (`UserID`),
  ADD CONSTRAINT `reservas_ibfk_2` FOREIGN KEY (`CanchaID`) REFERENCES `canchas` (`CanchaID`),
  ADD CONSTRAINT `reservas_ibfk_3` FOREIGN KEY (`HorarioID`) REFERENCES `horario` (`HorarioID`);

--
-- Filtros para la tabla `servicios`
--
ALTER TABLE `servicios`
  ADD CONSTRAINT `servicios_ibfk_1` FOREIGN KEY (`CentroID`) REFERENCES `centrosdeportivos` (`CentroID`) ON DELETE CASCADE;

--
-- Filtros para la tabla `transacciones`
--
ALTER TABLE `transacciones`
  ADD CONSTRAINT `transacciones_ibfk_1` FOREIGN KEY (`ReservaID`) REFERENCES `reservas` (`ReservaID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
