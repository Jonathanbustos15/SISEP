<?php
	
	/**/
	include('../controller/muestra_pagina.php');
	
	$muestra_estudiantes = new mostrar();
	
	//---------------------------------------------------------
	$pagina = 'cont_fotos_album_tiex.php';
	$scripts = array('cont_album_tiex.js');   
	$id_modulo = 50; 
	//---------------------------------------------------------
	
	$muestra_estudiantes->mostrar_pagina_scripts($pagina,$scripts,$id_modulo);
?>