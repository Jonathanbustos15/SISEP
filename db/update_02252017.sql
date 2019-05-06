#---------------------------------------
ALTER TABLE `respuesta_p` DROP `fkID_banco_rta_p`;

CREATE TABLE `respuesta_p_banco` ( 
  `pkID` INT NOT NULL AUTO_INCREMENT , 
  `fkID_respuesta_p` INT NOT NULL , 
  `fkID_banco` INT NOT NULL , PRIMARY KEY (`pkID`)
);
#---------------------------------------