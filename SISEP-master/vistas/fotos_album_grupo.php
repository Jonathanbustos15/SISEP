<?php
	
	/**/
	include('../controller/muestra_pagina.php');
	
	$muestra_estudiantes = new mostrar();
	
	//---------------------------------------------------------
	$pagina = 'cont_fotos_album_grupo.php';
	$scripts = array('con_album_grupo.js');  
	$id_modulo = 42;
	//---------------------------------------------------------
	
	$muestra_estudiantes->mostrar_pagina_scripts($pagina,$scripts,$id_modulo);
?>   