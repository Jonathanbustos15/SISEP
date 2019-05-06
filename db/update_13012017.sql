
 alter table proyecto
  add fkID_grupo int(11) not null after fkID_estado_proyecto ;

#añade institucion al grupo
ALTER TABLE `grupo` ADD `fkID_institucion` INT NOT NULL AFTER `fkID_grado`;
