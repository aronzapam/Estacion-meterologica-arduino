-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 03-10-2019 a las 04:53:57
-- Versión del servidor: 10.1.40-MariaDB
-- Versión de PHP: 7.3.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `proyecto`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sensor_temp_hum`
--

CREATE TABLE `sensor_temp_hum` (
  `id` int(11) NOT NULL,
  `temperatura` int(255) NOT NULL,
  `humedad` int(255) NOT NULL,
  `monoxido` int(255) NOT NULL,
  `estado_lluvia` int(255) NOT NULL,
  `estado_luz` int(255) NOT NULL,
  `uv` int(255) NOT NULL,
  `fecha_hora` datetime(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `sensor_temp_hum`
--

INSERT INTO `sensor_temp_hum` (`id`, `temperatura`, `humedad`, `monoxido`, `estado_lluvia`, `estado_luz`, `uv`, `fecha_hora`) VALUES
(1, 1, 1, 1, 1, 1, 1, '2019-10-03 00:00:00.000000'),
(2, -999, -999, 497, 1, 2, 0, '2019-10-02 18:21:14.000000'),
(3, -999, -999, 126, 1, 2, 0, '2019-10-02 18:25:05.000000'),
(4, 17, 36, 475, 1, 2, 0, '2019-10-02 18:30:08.000000'),
(5, 17, 36, 150, 1, 2, 0, '2019-10-02 18:33:58.000000'),
(10, 1, 1, 1, 1, 1, 1, '2019-10-03 00:00:00.000000');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `sensor_temp_hum`
--
ALTER TABLE `sensor_temp_hum`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `sensor_temp_hum`
--
ALTER TABLE `sensor_temp_hum`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
