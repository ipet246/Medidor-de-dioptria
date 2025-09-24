-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 26-08-2025 a las 15:33:12
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `lente_db`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `medicion_arduino`
--

CREATE TABLE `medicion_arduino` (
  `Id` int(11) NOT NULL,
  `Dato` decimal(5,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `medicion_arduino`
--

INSERT INTO `medicion_arduino` (`Id`, `Dato`) VALUES
(1, 1.00);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `potencias`
--

CREATE TABLE `potencias` (
  `id_potencia` int(11) NOT NULL,
  `potencia` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `potencias`
--

INSERT INTO `potencias` (`id_potencia`, `potencia`) VALUES
(1, 2),
(2, 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `registrar_medicion_lente`
--

CREATE TABLE `registrar_medicion_lente` (
  `Id_RML` int(11) NOT NULL,
  `Fech_Hora_RML` datetime NOT NULL,
  `Potencia_Ingresada_RML` decimal(10,2) NOT NULL,
  `Potencia_Resultante_RML` decimal(10,2) NOT NULL,
  `Estado_Validacion_RML` enum('Correcto','Incorrecto','','') DEFAULT NULL,
  `Distancia_Focal_RML` decimal(10,2) NOT NULL,
  `potencia_averiguada_lente` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `medicion_arduino`
--
ALTER TABLE `medicion_arduino`
  ADD PRIMARY KEY (`Id`);

--
-- Indices de la tabla `potencias`
--
ALTER TABLE `potencias`
  ADD PRIMARY KEY (`id_potencia`);

--
-- Indices de la tabla `registrar_medicion_lente`
--
ALTER TABLE `registrar_medicion_lente`
  ADD PRIMARY KEY (`Id_RML`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `medicion_arduino`
--
ALTER TABLE `medicion_arduino`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `potencias`
--
ALTER TABLE `potencias`
  MODIFY `id_potencia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `registrar_medicion_lente`
--
ALTER TABLE `registrar_medicion_lente`
  MODIFY `Id_RML` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
