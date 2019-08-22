-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 20-06-2019 a las 18:47:58
-- Versión del servidor: 10.1.38-MariaDB
-- Versión de PHP: 5.6.40

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `siseppbd`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_documento_id`
--

CREATE TABLE `tipo_documento_id` (
  `pkID` int(11) NOT NULL,
  `nombre` varchar(250) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tipo_documento_id`
--

INSERT INTO `tipo_documento_id` (`pkID`, `nombre`) VALUES
(1, 'Cédula'),
(2, 'Tarjeta de identidad'),
(3, 'Pasaporte'),
(4, 'Cédula de Extranjería'),
(5, 'Registro Civil');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `tipo_documento_id`
--
ALTER TABLE `tipo_documento_id`
  ADD PRIMARY KEY (`pkID`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `tipo_documento_id`
--
ALTER TABLE `tipo_documento_id`
  MODIFY `pkID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
