<?php

/**/
include '../controller/muestra_pagina.php';

$muestra_grupo = new mostrar();

//---------------------------------------------------------
$pagina    = 'cont_aibd.php';
$scripts   = array('test_validaPV3.js', 'cont_detalles_aibd.js', 'cont_aibd.js');
$id_modulo = 32;
//---------------------------------------------------------

$muestra_grupo->mostrar_pagina_scripts($pagina, $scripts, $id_modulo);
