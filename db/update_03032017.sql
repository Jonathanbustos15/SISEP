
#modificaciones tabla proyecto_marco
ALTER TABLE `proyecto_marco` DROP `lugar_ejecucion`;

#se añade campo fkID_departamento a proyecto_marco
ALTER TABLE `proyecto_marco` ADD `fkID_departamento` INT NOT NULL AFTER `gerente`;

#creacion de tabla de muchos municipios
CREATE TABLE `proyectoM_municipio` ( 
	`pkID` INT NOT NULL AUTO_INCREMENT , 
	`fkID_proyectoM` INT NOT NULL , 
	`fkID_municipio` INT NOT NULL , 
	PRIMARY KEY (`pkID`));

#modificaciones tabla de prueba
ALTER TABLE `prueba` ADD `fkID_tipo_prueba` INT NOT NULL AFTER `nombre`;

#creacion de los tipos de prueba
CREATE TABLE `tipo_prueba` ( 
	`pkID` INT NOT NULL AUTO_INCREMENT , 
	`nombre` VARCHAR(250) NOT NULL , 
	PRIMARY KEY (`pkID`));
#estos tipos son fijos
INSERT INTO `tipo_prueba` (`pkID`, `nombre`) VALUES 
(NULL, 'Conocimiento'), 
(NULL, 'Percepción');

#se añade campo de tipo usuario a cada pregunta
ALTER TABLE `pregunta_p` ADD `fkID_tipo_usuario` INT NOT NULL AFTER `fkID_tipo_pregunta_p`;

#se añade campo para saber cual es la respuesta o respuestas correctas
ALTER TABLE `banco_respuestas_p` ADD `correcta` BOOLEAN NOT NULL AFTER `fkID_pregunta_p`;

#se añade el tipo de usuario que pueden responder las preguntas bitacora
ALTER TABLE `preguntas_b` ADD `fkID_tipo_usuario` INT NOT NULL AFTER `fkID_bitacora`;


create table usuario_proyectoM(
	pkID int(11) not null AUTO_INCREMENT,
    fkID_usuario int(11) not null,
    fkID_proyectoM int(11) not null,
    primary key(pkID)
);



ALTER TABLE `actor` CHANGE `nombre` `actor` VARCHAR(250) NOT NULL;

ALTER TABLE `actor` DROP `apellido`;

ALTER TABLE `actor`
  DROP `telefono`,
  DROP `email`,
  DROP `direccion`,
  DROP `fkID_departamento`,
  DROP `fkID_municipio`,
  DROP `cargo`;

  ALTER TABLE `actor` CHANGE `fkID_proyectoM` `nombre_contacto` VARCHAR(250) NOT NULL;

  ALTER TABLE `actor` ADD `apellido_contacto` VARCHAR(250) NOT NULL AFTER `nombre_contacto`;

  ALTER TABLE `actor` ADD `cargo_contacto` VARCHAR(250) NOT NULL AFTER `apellido_contacto`;

  ALTER TABLE `actor` ADD `telefono_contacto` INT NOT NULL AFTER `cargo_contacto`;

  ALTER TABLE `actor` ADD `email_contacto` VARCHAR(500) NOT NULL AFTER `telefono_contacto`;

  ALTER TABLE `actor` ADD `direccion_contacto` VARCHAR(250) NOT NULL AFTER `email_contacto`;

  ALTER TABLE `actor` ADD `fkID_departamento` INT(11) NOT NULL AFTER `direccion_contacto`;

  ALTER TABLE `actor` ADD `fkID_municipio` INT(11) NOT NULL AFTER `fkID_departamento`;

  ALTER TABLE `actor` ADD `fkID_proyectoM` INT(11) NOT NULL AFTER `fkID_municipio`;


  DROP TABLE docente_proyectoM;

  DROP TABLE estudiante_proyectoM;

  DROP TABLE asesor_proyectoM;

INSERT INTO `usuario_proyectoM`(`pkID`, `fkID_usuario`, `fkID_proyectoM`) VALUES (null, 3, 1),(null, 4, 1),(null, 5, 1),(null, 6, 1),(null, 9, 1),(null, 10, 1),(null, 13, 1),(null, 15, 1),(null, 17, 1),(null, 18, 1),(null, 19, 1);


ALTER TABLE `bitacora` ADD `fkID_proyectoM` INT(11) NOT NULL AFTER `evento`;

UPDATE `bitacora` SET `fkID_proyectoM` = '1' WHERE `bitacora`.`pkID` = 1;

UPDATE `bitacora` SET `fkID_proyectoM` = '1' WHERE `bitacora`.`pkID` = 2;

UPDATE `bitacora` SET `fkID_proyectoM` = '1' WHERE `bitacora`.`pkID` = 3;

UPDATE `bitacora` SET `fkID_proyectoM` = '1' WHERE `bitacora`.`pkID` = 4;


ALTER TABLE `actor` DROP `fkID_tipo_vinculacion`;

ALTER TABLE `actor` ADD `fecha_socializacion` DATE NULL AFTER `fkID_tipo`;

ALTER TABLE `actor` ADD `fecha_vinculacion` DATE NULL AFTER `fecha_socializacion`;


