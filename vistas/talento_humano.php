<?php

/**/
include '../controller/muestra_pagina.php';
include '../controller/indexController.php';

$index = new indexController();

$index->unSetConstantProyectoM();

$muestra_proyecto_marco = new mostrar();

//---------------------------------------------------------
$pagina    = 'cont_talento_humano.php';
$scripts   = array('cont_talento_humano.js', 'cont_talento_humano_date.js');
$id_modulo = 15;
//---------------------------------------------------------

$muestra_proyecto_marco->mostrar_pagina_scripts($pagina, $scripts, $id_modulo);
