create table indicador(
	pkID int(11) AUTO_INCREMENT NOT NULL,
    nombre varchar(250) NOT NULL,
    descripcion text NOT NULL,
    tipo_indicador varchar(250) NOT NULL,
    script text NOT NULL,
    PRIMARY KEY(pkID)
);


INSERT INTO `indicador`(`pkID`, `nombre`, `descripcion`, `tipo_indicador`, `script`) VALUES (null, 'Número de niños(as) y jóvenes participantes en el proyecto.', 'prueba', 'Indicador de producto', 'script1');


create table tipo_indicador(
	pkID int(11) AUTO_INCREMENT NOT NULL,
    nombre varchar(250) NOT NULL,
    primary key(pkID)
);

INSERT INTO `tipo_indicador`(`pkID`, `nombre`) VALUES (null, 'Producto'), (null, 'Resultado'), (null, 'Impacto');


ALTER TABLE `indicador` CHANGE `tipo_indicador` `fkID_tipoI` INT(11) NOT NULL;

UPDATE `indicador` SET `fkID_tipoI` = '1' WHERE `indicador`.`pkID` = 1;

UPDATE `indicador` SET `fkID_tipoI` = '2' WHERE `indicador`.`pkID` = 2;

UPDATE `indicador` SET `fkID_tipoI` = '3' WHERE `indicador`.`pkID` = 3;


