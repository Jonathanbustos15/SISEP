TRUNCATE TABLE `tipo_apropiacion_social`;

INSERT INTO `tipo_apropiacion_social`(`pkID`, `nombre`) VALUES (null, 'Tipo1'),(null, 'Tipo2');


create table nombre_apropiacionS(
	pkID int(11) not null AUTO_INCREMENT,
    nombre varchar(250) not null,
    primary key(pkID)
);

INSERT INTO `nombre_apropiacionS`(`pkID`, `nombre`) VALUES 
(null, 'Ferias de Ciencias'),
(null, 'Feria Departamental de CteI'),
(null, 'Feria Nacional de CteI'),
(null, 'Feria Internacional de CteI'),
(null, 'Talleres de Innovación con TIC y Cultura Digital'),
(null, 'TEDx-Guainía'),
(null, 'Talleres de Ideación'),
(null, 'Start-Up Weekend'),
(null, 'Talleres de Modelo de Negocio'),
(null, 'Talleres de Biotecnología Básica'),
(null,'Talleres de Microbiología Básica');


ALTER TABLE `apropiacion_social` CHANGE `nombre` `fkID_nombre` INT(11) NOT NULL;