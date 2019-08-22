-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 18-06-2019 a las 19:17:48
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
-- Estructura de tabla para la tabla `institucion`
--

CREATE TABLE `institucion` (
  `pkID` int(11) NOT NULL,
  `nombre_institucion` varchar(250) NOT NULL,
  `codigo_dane` varchar(250) NOT NULL,
  `direccion_institucion` varchar(60) NOT NULL,
  `email_institucion` varchar(100) NOT NULL,
  `fkID_municipio` int(11) NOT NULL,
  `telefono_institucion` int(11) NOT NULL,
  `estadoV` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `institucion`
--

INSERT INTO `institucion` (`pkID`, `nombre_institucion`, `codigo_dane`, `direccion_institucion`, `email_institucion`, `fkID_municipio`, `telefono_institucion`, `estadoV`) VALUES
(1, 'Gustavo_meme', 'hdudh393ed', 'calle', 'joknyh@live', 1, 675574566, 1),
(2, 'Los Laureles', '4354565464', '', '', 1, 0, 1),
(3, 'I.E. LA PRIMAVERA', '194001001026', '', '', 1, 0, 1),
(4, 'I.E. LUIS CARLOS GALAN SARMIENTO', '194001000496', '', '', 2, 0, 1),
(5, 'I.E. FRANCISCO MIRANDA', '294001000091', 'diagonal', 'jjhh@hot.com', 2, 324456776, 1),
(6, 'I.E. BAS SAN PEDRO CLAVER', '294001000369', 'transversal', 'kjuliyun@hotmail.com', 3, 2147483647, 1),
(7, 'I.E. MANUEL QUINTIN LAME', '294001000938', '', '', 4, 0, 1),
(8, 'I.E. LIBERTADORES', '194001001085', '', '', 1, 0, 1),
(9, 'I.E. CUSTODIO GARCIA ROVIRA', '194001000771', '', '', 2, 0, 2),
(11, 'I.E acacias', 'ty6767uh', 'carre 20', 'acacia@hotmail.com', 1, 3455676, 1),
(12, 'kjjuhh', '577776gf', 'hfhjffg', 'hgttr@joymil.co', 1, 79966555, 2);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `institucion`
--
ALTER TABLE `institucion`
  ADD PRIMARY KEY (`pkID`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `institucion`
--
ALTER TABLE `institucion`
  MODIFY `pkID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
