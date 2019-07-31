<?php

/**/
include '../controller/muestra_pagina.php';

$muestra_estudiantes = new mostrar();

//---------------------------------------------------------
$pagina    = 'cont_graficos.php';
$scripts   = array('cont_graficos.js');
$id_modulo = 40;
//---------------------------------------------------------

$muestra_estudiantes->mostrar_pagina_scripts($pagina, $scripts, $id_modulo);
