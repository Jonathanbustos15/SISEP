create table asesoria(
    pkID int(11) not null AUTO_INCREMENT,
    fecha date not null,
    logros text not null,
    dificultades text not null,
    primary key(pkID)
);

alter table asesoria 
add fkID_proyecto int(11) not null after dificultades;


create table fase(
	pkID int(11) not null AUTO_INCREMENT,
    nombre varchar(250) not null,
    primary key(pkID)
);

INSERT INTO `fase`(`pkID`, `nombre`) VALUES (NULL , 'Estar en la Onda de Ondas'),
(NULL, 'Las perturbaciones de las Ondas'),
(NULL, 'La superposición de las Ondas'),
(NULL, 'El diseño de las trayectorias de indagación'),
(NULL, 'El recorrido de las trayectorias de indagación'),
(NULL, 'La reflexión de las Ondas'),
(NULL, 'La propagación de las Ondas'),
(NULL, 'La conformación de comunidades de conocimiento');


alter table proyecto 
add fkID_fase int(11) not null after fkID_grupo;



create table bitacora(
	pkID int(11) not null AUTO_INCREMENT,
	nombre varchar(250) not null,
    fecha_creacion date not null,
    fkID_fase int(11) not null,
    primary key(pkID)
);




create table preguntas_b(
	pkID int(11) not null AUTO_INCREMENT,
    pregunta text not null,
    fkID_bitacora int(11) not null,
    primary key(pkID)
);

create table respuestas_b(
	pkID int(11) not null AUTO_INCREMENT,
    respuesta text not null,
    fkID_pregunta int(11) not null,
    fkID_usuario int(11) not null,
    primary key(pkID)
);


alter table respuestas_b
add fkID_grupo int(11) null after fkID_usuario;


alter table bitacora
add evento boolean not null after fkID_fase;












