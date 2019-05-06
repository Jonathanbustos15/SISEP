
                  
 ALTER TABLE `proyecto` ADD `descripcion` TEXT NOT NULL AFTER `nombre`;
 
 
 ALTER TABLE `proyecto` CHANGE `fkID_asesor` `fkID_asesor` INT(11) NULL;