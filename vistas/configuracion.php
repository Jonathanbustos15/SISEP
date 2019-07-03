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
$pagina    = 'cont_configuracion.php';
$scripts   = array('helper_proyectoM.js', 'cont_configuracion.js');
$id_modulo = 59;
//---------------------------------------------------------

$muestra_detalles_proyectoM->mostrar_pagina_scripts($pagina, $scripts, $id_modulo);
