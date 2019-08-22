<?php

/**/
include '../controller/muestra_pagina.php';

$muestra_asesoria = new mostrar();

//---------------------------------------------------------
$pagina    = 'cont_asesoria.php';
$scripts   = array('cont_asesoria.js');
$id_modulo = 40;
//---------------------------------------------------------

$muestra_asesoria->mostrar_pagina_scripts($pagina, $scripts, $id_modulo);
