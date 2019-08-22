INSERT INTO `materia`(`pkID`, `nombre`) VALUES (null, 'Director de Curso');


ALTER TABLE `grupo` CHANGE `lema` `lema` VARCHAR(250) NOT NULL;


UPDATE `rol` SET `nombre` = 'Lider' WHERE `rol`.`pkID` = 3;

INSERT INTO `rol`(`pkID`, `nombre`, `fkID_tipo_usuario`) VALUES (null, 'Vocero', 9), (null, 'Relator', 9), (null, 'Comunicador', 9), (null, 'Relacionista Público', 9);


ALTER TABLE `proyecto_marco` DROP `url_archivo`;