##Cambia el nombre y el tipo de dato, al campo fkID_coordinador
ALTER TABLE `apropiacion_social` CHANGE `fkID_coordinador` `coordinador` VARCHAR(250) NOT NULL;


ALTER TABLE `tematica` ADD `fkID_proyectoM` INT(11) NOT NULL AFTER `nombre`;


ALTER TABLE `lugar_apropiacion` ADD `fkID_proyectoM` INT(11) NOT NULL AFTER `telefono`;