<?php
	
	/**/
	include('../controller/muestra_pagina.php');
	
	$muestra_docentes = new mostrar();
	
	//---------------------------------------------------------
	$pagina = 'cont_docentes.php';
	$scripts = array('cont_docentes.js');
	$id_modulo = 26;
	//---------------------------------------------------------
	
	$muestra_docentes->mostrar_pagina_scripts($pagina,$scripts,$id_modulo);
?>
