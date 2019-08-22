<?php

/**/
include '../controller/muestra_pagina.php';

$muestra_grupo = new mostrar();

//---------------------------------------------------------
$pagina    = 'cont_detalles_microbiologia.php';
$scripts   = array('cont_detalles_microbiologia.js', 'cont_estudiantes.js', 'cont_album_microbiologia.js');
$id_modulo = 35;
//---------------------------------------------------------

$muestra_grupo->mostrar_pagina_scripts($pagina, $scripts, $id_modulo);
