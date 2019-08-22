<?php
	
	/**/
	include('../controller/muestra_pagina.php');
	
	$muestra_estudiantes = new mostrar();
	
	//---------------------------------------------------------
	$pagina = 'cont_fotos_album_resignificacion.php';
	$scripts = array('cont_album_resignificacion.js');  
	$id_modulo = 44;
	//---------------------------------------------------------
	
	$muestra_estudiantes->mostrar_pagina_scripts($pagina,$scripts,$id_modulo);
?>