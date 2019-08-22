<?php

/**/
include '../controller/muestra_pagina.php';

$muestra_estudiantes = new mostrar();

//---------------------------------------------------------
$pagina    = 'cont_reportes.php';
$scripts   = array('cont_reportes.js');
$id_modulo = 40;
//---------------------------------------------------------

$muestra_estudiantes->mostrar_pagina_scripts($pagina, $scripts, $id_modulo);
