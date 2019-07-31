<?php
	
	/**/
	include('../controller/muestra_pagina.php');
	
	$muestra_detalles_grupo = new mostrar();
	
	//---------------------------------------------------------
	$pagina = 'cont_detalle_feria.php';
	$scripts = array('test_validaPV3.js','helper_detalles_grupo.js','cont_detalles_grupo.js','helper_proyecto.js', 'cont_detalle_feria.js','cont_album_feria.js','cont_participante.js');
	$id_modulo = 28;
	//---------------------------------------------------------
	
	$muestra_detalles_grupo->mostrar_pagina_scripts($pagina,$scripts,$id_modulo);
?>