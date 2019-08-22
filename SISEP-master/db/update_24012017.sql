-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `curso_formacion`
--

CREATE TABLE `curso_formacion` (
  `pkID` int(11) NOT NULL,
  `nombre` varchar(250) NOT NULL,
  `objetivo` text NOT NULL,
  `intensidad` varchar(250) NOT NULL,
  `resultados` text NOT NULL
) ;

--
-- Volcado de datos para la tabla `curso_formacion`
--

INSERT INTO `curso_formacion` (`pkID`, `nombre`, `objetivo`, `intensidad`, `resultados`) VALUES
(1, 'Pedagogía Ditáctica', 'objetivo11', '48 Horas', 'Exitosos');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grupo_formacion`
--

CREATE TABLE `grupo_formacion` (
  `pkID` int(11) NOT NULL,
  `fkID_curso` int(11) NOT NULL,
  `fkID_capacitador` int(11) NOT NULL,
  `fecha_inicio` date NOT NULL,
  `fecha_fin` date NOT NULL,
  `url_archivo` varchar(250) NOT NULL
) ;

--
-- Volcado de datos para la tabla `grupo_formacion`
--

INSERT INTO `grupo_formacion` (`pkID`, `fkID_curso`, `fkID_capacitador`, `fecha_inicio`, `fecha_fin`, `url_archivo`) VALUES
(1, 1, 11, '2017-03-01', '2017-04-01', 'url');

----------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_usuario`
--

CREATE TABLE `tipo_usuario` (
  `pkID` int(11) NOT NULL,
  `nombre` varchar(250) NOT NULL
) ;

--
-- Volcado de datos para la tabla `tipo_usuario`
--

INSERT INTO `tipo_usuario` (`pkID`, `nombre`) VALUES
(1, 'Administrador'),
(8, 'Docente'),
(9, 'Estudiante'),
(10, 'Coordinador'),
(11, 'Asesor'),
(12, 'Capacitador');

-- --------------------------------------------------------

--

-- Volcado de datos para la tabla `usuarios`
--

UPDATE usuarios SET fkID_tipo = 12 WHERE usuarios.pkID = 11;

UPDATE usuarios SET fkID_tipo = 12 WHERE usuarios.pkID = 12;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario_grupo_formacion`
--

CREATE TABLE `usuario_grupo_formacion` (
  `pkID` int(11) NOT NULL,
  `fkID_usuario` int(11) NOT NULL,
  `fkID_grupo_formacion` int(11) NOT NULL
) ;

--
-- Volcado de datos para la tabla `usuario_grupo_formacion`
--

INSERT INTO `usuario_grupo_formacion` (`pkID`, `fkID_usuario`, `fkID_grupo_formacion`) VALUES
(1, 3, 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `curso_formacion`
--
ALTER TABLE `curso_formacion`
  ADD PRIMARY KEY (`pkID`);

--
-- Indices de la tabla `grupo_formacion`
--
ALTER TABLE `grupo_formacion`
  ADD PRIMARY KEY (`pkID`);

--
-- Indices de la tabla `tipo_usuario`
--
ALTER TABLE `tipo_usuario`
  ADD PRIMARY KEY (`pkID`);

--
--
-- Indices de la tabla `usuario_grupo_formacion`
--
ALTER TABLE `usuario_grupo_formacion`
  ADD PRIMARY KEY (`pkID`);

--
-- AUTO_INCREMENT de la tabla `curso_formacion`
--
ALTER TABLE `curso_formacion`
  MODIFY `pkID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `grupo_formacion`
--
ALTER TABLE `grupo_formacion`
  MODIFY `pkID` int(11) NOT NULL AUTO_INCREMENT;
--
--
-- AUTO_INCREMENT de la tabla `tipo_usuario`
--
ALTER TABLE `tipo_usuario`
  MODIFY `pkID` int(11) NOT NULL AUTO_INCREMENT;
--

--
-- AUTO_INCREMENT de la tabla `usuario_grupo_formacion`
--
ALTER TABLE `usuario_grupo_formacion`
  MODIFY `pkID` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
