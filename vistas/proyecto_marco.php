<?php

/**/
include '../controller/muestra_pagina.php';
include '../controller/indexController.php';

$index = new indexController();

$index->unSetConstantProyectoM();

$muestra_proyecto_marco = new mostrar();

//---------------------------------------------------------
$pagina    = 'cont_proyecto_marco.php';
$scripts   = array('cont_proyecto_marco.js', 'cont_proyecto_marco_date.js');
$id_modulo = 1;
//echo $id_modulo;
//---------------------------------------------------------

$muestra_proyecto_marco->mostrar_pagina_scripts($pagina, $scripts, $id_modulo);
