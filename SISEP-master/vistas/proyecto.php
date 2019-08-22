<?php

/**/
include '../controller/muestra_pagina.php';

$muestra_proyecto = new mostrar();

//---------------------------------------------------------
$pagina    = 'cont_proyecto.php';
$scripts   = array('cont_proyecto.js', 'helper_proyecto.js');
$id_modulo = 32;
//---------------------------------------------------------

$muestra_proyecto->mostrar_pagina_scripts($pagina, $scripts, $id_modulo);
