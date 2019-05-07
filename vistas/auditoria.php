<?php
	
	/**/
	include('../controller/muestra_pagina.php');
	
	$muestra_auditoria = new mostrar();
	
	//---------------------------------------------------------
	$pagina = 'cont_auditoria.php';
	$scripts = array('cont_auditoria.js');
	$id_modulo = 58;
	//---------------------------------------------------------
	
	$muestra_auditoria->mostrar_pagina_scripts($pagina,$scripts,$id_modulo);
?>
