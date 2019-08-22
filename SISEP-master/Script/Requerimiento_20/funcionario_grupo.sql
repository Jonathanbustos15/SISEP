-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 27-06-2019 a las 16:21:50
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
-- Estructura de tabla para la tabla `funcionario_grupo`
--

CREATE TABLE `funcionario_grupo` (
  `pkID` int(11) NOT NULL COMMENT 'llave primaria de la tabla',
  `fkID_grupo` int(11) NOT NULL COMMENT 'llave foránea del grupo ',
  `fkID_tutor` int(11) NOT NULL COMMENT 'llave foránea del tutor',
  `fecha_asignacion_tutor` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'fecha de asignación del tutor al grupo',
  `estadoV` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `funcionario_grupo`
--

INSERT INTO `funcionario_grupo` (`pkID`, `fkID_grupo`, `fkID_tutor`, `fecha_asignacion_tutor`, `estadoV`) VALUES
(1, 118, 2, '2018-05-25 05:00:00', 1),
(2, 119, 8, '2017-04-25 05:00:00', 1),
(3, 119, 4, '2017-04-25 05:00:00', 1),
(4, 120, 8, '2018-04-25 05:00:00', 1),
(5, 120, 1, '2018-04-25 05:00:00', 1),
(6, 121, 8, '2017-05-22 05:00:00', 1),
(7, 124, 8, '2018-05-25 05:00:00', 1),
(8, 125, 8, '2018-05-25 05:00:00', 1),
(9, 126, 8, '2017-04-25 05:00:00', 1),
(10, 127, 4, '2019-06-19 05:00:00', 1),
(11, 129, 8, '2017-04-25 05:00:00', 1),
(12, 129, 1, '2017-04-25 05:00:00', 1),
(13, 130, 4, '2019-06-26 05:00:00', 1),
(14, 131, 8, '2017-04-25 05:00:00', 1),
(16, 132, 2, '0000-00-00 00:00:00', 1),
(17, 132, 4, '2019-06-18 05:00:00', 1),
(18, 133, 8, '2017-04-25 05:00:00', 1),
(19, 133, 4, '2017-04-25 05:00:00', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `funcionario_grupo`
--
ALTER TABLE `funcionario_grupo`
  ADD PRIMARY KEY (`pkID`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `funcionario_grupo`
--
ALTER TABLE `funcionario_grupo`
  MODIFY `pkID` int(11) NOT NULL AUTO_INCREMENT COMMENT 'llave primaria de la tabla', AUTO_INCREMENT=20;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
