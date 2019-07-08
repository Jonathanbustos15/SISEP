<?php
	
	/**/
	include('../controller/muestra_pagina.php');
	
	$muestra_grupo = new mostrar();
	
	//---------------------------------------------------------
	$pagina = 'cont_saberes_propios.php';
	$scripts = array('test_validaPV3.js','cont_saberes_propios.js');
	$id_modulo = 25;
	//---------------------------------------------------------
	
	$muestra_grupo->mostrar_pagina_scripts($pagina,$scripts,$id_modulo);
?>