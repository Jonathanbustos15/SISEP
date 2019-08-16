<?php

/**/
include '../controller/muestra_pagina.php';

$muestra_estudiantes = new mostrar();

//---------------------------------------------------------
$pagina    = 'cont_repositorio.php';
$scripts   = array('cont_repositorio.js');
$id_modulo = 52;
//---------------------------------------------------------

$muestra_estudiantes->mostrar_pagina_scripts($pagina, $scripts, $id_modulo);

?>