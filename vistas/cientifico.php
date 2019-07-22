<?php

/**/
//--------------------------------------------------------------------
include '../controller/indexController.php';
$setCookie = new indexController();
$setCookie->setConstantProyectoM($_GET["id_proyectoM"], $_GET["nom_proyectoM"]);
//--------------------------------------------------------------------
include '../controller/muestra_pagina.php';

$muestra_detalles_proyectoM = new mostrar();

//---------------------------------------------------------
$pagina    = 'cont_cientifico.php';
$scripts   = array('helper_proyectoM.js', 'cont_cientifico.js');
$id_modulo = 29;
//---------------------------------------------------------

$muestra_detalles_proyectoM->mostrar_pagina_scripts($pagina, $scripts, $id_modulo);
