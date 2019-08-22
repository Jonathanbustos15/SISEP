ALTER TABLE `grupo` ADD `fkID_estado` INT(11) NOT NULL AFTER `fecha_creacion`;


create table estado_grupo_inv(
	pkID int(11) not null AUTO_INCREMENT,
    nombre varchar(250) not null,
    primary key(pkID)
);


INSERT INTO `estado_grupo_inv`(`pkID`, `nombre`) VALUES (null, 'Activo'),(null, 'Inactivo')



create table cambio_estado_grupo_inv(
 pkID int(11) not null AUTO_INCREMENT,
 fecha date not null,
 fkID_estado int(11) not null,
 fkID_grupo int(11) not null,
 primary key(pkID) 
 );



create table estado_pregunta_bitacora(
	pkID int(11) not null AUTO_INCREMENT,
    nombre varchar(250) not null,
    primary key(pkID)
);

INSERT INTO `estado_pregunta_bitacora`(`pkID`, `nombre`) VALUES (NULL, 'Activo'),(NULL, 'Inactivo')


ALTER TABLE `preguntas_b` ADD `fkID_estado` INT(11) NOT NULL AFTER `fkID_tipo_usuario`;