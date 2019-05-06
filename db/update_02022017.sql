#-----------------------------------------------
ALTER TABLE `institucion` ADD `codigo_dane` VARCHAR(250) NOT NULL AFTER `nombre`;
#-----------------------------------------------
ALTER TABLE `sede` DROP `codigo_dane`;
#-----------------------------------------------

drop table pregunta_p_respuesta_p;


create table banco_respuestas_p(
   pkID int(11) not null AUTO_INCREMENT,
   respuestab varchar(250) not null,
   fkID_pregunta_p int(11) not null,
   primary key (pkID) 
);


ALTER TABLE `respuesta_p` CHANGE `respuesta` `respuesta` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL;

ALTER TABLE respuesta_p ADD fkID_pregunta_p int(11) not null after respuesta;

ALTER TABLE respuesta_p ADD fkID_banco_rta_p int(11) null after fkID_pregunta_p;

ALTER TABLE `banco_respuestas_p` CHANGE `respuestab` `respuestab` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL;

ALTER TABLE respuesta_p ADD fkID_usuario int(11) not null after fkID_banco_rta_p;



INSERT INTO `banco_respuestas_p`(`pkID`, `respuestab`, `fkID_pregunta_p`) VALUES (null, 'Excelente', 1), (null, 'Bueno',1), (null, 'Regular', 1), (null, 'Malo', 1);

ALTER TABLE `respuesta_p` CHANGE `pkID` `pkID` INT(11) NOT NULL AUTO_INCREMENT;

INSERT INTO `respuesta_p`(`pkID`, `respuesta`, `fkID_pregunta_p`, `fkID_banco_rta_p`, `fkID_usuario`) VALUES (null, 'Más tiempo en las asesorias', 4, null, 1);

#-----------------------------------------------
