 <?php
	
	/**/
	include('../controller/muestra_pagina.php');
	
	$muestra_funcionario = new mostrar();
	
	//---------------------------------------------------------
	$pagina = 'cont_participante.php';
	$scripts = array('cont_participante.js'); 
	$id_modulo = 30;
	//---------------------------------------------------------
	
	$muestra_funcionario->mostrar_pagina_scripts($pagina,$scripts,$id_modulo);
?>