
##agrega campo edad a la tabla usuarios
ALTER TABLE `usuarios` ADD `edad` INT NULL AFTER `fecha_nacimiento`;

TRUNCATE TABLE materia;

INSERT INTO `materia`(`pkID`, `nombre`) VALUES (null, 'Ciencias naturales'),
 (null,'Biología'),
 (null, 'Química'),
 (null, 'Física'),
 (null, 'Historia'),
 (null, 'Ciencias sociales'),
 (null, 'Geografía'),
 (null, 'Ciencias económicas y políticas'),
 (null, 'Historia Geografía'),
 (null, 'Democracia'),
 (null, 'Educación Ética y en Valores'),
 (null, 'Educación Religiosa'),
 (null, 'Filosofía'),
 (null, 'Educación Artística'),
 (null, 'Dibujo'),
 (null, 'Artes Escénicas'),
 (null, 'Música'),
 (null, 'Danzas'),
 (null, 'Educación Física'),
 (null, 'Lengua Castellana'),
 (null, 'Ingles'),
 (null, 'Francés'),
 (null, 'Matemáticas'),
 (null, 'Cálculo'),
 (null, 'Geometría'),
 (null, 'Estadística'),
 (null, 'Trigonometría'),
 (null, 'Tecnología e informática');

