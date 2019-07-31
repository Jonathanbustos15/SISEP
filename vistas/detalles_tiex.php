<?php

/**/
include '../controller/muestra_pagina.php';

$muestra_grupo = new mostrar();

//---------------------------------------------------------
$pagina    = 'cont_detalles_tiex.php';
$scripts   = array('cont_detalles_tiex.js', 'cont_estudiantes.js', 'cont_album_tiex.js');
$id_modulo = 31;
//---------------------------------------------------------

$muestra_grupo->mostrar_pagina_scripts($pagina, $scripts, $id_modulo);
