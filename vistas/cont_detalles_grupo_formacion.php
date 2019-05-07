<?php
	
	include('../controller/docentesController.php');
	
	include('../controller/grupo_formacionController.php');
	
	include('../conexion/datos.php');


	$docentesInst = new docentesController();
	
	$arrPermisosD = $docentesInst->getPermisosModulo_Tipo(26,$_COOKIE[$NomCookiesApp.'_IDtipo']);
	
	$creaD = $arrPermisosD[0]['crear'];

	
	$detalles_grupo_formacionInst = new grupo_formacionController();
	
	$arrPermisos = $detalles_grupo_formacionInst->getPermisosModulo_Tipo($id_modulo,$_COOKIE[$NomCookiesApp.'_IDtipo']);
	
	$crea = $arrPermisos[0]['crear'];

	$pkID_grupof = $_GET["id_grupof"];

	//print_r($id_modulo);



	$arrPermisosDocentes = $detalles_grupo_formacionInst->getPermisosModulo_Tipo(48,$_COOKIE[$NomCookiesApp.'_IDtipo']);
	$creaDocente = $arrPermisosDocentes[0]['crear'];


	$arrPermisosCapacitadores = $detalles_grupo_formacionInst->getPermisosModulo_Tipo(49,$_COOKIE[$NomCookiesApp.'_IDtipo']);
	$creaCapacitador = $arrPermisosCapacitadores[0]['crear'];



	$numeroCapacitadores = $detalles_grupo_formacionInst->getNumCapacitadoresesGrupoF(12, $pkID_grupof);

	$nc = $numeroCapacitadores[0]['num_capacitadores'];

	include('form_docentes.php');
	include('form_grupof_docentes.php');
	include('form_grupof_capacitadores.php');
	include("form_modal_archivos.php");
?>

<div class="form-group " hidden>                     
    <div class="col-sm-10">
        <input type="text" class="form-control" id="grupof" name="grupof" value=<?php echo $pkID_grupof; ?>>
    </div>
</div>

<div class="form-group " hidden>                     
    <div class="col-sm-10">
        <input type="text" class="form-control" id="modulo" name="modulo" value=<?php echo $id_modulo; ?>>
    </div>
</div>


<div id="page-wrapper" style="margin: 0px;">

	<div class="row">
		<!-- Campo que contiene el valor del id del modulo para auditoria con el nombre del modulo-->
      <input type="hidden" id="id_mod_page_docente" value=<?php echo $id_modulo ?>>
      
      <input type="hidden" id="id_mod_page_usuario" value=<?php echo $id_modulo ?>>

		<div class="col-lg-12">

			<h1 class="page-header titleprincipal"><img src="../img/botones/gruposformaciononly.png">Grupo de Formación</h1> 
		</div>        
		<!-- /.col-lg-12 -->

		<div class="col-lg-12">
			<ol class="breadcrumb migadepan">				
				<li><a class="migadepan" <?php echo 'href="detalles_proyectoM.php?id_proyectoM='.$detalles_grupo_formacionInst->getcpm().'&nom_proyectoM='.$detalles_grupo_formacionInst->getCookieNombreProyectoM().'"';?>>Proyecto Marco <?php echo $detalles_grupo_formacionInst->getCookieNombreProyectoM(); ?></a></li>
				<li><a class="migadepan" href="grupo_formacion.php">Grupos de Formación</a></li>
				<li class="active migadepan">Detalles Grupo de Formación</li>
			</ol>
		</div>

	</div>
	<!-- /.row -->

	<div class="row">    

		<div class="col-lg-12">

			<div role="tabpanel">

				<!-- Nav tabs -->
				<ul class="nav nav-tabs tabs-proc3" role="tablist">
					<li id="li_general" role="presentation"><a href="#general" aria-controls="general" role="tab" data-toggle="tab">General</a></li>
					<li id="li_docentes" role="presentation"><a href="#docentes" aria-controls="general" role="tab" data-toggle="tab">Docentes</a></li>
					<li id="li_capacitadores" role="presentation"><a href="#capacitadores" aria-controls="general" role="tab" data-toggle="tab">Capacitadores</a></li>	        
				</ul>

				<div class="tab-content">

					<div role="tabpanel" class="tab-pane" id="general">
						<br>
						<!-- contenido general -->
						<div class="panel panel-default proc-pan-def3">

							<div class="panel-body">

								<div class="col-md-12">									
									<?php $detalles_grupo_formacionInst->getDataGrupoFGen($pkID_grupof); ?>							
								</div>
							</div>

						</div>
						<!-- /.contenido general -->

					</div>

					<div role="tabpanel" class="tab-pane" id="docentes">
						<br>
						<!-- contenido general -->
						<div class="panel panel-default proc-pan-def3">

							<div class="titulohead">

								<div class="row">
									<div class="col-md-6">
										<div class="titleprincipal"><h4>Docentes Asignados</h4></div>
									</div>
									<div class="col-md-6 text-right">
										<button id="btn_nuevodocente" type="button" class="btn btn-primary botonnewgrupo" data-toggle="modal" data-target="#frm_modal_docente" <?php if ($creaDocente != 1){echo 'disabled="disabled"';} ?> ><span class="glyphicon glyphicon-plus"></span> Crear Docente</button>
									
										
										<button id="btn_nuevodocentegf" type="button" class="btn btn-primary botonnewgrupo" data-toggle="modal" data-target="#frm_modal_grupof_docente" <?php if ($creaDocente != 1){echo 'disabled="disabled"';} ?> ><span class="glyphicon glyphicon-plus"></span> Asignar Docente</button>
									</div>
								</div>

							</div>
							<!-- /.panel-heading -->

							<div class="panel-body">

								<div class="col-md-12">
									<div class="dataTable_wrapper">
										<table class="display table table-striped table-bordered table-hover" id="tbl_docenteS">
											<thead>
												<tr>				                          
													<th>Nombre</th>
													<th>Apellido</th>
													<th data-orderable="false">Opciones</th>                                               
												</tr>
											</thead>

											<tbody>
												<?php                          
													$detalles_grupo_formacionInst->getTablaGrupoFUsuarios(8,$pkID_grupof);                           
												?>
											</tbody>
										</table>
									</div>
								<!-- /.table-responsive -->					
								</div>				

							</div>

						</div>
						<!-- /.contenido general -->

					</div>


					<div role="tabpanel" class="tab-pane" id="capacitadores">
						<br>
						<!-- contenido general -->
						<div class="panel panel-default proc-pan-def3">

							<div class="titulohead">

								<div class="row">
									<div class="col-md-6">
										<div class="titleprincipal"><h4>Capacitador Asignado</h4></div>
									</div>
									<div class="col-md-6 text-right">
										<button id="btn_nuevocapacitador" type="button" class="btn btn-primary botonnewgrupo" data-toggle="modal" data-target="#frm_modal_grupof_capacitador" <?php if (($creaCapacitador != 1) || ($nc>=1)){echo 'disabled="disabled"';} ?> ><span class="glyphicon glyphicon-plus"></span> Asignar Capacitador</button>
									</div>
								</div>

							</div>
							<!-- /.panel-heading -->

							<div class="panel-body">

								<div class="col-md-12">
									<div class="dataTable_wrapper">
										<table class="display table table-striped table-bordered table-hover" id="tbl_grupof_docente">
											<thead>
												<tr>				                          
													<th>Nombre</th>
													<th>Apellido</th>
													<th data-orderable="false">Opciones</th>                                               
												</tr>
											</thead>

											<tbody>
												<?php                          
													$detalles_grupo_formacionInst->getTablaGrupoFUsuarios(12,$pkID_grupof);                           
												?>
											</tbody>
										</table>
									</div>
								<!-- /.table-responsive -->					
								</div>						

							</div>

						</div>
						<!-- /.contenido general -->
					</div>

				</div>
				<!-- /.tab-content -->
			</div>
			<!-- ./tabpanel -->

		</div>
		<!-- /.col-lg-12 -->

	</div>
	<!-- /.row -->

</div>
<!-- /#page-wrapper -->