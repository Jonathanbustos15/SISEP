<?php

/**/
include '../controller/muestra_pagina.php';

$muestra_estudiantes = new mostrar();

//---------------------------------------------------------
$pagina    = 'cont_financiero.php';
$scripts   = array('cont_financiero.js');
$id_modulo = 51;
//---------------------------------------------------------

$muestra_estudiantes->mostrar_pagina_scripts($pagina, $scripts, $id_modulo);