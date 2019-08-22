<?php

/**/
include '../controller/muestra_pagina.php';

$muestra_grupo = new mostrar();

//---------------------------------------------------------
$pagina    = 'cont_resignificacion.php';
$scripts   = array('test_validaPV3.js', 'cont_detalles_resignificacion.js', 'cont_resignificacion.js', 'cont_filtro_anio.js');
$id_modulo = 19;
//---------------------------------------------------------

$muestra_grupo->mostrar_pagina_scripts($pagina, $scripts, $id_modulo);
