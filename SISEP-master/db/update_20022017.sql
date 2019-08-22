create table meta(
	pkID int(11) not null AUTO_INCREMENT,
    nombre varchar(250) not null,
    total int(11) not null,
    fecha_ini date not null,
    fecha_fin date not null,
    primary key (pkID)
);

INSERT INTO `meta`(`pkID`, `nombre`, `total`, `fecha_ini`, `fecha_fin`) VALUES (null,'meta1',200,'2017-02-01','2018-02-01')


create table valores_meta(
	pkID int(11) not null AUTO_INCREMENT,
    nombre varchar(250) not null,
    valor int(11) not null,
    fecha_ini date not null,
    fecha_fin date not null,
    primary key(pkID)
);

INSERT INTO `valores_meta`(`pkID`, `nombre`, `valor`, `fecha_ini`, `fecha_fin`) VALUES (null, 'valor1', 159, '2016-03-01', '2017-03-02')


create table meta_valor(
	pkID int(11) not null AUTO_INCREMENT,
    fkID_meta int(11) not null,
    fkID_valor_meta int(11) not null,
    primary key(pkID)
);


ALTER TABLE `indicador` ADD `fkID_meta` INT(11) NOT NULL AFTER `fkID_proyectoM`;
ALTER TABLE `indicador` CHANGE `fkID_meta` `fkID_meta` INT(11) NULL;


UPDATE `indicador` SET `fkID_meta` = '1' WHERE `indicador`.`pkID` = 1;
UPDATE `indicador` SET `descripcion` = 'Este indicador muestra el número de estudiantes participantes del proyecto a través de grupos de investigación e innovación.' WHERE `indicador`.`pkID` = 1;
