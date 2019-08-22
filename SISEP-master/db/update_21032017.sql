##creacion de la tabla de auditoria------
CREATE TABLE `auditoria` ( 
	`pkID` INT NOT NULL AUTO_INCREMENT , 
	`accion` VARCHAR(250) NOT NULL , 
	`fecha` DATE NOT NULL , 
	`consulta_sql` TEXT NOT NULL , 
	`fkID_modulo` INT NOT NULL , 
	`fkID_usuario` INT NOT NULL , 
	`fkID_proyectoM` INT NOT NULL , 
	PRIMARY KEY (`pkID`)
);
##---------------------------------------
INSERT INTO `modulos`(`pkID`, `Nombre`, `fkID_padre`) VALUES (null,'auditoria',null);
