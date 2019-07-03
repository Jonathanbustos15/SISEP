<?php
	
	/**/
	include('../controller/muestra_pagina.php');
	
	$muestra_detalles_grupo = new mostrar();
	
	//---------------------------------------------------------
	$pagina = 'cont_detalles_grupo.php';
	$scripts = array('test_validaPV3.js','helper_detalles_grupo.js','cont_detalles_grupo.js','helper_proyecto.js', 'cont_proyecto.js', 'cont_estudiantes.js', 'cont_docentes.js', 'cont_selectMunicipios.js','cont_albumgrupos.js','cont_proyecto_grupo.js');
	$id_modulo = 31;
	//---------------------------------------------------------
	
	$muestra_detalles_grupo->mostrar_pagina_scripts($pagina,$scripts,$id_modulo);
?>
