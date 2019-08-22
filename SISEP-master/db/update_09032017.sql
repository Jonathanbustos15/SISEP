--Lista desplegable tipo_actor

UPDATE `tipo_actor` SET `nombre` = 'Regional' WHERE `tipo_actor`.`pkID` = 1;

UPDATE `tipo_actor` SET `nombre` = 'Nacional' WHERE `tipo_actor`.`pkID` = 2;

INSERT INTO `tipo_actor`(`pkID`, `nombre`) VALUES (null,'Internacional');


--Lista desplegable tipo_vinculación de un actor

UPDATE `tipo_vinculacion` SET `nombre` = 'Viculado' WHERE `tipo_vinculacion`.`pkID` = 1;

UPDATE `tipo_vinculacion` SET `nombre` = 'Sensibilizado' WHERE `tipo_vinculacion`.`pkID` = 2;


--Lista desplegable linea_investigación

UPDATE `linea_investigacion` SET `nombre` = 'Ciencias espaciales y terrestres.' WHERE `linea_investigacion`.`pkID` = 1;

UPDATE `linea_investigacion` SET `nombre` = 'Química y bioquímica.' WHERE `linea_investigacion`.`pkID` = 2;

INSERT INTO `linea_investigacion`(`pkID`, `nombre`, `descripcion`) VALUES (null,'Acercándonos a nuestros lenguajes.','nn'),
(null,'Matemáticas.','nn'),
(null,'Electrotecnia y energías para el futuro.','nn'),
(null,'Cultura ciudadana y emprendimientos.','nn'),
(null,'Biología, botánica, zoología, microbiología y biotecnología. ','nn'),
(null,'Ciencias sociales del comportamiento, educación y pedagogía.','nn'),
(null,'Haciendo seguridad, soberanía y autonomía alimentaria.','nn'),
(null,'Explorando los mundos infantiles.','nn'),
(null,'Socialización familiar y juvenil.','nn'),
(null,'Conocimientos y saberes culturales y ancestrales.','nn'),
(null,'Derecho y bienestar infantil y juvenil.','nn'),
(null,'Historia, memoria y tradición.','nn'),
(null,'Mundo estético y creación artística.','nn'),
(null,'Construir una cultura ambiental y del buen vivir.','nn'),
(null,'Ciencias de la computación, robótica, automatización, electrónica y sus aplicaciones.','nn');



--Lista desplegable tipo_proyecto

UPDATE `tipo_proyecto` SET `nombre` = 'Innovación' WHERE `tipo_proyecto`.`pkID` = 2;
UPDATE `tipo_proyecto` SET `nombre` = 'Innovación y Emprendimiento' WHERE `tipo_proyecto`.`pkID` = 3;


--LIsta desplegable tipo_apropiacion_social

UPDATE `tipo_apropiacion_social` SET `nombre` = 'Ferias de Ciencias' WHERE `tipo_apropiacion_social`.`pkID` = 1;
UPDATE `tipo_apropiacion_social` SET `nombre` = 'Feria Departamental de CTeI' WHERE `tipo_apropiacion_social`.`pkID` = 2;

INSERT INTO `tipo_apropiacion_social`(`pkID`, `nombre`) VALUES (null, 'Feria Nacional de CTeI'),
(null, 'Feria Internacional de CTeI'),
(null, 'Talleres de Innovación con TIC y Cultura Digital'),
(null, 'TEDx-Guainía'),
(null, 'Talleres de Ideación'),
(null, 'Start-Up Weekend '),
(null, 'Talleres de Modelo de Negocio'),
(null, 'Talleres de Biotecnología Básica'),
(null, 'Talleres de Microbiología Básica');