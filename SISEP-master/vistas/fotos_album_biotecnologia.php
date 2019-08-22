<?php
	
	/**/
	include('../controller/muestra_pagina.php');
	
	$muestra_estudiantes = new mostrar();
	
	//---------------------------------------------------------
	$pagina = 'cont_fotos_album_biotecnologia.php';
	$scripts = array('cont_album_biotecnologia.js');   
	$id_modulo = 47; 
	//---------------------------------------------------------
	
	$muestra_estudiantes->mostrar_pagina_scripts($pagina,$scripts,$id_modulo);
?>