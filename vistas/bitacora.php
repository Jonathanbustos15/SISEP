<?php
	
	/**/
	include('../controller/muestra_pagina.php');
	
	$muestra_bitacora = new mostrar();
	
	//---------------------------------------------------------
	$pagina = 'cont_bitacora.php';
	$scripts = array('helper_bitacora_fase.js','cont_bitacora.js');
	$id_modulo = 41;
	//---------------------------------------------------------
	
	$muestra_bitacora->mostrar_pagina_scripts($pagina,$scripts,$id_modulo);
?>
