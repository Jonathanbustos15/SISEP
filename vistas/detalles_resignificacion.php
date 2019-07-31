<?php

/**/
include '../controller/muestra_pagina.php';

$muestra_detalles_resignificacion = new mostrar();

//---------------------------------------------------------
$pagina    = 'cont_detalles_resignificacion.php';
$scripts   = array('test_validaPV3.js', 'helper_detalles_resignificacion.js', 'cont_detalles_resignificacion.js', 'helper_proyecto.js', 'cont_proyecto.js', 'cont_estudiantes.js', 'cont_docentes.js', 'cont_selectMunicipios.js', 'cont_album_resignificacion.js', 'cont_proyecto_resignificacion.js');
$id_modulo = 20;     
//---------------------------------------------------------

$muestra_detalles_resignificacion->mostrar_pagina_scripts($pagina, $scripts, $id_modulo);
