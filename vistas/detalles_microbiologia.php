<?php

/**/
include '../controller/muestra_pagina.php';

$muestra_grupo = new mostrar();

//---------------------------------------------------------
$pagina    = 'cont_detalles_microbiologia.php';
$scripts   = array('test_validaPV3.js', 'cont_detalles_microbiologia.js');
$id_modulo = 35;
//---------------------------------------------------------

$muestra_grupo->mostrar_pagina_scripts($pagina, $scripts, $id_modulo);
