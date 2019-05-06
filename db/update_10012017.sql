-- 
-- añade departamento y municipio en usuarios

ALTER TABLE `usuarios` 
ADD `fkID_departamento` VARCHAR(250) NULL AFTER `fecha_nacimiento`, 
ADD `fkID_municipio` VARCHAR(250) NULL AFTER `fkID_departamento`;

-- campo de grupo que no va

ALTER TABLE `grupo` DROP `url_imagen`;

-- se agregan campos

ALTER TABLE `grupo` 
ADD `descripcion` TEXT NULL AFTER `nombre`, 
ADD `fkID_grado` INT NULL AFTER `descripcion`;

#no aplica en grado

INSERT INTO `grado` (`pkID`, `nombre`) VALUES (NULL, 'No Aplica');


#tabla que relaciona usuarios y grupos e identifica el rol en cada grupo
CREATE TABLE `usuario_grupo` ( 
	`pkID` INT NOT NULL AUTO_INCREMENT , 
	`fkID_usuario` INT NOT NULL , 
	`fkID_grupo` INT NOT NULL , 
	`fkID_rol` INT NOT NULL , 
	PRIMARY KEY (`pkID`)
);


#agregar campo tabla rol
ALTER TABLE `rol` ADD `fkID_tipo_usuario` INT NOT NULL AFTER `nombre`;

UPDATE `rol` SET fkID_tipo_usuario = 9 WHERE fkID_tipo_usuario = 0;

#roles de docentes
INSERT INTO `rol` (`pkID`, `nombre`, `fkID_tipo_usuario`) VALUES (NULL, 'Principal', '8'), (NULL, 'Acompañante', '8');