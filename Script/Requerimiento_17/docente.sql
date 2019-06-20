-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 20-06-2019 a las 18:47:00
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
-- Estructura de tabla para la tabla `docente`
--

CREATE TABLE `docente` (
  `pkID` int(11) NOT NULL,
  `nombre_docente` varchar(50) NOT NULL,
  `apellido_docente` varchar(60) NOT NULL,
  `fkID_tipo_documento` int(11) NOT NULL,
  `documento_docente` varchar(30) NOT NULL,
  `fkID_institucion` int(11) NOT NULL,
  `telefono_docente` int(11) NOT NULL,
  `direccion_docente` varchar(60) NOT NULL,
  `email_docente` varchar(50) NOT NULL,
  `estadoV` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `docente`
--

INSERT INTO `docente` (`pkID`, `nombre_docente`, `apellido_docente`, `fkID_tipo_documento`, `documento_docente`, `fkID_institucion`, `telefono_docente`, `direccion_docente`, `email_docente`, `estadoV`) VALUES
(1, 'Profesor ', 'Jirafales', 1, '101765667', 2, 32445676, 'carrera', 'carlos@hyti.com', 2),
(2, 'carlos', 'gutierres', 1, '676666566', 1, 7655454, 'carrera', 'crats@hotm.com', 1),
(3, 'Jimena', 'Gonzales', 1, '104465543', 5, 45676345, 'carrera', 'jimen@gmail.com', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `docente`
--
ALTER TABLE `docente`
  ADD PRIMARY KEY (`pkID`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `docente`
--
ALTER TABLE `docente`
  MODIFY `pkID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
