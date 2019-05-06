ALTER TABLE `actor` ADD `fkID_proyectoM` INT(11) NOT NULL AFTER `fkID_tipo_vinculacion`;

UPDATE `actor` SET `fkID_proyectoM` = '1' WHERE `actor`.`pkID` = 1;
UPDATE `actor` SET `fkID_proyectoM` = '1' WHERE `actor`.`pkID` = 2;
UPDATE `actor` SET `fkID_proyectoM` = '1' WHERE `actor`.`pkID` = 6;



ALTER TABLE `prueba` ADD `fkID_proyectoM` INT(11) NOT NULL AFTER `url_archivo`;

UPDATE `prueba` SET `fkID_proyectoM` = '1' WHERE `prueba`.`pkID` = 1;
UPDATE `prueba` SET `fkID_proyectoM` = '1' WHERE `prueba`.`pkID` = 2;
UPDATE `prueba` SET `fkID_proyectoM` = '1' WHERE `prueba`.`pkID` = 3;



ALTER TABLE `indicador` ADD `fkID_proyectoM` INT(11) NOT NULL AFTER `script`;

UPDATE `indicador` SET `fkID_proyectoM` = '1' WHERE `indicador`.`pkID` = 1;
UPDATE `indicador` SET `fkID_proyectoM` = '1' WHERE `indicador`.`pkID` = 2;
UPDATE `indicador` SET `fkID_proyectoM` = '1' WHERE `indicador`.`pkID` = 3;



ALTER TABLE `infraestructura` ADD `fkID_proyectoM` INT(11) NOT NULL AFTER `url_archivo`;

UPDATE `infraestructura` SET `fkID_proyectoM` = '1' WHERE `infraestructura`.`pkID` = 2;
UPDATE `infraestructura` SET `fkID_proyectoM` = '1' WHERE `infraestructura`.`pkID` = 3;
UPDATE `infraestructura` SET `fkID_proyectoM` = '1' WHERE `infraestructura`.`pkID` = 4;
UPDATE `infraestructura` SET `fkID_proyectoM` = '1' WHERE `infraestructura`.`pkID` = 5;
UPDATE `infraestructura` SET `fkID_proyectoM` = '1' WHERE `infraestructura`.`pkID` = 6;




create table asesor_proyectoM(
	pkID int(11) not null AUTO_INCREMENT,
    fkID_usuario int(11) not null,
    fkID_proyectoM int(11) not null,
    primary key(pkID)
);

INSERT INTO `asesor_proyectoM`(`pkID`, `fkID_usuario`, `fkID_proyectoM`) VALUES (null, 5, 1),(null, 6, 1);




ALTER TABLE `apropiacion_social` ADD `fkID_proyectoM` INT(11) NOT NULL AFTER `url_archivo`;

UPDATE `apropiacion_social` SET `fkID_proyectoM` = '1' WHERE `apropiacion_social`.`pkID` = 1;
UPDATE `apropiacion_social` SET `fkID_proyectoM` = '1' WHERE `apropiacion_social`.`pkID` = 2;
UPDATE `apropiacion_social` SET `fkID_proyectoM` = '1' WHERE `apropiacion_social`.`pkID` = 5;
UPDATE `apropiacion_social` SET `fkID_proyectoM` = '1' WHERE `apropiacion_social`.`pkID` = 7;



ALTER TABLE `institucion` ADD `fkID_proyectoM` INT(11) NOT NULL AFTER `codigo_dane`;

UPDATE `institucion` SET `fkID_proyectoM` = '1' WHERE `institucion`.`pkID` = 1;
UPDATE `institucion` SET `fkID_proyectoM` = '1' WHERE `institucion`.`pkID` = 3;
UPDATE `institucion` SET `fkID_proyectoM` = '1' WHERE `institucion`.`pkID` = 4;
UPDATE `institucion` SET `fkID_proyectoM` = '1' WHERE `institucion`.`pkID` = 5;
UPDATE `institucion` SET `fkID_proyectoM` = '1' WHERE `institucion`.`pkID` = 6;
UPDATE `institucion` SET `fkID_proyectoM` = '1' WHERE `institucion`.`pkID` = 7;
UPDATE `institucion` SET `fkID_proyectoM` = '1' WHERE `institucion`.`pkID` = 8;
UPDATE `institucion` SET `fkID_proyectoM` = '1' WHERE `institucion`.`pkID` = 9;

ALTER TABLE `institucion` DROP `fkID_proyectoM`;

create table institucion_proyectoM(
    pkID int(11) not null AUTO_INCREMENT,
    fkID_institucion int(11) not null,
    fkID_proyectoM int(11) not null,
    primary key(pkID)
);

INSERT INTO `institucion_proyectoM`(`pkID`, `fkID_institucion`, `fkID_proyectoM`) VALUES (null, 1, 1),
(null, 3, 1),(null, 4, 1),(null, 5, 1),(null, 6, 1),(null, 7, 1),(null, 8, 1),(null, 9, 1);



create table docente_proyectoM(
	pkID int(11) not null AUTO_INCREMENT,
    fkID_usuario int(11) not null,
    fkID_proyectoM int(11) not null,
	primary key(pkID)
);

INSERT INTO `docente_proyectoM`(`pkID`, `fkID_usuario`, `fkID_proyectoM`) VALUES (null, 3, 1),(null, 4, 1),(null, 15, 1),(null, 17, 1),(null, 18, 1),(null, 19, 1);




create table estudiante_proyectoM(
	pkID int(11) not null AUTO_INCREMENT,
    fkID_usuario int(11) not null,
    fkID_proyectoM int(11) not null,
    primary key(pkID)
);

INSERT INTO `estudiante_proyectoM`(`pkID`, `fkID_usuario`, `fkID_proyectoM`) VALUES (null, 9, 1),(null, 10, 1),(null, 13, 1);



create table cursosF_proyectoM(
	pkID int(11) not null AUTO_INCREMENT,
    fkID_cursosF int(11) not null,
    fkID_proyectoM int(11) not null,
    primary key(pkID)
);

INSERT INTO `cursosF_proyectoM`(`pkID`, `fkID_cursosF`, `fkID_proyectoM`) VALUES (null, 1, 1),(null, 3, 1),(null, 4, 1);



ALTER TABLE `grupo_formacion` ADD `fkID_proyectoM` INT(11) NOT NULL AFTER `url_archivo`;

UPDATE `grupo_formacion` SET `fkID_proyectoM` = '1' WHERE `grupo_formacion`.`pkID` = 1;
UPDATE `grupo_formacion` SET `fkID_proyectoM` = '1' WHERE `grupo_formacion`.`pkID` = 2;
UPDATE `grupo_formacion` SET `fkID_proyectoM` = '1' WHERE `grupo_formacion`.`pkID` = 3;



create table grupos_proyectoM(
	pkID int(11) not null AUTO_INCREMENT,
    fkID_grupo int(11) not null,
    fkID_proyectoM int(11) not null,
    primary key(pkID)
);

INSERT INTO `grupos_proyectoM`(`pkID`, `fkID_grupo`, `fkID_proyectoM`) VALUES (null, 1, 1),(null, 5, 1),(null, 6, 1),(null, 7, 1),(null, 8, 1);