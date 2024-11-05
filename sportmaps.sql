-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 06-11-2024 a las 00:22:58
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
(5, 6, 'C1', 'Fútbol', 10, 2000.00, 'Cancha de césped sintético', 1, '2024-11-05 12:20:08', '2024-11-05 12:20:08'),
(6, 6, 'C2', 'Fútbol', 12, 2500.00, 'Cancha con iluminación nocturna', 1, '2024-11-05 12:20:08', '2024-11-05 12:20:08'),
(7, 6, 'C3', 'Fútbol', 15, 2300.00, 'Cancha techada', 1, '2024-11-05 12:20:08', '2024-11-05 12:20:08'),
(8, 7, 'C1', 'Fútbol', 10, 1500.00, 'Cancha de césped natural', 1, '2024-11-05 12:20:08', '2024-11-05 12:20:08'),
(9, 7, 'C2', 'Fútbol', 12, 2200.00, 'Cancha con gradas', 1, '2024-11-05 12:20:08', '2024-11-05 12:20:08'),
(10, 8, 'C1', 'Fútbol', 8, 1800.00, 'Cancha pequeña para entrenamiento', 1, '2024-11-05 12:20:08', '2024-11-05 12:20:08'),
(11, 8, 'C2', 'Fútbol', 10, 2100.00, 'Cancha al aire libre', 1, '2024-11-05 12:20:08', '2024-11-05 12:20:08'),
(12, 8, 'C3', 'Fútbol', 14, 2600.00, 'Cancha techada con vestidores', 1, '2024-11-05 12:20:08', '2024-11-05 12:20:08'),
(13, 8, 'C4', 'Fútbol', 12, 2400.00, 'Cancha de césped natural', 1, '2024-11-05 12:20:08', '2024-11-05 12:20:08'),
(14, 9, 'C1', 'Fútbol', 12, 1700.00, 'Cancha con asientos para espectadores', 1, '2024-11-05 12:20:08', '2024-11-05 12:20:08'),
(15, 9, 'C2', 'Fútbol', 15, 2200.00, 'Cancha con buena iluminación', 1, '2024-11-05 12:20:08', '2024-11-05 12:20:08'),
(16, 10, 'C1', 'Fútbol', 10, 2500.00, 'Cancha techada', 1, '2024-11-05 12:20:08', '2024-11-05 12:20:08'),
(17, 10, 'C2', 'Fútbol', 8, 2000.00, 'Cancha de césped sintético', 1, '2024-11-05 12:20:08', '2024-11-05 12:20:08'),
(18, 10, 'C3', 'Fútbol', 14, 2700.00, 'Cancha con vestidores y gradas', 1, '2024-11-05 12:20:08', '2024-11-05 12:20:08'),
(19, 11, 'C1', 'Fútbol', 12, 2300.00, 'Cancha de césped natural', 1, '2024-11-05 12:20:08', '2024-11-05 12:20:08'),
(20, 11, 'C2', 'Fútbol', 10, 2100.00, 'Cancha con iluminación', 1, '2024-11-05 12:20:08', '2024-11-05 12:20:08'),
(21, 12, 'C1', 'Fútbol', 8, 1800.00, 'Cancha para niños', 1, '2024-11-05 12:20:08', '2024-11-05 12:20:08'),
(22, 12, 'C2', 'Fútbol', 10, 2000.00, 'Cancha techada', 1, '2024-11-05 12:20:08', '2024-11-05 12:20:08'),
(23, 13, 'C1', 'Fútbol', 10, 2100.00, 'Cancha con buen drenaje', 1, '2024-11-05 12:20:08', '2024-11-05 12:20:08'),
(24, 13, 'C2', 'Fútbol', 8, 1900.00, 'Cancha de césped sintético', 1, '2024-11-05 12:20:08', '2024-11-05 12:20:08'),
(25, 13, 'C3', 'Fútbol', 14, 2300.00, 'Cancha con gradas y vestidores', 1, '2024-11-05 12:20:08', '2024-11-05 12:20:08'),
(26, 14, 'C1', 'Fútbol', 15, 2600.00, 'Cancha de entrenamiento', 1, '2024-11-05 12:20:08', '2024-11-05 12:20:08'),
(27, 14, 'C2', 'Fútbol', 10, 2500.00, 'Cancha techada', 1, '2024-11-05 12:20:08', '2024-11-05 12:20:08'),
(28, 15, 'C1', 'Fútbol', 12, 2000.00, 'Cancha al aire libre', 1, '2024-11-05 12:20:08', '2024-11-05 12:20:08'),
(29, 15, 'C2', 'Fútbol', 15, 2700.00, 'Cancha techada con cafetería', 1, '2024-11-05 12:20:08', '2024-11-05 12:20:08'),
(30, 16, 'C1', 'Fútbol', 10, 2200.00, 'Cancha techada', 1, '2024-11-05 12:20:08', '2024-11-05 12:20:08'),
(31, 16, 'C2', 'Fútbol', 8, 1800.00, 'Cancha de césped sintético', 1, '2024-11-05 12:20:08', '2024-11-05 12:20:08'),
(32, 17, 'C1', 'Fútbol', 12, 2300.00, 'Cancha con gradas', 1, '2024-11-05 12:20:08', '2024-11-05 12:20:08'),
(33, 17, 'C2', 'Fútbol', 10, 2100.00, 'Cancha al aire libre', 1, '2024-11-05 12:20:08', '2024-11-05 12:20:08'),
(34, 17, 'C3', 'Fútbol', 15, 2500.00, 'Cancha con iluminación nocturna', 1, '2024-11-05 12:20:08', '2024-11-05 12:20:08');

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
(6, 'Sport Park Malloco', 'Ubicación F', '+56987235467', 'sportparkmalloco@gmail.com', 'Centro deportivo en Malloco', 'futbolito', 1, '2024-11-05 12:16:00', '2024-11-05 12:16:00', 'Peñaflor'),
(7, 'Canchas San Javier', 'Ubicación G', '+56993487612', 'canchassanjavier@gmail.com', 'Centro deportivo en Peñaflor', 'futbolito', 1, '2024-11-05 12:16:00', '2024-11-05 12:16:00', 'Peñaflor'),
(8, 'Club del Valle Peñaflor', 'Ubicación H', '+56975123984', 'clubdelvallepenaflor@hotmail.com', 'Centro deportivo en Peñaflor', 'futbolito', 1, '2024-11-05 12:16:00', '2024-11-05 12:16:00', 'Peñaflor'),
(9, 'Cancha Club Deportivo Estrella de Nazareth', 'Ubicación I', '+56961573829', 'clubdeportivoestrellanazareth@gmail.com', 'Centro deportivo en Peñaflor', 'futbolito', 1, '2024-11-05 12:16:00', '2024-11-05 12:16:00', 'Peñaflor'),
(10, 'Ex Polideportivo Cerrillos', 'Ubicación J', '+56948392175', 'expolideportivocerrillos@hotmail.com', 'Centro deportivo en Cerrillos', 'futbolito', 1, '2024-11-05 12:16:00', '2024-11-05 12:16:00', 'Cerrillos'),
(11, 'Cancha de pasto Cerrillos', 'Ubicación K', '+56992756184', 'cancha.cerrillos@gmail.com', 'Centro deportivo en Cerrillos', 'futbolito', 1, '2024-11-05 12:16:00', '2024-11-05 12:16:00', 'Cerrillos'),
(12, 'Multicancha Las Tres Villas', 'Ubicación L', '+56983649215', 'multicanchalastresvillas@gmail.com', 'Centro deportivo en Cerrillos', 'futbolito', 1, '2024-11-05 12:16:00', '2024-11-05 12:16:00', 'Cerrillos'),
(13, 'Multicancha Los Presidentes', 'Ubicación M', '+56974259831', 'multicanchalospresidentes@gmail.com', 'Centro deportivo en Cerrillos', 'futbolito', 1, '2024-11-05 12:16:00', '2024-11-05 12:16:00', 'Cerrillos'),
(14, 'Power Soccer', 'Ubicación N', '+56969348527', 'powersoccer@hotmail.com', 'Centro deportivo en Talagante', 'futbolito', 1, '2024-11-05 12:16:00', '2024-11-05 12:16:00', 'Talagante'),
(15, 'Canchas Club Rabona & Bier Garden', 'Ubicación O', '+56952487369', 'clubrabona@gmail.com', 'Centro deportivo en Talagante', 'futbolito', 1, '2024-11-05 12:16:00', '2024-11-05 12:16:00', 'Talagante'),
(16, 'Club Carampangue', 'Ubicación P', '+56987521439', 'clubcarampangue@hotmail.com', 'Centro deportivo en Talagante', 'futbolito', 1, '2024-11-05 12:16:00', '2024-11-05 12:16:00', 'Talagante'),
(17, 'Cancha Club Deportivo Talagante', 'Ubicación Q', '+56931465872', 'clubdeportivotalagante@gmail.com', 'Centro deportivo en Talagante', 'futbolito', 1, '2024-11-05 12:16:00', '2024-11-05 12:16:00', 'Talagante');

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
(5, 5, '2024-11-06', '08:00:00', '09:00:00', 1, 'Disponible'),
(6, 5, '2024-11-06', '09:00:00', '10:00:00', 1, 'Disponible'),
(7, 5, '2024-11-06', '10:00:00', '11:00:00', 1, 'Disponible'),
(8, 5, '2024-11-06', '11:00:00', '12:00:00', 1, 'Disponible'),
(9, 5, '2024-11-06', '12:00:00', '13:00:00', 1, 'Disponible'),
(10, 5, '2024-11-06', '13:00:00', '14:00:00', 1, 'Disponible'),
(11, 5, '2024-11-06', '14:00:00', '15:00:00', 1, 'Disponible'),
(12, 5, '2024-11-06', '15:00:00', '16:00:00', 1, 'Disponible'),
(13, 5, '2024-11-06', '16:00:00', '17:00:00', 1, 'Disponible'),
(14, 5, '2024-11-06', '17:00:00', '18:00:00', 1, 'Disponible'),
(15, 5, '2024-11-06', '18:00:00', '19:00:00', 1, 'Disponible'),
(16, 5, '2024-11-06', '19:00:00', '20:00:00', 1, 'Disponible'),
(17, 5, '2024-11-06', '20:00:00', '21:00:00', 1, 'Disponible'),
(18, 6, '2024-11-06', '08:00:00', '09:00:00', 1, 'Disponible'),
(19, 6, '2024-11-06', '09:00:00', '10:00:00', 1, 'Disponible'),
(20, 6, '2024-11-06', '10:00:00', '11:00:00', 1, 'Disponible'),
(21, 6, '2024-11-06', '11:00:00', '12:00:00', 1, 'Disponible'),
(22, 6, '2024-11-06', '12:00:00', '13:00:00', 1, 'Disponible'),
(23, 6, '2024-11-06', '13:00:00', '14:00:00', 1, 'Disponible'),
(24, 6, '2024-11-06', '14:00:00', '15:00:00', 1, 'Disponible'),
(25, 6, '2024-11-06', '15:00:00', '16:00:00', 1, 'Disponible'),
(26, 6, '2024-11-06', '16:00:00', '17:00:00', 1, 'Disponible'),
(27, 6, '2024-11-06', '17:00:00', '18:00:00', 1, 'Disponible'),
(28, 6, '2024-11-06', '18:00:00', '19:00:00', 1, 'Disponible'),
(29, 6, '2024-11-06', '19:00:00', '20:00:00', 1, 'Disponible'),
(30, 6, '2024-11-06', '20:00:00', '21:00:00', 1, 'Disponible'),
(31, 7, '2024-11-06', '08:00:00', '09:00:00', 1, 'Disponible'),
(32, 7, '2024-11-06', '09:00:00', '10:00:00', 1, 'Disponible'),
(33, 7, '2024-11-06', '10:00:00', '11:00:00', 1, 'Disponible'),
(34, 7, '2024-11-06', '11:00:00', '12:00:00', 1, 'Disponible'),
(35, 7, '2024-11-06', '12:00:00', '13:00:00', 1, 'Disponible'),
(36, 7, '2024-11-06', '13:00:00', '14:00:00', 1, 'Disponible'),
(37, 7, '2024-11-06', '14:00:00', '15:00:00', 1, 'Disponible'),
(38, 7, '2024-11-06', '15:00:00', '16:00:00', 1, 'Disponible'),
(39, 7, '2024-11-06', '16:00:00', '17:00:00', 1, 'Disponible'),
(40, 7, '2024-11-06', '17:00:00', '18:00:00', 1, 'Disponible'),
(41, 7, '2024-11-06', '18:00:00', '19:00:00', 1, 'Disponible'),
(42, 7, '2024-11-06', '19:00:00', '20:00:00', 1, 'Disponible'),
(43, 7, '2024-11-06', '20:00:00', '21:00:00', 1, 'Disponible'),
(44, 8, '2024-11-06', '08:00:00', '09:00:00', 1, 'Disponible'),
(45, 8, '2024-11-06', '09:00:00', '10:00:00', 1, 'Disponible'),
(46, 8, '2024-11-06', '10:00:00', '11:00:00', 1, 'Disponible'),
(47, 8, '2024-11-06', '11:00:00', '12:00:00', 1, 'Disponible'),
(48, 8, '2024-11-06', '12:00:00', '13:00:00', 1, 'Disponible'),
(49, 8, '2024-11-06', '13:00:00', '14:00:00', 1, 'Disponible'),
(50, 8, '2024-11-06', '14:00:00', '15:00:00', 1, 'Disponible'),
(51, 8, '2024-11-06', '15:00:00', '16:00:00', 1, 'Disponible'),
(52, 8, '2024-11-06', '16:00:00', '17:00:00', 1, 'Disponible'),
(53, 8, '2024-11-06', '17:00:00', '18:00:00', 1, 'Disponible'),
(54, 8, '2024-11-06', '18:00:00', '19:00:00', 1, 'Disponible'),
(55, 8, '2024-11-06', '19:00:00', '20:00:00', 1, 'Disponible'),
(56, 9, '2024-11-06', '08:00:00', '09:00:00', 1, 'Disponible'),
(57, 9, '2024-11-06', '09:00:00', '10:00:00', 1, 'Disponible'),
(58, 9, '2024-11-06', '10:00:00', '11:00:00', 1, 'Disponible'),
(59, 9, '2024-11-06', '11:00:00', '12:00:00', 1, 'Disponible'),
(60, 9, '2024-11-06', '12:00:00', '13:00:00', 1, 'Disponible'),
(61, 9, '2024-11-06', '13:00:00', '14:00:00', 1, 'Disponible'),
(62, 9, '2024-11-06', '14:00:00', '15:00:00', 1, 'Disponible'),
(63, 9, '2024-11-06', '15:00:00', '16:00:00', 1, 'Disponible'),
(64, 9, '2024-11-06', '16:00:00', '17:00:00', 1, 'Disponible'),
(65, 9, '2024-11-06', '17:00:00', '18:00:00', 1, 'Disponible'),
(66, 9, '2024-11-06', '18:00:00', '19:00:00', 1, 'Disponible'),
(67, 9, '2024-11-06', '19:00:00', '20:00:00', 1, 'Disponible'),
(68, 10, '2024-11-06', '08:00:00', '09:00:00', 1, 'Disponible'),
(69, 10, '2024-11-06', '09:00:00', '10:00:00', 1, 'Disponible'),
(70, 10, '2024-11-06', '10:00:00', '11:00:00', 1, 'Disponible'),
(71, 10, '2024-11-06', '11:00:00', '12:00:00', 1, 'Disponible'),
(72, 10, '2024-11-06', '12:00:00', '13:00:00', 1, 'Disponible'),
(73, 10, '2024-11-06', '13:00:00', '14:00:00', 1, 'Disponible'),
(74, 10, '2024-11-06', '14:00:00', '15:00:00', 1, 'Disponible'),
(75, 10, '2024-11-06', '15:00:00', '16:00:00', 1, 'Disponible'),
(76, 10, '2024-11-06', '16:00:00', '17:00:00', 1, 'Disponible'),
(77, 10, '2024-11-06', '17:00:00', '18:00:00', 1, 'Disponible'),
(78, 10, '2024-11-06', '18:00:00', '19:00:00', 1, 'Disponible'),
(79, 10, '2024-11-06', '19:00:00', '20:00:00', 1, 'Disponible'),
(80, 11, '2024-11-06', '08:00:00', '09:00:00', 1, 'Disponible'),
(81, 11, '2024-11-06', '09:00:00', '10:00:00', 1, 'Disponible'),
(82, 11, '2024-11-06', '10:00:00', '11:00:00', 1, 'Disponible'),
(83, 11, '2024-11-06', '11:00:00', '12:00:00', 1, 'Disponible'),
(84, 11, '2024-11-06', '12:00:00', '13:00:00', 1, 'Disponible'),
(85, 11, '2024-11-06', '13:00:00', '14:00:00', 1, 'Disponible'),
(86, 11, '2024-11-06', '14:00:00', '15:00:00', 1, 'Disponible'),
(87, 11, '2024-11-06', '15:00:00', '16:00:00', 1, 'Disponible'),
(88, 11, '2024-11-06', '16:00:00', '17:00:00', 1, 'Disponible'),
(89, 11, '2024-11-06', '17:00:00', '18:00:00', 1, 'Disponible'),
(90, 11, '2024-11-06', '18:00:00', '19:00:00', 1, 'Disponible'),
(91, 11, '2024-11-06', '19:00:00', '20:00:00', 1, 'Disponible'),
(92, 12, '2024-11-06', '08:00:00', '09:00:00', 1, 'Disponible'),
(93, 12, '2024-11-06', '09:00:00', '10:00:00', 1, 'Disponible'),
(94, 12, '2024-11-06', '10:00:00', '11:00:00', 1, 'Disponible'),
(95, 12, '2024-11-06', '11:00:00', '12:00:00', 1, 'Disponible'),
(96, 12, '2024-11-06', '12:00:00', '13:00:00', 1, 'Disponible'),
(97, 12, '2024-11-06', '13:00:00', '14:00:00', 1, 'Disponible'),
(98, 12, '2024-11-06', '14:00:00', '15:00:00', 1, 'Disponible'),
(99, 12, '2024-11-06', '15:00:00', '16:00:00', 1, 'Disponible'),
(100, 12, '2024-11-06', '16:00:00', '17:00:00', 1, 'Disponible'),
(101, 12, '2024-11-06', '17:00:00', '18:00:00', 1, 'Disponible'),
(102, 12, '2024-11-06', '18:00:00', '19:00:00', 1, 'Disponible'),
(103, 12, '2024-11-06', '19:00:00', '20:00:00', 1, 'Disponible'),
(104, 13, '2024-11-06', '08:00:00', '09:00:00', 1, 'Disponible'),
(105, 13, '2024-11-06', '09:00:00', '10:00:00', 1, 'Disponible'),
(106, 13, '2024-11-06', '10:00:00', '11:00:00', 1, 'Disponible'),
(107, 13, '2024-11-06', '11:00:00', '12:00:00', 1, 'Disponible'),
(108, 13, '2024-11-06', '12:00:00', '13:00:00', 1, 'Disponible'),
(109, 13, '2024-11-06', '13:00:00', '14:00:00', 1, 'Disponible'),
(110, 13, '2024-11-06', '14:00:00', '15:00:00', 1, 'Disponible'),
(111, 13, '2024-11-06', '15:00:00', '16:00:00', 1, 'Disponible'),
(112, 13, '2024-11-06', '16:00:00', '17:00:00', 1, 'Disponible'),
(113, 13, '2024-11-06', '17:00:00', '18:00:00', 1, 'Disponible'),
(114, 13, '2024-11-06', '18:00:00', '19:00:00', 1, 'Disponible'),
(115, 13, '2024-11-06', '19:00:00', '20:00:00', 1, 'Disponible'),
(116, 14, '2024-11-06', '08:00:00', '09:00:00', 1, 'Disponible'),
(117, 14, '2024-11-06', '09:00:00', '10:00:00', 1, 'Disponible'),
(118, 14, '2024-11-06', '10:00:00', '11:00:00', 1, 'Disponible'),
(119, 14, '2024-11-06', '11:00:00', '12:00:00', 1, 'Disponible'),
(120, 14, '2024-11-06', '12:00:00', '13:00:00', 1, 'Disponible'),
(121, 14, '2024-11-06', '13:00:00', '14:00:00', 1, 'Disponible'),
(122, 14, '2024-11-06', '14:00:00', '15:00:00', 1, 'Disponible'),
(123, 14, '2024-11-06', '15:00:00', '16:00:00', 1, 'Disponible'),
(124, 14, '2024-11-06', '16:00:00', '17:00:00', 1, 'Disponible'),
(125, 14, '2024-11-06', '17:00:00', '18:00:00', 1, 'Disponible'),
(126, 14, '2024-11-06', '18:00:00', '19:00:00', 1, 'Disponible'),
(127, 14, '2024-11-06', '19:00:00', '20:00:00', 1, 'Disponible'),
(128, 15, '2024-11-06', '08:00:00', '09:00:00', 1, 'Disponible'),
(129, 15, '2024-11-06', '09:00:00', '10:00:00', 1, 'Disponible'),
(130, 15, '2024-11-06', '10:00:00', '11:00:00', 1, 'Disponible'),
(131, 15, '2024-11-06', '11:00:00', '12:00:00', 1, 'Disponible'),
(132, 15, '2024-11-06', '12:00:00', '13:00:00', 1, 'Disponible'),
(133, 15, '2024-11-06', '13:00:00', '14:00:00', 1, 'Disponible'),
(134, 15, '2024-11-06', '14:00:00', '15:00:00', 1, 'Disponible'),
(135, 15, '2024-11-06', '15:00:00', '16:00:00', 1, 'Disponible'),
(136, 15, '2024-11-06', '16:00:00', '17:00:00', 1, 'Disponible'),
(137, 15, '2024-11-06', '17:00:00', '18:00:00', 1, 'Disponible'),
(138, 15, '2024-11-06', '18:00:00', '19:00:00', 1, 'Disponible'),
(139, 15, '2024-11-06', '19:00:00', '20:00:00', 1, 'Disponible'),
(140, 16, '2024-11-06', '08:00:00', '09:00:00', 1, 'Disponible'),
(141, 16, '2024-11-06', '09:00:00', '10:00:00', 1, 'Disponible'),
(142, 16, '2024-11-06', '10:00:00', '11:00:00', 1, 'Disponible'),
(143, 16, '2024-11-06', '11:00:00', '12:00:00', 1, 'Disponible'),
(144, 16, '2024-11-06', '12:00:00', '13:00:00', 1, 'Disponible'),
(145, 16, '2024-11-06', '13:00:00', '14:00:00', 1, 'Disponible'),
(146, 16, '2024-11-06', '14:00:00', '15:00:00', 1, 'Disponible'),
(147, 16, '2024-11-06', '15:00:00', '16:00:00', 1, 'Disponible'),
(148, 16, '2024-11-06', '16:00:00', '17:00:00', 1, 'Disponible'),
(149, 16, '2024-11-06', '17:00:00', '18:00:00', 1, 'Disponible'),
(150, 16, '2024-11-06', '18:00:00', '19:00:00', 1, 'Disponible'),
(151, 16, '2024-11-06', '19:00:00', '20:00:00', 1, 'Disponible'),
(152, 17, '2024-11-06', '08:00:00', '09:00:00', 1, 'Disponible'),
(153, 17, '2024-11-06', '09:00:00', '10:00:00', 1, 'Disponible'),
(154, 17, '2024-11-06', '10:00:00', '11:00:00', 1, 'Disponible'),
(155, 17, '2024-11-06', '11:00:00', '12:00:00', 1, 'Disponible'),
(156, 17, '2024-11-06', '12:00:00', '13:00:00', 1, 'Disponible'),
(157, 17, '2024-11-06', '13:00:00', '14:00:00', 1, 'Disponible'),
(158, 17, '2024-11-06', '14:00:00', '15:00:00', 1, 'Disponible'),
(159, 17, '2024-11-06', '15:00:00', '16:00:00', 1, 'Disponible'),
(160, 17, '2024-11-06', '16:00:00', '17:00:00', 1, 'Disponible'),
(161, 17, '2024-11-06', '17:00:00', '18:00:00', 1, 'Disponible'),
(162, 17, '2024-11-06', '18:00:00', '19:00:00', 1, 'Disponible'),
(163, 17, '2024-11-06', '19:00:00', '20:00:00', 1, 'Disponible'),
(164, 18, '2024-11-06', '08:00:00', '09:00:00', 1, 'Disponible'),
(165, 18, '2024-11-06', '09:00:00', '10:00:00', 1, 'Disponible'),
(166, 18, '2024-11-06', '10:00:00', '11:00:00', 1, 'Disponible'),
(167, 18, '2024-11-06', '11:00:00', '12:00:00', 1, 'Disponible'),
(168, 18, '2024-11-06', '12:00:00', '13:00:00', 1, 'Disponible'),
(169, 18, '2024-11-06', '13:00:00', '14:00:00', 1, 'Disponible'),
(170, 18, '2024-11-06', '14:00:00', '15:00:00', 1, 'Disponible'),
(171, 18, '2024-11-06', '15:00:00', '16:00:00', 1, 'Disponible'),
(172, 18, '2024-11-06', '16:00:00', '17:00:00', 1, 'Disponible'),
(173, 18, '2024-11-06', '17:00:00', '18:00:00', 1, 'Disponible'),
(174, 18, '2024-11-06', '18:00:00', '19:00:00', 1, 'Disponible'),
(175, 18, '2024-11-06', '19:00:00', '20:00:00', 1, 'Disponible'),
(176, 19, '2024-11-06', '08:00:00', '09:00:00', 1, 'Disponible'),
(177, 19, '2024-11-06', '09:00:00', '10:00:00', 1, 'Disponible'),
(178, 19, '2024-11-06', '10:00:00', '11:00:00', 1, 'Disponible'),
(179, 19, '2024-11-06', '11:00:00', '12:00:00', 1, 'Disponible'),
(180, 19, '2024-11-06', '12:00:00', '13:00:00', 1, 'Disponible'),
(181, 19, '2024-11-06', '13:00:00', '14:00:00', 1, 'Disponible'),
(182, 19, '2024-11-06', '14:00:00', '15:00:00', 1, 'Disponible'),
(183, 19, '2024-11-06', '15:00:00', '16:00:00', 1, 'Disponible'),
(184, 19, '2024-11-06', '16:00:00', '17:00:00', 1, 'Disponible'),
(185, 19, '2024-11-06', '17:00:00', '18:00:00', 1, 'Disponible'),
(186, 19, '2024-11-06', '18:00:00', '19:00:00', 1, 'Disponible'),
(187, 19, '2024-11-06', '19:00:00', '20:00:00', 1, 'Disponible'),
(188, 20, '2024-11-06', '08:00:00', '09:00:00', 1, 'Disponible'),
(189, 20, '2024-11-06', '09:00:00', '10:00:00', 1, 'Disponible'),
(190, 20, '2024-11-06', '10:00:00', '11:00:00', 1, 'Disponible'),
(191, 20, '2024-11-06', '11:00:00', '12:00:00', 1, 'Disponible'),
(192, 20, '2024-11-06', '12:00:00', '13:00:00', 1, 'Disponible'),
(193, 20, '2024-11-06', '13:00:00', '14:00:00', 1, 'Disponible'),
(194, 20, '2024-11-06', '14:00:00', '15:00:00', 1, 'Disponible'),
(195, 20, '2024-11-06', '15:00:00', '16:00:00', 1, 'Disponible'),
(196, 20, '2024-11-06', '16:00:00', '17:00:00', 1, 'Disponible'),
(197, 20, '2024-11-06', '17:00:00', '18:00:00', 1, 'Disponible'),
(198, 20, '2024-11-06', '18:00:00', '19:00:00', 1, 'Disponible'),
(199, 20, '2024-11-06', '19:00:00', '20:00:00', 1, 'Disponible'),
(200, 21, '2024-11-06', '08:00:00', '09:00:00', 1, 'Disponible'),
(201, 21, '2024-11-06', '09:00:00', '10:00:00', 1, 'Disponible'),
(202, 21, '2024-11-06', '10:00:00', '11:00:00', 1, 'Disponible'),
(203, 21, '2024-11-06', '11:00:00', '12:00:00', 1, 'Disponible'),
(204, 21, '2024-11-06', '12:00:00', '13:00:00', 1, 'Disponible'),
(205, 21, '2024-11-06', '13:00:00', '14:00:00', 1, 'Disponible'),
(206, 21, '2024-11-06', '14:00:00', '15:00:00', 1, 'Disponible'),
(207, 21, '2024-11-06', '15:00:00', '16:00:00', 1, 'Disponible'),
(208, 21, '2024-11-06', '16:00:00', '17:00:00', 1, 'Disponible'),
(209, 21, '2024-11-06', '17:00:00', '18:00:00', 1, 'Disponible'),
(210, 21, '2024-11-06', '18:00:00', '19:00:00', 1, 'Disponible'),
(211, 21, '2024-11-06', '19:00:00', '20:00:00', 1, 'Disponible'),
(212, 22, '2024-11-06', '08:00:00', '09:00:00', 1, 'Disponible'),
(213, 22, '2024-11-06', '09:00:00', '10:00:00', 1, 'Disponible'),
(214, 22, '2024-11-06', '10:00:00', '11:00:00', 1, 'Disponible'),
(215, 22, '2024-11-06', '11:00:00', '12:00:00', 1, 'Disponible'),
(216, 22, '2024-11-06', '12:00:00', '13:00:00', 1, 'Disponible'),
(217, 22, '2024-11-06', '13:00:00', '14:00:00', 1, 'Disponible'),
(218, 22, '2024-11-06', '14:00:00', '15:00:00', 1, 'Disponible'),
(219, 22, '2024-11-06', '15:00:00', '16:00:00', 1, 'Disponible'),
(220, 22, '2024-11-06', '16:00:00', '17:00:00', 1, 'Disponible'),
(221, 22, '2024-11-06', '17:00:00', '18:00:00', 1, 'Disponible'),
(222, 22, '2024-11-06', '18:00:00', '19:00:00', 1, 'Disponible'),
(223, 22, '2024-11-06', '19:00:00', '20:00:00', 1, 'Disponible'),
(224, 23, '2024-11-06', '08:00:00', '09:00:00', 1, 'Disponible'),
(225, 23, '2024-11-06', '09:00:00', '10:00:00', 1, 'Disponible'),
(226, 23, '2024-11-06', '10:00:00', '11:00:00', 1, 'Disponible'),
(227, 23, '2024-11-06', '11:00:00', '12:00:00', 1, 'Disponible'),
(228, 23, '2024-11-06', '12:00:00', '13:00:00', 1, 'Disponible'),
(229, 23, '2024-11-06', '13:00:00', '14:00:00', 1, 'Disponible'),
(230, 23, '2024-11-06', '14:00:00', '15:00:00', 1, 'Disponible'),
(231, 23, '2024-11-06', '15:00:00', '16:00:00', 1, 'Disponible'),
(232, 23, '2024-11-06', '16:00:00', '17:00:00', 1, 'Disponible'),
(233, 23, '2024-11-06', '17:00:00', '18:00:00', 1, 'Disponible'),
(234, 23, '2024-11-06', '18:00:00', '19:00:00', 1, 'Disponible'),
(235, 23, '2024-11-06', '19:00:00', '20:00:00', 1, 'Disponible'),
(236, 24, '2024-11-06', '08:00:00', '09:00:00', 1, 'Disponible'),
(237, 24, '2024-11-06', '09:00:00', '10:00:00', 1, 'Disponible'),
(238, 24, '2024-11-06', '10:00:00', '11:00:00', 1, 'Disponible'),
(239, 24, '2024-11-06', '11:00:00', '12:00:00', 1, 'Disponible'),
(240, 24, '2024-11-06', '12:00:00', '13:00:00', 1, 'Disponible'),
(241, 24, '2024-11-06', '13:00:00', '14:00:00', 1, 'Disponible'),
(242, 24, '2024-11-06', '14:00:00', '15:00:00', 1, 'Disponible'),
(243, 24, '2024-11-06', '15:00:00', '16:00:00', 1, 'Disponible'),
(244, 24, '2024-11-06', '16:00:00', '17:00:00', 1, 'Disponible'),
(245, 24, '2024-11-06', '17:00:00', '18:00:00', 1, 'Disponible'),
(246, 24, '2024-11-06', '18:00:00', '19:00:00', 1, 'Disponible'),
(247, 24, '2024-11-06', '19:00:00', '20:00:00', 1, 'Disponible'),
(248, 25, '2024-11-06', '08:00:00', '09:00:00', 1, 'Disponible'),
(249, 25, '2024-11-06', '09:00:00', '10:00:00', 1, 'Disponible'),
(250, 25, '2024-11-06', '10:00:00', '11:00:00', 1, 'Disponible'),
(251, 25, '2024-11-06', '11:00:00', '12:00:00', 1, 'Disponible'),
(252, 25, '2024-11-06', '12:00:00', '13:00:00', 1, 'Disponible'),
(253, 25, '2024-11-06', '13:00:00', '14:00:00', 1, 'Disponible'),
(254, 25, '2024-11-06', '14:00:00', '15:00:00', 1, 'Disponible'),
(255, 25, '2024-11-06', '15:00:00', '16:00:00', 1, 'Disponible'),
(256, 25, '2024-11-06', '16:00:00', '17:00:00', 1, 'Disponible'),
(257, 25, '2024-11-06', '17:00:00', '18:00:00', 1, 'Disponible'),
(258, 25, '2024-11-06', '18:00:00', '19:00:00', 1, 'Disponible'),
(259, 25, '2024-11-06', '19:00:00', '20:00:00', 1, 'Disponible'),
(260, 26, '2024-11-06', '08:00:00', '09:00:00', 1, 'Disponible'),
(261, 26, '2024-11-06', '09:00:00', '10:00:00', 1, 'Disponible'),
(262, 26, '2024-11-06', '10:00:00', '11:00:00', 1, 'Disponible'),
(263, 26, '2024-11-06', '11:00:00', '12:00:00', 1, 'Disponible'),
(264, 26, '2024-11-06', '12:00:00', '13:00:00', 1, 'Disponible'),
(265, 26, '2024-11-06', '13:00:00', '14:00:00', 1, 'Disponible'),
(266, 26, '2024-11-06', '14:00:00', '15:00:00', 1, 'Disponible'),
(267, 26, '2024-11-06', '15:00:00', '16:00:00', 1, 'Disponible'),
(268, 26, '2024-11-06', '16:00:00', '17:00:00', 1, 'Disponible'),
(269, 26, '2024-11-06', '17:00:00', '18:00:00', 1, 'Disponible'),
(270, 26, '2024-11-06', '18:00:00', '19:00:00', 1, 'Disponible'),
(271, 26, '2024-11-06', '19:00:00', '20:00:00', 1, 'Disponible'),
(272, 27, '2024-11-06', '08:00:00', '09:00:00', 1, 'Disponible'),
(273, 27, '2024-11-06', '09:00:00', '10:00:00', 1, 'Disponible'),
(274, 27, '2024-11-06', '10:00:00', '11:00:00', 1, 'Disponible'),
(275, 27, '2024-11-06', '11:00:00', '12:00:00', 1, 'Disponible'),
(276, 27, '2024-11-06', '12:00:00', '13:00:00', 1, 'Disponible'),
(277, 27, '2024-11-06', '13:00:00', '14:00:00', 1, 'Disponible'),
(278, 27, '2024-11-06', '14:00:00', '15:00:00', 1, 'Disponible'),
(279, 27, '2024-11-06', '15:00:00', '16:00:00', 1, 'Disponible'),
(280, 27, '2024-11-06', '16:00:00', '17:00:00', 1, 'Disponible'),
(281, 27, '2024-11-06', '17:00:00', '18:00:00', 1, 'Disponible'),
(282, 27, '2024-11-06', '18:00:00', '19:00:00', 1, 'Disponible'),
(283, 27, '2024-11-06', '19:00:00', '20:00:00', 1, 'Disponible'),
(284, 28, '2024-11-06', '08:00:00', '09:00:00', 1, 'Disponible'),
(285, 28, '2024-11-06', '09:00:00', '10:00:00', 1, 'Disponible'),
(286, 28, '2024-11-06', '10:00:00', '11:00:00', 1, 'Disponible'),
(287, 28, '2024-11-06', '11:00:00', '12:00:00', 1, 'Disponible'),
(288, 28, '2024-11-06', '12:00:00', '13:00:00', 1, 'Disponible'),
(289, 28, '2024-11-06', '13:00:00', '14:00:00', 1, 'Disponible'),
(290, 28, '2024-11-06', '14:00:00', '15:00:00', 1, 'Disponible'),
(291, 28, '2024-11-06', '15:00:00', '16:00:00', 1, 'Disponible'),
(292, 28, '2024-11-06', '16:00:00', '17:00:00', 1, 'Disponible'),
(293, 28, '2024-11-06', '17:00:00', '18:00:00', 1, 'Disponible'),
(294, 28, '2024-11-06', '18:00:00', '19:00:00', 1, 'Disponible'),
(295, 28, '2024-11-06', '19:00:00', '20:00:00', 1, 'Disponible'),
(296, 29, '2024-11-06', '08:00:00', '09:00:00', 1, 'Disponible'),
(297, 29, '2024-11-06', '09:00:00', '10:00:00', 1, 'Disponible'),
(298, 29, '2024-11-06', '10:00:00', '11:00:00', 1, 'Disponible'),
(299, 29, '2024-11-06', '11:00:00', '12:00:00', 1, 'Disponible'),
(300, 29, '2024-11-06', '12:00:00', '13:00:00', 1, 'Disponible'),
(301, 29, '2024-11-06', '13:00:00', '14:00:00', 1, 'Disponible'),
(302, 29, '2024-11-06', '14:00:00', '15:00:00', 1, 'Disponible'),
(303, 29, '2024-11-06', '15:00:00', '16:00:00', 1, 'Disponible'),
(304, 29, '2024-11-06', '16:00:00', '17:00:00', 1, 'Disponible'),
(305, 29, '2024-11-06', '17:00:00', '18:00:00', 1, 'Disponible'),
(306, 29, '2024-11-06', '18:00:00', '19:00:00', 1, 'Disponible'),
(307, 29, '2024-11-06', '19:00:00', '20:00:00', 1, 'Disponible');

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
(20, 'INSERT', 'Reservas', 16, 'Nueva reserva: RES-6723ea12ade86', 10, '2024-10-31 16:35:30', NULL),
(21, 'INSERT', 'Reservas', 17, 'Nueva reserva: RES-672a3fc73440a', 10, '2024-11-05 11:54:47', NULL),
(22, 'INSERT', 'CentrosDeportivos', 6, 'Nuevo centro deportivo: Sport Park Malloco', NULL, '2024-11-05 12:13:47', NULL),
(23, 'INSERT', 'CentrosDeportivos', 7, 'Nuevo centro deportivo: Canchas San Javier', NULL, '2024-11-05 12:13:47', NULL),
(24, 'INSERT', 'CentrosDeportivos', 8, 'Nuevo centro deportivo: Club del Valle Peñaflor', NULL, '2024-11-05 12:13:47', NULL),
(25, 'INSERT', 'CentrosDeportivos', 9, 'Nuevo centro deportivo: Cancha Club Deportivo Estrella de Nazareth', NULL, '2024-11-05 12:13:47', NULL),
(26, 'INSERT', 'CentrosDeportivos', 10, 'Nuevo centro deportivo: Ex Polideportivo Cerrillos', NULL, '2024-11-05 12:13:47', NULL),
(27, 'INSERT', 'CentrosDeportivos', 11, 'Nuevo centro deportivo: Cancha de pasto Cerrillos', NULL, '2024-11-05 12:13:47', NULL),
(28, 'INSERT', 'CentrosDeportivos', 12, 'Nuevo centro deportivo: Multicancha Las Tres Villas', NULL, '2024-11-05 12:13:47', NULL),
(29, 'INSERT', 'CentrosDeportivos', 13, 'Nuevo centro deportivo: Multicancha Los Presidentes', NULL, '2024-11-05 12:13:47', NULL),
(30, 'INSERT', 'CentrosDeportivos', 14, 'Nuevo centro deportivo: Power Soccer', NULL, '2024-11-05 12:13:47', NULL),
(31, 'INSERT', 'CentrosDeportivos', 15, 'Nuevo centro deportivo: Canchas Club Rabona & Bier Garden', NULL, '2024-11-05 12:13:47', NULL),
(32, 'INSERT', 'CentrosDeportivos', 16, 'Nuevo centro deportivo: Club Carampangue', NULL, '2024-11-05 12:13:47', NULL),
(33, 'INSERT', 'CentrosDeportivos', 17, 'Nuevo centro deportivo: Cancha Club Deportivo Talagante', NULL, '2024-11-05 12:13:47', NULL),
(34, 'INSERT', 'CentrosDeportivos', 6, 'Nuevo centro deportivo: Sport Park Malloco', NULL, '2024-11-05 12:16:00', NULL),
(35, 'INSERT', 'CentrosDeportivos', 7, 'Nuevo centro deportivo: Canchas San Javier', NULL, '2024-11-05 12:16:00', NULL),
(36, 'INSERT', 'CentrosDeportivos', 8, 'Nuevo centro deportivo: Club del Valle Peñaflor', NULL, '2024-11-05 12:16:00', NULL),
(37, 'INSERT', 'CentrosDeportivos', 9, 'Nuevo centro deportivo: Cancha Club Deportivo Estrella de Nazareth', NULL, '2024-11-05 12:16:00', NULL),
(38, 'INSERT', 'CentrosDeportivos', 10, 'Nuevo centro deportivo: Ex Polideportivo Cerrillos', NULL, '2024-11-05 12:16:00', NULL),
(39, 'INSERT', 'CentrosDeportivos', 11, 'Nuevo centro deportivo: Cancha de pasto Cerrillos', NULL, '2024-11-05 12:16:00', NULL),
(40, 'INSERT', 'CentrosDeportivos', 12, 'Nuevo centro deportivo: Multicancha Las Tres Villas', NULL, '2024-11-05 12:16:00', NULL),
(41, 'INSERT', 'CentrosDeportivos', 13, 'Nuevo centro deportivo: Multicancha Los Presidentes', NULL, '2024-11-05 12:16:00', NULL),
(42, 'INSERT', 'CentrosDeportivos', 14, 'Nuevo centro deportivo: Power Soccer', NULL, '2024-11-05 12:16:00', NULL),
(43, 'INSERT', 'CentrosDeportivos', 15, 'Nuevo centro deportivo: Canchas Club Rabona & Bier Garden', NULL, '2024-11-05 12:16:00', NULL),
(44, 'INSERT', 'CentrosDeportivos', 16, 'Nuevo centro deportivo: Club Carampangue', NULL, '2024-11-05 12:16:00', NULL),
(45, 'INSERT', 'CentrosDeportivos', 17, 'Nuevo centro deportivo: Cancha Club Deportivo Talagante', NULL, '2024-11-05 12:16:00', NULL),
(46, 'INSERT', 'Reservas', 18, 'Nueva reserva: RES-672a4789c6c1b', 10, '2024-11-05 12:27:53', NULL),
(47, 'INSERT', 'Reservas', 19, 'Nueva reserva: RES-672a49fc459cc', 10, '2024-11-05 12:38:20', NULL),
(48, 'INSERT', 'Reservas', 20, 'Nueva reserva: RES-672a4e96a881e', 10, '2024-11-05 12:57:58', NULL),
(49, 'INSERT', 'Reservas', 21, 'Nueva reserva: RES-672a501ee8b34', 10, '2024-11-05 13:04:30', NULL),
(50, 'INSERT', 'Reservas', 22, 'Nueva reserva: RES-672a50f8273ca', 10, '2024-11-05 13:08:08', NULL),
(51, 'INSERT', 'Reservas', 23, 'Nueva reserva: RES-672a512017032', 10, '2024-11-05 13:08:48', NULL),
(52, 'INSERT', 'Reservas', 24, 'Nueva reserva: RES-672a515e89c02', 10, '2024-11-05 13:09:50', NULL),
(53, 'INSERT', 'Reservas', 25, 'Nueva reserva: RES-672a51b78140b', 10, '2024-11-05 13:11:19', NULL),
(54, 'INSERT', 'Reservas', 26, 'Nueva reserva: RES-672a51cd10900', 10, '2024-11-05 13:11:41', NULL),
(55, 'INSERT', 'Reservas', 27, 'Nueva reserva: RES-672a53cebf7eb', 10, '2024-11-05 13:20:14', NULL),
(56, 'INSERT', 'Reservas', 28, 'Nueva reserva: RES-672a5b62562b2', 10, '2024-11-05 13:52:34', NULL),
(57, 'INSERT', 'Reservas', 29, 'Nueva reserva: RES-672a5ba52d443', 10, '2024-11-05 13:53:41', NULL),
(58, 'INSERT', 'Reservas', 30, 'Nueva reserva: RES-672a60672637c', 10, '2024-11-05 14:13:59', NULL);

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
(30, 'RES-672a60672637c', 10, 12, 99, '2024-11-13', '15:00:00', '16:00:00', 'pendiente', '2600.00', 'tarjeta', '2024-11-05 14:13:59', '2024-11-05 14:13:59');

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
  MODIFY `CanchaID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT de la tabla `centrosdeportivos`
--
ALTER TABLE `centrosdeportivos`
  MODIFY `CentroID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de la tabla `equipamiento`
--
ALTER TABLE `equipamiento`
  MODIFY `EquipamientoID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `horario`
--
ALTER TABLE `horario`
  MODIFY `HorarioID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=308;

--
-- AUTO_INCREMENT de la tabla `horariooperacion`
--
ALTER TABLE `horariooperacion`
  MODIFY `HorarioOpID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `logsauditoria`
--
ALTER TABLE `logsauditoria`
  MODIFY `LogID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

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
  MODIFY `ReservaID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT de la tabla `servicios`
--
ALTER TABLE `servicios`
  MODIFY `ServicioID` int(11) NOT NULL AUTO_INCREMENT;

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
