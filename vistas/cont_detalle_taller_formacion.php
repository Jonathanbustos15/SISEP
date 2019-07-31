 <?php

//ini_set('error_reporting', E_ALL|E_STRICT);
//ini_set('display_errors', 1);

include '../controller/cambio_estado_grupo_invController.php';

include '../controller/saberes_propioscontroller.php';

include '../controller/tallerescontroller.php';

include '../controller/participantecontroller.php';

include '../controller/proyectoController.php';

include '../controller/docentesController.php';

include '../controller/estudiantesController.php';

include '../controller/grupoController.php';

include '../conexion/datos.php';

$cambia_estadoGInst = new cambio_estado_grupo_invController();

$arrPermisosEG = $cambia_estadoGInst->getPermisosModulo_Tipo(57, $_COOKIE[$NomCookiesApp . '_IDtipo']);

$creaEG = $arrPermisosEG[0]['crear'];

$docentesInst = new docentesController();

$arrPermisosD = $docentesInst->getPermisosModulo_Tipo(26, $_COOKIE[$NomCookiesApp . '_IDtipo']);

$creaD = $arrPermisosD[0]['crear'];

$tallerInst = new talleresController();

$arrPermisoss = $tallerInst->getPermisosModulo_Tipo(26, $_COOKIE[$NomCookiesApp . '_IDtipo']);

$creas = $arrPermisoss[0]['crear'];

$estudiantesInst = new estudiantesController();

$arrPermisoseg = $estudiantesInst->getPermisosModulo_Tipo(30, $_COOKIE[$NomCookiesApp . '_IDtipo']);

$creaeg = $arrPermisoseg[0]['crear'];

$rolEstudiante = $estudiantesInst->getRolEstudiante(); 

$re = $rolEstudiante[0]["pkID_rol"];

//print_r($re);

$detalles_grupoInst = new grupoController();

$arrPermisos = $detalles_grupoInst->getPermisosModulo_Tipo($id_modulo, $_COOKIE[$NomCookiesApp . '_IDtipo']);

$crea = $arrPermisos[0]['crear'];

$pkID_taller = $_GET["id_taller_formacion"];

$estado = $detalles_grupoInst->getEstadoGrupo($pkID_taller);

$estadoG = $estado[0]['fkID_estado'];

$proyectoInst = new proyectoController();

$arrPermisosp = $proyectoInst->getPermisosModulo_Tipo(32, $_COOKIE[$NomCookiesApp . '_IDtipo']);

$creap = $arrPermisosp[0]['crear'];

$tipo_user = $_COOKIE[$NomCookiesApp . '_IDtipo'];

//print_r($tipo_user);

//++++++++++++++++++++++++++++++

$grupoGen = $detalles_grupoInst->getGruposId($pkID_taller);

//variables grado
$pkID_grado = $grupoGen[0]["fkID_grado"];
$nom_grado  = $grupoGen[0]["nom_grado"];
//variables de institucion
$pkID_institucion = $grupoGen[0]["fkID_institucion"];
$nom_institucion  = $grupoGen[0]["nom_institucion"];
//------------------------------------------
$arrPermisosEstudiantes = $detalles_grupoInst->getPermisosModulo_Tipo(38, $_COOKIE[$NomCookiesApp . '_IDtipo']);
$creaEstudiante         = $arrPermisosEstudiantes[0]['crear'];

$participanteInst = new participanteController();

//+++++++++++++++++++++++++++++++
$arrPermisosDocentes = $detalles_grupoInst->getPermisosModulo_Tipo(39, $_COOKIE[$NomCookiesApp . '_IDtipo']);
$creaDocente         = $arrPermisosDocentes[0]['crear'];
//------------------------------------------

$numeroEstudiantes = $detalles_grupoInst->getNumEstudiantesGrupo(9, $pkID_taller, $pkID_grado);

$ne = $numeroEstudiantes[0]['num_estudiantes'];

$proyectoMGen = $detalles_grupoInst->getProyectosMarcoGrupo($pkID_taller);

$pkID_proyectoM = $proyectoMGen[0]["fkID_proyecto_marco"];

//echo date("Y-m-d");

//print_r($fecha);
//++++++++++++++++++++++++++++++++++
include 'form_asignacion_participante.php';
include 'form_participante.php';
include 'form_estudiantes.php';
include 'form_docentes.php';
include 'form_grupo_estudiante.php';
include 'form_grupo_docente.php';
include "form_proyecto.php";
include "form_modal_archivos.php";
include "form_album_taller.php";
include "form_sesiones.php";
include "frm_modal_proyectog.php";
//++++++++++++++++++++++++++++++++++/**/
?>

<div class="form-group " hidden>
    <div class="col-sm-10">
        <input type="text" class="form-control" id="grupo" name="grupo" value=<?php echo $pkID_taller; ?>>
    </div>
</div>

<div class="form-group " hidden>
    <div class="col-sm-10">
        <input type="text" class="form-control" id="estado" name="estado" value=<?php echo $estadoG; ?>>
    </div>
</div>

<div class="form-group " hidden>
    <div class="col-sm-10">
        <input type="text" class="form-control" id="fecha" name="fecha" value=<?php echo date("Y-m-d"); ?>>
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
      <input type="hidden" id="id_mod_page_proyecto" value=<?php echo $id_modulo ?>>

      <input type="hidden" id="id_mod_page_docente" value=<?php echo $id_modulo ?>>

      <input type="hidden" id="id_mod_page_estudiante" value=<?php echo $id_modulo ?>>

      <div class="col-lg-12">
          <h1 class="page-header titleprincipal"><img src="../img/botones/grupoonly.png"><?php echo  $proyectoMGen[0]["nombre_proyecto"] ?> - Taller Formación</h1>
      </div>
      <!-- /.col-lg-12 -->

    <div class="col-lg-12">
          <ol class="breadcrumb migadepan">
            <li><a href="proyecto_marco.php" class="migadepan">Inicio</a></li>
            <li><a href="principal.php?id_proyectoM=<?php echo $pkID_proyectoM; ?>" class="migadepan">Menú principal</a></li>
            <li><a href="academico.php?id_proyectoM=<?php echo $pkID_proyectoM; ?>" class="migadepan">Académico</a></li>
            <li><a href="apropiacion.php?id_proyectoM=<?php echo $pkID_proyectoM; ?>" class="migadepan">Apropiacion social</a></li> 
            <li><a href="taller_formacion.php?id_proyectoM=<?php echo $pkID_proyectoM; ?>" class="migadepan">Taller de formación</a></li>
            <li class="active migadepan">Detalle Talleres de Formación</li>
          </ol>
    </div>

  </div>
  <!-- /.row -->

  <div class="row">

      <div class="col-lg-12">

        <!-- Nav tabs -->
        <ul class="nav nav-tabs tabs-proc3" role="tablist">
	        <li id="li_general" role="presentation"><a href="#general" aria-controls="general" role="tab" data-toggle="tab">General</a></li>
	        <li id="li_general" role="presentation"><a href="#Sesiones" aria-controls="general" role="tab" data-toggle="tab">Sesiones</a></li>
          	<li id="li_general" role="presentation"><a href="#participantes" aria-controls="general" role="tab" data-toggle="tab">Participantes</a></li>
	        <li id="li_album" role="presentation"><a href="#album" aria-controls="general" role="tab" data-toggle="tab">Galeria</a></li>
	    </ul>

	    <div class="tab-content">

			<div role="tabpanel" class="tab-pane" id="general">
				<br>
				<!-- contenido general -->
				<div class="panel panel-default proc-pan-def3">

					<div class="panel-body">

						<div class="col-md-12">
							<!-- instanciFa php controller -->
							<?php $tallerInst->getDataTallerGen($pkID_taller);?>
						</div>
						<div class="col-md-12" hidden="true">
							<input type="text" id="grupo_id" value=<?php echo $pkID_taller; ?>>
							<input type="text" id="grado_grupo" value=<?php echo $pkID_grado; ?>>
							<input type="text" id="institucion_grupo" value=<?php echo $pkID_institucion; ?>>
						</div>
					</div>

				</div>
				<!-- /.contenido general -->

			</div>

			<div role="tabpanel" class="tab-pane" id="Sesiones">
				<br>
				<!-- contenido general -->
				<div class="panel panel-default proc-pan-def3">

					<div class="titulohead">

			            <div class="row">
			              <div class="col-md-6">
			                  <div class="titleprincipal"><h4>Sesiones del Taller</h4></div>
			              </div>
			              <div class="col-md-6 text-right">
			      			 <button id="btn_nuevosesion" type="button" class="btn btn-primary botonnewgrupo" data-toggle="modal"  data-taller="<?php echo $pkID_taller ?>" data-target="#frm_modal_sesion"><span class="glyphicon glyphicon-plus"></span> Crear Sesion</button>
			              </div>
			            </div>

		            </div>
		            <!-- /.panel-heading -->

					<div class="panel-body">

						<div class="col-md-12">
							<div class="dataTable_wrapper">
				              <table class="display table table-striped table-bordered table-hover" id="tbl_grupo_estudiante">
				                  <thead>
				                      <tr>
				                          <th>Fecha</th>
				                          <th>Descripción</th>
				                          <th>Lista de Asistencia</th>
				                          <th data-orderable="false">Opciones</th>
				                      </tr>
				                  </thead>

				                  <tbody>
				                      <?php
										$tallerInst->getTablasesiones($pkID_taller);
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

			<div role="tabpanel" class="tab-pane" id="participantes">
				<br>
				<!-- contenido general -->
				<div class="panel panel-default proc-pan-def3">

					<div class="titulohead">

			            <div class="row">
			              <div class="col-md-6">
			                  <div class="titleprincipal"><h4>Participantes</h4></div>
			              </div>
			              <div class="col-md-6 text-right">
			      			 <button id="btn_asignarparticipante" type="button" class="btn btn-primary botonnewgrupo" data-toggle="modal"  data-taller="<?php echo $pkID_taller ?>" data-target="#frm_modal_asignacion_participante"><span class="glyphicon glyphicon-plus"></span> Asignar Participante</button>
			              </div>
			            </div>

		            </div>
		            <!-- /.panel-heading -->

					<div class="panel-body">

						<div class="col-md-12">
							<div class="dataTable_wrapper">
				              <table class="display table table-striped table-bordered table-hover" id="tbl_grupo_estudiante">
				                  <thead>
				                      <tr>
				                          <th>Nombres</th>
				                          <th>Apellidos</th>
				                          <th>Documento</th>
				                          <th>Dirección</th>
				                          <th data-orderable="false">Opciones</th>
				                      </tr>
				                  </thead>

				                  <tbody>
				                      <?php
												$tallerInst->getTablaParticipantesTaller($pkID_taller);
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

			<div role="tabpanel" class="tab-pane" id="album">
				<br>
				<!-- contenido general -->

				<div class="panel panel-default proc-pan-def3">

					<div class="titulohead"> 

			            <div class="row">
			              <div class="col-md-6">
			                  <div class="titleprincipal"><h4>Galeria de Álbumes</h4></div>
			              </div>
			              <div class="col-md-6 text-right">
			      			 <button id="btn_album_taller" type="button" class="btn btn-primary botonnewgrupo" data-toggle="modal"  data-acompanamiento="<?php echo $pkID_taller ?>" data-target="#frm_modal_album_taller"><span class="glyphicon glyphicon-plus"></span> 
			      			 Crear album</button>  

			      			 <div class="form-group " hidden>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="pkID_grup" name="pkID_grup" value=<?php echo $pkID_acompanamiento; ?>>
                        </div>
                    </div>
			              </div>
			            </div>

		            </div>
		            <br><br>
		            <!-- /.panel-heading -->

					<div class="container-fluid">
						<div class="row">
							<?php
								$tallerInst->getSelectAlbumTaller($pkID_taller);
							?>

						
						</div>  
					</div>

				</div>

				<!-- /.contenido general -->

			</div>

	    </div>

      </div>
      <!-- /.col-lg-12 -->

    </div>
    <!-- /.row -->

</div>
<!-- /#page-wrapper -->