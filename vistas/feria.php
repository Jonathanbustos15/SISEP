<?php
	
	/**/
	include('../controller/muestra_pagina.php');
	
	$muestra_grupo = new mostrar();
	
	//---------------------------------------------------------
	$pagina = 'cont_feria.php';
	$scripts = array('test_validaPV3.js','cont_feria.js');
	$id_modulo = 27;
	//---------------------------------------------------------
	
	$muestra_grupo->mostrar_pagina_scripts($pagina,$scripts,$id_modulo);
?>