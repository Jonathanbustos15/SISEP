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
$pagina    = 'cont_apropiacion.php';
$scripts   = array('helper_proyectoM.js', 'cont_apropiacion.js');
$id_modulo = 21;//---------------------------------------------------------

$muestra_detalles_proyectoM->mostrar_pagina_scripts($pagina, $scripts, $id_modulo);
