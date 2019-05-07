<?php
	include_once('UsuariosController.php');
	//UsuariosController::AutenticarUsuario();
	//----------------------------------------------------
	//cambio de ejecucion de metodo instanciando
	//la clase ya que static deshabilita la variable $this
	//----------------------------------------------------
	$usuarios = new UsuariosController();
	$usuarios->AutenticarUsuario();
 ?>