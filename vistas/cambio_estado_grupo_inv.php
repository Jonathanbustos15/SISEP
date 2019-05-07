<?php
	
	/**/
	include('../controller/muestra_pagina.php');
	
	$muestra_cambio_estado_grupo_inv = new mostrar();
	
	//---------------------------------------------------------
	$pagina = 'cont_cambio_estado_grupo_inv.php';
	$scripts = array('cont_cambio_estado_grupo_inv.js');
	$id_modulo = 57;
	//---------------------------------------------------------
	
	$muestra_cambio_estado_grupo_inv->mostrar_pagina_scripts($pagina,$scripts,$id_modulo);
?>
