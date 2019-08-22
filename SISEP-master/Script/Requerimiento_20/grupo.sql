-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 26-06-2019 a las 18:44:15
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
-- Estructura de tabla para la tabla `grupo`
--

CREATE TABLE `grupo` (
  `pkID` int(11) NOT NULL,
  `nombre` varchar(250) NOT NULL,
  `fkID_tipo_grupo` int(11) NOT NULL,
  `fkID_grado` int(11) DEFAULT NULL,
  `fkID_institucion` int(11) NOT NULL,
  `url_logo` varchar(250) NOT NULL,
  `fecha_creacion` date NOT NULL,
  `estadoV` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `grupo`
--

INSERT INTO `grupo` (`pkID`, `nombre`, `fkID_tipo_grupo`, `fkID_grado`, `fkID_institucion`, `url_logo`, `fecha_creacion`, `estadoV`) VALUES
(1, 'los propioses', 0, 2, 1, '2lto_410749_jin-kazama_p.jpg', '2017-11-09', 2),
(2, 'LOS BOTÁNICOS DE GUAINIA', 0, 6, 3, 'LOS BOTANICOS DEL GUAINIA.png', '2017-02-01', 2),
(3, 'LOS BÚHOS EXPLORADORES', 0, 3, 3, 'LOS BUHOS EXPLORADORES.png', '2017-02-01', 2),
(4, 'LOS JORUGOT DEL MONTE', 0, 4, 3, 'LOS JORUGOT DEL MONTE.png', '2017-02-01', 2),
(5, 'ARQUEÓLOGOS DE NÚMEROS', 0, 9, 3, 'ARQUEOLOGOS DE NUMEROS.png', '2017-04-01', 2),
(6, 'ASTRÓNOMOS DEL PASADO', 0, 9, 3, 'ASTRONOMOS DEL PASADO.png', '2017-03-05', 2),
(7, 'ZONA VERDE DEL GUAINIA', 0, 8, 3, 'ZONA VERDE DEL GUAINIA.jpg', '2017-02-20', 2),
(8, 'LOS EXPLORADORES DE INIRIDA', 0, 1, 3, 'LOS EXPLORADORES DE INIRIDA.jpg', '2017-02-01', 2),
(9, 'LOS DUEÑOS DE LA NATURALEZA', 0, 6, 3, 'LOS DUEÑOS DE LA NATURALEZA.jpg', '2017-02-01', 2),
(10, 'LOS CANTORES DE LA PRIMAVERA', 0, 4, 3, 'LOS CANTORES DE LA PRIMAVERA.jpg', '2017-02-01', 2),
(11, 'JALAPITU', 0, 8, 3, 'JALAPITU.jpg', '2017-03-09', 2),
(12, 'KALIAVIRINAE', 0, 10, 3, 'KALIAVIRINAE.jpg', '2017-02-02', 2),
(13, 'LOS TICS', 0, 12, 3, 'LOS TICS.jpg', '2017-03-03', 2),
(14, 'CLORO - FILIA', 0, 10, 3, 'CLORO - FILIA.jpg', '2017-02-21', 2),
(15, 'ABUELOS DE AGUA', 0, 6, 3, 'ABUELOS DE AGUA.jpg', '2017-02-01', 2),
(16, 'LOS JAGUARES DE LA PRIMAVERA', 0, 2, 3, 'LOS JAGUARES DE LA PRIMAVERA.jpg', '2017-02-01', 2),
(17, 'LOS PECECITOS DE LA PRIMAVERA', 0, 1, 3, 'LOS PECESITOS DE LA PRIMAVERA.jpg', '2017-02-01', 2),
(18, 'LOS LEONES', 0, 3, 3, 'HACIENDO FLORES Y FRUTAS.jpg', '2017-02-01', 2),
(19, 'PEMATABUCUENE', 0, 10, 4, 'PEMATABUCUENE[1].jpg', '2017-03-22', 2),
(20, 'EN LA ONDA CON PANDI', 0, 8, 4, 'EN_LA_ONDA_CON_PANDI[1].jpg', '2016-07-01', 2),
(21, 'INVESTIGADORES DE ACERO', 0, 5, 4, 'INVESTIGADORES_DE_ACERO[1].jpg', '2017-02-22', 2),
(22, 'LOS HAPI DEL GALAN', 0, 4, 4, 'LOS_HAPI_DEL_GALAN[1].jpg', '2017-02-21', 2),
(23, 'PROYECTO TIM', 0, 9, 4, 'PROYECTO_TIM[1].jpg', '2017-02-19', 2),
(24, 'LOS ARQUEROS', 0, 6, 4, 'LOS_ARQUEROS[1].jpg', '2017-02-21', 2),
(25, 'LOS HEREDEROS DE LA CULTURA PUINAVE', 0, 6, 4, 'LOS_HEREDEROS_DE_LA_CULTURA_PUINAVE[2].jpg', '2017-02-01', 2),
(26, 'EXCAVADORES DE LA CULTURA', 0, 8, 4, 'EXCAVADORES_DE_LA_CULTURA[1].jpg', '2017-02-19', 2),
(27, 'GUAINÍRIDA PROYECT@', 0, 8, 4, 'GUAINIRIDA_PROYECTA[1].jpg', '2017-02-20', 2),
(28, 'PLUMA - DIGITAL', 0, 9, 4, 'PLUMA-DIGITAL.jpg', '2017-02-01', 2),
(29, 'LOS ASTRÓNOMOS DEL COCO', 0, 2, 5, 'LOS_ASTRÓNOMOS_DEL_COCO[1].jpg', '2017-02-01', 2),
(30, 'LOS NIÑOS DEL MABACO', 0, 3, 5, 'LOS_NIÑOS_DEL_MABACO[1].jpg', '2017-02-01', 2),
(31, 'LOS JUGLARES DE INÍRIDA', 0, 9, 5, 'LOS_JUGLARES_DE_INIRIDA[2].jpg', '2017-02-01', 2),
(32, 'LOS NIÑOS DEL TZAZE', 0, 2, 6, 'LOS_NIÑOS_DEL_TZAZE[1].jpg', '2017-02-01', 2),
(33, 'LOS BUSCADORES DE RECETAS', 0, 3, 6, 'LOS_BUSCADORES_DE_RECETAS[1].jpg', '2017-02-27', 2),
(34, 'YAVINAPA', 0, 2, 6, 'YAVINAPA[2].jpg', '2017-02-27', 2),
(35, 'LOS BICHITOS', 0, 1, 6, 'LOS BICHITOS.jpg', '2017-02-01', 2),
(36, 'FLOR DE INÍRIDA', 0, 13, 6, 'FLOR DE INIRIDA.jpg', '2017-02-27', 2),
(37, 'LOS NIÑOS DEL RÍO', 0, 2, 6, 'LOS NIÑOS DEL RÍO.jpg', '2017-02-01', 2),
(38, 'LOS PÁJAROS DEL PAUJIL', 0, 2, 6, 'LOS PÁJAROS DEL PAUJIL.jpg', '2017-02-01', 2),
(39, 'LOS CHUPAFLORES', 0, 1, 6, 'LOS CHUPAFLORES.jpg', '2017-02-01', 2),
(40, 'LA NUEVA GENERACIÓN YANOMALISTA', 0, 8, 7, 'LA NUEVA GENERACIÓN YANOMALISTA.jpg', '2017-04-25', 2),
(41, 'LOS NAVEGANTES DEL RÍO NEGRO', 0, 5, 7, 'LOS NAVEGANTES DEL RÍO NEGRO.jpg', '2017-02-01', 2),
(42, 'LOS AVENTUREROS TRI-FRONTERIZOS', 0, 4, 7, 'LOS AVENTUREROS TRI-FRONTERAS.jpg', '2017-04-25', 2),
(43, 'LAS KUÑAITA DEL COPOAZU', 0, 7, 7, 'LOS KUÑAITA DEL COPOAZU.jpg', '2017-04-24', 2),
(44, 'LOS CURANDEROS', 0, 11, 7, 'LOS CURANDEROS.jpg', '2017-02-01', 2),
(45, 'LOS MAGOS INDÍGENAS DE LA TRIPLE-FRONTERA', 0, 12, 7, 'LOS MAGOS INDÍGENAS DE LA TRIPLE FRONTERA.jpg', '2017-02-01', 2),
(46, 'LOS PESCADORES DEL RÍO NEGRO', 0, 7, 7, 'LOS PESCADORES DEL RIO NEGRO.png', '2017-02-01', 2),
(47, 'LOS INVESTIGADORES DE TONINAS', 0, 1, 7, 'LOS INVESTIGADORES DE TONINAS.jpg', '2017-04-25', 2),
(48, 'LOS EXPLORADORES DE SAN FELIPE', 0, 2, 7, 'LOS EXPLORADORES DE SAN FELIPE.jpg', '2017-02-01', 2),
(49, 'LOS PUSANEROS', 0, 8, 8, 'LOS PUSANEROS.jpg', '2017-05-04', 2),
(50, 'LOS HISTORIADORES', 0, 10, 8, 'LOS HISTORIADORES.jpg', '2017-02-01', 2),
(51, 'KALIAKEYEI', 0, 10, 8, 'KALIAKEYEI.jpg', '2017-03-04', 2),
(52, 'HISTORIADORES DE BARRANCOMINAS', 0, 11, 8, 'HISTORIADORES DE BARRANCOMINAS.jpg', '2017-02-01', 2),
(53, 'EXPLORADORES DEL GUAINÍA', 0, 7, 8, 'EXPLORADORES DEL GUAINIA.jpg', '2017-02-01', 2),
(54, 'ASTROONDAS', 0, 8, 8, 'ASTROONDAS.jpg', '2017-02-01', 2),
(55, 'LOS X-PERIMENTADORES', 0, 7, 9, 'LOS X-PERIMENTADORES.jpg', '2017-04-06', 2),
(56, 'CONTADORES DE HISTORIAS', 0, 10, 9, 'CANTADORES DE HISTORIAS.jpg', '2017-02-28', 2),
(57, 'LOS INVESTIGADORES DEL CURRIPACO', 0, 7, 9, 'LOS INVESTIGADORES DEL CURRIPACO.jpg', '2017-04-05', 2),
(58, 'THE SCIENTIST BOYS', 0, 10, 9, 'THE SCIENTIST BOYS.jpg', '2017-02-20', 2),
(59, 'LENGUA TIERRA', 0, 8, 9, 'LENGUA TIERRA.jpg', '2017-02-18', 2),
(60, 'EL IMPACTO', 0, 12, 9, 'EL IMPACTO.jpg', '2017-04-06', 2),
(61, 'LOS SUPER INVESTIGADORES DE PLANTAS', 0, 4, 9, 'LOS SUPER INVESTIGADORES DE PLANTAS.jpg', '2017-02-01', 2),
(62, 'LOS DOCTORES DE PLANTAS', 0, 2, 9, 'LOS DOCTORES DE PLANTAS.jpg', '2017-02-01', 2),
(63, 'LOS LOCOS EN CARRERAS', 0, 4, 11, 'LOS LOCOS EN CARRERAS.jpg', '2017-02-24', 2),
(64, 'LOS INVESTIGADORES', 0, 3, 11, 'LOS INVESTIGADORES.jpg', '2017-02-01', 2),
(65, 'LOS EXPLORADORES INTERGALACTICOS', 0, 2, 11, 'LOS EXPLORADORES INTERGALACTICOS.jpg', '2017-02-01', 2),
(66, 'LARSI', 0, 8, 10, 'LARSI.jpg', '2017-03-03', 2),
(67, 'TE CUENTO MI CUENTO', 0, 7, 10, 'TE CUENTO MI CUENTO.jpg', '2017-02-01', 2),
(68, 'BACK TO THE PAST 8', 0, 9, 10, 'BACK TO THE PAST 8.jpg', '2017-02-01', 2),
(69, 'DUGIN', 0, 10, 10, 'DUGIN.jpg', '2017-02-01', 2),
(74, 'LAS ESTRELLITAS Y LOS TIGRES DEL MERCADO', 0, 5, 10, 'LAS ESTRELLITAS Y LOS TIGRES DEL MERCADO.jpg', '2017-02-01', 2),
(75, 'LOS ISÓTOPOS DEL GUAINÍA ', 0, 5, 10, 'LOS ISOTOPOS DEL GUAINIA.jpg', '2017-02-01', 2),
(76, 'LOS REYES DEL AJEDREZ', 0, 1, 10, 'LOS REYES DEL AJEDREZ.jpg', '2017-02-01', 2),
(77, 'GARIMPEIROS', 0, 10, 10, 'GARIMPEIROS.jpg', '2017-03-02', 2),
(78, 'LOS PECES DEL RIO', 0, 4, 10, 'LOS PECES DEL RÍO.jpg', '2017-02-01', 2),
(79, 'MINICIENTIFICOS', 0, 8, 10, 'MINICIENTIFICOS.jpg', '2017-02-27', 2),
(80, 'INVESTIGADORES DE LA NATURALEZA', 0, 8, 10, 'INVESTIGUEMOS LA NATURALEZA.jpg', '2017-03-14', 2),
(81, 'LAS TONINAS SALTARINAS LA LA LA', 0, 2, 10, 'LAS TONINAS SALTARINAS LA LA LA.jpg', '2017-02-01', 2),
(82, 'KAMALIKERRY', 0, 11, 10, 'KAMALIKERRY.jpg', '2017-02-01', 2),
(83, 'LAS EXPLORADOR@S', 0, 12, 10, 'LOS EXPLORADOR@S.jpg', '2017-03-01', 2),
(84, 'AMANA', 0, 12, 10, 'AMANA.jpg', '2017-02-01', 2),
(85, 'DE LA MANO A INVESTIGAR', 0, 7, 10, 'DE LA MANO A INVESTIGAR.jpg', '2017-03-07', 2),
(86, 'gghj', 0, 3, 1, '3d3dYBZM5boI.jpg', '2018-07-26', 2),
(87, 'Grupo 1', 1, 5, 4, 'noveno_cambio.PNG', '0000-00-00', 1),
(88, 'grupo 2', 1, 3, 4, '', '2018-05-25', 1),
(89, 'grupo3', 1, 2, 4, '', '2017-04-25', 1),
(90, 'grupo 4', 1, 1, 1, '', '2017-07-25', 1),
(91, 'grupo 5', 1, 9, 1, '', '2018-05-25', 1),
(92, 'grupo 6', 1, 5, 1, '', '2018-05-25', 1),
(93, 'Grupo 9', 1, 1, 3, '', '2017-05-24', 1),
(94, 'grupo 10', 1, 4, 1, '', '2016-05-25', 1),
(95, 'grupo 11', 2, 2, 3, '', '2016-04-24', 1),
(96, 'grupo 13', 2, 1, 4, '', '2017-05-25', 1),
(97, 'grupo 15', 2, 7, 1, '', '2017-03-25', 1),
(98, 'grupo 18', 2, 2, 6, '', '2017-04-24', 1),
(99, 'grupo 20', 2, 6, 3, '', '2017-04-25', 1),
(100, 'grupo 21', 2, 5, 5, '', '2017-04-25', 1),
(101, 'grupo 21', 2, 2, 3, '', '2017-04-25', 1),
(102, 'grupo 25', 2, 3, 5, '', '2017-04-25', 1),
(103, 'grupo 27', 2, 2, 3, '', '2017-04-24', 1),
(104, 'grupo 28', 2, 2, 3, '', '2017-05-25', 1),
(105, 'grupo 32', 2, 2, 3, '', '2017-04-25', 1),
(106, 'grupo 31', 2, 5, 5, '', '2017-04-25', 1),
(107, 'carlos', 2, 2, 3, '', '2018-04-24', 1),
(108, 'grupo 16', 1, 2, 3, '', '2017-04-24', 1),
(109, 'grupo 111', 2, 3, 3, '', '2017-03-22', 1),
(110, 'grupo 25', 2, 7, 6, '', '2019-06-20', 1),
(111, 'grupo 45', 2, 2, 3, '', '2017-04-25', 1),
(112, 'grupo 40', 2, 2, 3, '', '2017-04-25', 1),
(113, 'grupo 2', 2, 6, 3, '', '2018-05-25', 1),
(114, 'grupo 22', 1, 2, 3, '', '2017-03-24', 1),
(115, 'grupo 007', 1, 2, 3, '', '2016-04-24', 1),
(116, 'grupo 06', 1, 9, 6, '', '2019-06-19', 1),
(117, 'camino de paz', 3, 2, 3, '', '2017-04-25', 1),
(118, 'grupo comandos', 1, 2, 3, '', '2018-05-25', 1),
(119, 'grupo los heroes', 2, 2, 3, '', '2017-04-25', 1),
(120, 'grupo las estrellas', 2, 2, 3, '', '2018-04-25', 1),
(121, 'Grupo Colombia', 2, 2, 3, '', '2017-05-22', 1),
(122, 'Grupo terricolas', 2, 2, 3, 'logo_1.jpg', '2018-05-25', 1),
(123, 'Grupo terricolas', 2, 2, 3, 'logo_1.jpg', '2018-05-25', 1),
(124, 'Grupo terricolas', 2, 2, 3, 'logo_1.jpg', '2018-05-25', 1),
(125, 'Grupo 45676', 2, 1, 3, 'logo_1.jpg', '2018-05-25', 1),
(126, 'carlitos', 1, 3, 3, 'logo_1.jpg', '2017-04-25', 1),
(127, 'grupo0071', 2, 9, 4, '', '2019-06-19', 1),
(128, 'grupo la 21', 2, 2, 3, '', '2016-04-24', 1),
(129, 'grupo la 56', 2, 2, 4, '', '2017-04-25', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `grupo`
--
ALTER TABLE `grupo`
  ADD PRIMARY KEY (`pkID`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `grupo`
--
ALTER TABLE `grupo`
  MODIFY `pkID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=130;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
