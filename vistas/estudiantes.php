<?php
	
	/**/
	include('../controller/muestra_pagina.php');
	
	$muestra_estudiantes = new mostrar();
	
	//---------------------------------------------------------
	$pagina = 'cont_estudiantes.php';
	$scripts = array('cont_estudiantes.js'); 
	$id_modulo = 6;
	//---------------------------------------------------------
	
	$muestra_estudiantes->mostrar_pagina_scripts($pagina,$scripts,$id_modulo);
?>
