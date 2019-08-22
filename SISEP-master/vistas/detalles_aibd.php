<?php

/**/
include '../controller/muestra_pagina.php';

$muestra_detalles_acompanamiento = new mostrar();

//---------------------------------------------------------
$pagina    = 'cont_detalles_aibd.php';
$scripts   = array('cont_detalles_aibd.js');
$id_modulo = 33;
//---------------------------------------------------------

$muestra_detalles_acompanamiento->mostrar_pagina_scripts($pagina, $scripts, $id_modulo);
