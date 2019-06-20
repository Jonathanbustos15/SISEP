<?php
	
	/**/
	include('../controller/muestra_pagina.php');
	
	$muestra_funcionario = new mostrar();
	
	//---------------------------------------------------------
	$pagina = 'cont_funcionario.php';
	$scripts = array('cont_funcionario.js'); 
	$id_modulo = 30;
	//---------------------------------------------------------
	
	$muestra_funcionario->mostrar_pagina_scripts($pagina,$scripts,$id_modulo);
?>