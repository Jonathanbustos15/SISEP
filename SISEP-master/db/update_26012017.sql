
CREATE TABLE `grupo_evento` (
  `pkID` int(11) NOT NULL,
  `fkID_grupo` int(11) NOT NULL,
  `fkID_evento` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `grupo_evento`
--
ALTER TABLE `grupo_evento`
  ADD PRIMARY KEY (`pkID`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `grupo_evento`
--
ALTER TABLE `grupo_evento`
  MODIFY `pkID` int(11) NOT NULL AUTO_INCREMENT;


ALTER TABLE `grupo_evento` ADD `puntaje` BIGINT NULL AFTER `fkID_evento`;

#puntaje de tipo boolean saber si lleva puntaje o no.
ALTER TABLE `apropiacion_social` ADD `puntaje` BOOLEAN NOT NULL AFTER `fkID_tipo`;