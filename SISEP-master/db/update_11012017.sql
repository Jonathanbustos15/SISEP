

--
-- Estructura de tabla para la tabla `estado_proyecto`
--

CREATE TABLE `estado_proyecto` (
  `pkID` int(11) NOT NULL,
  `nombre` varchar(250) NOT NULL,
  `descripcion` text NOT NULL
) ;

ALTER TABLE `estado_proyecto` ADD PRIMARY KEY(`pkID`);

--
-- Volcado de datos para la tabla `estado_proyecto`
--

INSERT INTO `estado_proyecto` (`pkID`, `nombre`, `descripcion`) VALUES
(1, 'Aprobado', 'Estado en el cual el proyecto cumplio con los requisitos necesarios'),
(2, 'Rechazado', 'Estado en el cual el proyecto no cumplio con los requisitos necesarios');

-- --------------------------------------------------------



--
-- Estructura de tabla para la tabla `linea_investigacion`
--

CREATE TABLE `linea_investigacion` (
  `pkID` int(11) NOT NULL,
  `nombre` varchar(250) NOT NULL,
  `descripcion` text NOT NULL
) ;

--
-- Volcado de datos para la tabla `linea_investigacion`
--

INSERT INTO `linea_investigacion` (`pkID`, `nombre`, `descripcion`) VALUES
(1, 'linea1', 'desc1'),
(2, 'linea2', 'desc2');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proyecto`
--

CREATE TABLE `proyecto` (
  `pkID` int(11) NOT NULL,
  `nombre` varchar(250) NOT NULL,
  `fkID_linea_investigacion` int(11) NOT NULL,
  `pregunta_investigacion` text NOT NULL,
  `fkID_asesor` int(11) NOT NULL,
  `fkID_tipo_proyecto` int(11) NOT NULL,
  `fkID_estado_proyecto` int(11) NOT NULL
);

--
-- Volcado de datos para la tabla `proyecto`
--

INSERT INTO `proyecto` (`pkID`, `nombre`, `fkID_linea_investigacion`, `pregunta_investigacion`, `fkID_asesor`, `fkID_tipo_proyecto`, `fkID_estado_proyecto`) VALUES
(1, 'Cuidando el medio ambiente', 1, '¿Velas por el medio ambiente en el que vives?', 1, 1, 3);

-- --------------------------------------------------------
--
-- Estructura de tabla para la tabla `tipo_proyecto`
--

CREATE TABLE `tipo_proyecto` (
  `pkID` int(11) NOT NULL,
  `nombre` varchar(250) NOT NULL,
  `descripcion` text NOT NULL
);

--
-- Volcado de datos para la tabla `tipo_proyecto`
--

INSERT INTO `tipo_proyecto` (`pkID`, `nombre`, `descripcion`) VALUES
(1, 'Investigación', 'Buscar información y formular hipótesis, sobre un tema en especifico'),
(2, 'Social', 'Lograr alguna obra que beneficie a la comunidad'),
(3, 'Desarrollo Sostenible', 'Busca la participación equitativa de la sociedad');

-- --------------------------------------------------------
