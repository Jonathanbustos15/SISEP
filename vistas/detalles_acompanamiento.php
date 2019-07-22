<?php

/**/
include '../controller/muestra_pagina.php';

$muestra_detalles_acompanamiento = new mostrar();

//---------------------------------------------------------
$pagina    = 'cont_detalles_acompanamiento.php';
$scripts   = array('test_validaPV3.js', 'helper_detalles_acompanamiento.js', 'cont_detalles_acompanamiento.js', 'helper_proyecto.js', 'cont_proyecto.js', 'cont_estudiantes.js', 'cont_docentes.js', 'cont_selectMunicipios.js', 'cont_albumacompanamientos.js', 'cont_proyecto_acompanamiento.js');
$id_modulo = 18;
//---------------------------------------------------------

$muestra_detalles_acompanamiento->mostrar_pagina_scripts($pagina, $scripts, $id_modulo);
