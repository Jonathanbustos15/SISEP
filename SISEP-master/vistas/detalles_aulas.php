<?php

/**/
include '../controller/muestra_pagina.php';

$muestra_detalles_aulas = new mostrar();

//---------------------------------------------------------
$pagina    = 'cont_detalles_aulas.php';
$scripts   = array('cont_detalles_aulas.js', 'cont_album_aula.js');
$id_modulo = 39;
//---------------------------------------------------------

$muestra_detalles_aulas->mostrar_pagina_scripts($pagina, $scripts, $id_modulo);
