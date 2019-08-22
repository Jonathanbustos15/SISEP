create table documentos_proyectoM(
	pkID int(11) not null AUTO_INCREMENT,
    nombre varchar(250) not null,
    url varchar(250) not null,
    fkID_proyectoM int(11) not null,
    primary key(pkID)
);




alter table apropiacion_social drop url_archivo;

create table documentos_apropiacionS(
	pkID int(11) not null AUTO_INCREMENT,
    nombre varchar(250) not null,
    url varchar(250) not null,
    fkID_apropiacionS int(11) not null,
    primary key(pkID)
);


create table documentos_actor(
	pkID int(11) not null AUTO_INCREMENT,
    nombre varchar(250) not null,
    url varchar(250) not null,
    fkID_actor int(11) not null,
    primary key(pkID)
);

ALTER TABLE `actor` DROP `url_archivo`;


create table documentos_prueba(
	pkID int(11) not null AUTO_INCREMENT,
    nombre varchar(250) not null,
    url varchar(250) not null,
    fkID_prueba int(11) not null,
    primary key(pkID)
);

ALTER TABLE `prueba` DROP `url_archivo`;


create table documentos_asesoria(
	pkID int(11) not null AUTO_INCREMENT,
    nombre varchar(250) not null,
    url varchar(250) not null,
    fkID_asesoria int(11) not null,
    primary key(pkID)
);

ALTER TABLE `asesoria` DROP `url_archivo`;

create table documentos_grupoF(
	pkID int(11) not null AUTO_INCREMENT,
    nombre varchar(250) not null,
    url varchar(250) not null,
    fkID_grupoF int(11) not null,
    primary key(pkID)
);

ALTER TABLE `grupo_formacion` DROP `url_archivo`;