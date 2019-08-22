UPDATE `tipo_apropiacion_social` SET `nombre` = 'Grupos Ondas' WHERE `tipo_apropiacion_social`.`pkID` = 13;

UPDATE `tipo_apropiacion_social` SET `nombre` = 'Comunidad en General' WHERE `tipo_apropiacion_social`.`pkID` = 12;

INSERT INTO `tipo_apropiacion_social`(`pkID`, `nombre`) VALUES (null, 'Grupos Ondas y Comunidad en General');



ALTER TABLE `apropiacion_social` ADD `otros_participantes` INT(11) NOT NULL AFTER `num_docentes`;




