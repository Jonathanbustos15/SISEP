#creacin de tabla usuario proyectoM
CREATE TABLE `usuario_proyectoM` (
  `pkID` int(11) NOT NULL,
  `fkID_usuario` int(11) NOT NULL,
  `fkID_proyectoM` int(11) NOT NULL
);
#llave primaria tabla
ALTER TABLE `usuario_proyectoM`
  ADD PRIMARY KEY (`pkID`);

#auto incremento de la llave de la tabla
ALTER TABLE `institucion_proyectoM`
  MODIFY `pkID` int(11) NOT NULL AUTO_INCREMENT;