#modificacion de los valores de los estados del proyecto.

TRUNCATE TABLE `estado_proyecto`;

INSERT INTO `estado_proyecto` (`pkID`, `nombre`, `descripcion`) VALUES
(1, 'Creado', 'Creación del proyecto.'),
(2, 'Aprobado', 'Estado en el cual el proyecto cumplio con los requisitos necesarios'),
(3, 'Rechazado', 'Estado en el cual el proyecto no cumplio con los requisitos necesarios');

#--------------------------------
ALTER TABLE `proyecto` ADD `anio_creacion` YEAR(4) NOT NULL AFTER `nombre`;