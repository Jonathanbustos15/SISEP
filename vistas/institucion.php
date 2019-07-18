<?php
	
	/**/
	include('../controller/muestra_pagina.php');
	
	$muestra_institucion = new mostrar();
	
	//---------------------------------------------------------
	$pagina = 'cont_institucion.php';
	$scripts = array('cont_institucion.js', 'cont_institucion_selectsMunicipio.js');
	$id_modulo = 4;
	//---------------------------------------------------------
	
	$muestra_institucion->mostrar_pagina_scripts($pagina,$scripts,$id_modulo);
?>
