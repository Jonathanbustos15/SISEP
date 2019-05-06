ALTER TABLE `indicador` CHANGE `descripcion` `descripcion` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL;


ALTER TABLE `sede` CHANGE `fkID_tipo_escuela` `fkID_tipo` INT(11) NOT NULL;

DROP TABLE `tipo_escuela`;


create table tipo(
	pkID int(11) not null AUTO_INCREMENT,
    nombre varchar(250) not null,
    primary key(pkID)
);

INSERT INTO `tipo`(`pkID`, `nombre`) VALUES (null, 'Principal'), (null, 'Sede');




UPDATE `sede` SET `fkID_tipo` = '2' WHERE `sede`.`pkID` = 6;


ALTER TABLE `infraestructura` ADD `fkID_sede` INT(11) NOT NULL AFTER `url_archivo`;

UPDATE `infraestructura` SET `fkID_sede` = '4' WHERE `infraestructura`.`pkID` = 2;

UPDATE `infraestructura` SET `fkID_sede` = '5' WHERE `infraestructura`.`pkID` = 3;

UPDATE `infraestructura` SET `fkID_sede` = '6' WHERE `infraestructura`.`pkID` = 4;

UPDATE `infraestructura` SET `fkID_sede` = '4' WHERE `infraestructura`.`pkID` = 5;

UPDATE `infraestructura` SET `fkID_sede` = '6' WHERE `infraestructura`.`pkID` = 6;


ALTER TABLE `infraestructura` ADD `fecha_entrega` DATE NOT NULL AFTER `descripcion`;



create table documentos_infraestructura(
	pkID int(11) not null AUTO_INCREMENT,
    nombre varchar(250) not null,
    url varchar(250) not null,
    fkID_infraestructura int(11) not null,
    primary key(pkID)
);

INSERT INTO `documentos_infraestructura`(`pkID`, `nombre`, `url`, `fkID_infraestructura`) VALUES (null, 'doc1', 'url1', 2), (null, 'doc2', 'url2', 4), (null, 'doc3', 'url3', 5);


ALTER TABLE `infraestructura` DROP `url_archivo`;



ALTER TABLE `actor` ADD `apellido` VARCHAR(250) NOT NULL AFTER `nombre`;
ALTER TABLE `actor` ADD `telefono` VARCHAR(250) NOT NULL AFTER `apellido`;
ALTER TABLE `actor` ADD `email` VARCHAR(250) NOT NULL AFTER `telefono`;
ALTER TABLE `actor` ADD `direccion` VARCHAR(250) NOT NULL AFTER `email`;
ALTER TABLE `actor` ADD `departamento` VARCHAR(250) NOT NULL AFTER `direccion`;
ALTER TABLE `actor` ADD `municipio` VARCHAR(250) NOT NULL AFTER `departamento`;
ALTER TABLE `actor` ADD `cargo` VARCHAR(250) NOT NULL AFTER `municipio`;
ALTER TABLE `actor` ADD `descripcion` VARCHAR(250) NOT NULL AFTER `apellido`;
ALTER TABLE `actor` ADD `url_archivo` VARCHAR(250) NOT NULL AFTER `cargo`;

ALTER TABLE `actor` CHANGE `url_archivo` `url_archivo` VARCHAR(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL AFTER `fkID_proyectoM`;



ALTER TABLE `asesoria` ADD `url_archivo` VARCHAR(250) NULL AFTER `fkID_proyecto`;

ALTER TABLE `proyecto_marco` ADD `url_archivo` VARCHAR(250) NULL AFTER `supervisor`;






