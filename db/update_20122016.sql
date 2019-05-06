#añade los campos necesarios para usuarios

#----------------------------------------------------------------------

#tabla tipo-documento_id
CREATE TABLE `tipo_documento_id` ( `pkID` INT NOT NULL AUTO_INCREMENT , `nombre` VARCHAR(250) NOT NULL , PRIMARY KEY (`pkID`));

#tabla cargo
CREATE TABLE `cargo` ( `pkID` INT NOT NULL AUTO_INCREMENT , `nombre` VARCHAR(250) NOT NULL , PRIMARY KEY (`pkID`));

#grupo_etnico
CREATE TABLE `grupo_etnico` ( `pkID` INT NOT NULL AUTO_INCREMENT , `nombre` VARCHAR(250) NOT NULL , PRIMARY KEY (`pkID`));

#nivel_formacion
CREATE TABLE `nivel_formacion` ( `pkID` INT NOT NULL AUTO_INCREMENT , `nombre` VARCHAR(250) NOT NULL , PRIMARY KEY (`pkID`));

#rol
CREATE TABLE `rol` ( `pkID` INT NOT NULL AUTO_INCREMENT , `nombre` VARCHAR(250) NOT NULL , PRIMARY KEY (`pkID`));

#genero
CREATE TABLE `genero` ( `pkID` INT NOT NULL AUTO_INCREMENT , `nombre` VARCHAR(250) NOT NULL , PRIMARY KEY (`pkID`));

#----------------------------------------------------------------------
#tabla institucion

CREATE TABLE `institucion` 
( `pkID` INT NOT NULL AUTO_INCREMENT , 
	`nombre` VARCHAR(250) NOT NULL , 
	`direccion` VARCHAR(250) NOT NULL , 
	`telefono` VARCHAR(250) NOT NULL , 
	`email` VARCHAR(250) NOT NULL , 
	`codigo_dane` VARCHAR(250) NOT NULL , 
	`fkID_departamento` INT NULL , 
	`fkID_municipio` INT NULL , 
	`fkID_zona` INT NULL , 
	`fkID_tipo_escuela` INT NULL , 
	`fkID_tipo_sede` INT NULL , 
	PRIMARY KEY (`pkID`));

#----------------------------------------------------------------------
#tabla materia
CREATE TABLE `materia` ( `pkID` INT NOT NULL AUTO_INCREMENT , `nombre` VARCHAR(250) NOT NULL , PRIMARY KEY (`pkID`));

CREATE TABLE `usuario_materia` ( `pkID` INT NOT NULL AUTO_INCREMENT , `fkID_usuario` INT NOT NULL , `fkID_materia` INT NOT NULL , PRIMARY KEY (`pkID`));

#tabla grado
CREATE TABLE `grado` ( `pkID` INT NOT NULL AUTO_INCREMENT , `nombre` VARCHAR(250) NOT NULL , PRIMARY KEY (`pkID`));

CREATE TABLE `usuario_grado` ( `pkID` INT NOT NULL AUTO_INCREMENT , `fkID_usuario` INT NOT NULL , `fkID_grado` INT NOT NULL , PRIMARY KEY (`pkID`));


#campos que completan usuarios
ALTER TABLE `usuarios` ADD `fkID_tipo_documento` INT NOT NULL AFTER `fkID_tipo`, 
					   ADD `numero_documento` VARCHAR(250) NOT NULL AFTER `fkID_tipo_documento`, 
					   ADD `fecha_nacimiento` DATE NOT NULL AFTER `numero_documento`, 
					   ADD `direccion` VARCHAR(250) NOT NULL AFTER `fecha_nacimiento`, 
					   ADD `numero_telefono` VARCHAR(250) NOT NULL AFTER `direccion`, 
					   ADD `fkID_cargo` INT NULL AFTER `numero_telefono`, 
					   ADD `fecha_vinculacion` DATE NULL AFTER `fkID_cargo`, 
					   ADD `fkID_nivel_formacion` INT NULL AFTER `fecha_vinculacion`, 
					   ADD `nombre_titulo` VARCHAR(250) NULL AFTER `fkID_nivel_formacion`, 
					   ADD `ultimo_titulo` VARCHAR(250) NULL AFTER `nombre_titulo`, 
					   ADD `fkID_grupo_etnico` INT NULL AFTER `ultimo_titulo`, 
					   ADD `fkID_institucion` INT NULL AFTER `fkID_grupo_etnico`, 
					   ADD `fkID_rol` INT NULL AFTER `fkID_institucion`, 
					   ADD `fkID_genero` INT NULL AFTER `fkID_rol`;

#ALTER TABLE `usuarios` ADD `admin` BOOLEAN NOT NULL AFTER `email`;

#documentos para el docente
CREATE TABLE `documentos_docente` ( `pkID` INT NOT NULL AUTO_INCREMENT , `nombre` VARCHAR(250) NOT NULL , `url` VARCHAR(250) NOT NULL , `fkID_docente` INT NOT NULL , PRIMARY KEY (`pkID`));

#----------------------------------------------------------------------
#Seeds
#----------------------------------------------------------------------
#seeds de tipos de usuarios
INSERT INTO `tipo_usuario` (`pkID`, `nombre`) 

VALUES (8, 'Docente'), 
	   (9, 'Estudiante'), 
	   (10, 'Coordinador'), 
	   (11, 'Asesor');
#----------------------------------------------------------------------

#----------------------------------------------------------------------
#tipo de documento
INSERT INTO `tipo_documento_id` (`pkID`, `nombre`) VALUES (NULL, 'Cédula'), (NULL, 'Tarjeta de identidad'), (NULL, 'Pasaporte'), (NULL, 'Cédula de Extrangería');
#----------------------------------------------------------------------
#nivel de formacion
INSERT INTO `nivel_formacion` (`pkID`, `nombre`) VALUES (NULL, 'Básico'), (NULL, 'Técnico'), (NULL, 'Superior');
UPDATE `nivel_formacion` SET `nombre` = 'Técnico' WHERE `nivel_formacion`.`pkID` = 1; UPDATE `nivel_formacion` SET `nombre` = 'Normalista' WHERE `nivel_formacion`.`pkID` = 2; UPDATE `nivel_formacion` SET `nombre` = 'Estudiante de Pregrado' WHERE `nivel_formacion`.`pkID` = 3;
INSERT INTO `nivel_formacion` (`pkID`, `nombre`) VALUES (NULL, 'Profesional Universitario'), (NULL, 'Especialización'), (NULL, 'Maestría'), (NULL, 'Doctorado');
#grupo etnico
INSERT INTO `grupo_etnico` (`pkID`, `nombre`) VALUES (NULL, 'Puinave'), (NULL, 'Sikuani'), (NULL, 'Curripaco'), (NULL, 'Piaroa'), (NULL, 'Piapoco');
INSERT INTO `grupo_etnico` (`pkID`, `nombre`) VALUES (NULL, 'No Aplica');
#instituciones
INSERT INTO `institucion` (`pkID`, `nombre`, `direccion`, `telefono`, `email`, `codigo_dane`, `fkID_departamento`, `fkID_municipio`, `fkID_zona`, `fkID_tipo_escuela`, `fkID_tipo_sede`) VALUES (NULL, 'Institución Educativa Guanía', 'cra 45 00', '3456712', 'insguania@edu.com.co', '', NULL, NULL, NULL, NULL, NULL), (NULL, 'Colegio Guanía', 'cra 2 00', '4569201', 'colegioguaninia@edu.com.co', '', NULL, NULL, NULL, NULL, NULL);
#genero
INSERT INTO `genero` (`pkID`, `nombre`) VALUES (NULL, 'Masculino'), (NULL, 'Femenino');

#materias
INSERT INTO `materia` (`pkID`, `nombre`) VALUES (NULL, 'Matemáticas'), (NULL, 'Física'), (NULL, 'Química'), (NULL, 'Trigonometría'), (NULL, 'Cálculo');

#grados
INSERT INTO `grado` (`pkID`, `nombre`) VALUES (NULL, 'Primero'), (NULL, 'Segundo'), (NULL, 'Tercero'), (NULL, 'Cuarto'), (NULL, 'Quinto');

#prueba materias usuarios
INSERT INTO `usuario_materia` (`pkID`, `fkID_usuario`, `fkID_materia`) VALUES (NULL, '17', '1');

#cargo no aplica
INSERT INTO `cargo` (`pkID`, `nombre`) VALUES ('6', 'No Aplica');