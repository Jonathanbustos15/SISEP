<?php
	
	/**/
	include('../controller/muestra_pagina.php');
	
	$muestra_actor = new mostrar();
	
	//---------------------------------------------------------
	$pagina = 'cont_actor.php';
	$scripts = array( 'test_validaPV3.js', 'cont_actor.js', 'cont_institucion_selectsMunicipio.js');
	$id_modulo = 18;
	//---------------------------------------------------------
	
	$muestra_actor->mostrar_pagina_scripts($pagina,$scripts,$id_modulo);
?>