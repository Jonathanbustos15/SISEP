DROP TABLE tipo_sede;

create table sede(
	pkID INT(11) NOT NULL AUTO_INCREMENT,
    nombre VARCHAR(250) NOT NULL,
    direccion VARCHAR(250) NOT NULL,
    telefono VARCHAR(250) NOT NULL,
    email VARCHAR(250) NOT NULL,
    codigo_dane VARCHAR(250) NOT NULL,
    fkID_departamento INT(11) NOT NULL,
    fkID_municipio INT(11) NOT NULL,
    fkID_zona INT(11) NOT NULL,
    fkID_tipo_escuela INT(11) NOT NULL,
    fkID_institucion INT(11) NOT NULL,
    PRIMARY KEY(pkID)
);

INSERT INTO `sede` (`pkID`, `nombre`, `direccion`, `telefono`, `email`, `codigo_dane`, `fkID_departamento`, `fkID_municipio`, `fkID_zona`, `fkID_tipo_escuela`, `fkID_institucion`) VALUES
(1, 'Las Lomas', 'Corregimiento Las Lomas', '3224312451', 'ielaslomas@gmail.com', '944388123', 29, 982, 1, 2, 1),
(2, 'sede1', 'koskfofsd', '3214326573', 'sede1@gmail.com', '6474822', 16, 632, 1, 1, 5),
(3, 'sede11', 'jjsdnssk', '5542424', 'sede11@gmail.com', 'f5325fd', 19, 682, 1, 1, 6),
(4, 'sede12', 'bsdabhh', '3138293030', 'sede12@gmail.com', 'eh323je', 15, 527, 1, 2, 6),
(5, 'sede33', 'nuxuau', '999922', 'sede33@gmail.com', 'gq5325d', 17, 634, 1, 1, 4),
(6, 'sede 1', 'coodds', '42353637', 'lalibertad@gmail.com', 'f25f52ff', 16, 632, 1, 3, 8);





ALTER TABLE `institucion`
  DROP `direccion`,
  DROP `telefono`,
  DROP `email`,
  DROP `codigo_dane`,
  DROP `fkID_departamento`,
  DROP `fkID_municipio`,
  DROP `fkID_zona`,
  DROP `fkID_tipo_escuela`,
  DROP `fkID_tipo_sede`;


  INSERT INTO `institucion` (`pkID`, `nombre`) VALUES
  (1, 'Normal Superior'),
  (3, 'prueba select'),
  (4, 'ppppp'),
  (5, 'Institución Educativa Guanía'),
  (6, 'Colegio Guanía'),
  (7, 'Colegio Mayor de Guainia'),
  (8, 'Institución Educativa La Libertad'),
  (9, 'Institución Educativa La Unión');

  UPDATE `institucion` SET `nombre` = 'Institucion Educativa Laguna Colorada' WHERE `institucion`.`pkID` = 4;

  UPDATE `institucion` SET `nombre` = 'Institución Educativa Luis Carlos Zambrano Díaz' WHERE `institucion`.`pkID` = 3;