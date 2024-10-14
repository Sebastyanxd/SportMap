-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 14-10-2024 a las 22:31:12
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
-- Base de datos: `sportmap`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `canchas`
--

CREATE TABLE `canchas` (
  `CanchaID` int(11) NOT NULL,
  `Nombre` varchar(100) NOT NULL,
  `CentroID` int(11) DEFAULT NULL,
  `PrecioPorHora` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `canchas`
--

INSERT INTO `canchas` (`CanchaID`, `Nombre`, `CentroID`, `PrecioPorHora`) VALUES
(2, 'Cancha A', 1, 110.00),
(3, 'Cancha B', 2, 150.00),
(5, 'Cancha C', 1, 700.00);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `centrosdeportivos`
--

CREATE TABLE `centrosdeportivos` (
  `CentroID` int(11) NOT NULL,
  `Nombre` varchar(100) NOT NULL,
  `Ubicacion` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `centrosdeportivos`
--

INSERT INTO `centrosdeportivos` (`CentroID`, `Nombre`, `Ubicacion`) VALUES
(1, 'Centro Deportivo A', 'Ubicación A'),
(2, 'Centro Deportivo B', 'Ubicación B');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contactos`
--

CREATE TABLE `contactos` (
  `contactoID` int(11) NOT NULL,
  `userID` int(11) DEFAULT NULL,
  `nombre_completo` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `asunto` varchar(255) DEFAULT NULL,
  `mensaje` text DEFAULT NULL,
  `fecha_contacto` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `contactos`
--

INSERT INTO `contactos` (`contactoID`, `userID`, `nombre_completo`, `email`, `telefono`, `asunto`, `mensaje`, `fecha_contacto`) VALUES
(1, 1, 'sebastian', 'sebas.200294@gmail.com', '930398712', 'pagina qla', 'caca', '2024-10-14 20:25:52');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `horarios`
--

CREATE TABLE `horarios` (
  `HorarioID` int(11) NOT NULL,
  `CanchaID` int(11) DEFAULT NULL,
  `Fecha` date DEFAULT NULL,
  `HoraInicio` time DEFAULT NULL,
  `HoraFin` time DEFAULT NULL,
  `Disponible` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `horarios`
--

INSERT INTO `horarios` (`HorarioID`, `CanchaID`, `Fecha`, `HoraInicio`, `HoraFin`, `Disponible`) VALUES
(5, 2, '2024-10-10', '09:00:00', '10:00:00', 1),
(6, 2, '2024-10-10', '10:00:00', '11:00:00', 1),
(7, 3, '2024-10-10', '11:00:00', '12:00:00', 1),
(8, 3, '2024-10-10', '12:00:00', '13:00:00', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reservas`
--

CREATE TABLE `reservas` (
  `ReservaID` int(11) NOT NULL,
  `UsuarioID` int(11) DEFAULT NULL,
  `CanchaID` int(11) DEFAULT NULL,
  `HorarioID` int(11) DEFAULT NULL,
  `FechaReserva` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `reservas`
--

INSERT INTO `reservas` (`ReservaID`, `UsuarioID`, `CanchaID`, `HorarioID`, `FechaReserva`) VALUES
(19, 1, 3, 7, '2024-10-18'),
(22, 2, 3, 8, '2024-10-25'),
(23, 3, 2, 5, '2024-10-24'),
(24, 1, 2, 6, '2024-10-25'),
(25, 1, 2, 5, '2024-10-18');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `UserID` int(11) NOT NULL,
  `Nombre` varchar(100) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Direccion` varchar(50) NOT NULL,
  `Telefono` int(11) NOT NULL,
  `Contrasena` varchar(255) NOT NULL,
  `FechaRegistro` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`UserID`, `Nombre`, `Email`, `Direccion`, `Telefono`, `Contrasena`, `FechaRegistro`) VALUES
(1, 'sebastian', 'sebas.200294@gmail.com', 'test', 123123, '$2y$10$u5zqfdpTkigK.kwt/KH0QeBhjoTG9J/WIhHLBwvNlpsQ9QCMLco46', '2024-10-10'),
(2, 'kevin', 'KEVINQLO@GMAIL.COM', 'test', 123123, '$2y$10$O/JCjF8HBf4KAzvnfnsLWeKJgSN2TFw9L.jVbWCr39Gb/TL0tFZWy', '2024-10-10'),
(3, 'cristiam', 'cristian@gmail.com', 'viena 1010', 83049839, '$2y$10$GC.usE9NUqWOGlb6x2iMEev2KgHTmWzmhR9bak7LE6jVWvEXpaqDG', '2024-10-11');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `canchas`
--
ALTER TABLE `canchas`
  ADD PRIMARY KEY (`CanchaID`),
  ADD KEY `CentroID` (`CentroID`);

--
-- Indices de la tabla `centrosdeportivos`
--
ALTER TABLE `centrosdeportivos`
  ADD PRIMARY KEY (`CentroID`);

--
-- Indices de la tabla `contactos`
--
ALTER TABLE `contactos`
  ADD PRIMARY KEY (`contactoID`),
  ADD KEY `userID` (`userID`);

--
-- Indices de la tabla `horarios`
--
ALTER TABLE `horarios`
  ADD PRIMARY KEY (`HorarioID`),
  ADD KEY `CanchaID` (`CanchaID`);

--
-- Indices de la tabla `reservas`
--
ALTER TABLE `reservas`
  ADD PRIMARY KEY (`ReservaID`),
  ADD KEY `UsuarioID` (`UsuarioID`),
  ADD KEY `CanchaID` (`CanchaID`),
  ADD KEY `HorarioID` (`HorarioID`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`UserID`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `canchas`
--
ALTER TABLE `canchas`
  MODIFY `CanchaID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `centrosdeportivos`
--
ALTER TABLE `centrosdeportivos`
  MODIFY `CentroID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `contactos`
--
ALTER TABLE `contactos`
  MODIFY `contactoID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `horarios`
--
ALTER TABLE `horarios`
  MODIFY `HorarioID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `reservas`
--
ALTER TABLE `reservas`
  MODIFY `ReservaID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `canchas`
--
ALTER TABLE `canchas`
  ADD CONSTRAINT `canchas_ibfk_1` FOREIGN KEY (`CentroID`) REFERENCES `centrosdeportivos` (`CentroID`) ON DELETE CASCADE;

--
-- Filtros para la tabla `contactos`
--
ALTER TABLE `contactos`
  ADD CONSTRAINT `contactos_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `usuarios` (`UserID`);

--
-- Filtros para la tabla `horarios`
--
ALTER TABLE `horarios`
  ADD CONSTRAINT `horarios_ibfk_1` FOREIGN KEY (`CanchaID`) REFERENCES `canchas` (`CanchaID`) ON DELETE CASCADE;

--
-- Filtros para la tabla `reservas`
--
ALTER TABLE `reservas`
  ADD CONSTRAINT `reservas_ibfk_1` FOREIGN KEY (`UsuarioID`) REFERENCES `usuarios` (`UserID`) ON DELETE CASCADE,
  ADD CONSTRAINT `reservas_ibfk_2` FOREIGN KEY (`CanchaID`) REFERENCES `canchas` (`CanchaID`) ON DELETE CASCADE,
  ADD CONSTRAINT `reservas_ibfk_3` FOREIGN KEY (`HorarioID`) REFERENCES `horarios` (`HorarioID`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
