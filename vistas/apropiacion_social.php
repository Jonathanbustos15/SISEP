<?php
	
	/**/
	include('../controller/muestra_pagina.php');
	
	$muestra_apropiacion_social = new mostrar();
	
	//---------------------------------------------------------
	$pagina = 'cont_apropiacion_social.php';
	$scripts = array('cont_lugar_apropiacion.js', 'cont_tematica.js', 'cont_apropiacion_social.js', 'test_validaPV3.js');
	$id_modulo = 19;
	//---------------------------------------------------------
	
	$muestra_apropiacion_social->mostrar_pagina_scripts($pagina,$scripts,$id_modulo);
?>