##creacion de usuario tipo Estudiante_temp
INSERT INTO `tipo_usuario` (`pkID`, `nombre`) VALUES (15, 'Estudiante_temp');

##permisos  de rol
INSERT INTO `permisos` (`pkID`, `fkID_tipo_usuario`, `fkID_modulo`, `crear`, `editar`, `eliminar`, `consultar`) VALUES
(null, 15, 15, 0, 0, 0, 1),
(null, 15, 35, 0, 0, 0, 1),
(null, 15, 22, 0, 0, 0, 1),
(null, 15, 52, 0, 0, 0, 1);