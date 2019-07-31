<?php

/**/
include '../controller/muestra_pagina.php';

$muestra_grupo = new mostrar();

//---------------------------------------------------------
$pagina    = 'cont_detalles_biotecnologia.php';
$scripts   = array('cont_detalles_biotecnologia.js', 'cont_estudiantes.js', 'cont_album_biotecnologia.js');
$id_modulo = 37;
//---------------------------------------------------------

$muestra_grupo->mostrar_pagina_scripts($pagina, $scripts, $id_modulo);
