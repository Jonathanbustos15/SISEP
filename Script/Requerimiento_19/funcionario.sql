-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 20-06-2019 a las 18:49:52
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
-- Estructura de tabla para la tabla `funcionario`
--

CREATE TABLE `funcionario` (
  `pkID` int(11) NOT NULL,
  `nombre_funcionario` varchar(60) NOT NULL,
  `apellido_funcionario` varchar(60) NOT NULL,
  `fkID_tipo_documento` int(11) NOT NULL,
  `documento_funcionario` int(11) NOT NULL,
  `telefono_funcionario` int(11) NOT NULL,
  `direccion_funcionario` varchar(60) NOT NULL,
  `email_funcionario` varchar(60) NOT NULL,
  `url_funcionario` varchar(60) NOT NULL,
  `estadoV` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `funcionario`
--

INSERT INTO `funcionario` (`pkID`, `nombre_funcionario`, `apellido_funcionario`, `fkID_tipo_documento`, `documento_funcionario`, `telefono_funcionario`, `direccion_funcionario`, `email_funcionario`, `url_funcionario`, `estadoV`) VALUES
(1, 'Daniel', 'Arias', 1, 67567564, 676566566, 'carrera', 'jhhjhj@kjkj', 'Maraton_Senior.docx', 1),
(3, 'Ramiro', 'Sanchez', 1, 76554658, 32156567, 'diagonal', 'carl@hotmail.com', 'archivo_(1).pdf', 1),
(4, 'Marcos', 'Gonzales', 1, 1, 7675666, 'jghjgjg', 'ujggjgjgjg', 'HOJA_DE_VIDA_ANDREA.docx', 2),
(5, 'jgjgjjj', 'hgjghh', 4, 67655, 76775656, 'hjgjhjhgghgh', 'hghghhggh', 'Maraton___.docx', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `funcionario`
--
ALTER TABLE `funcionario`
  ADD PRIMARY KEY (`pkID`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `funcionario`
--
ALTER TABLE `funcionario`
  MODIFY `pkID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
