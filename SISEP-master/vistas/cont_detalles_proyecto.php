<?php

/**/
include '../controller/grupoController.php';

include '../controller/proyectoController.php';

include '../controller/asesoriaController.php';

include '../controller/bitacoraController.php';

include '../conexion/datos.php';

$bitacoraInst = new bitacoraController();

$arrPermisosb = $bitacoraInst->getPermisosModulo_Tipo(41, $_COOKIE[$NomCookiesApp . '_IDtipo']);

$creab = $arrPermisosb[0]['crear'];

//----------------------------------------------------
$pkID_grupo = $_GET["id_grupo"];

if (!is_null($pkID_grupo)) {

    $grupoInst = new grupoController();
    $grupoGen  = $grupoInst->getGruposId($pkID_grupo);
}
//----------------------------------------------------

$asesoriaInst = new asesoriaController();

$arrPermisosa = $asesoriaInst->getPermisosModulo_Tipo(40, $_COOKIE[$NomCookiesApp . '_IDtipo']);

$creaa = $arrPermisosa[0]['crear'];

$proyectoInst = new proyectoController();

$arrPermisos = $proyectoInst->getPermisosModulo_Tipo($id_modulo, $_COOKIE[$NomCookiesApp . '_IDtipo']);

$crea = $arrPermisos[0]['crear'];

$pkID_proyecto = $_GET["id_proyecto"];

$proyectoGen = $proyectoInst->getProyectoId($pkID_proyecto);

$fasep = $bitacoraInst->getProyectoFase($pkID_proyecto);

$fase = $fasep[0]["fase"];

$nom_fase = $fasep[0]["nom_fase"];

//print_r($nom_fase);

//print_r($docentesInst->getDocentesId($_GET["id_docente"]));

include "form_modal_archivos.php";
?>

<div id="page-wrapper" style="margin: 0px;">

  <div class="row">

      <div class="col-lg-12">
          <h1 class="page-header titleprincipal">Proyectos</h1>
      </div>
      <!-- /.col-lg-12 -->

      <div class="col-lg-12">
          <ol class="breadcrumb migadepan">
            <li><a class="migadepan" <?php echo 'href="detalles_proyectoM.php?id_proyectoM=' . $proyectoInst->getcpm() . '&nom_proyectoM=' . $proyectoInst->getCookieNombreProyectoM() . '"'; ?>>Proyecto Marco <?php echo $proyectoInst->getCookieNombreProyectoM(); ?></a></li>
            <li <?php if ($pkID_grupo) {echo "style='display: none;'";}?> ><a class="migadepan" href="proyecto.php">Proyectos</a></li>
            <li <?php if (is_null($pkID_grupo)) {echo "style='display: none;'";}?> ><a class="migadepan" href="grupo.php">Grupos</a></li>
            <li <?php if (is_null($pkID_grupo)) {echo "style='display: none;'";}?> ><a class="migadepan" href=<?php echo "detalles_grupo.php?id_grupo=" . $_GET["id_grupo"] ?>>Detalles Grupo <?php echo $grupoGen[0]["nombre"] ?></a></li>
            <li class="active migadepan">Detalles Proyecto -- <?php echo $proyectoGen[0]["nombre"] ?> </li>
          </ol>
      </div>

  </div>
  <!-- /.row -->

  <div class="row">

      <div class="col-lg-12">

        <!-- Nav tabs -->
        <ul class="nav nav-tabs tabs-proc3" role="tablist">
	        <li id="li_general" role="presentation"><a href="#general" aria-controls="general" role="tab" data-toggle="tab">General</a></li>
          	<li id="li_asesorias" role="presentation"><a href="#asesorias" aria-controls="general" role="tab" data-toggle="tab">Asesorías</a></li>
          	<li id="li_bitacoras" role="presentation"><a href="#bitacoras" aria-controls="general" role="tab" data-toggle="tab">Diario de Investigación</a></li>
	    </ul>

	    <div class="tab-content">

			<div role="tabpanel" class="tab-pane" id="general">
				<br>
				<!-- contenido general -->
				<div class="panel panel-default proc-pan-def3">

					<div class="panel-body">

						<div class="col-md-12">
							<!-- instancia php controller -->
							<?php $proyectoInst->getDataProyectoGen($pkID_proyecto);?>
						</div>

					</div>

				</div>
				<!-- /.contenido general -->

			</div>

			<!-- ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++  -->
			<?php
include "form_asesoria.php";
?>
			<!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++  -->

			<div role="tabpanel" class="tab-pane" id="asesorias">
				<br>
				<!-- contenido general -->
				<div class="panel panel-default proc-pan-def3">

				<div class="titulohead">

            	 <div class="row">
              		<div class="col-md-6">
                  		<div class="titleprincipal"><h4>Registro de Asesorías</h4></div>
              		</div>
              		<div class="col-md-6 text-right">
                 	<button id="btn_nuevoasesoria" type="button" class="btn btn-primary botonnewgrupo" data-toggle="modal" data-target="#frm_modal_asesoria" <?php if ($creaa != 1) {echo 'disabled="disabled"';}?> >
                 	<span class="glyphicon glyphicon-plus"></span>Nueva asesoría</button>
              		</div>
            	 </div>

          		</div>

					<div class="panel-body">

						<div class="col-md-12">
							<div class="dataTable_wrapper">
				              <table class="display table table-striped table-bordered table-hover" id="tbl_asesoria">
				                  <thead>
				                      <tr>
				                          <th>Fecha de la Asesoria</th>
                          				  <th>Logros</th>
                          				  <th>Dificultades</th>
                          				  <th>Fase</th>
				                          <th data-orderable="false">Opciones</th>
				                      </tr>
				                  </thead>

				                  <tbody>
				                      <?php $asesoriaInst->getTablaAsesoriasProyecto($pkID_proyecto);?>
				                  </tbody>
				              </table>
					        </div>
					        <!-- /.table-responsive -->
						</div>

					</div>

				</div>
				<!-- /.contenido general -->

			</div>


			<!-- ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++  -->
			<?php
include "form_bitacora.php";
?>
			<!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++  -->

			<div role="tabpanel" class="tab-pane" id="bitacoras">
				<br>
				<!-- contenido general -->
				<div class="panel panel-default proc-pan-def3">

				<div class="titulohead">

            	 <div class="row">
              		<div class="col-md-6">
                  		<div class="titleprincipal"><h4>Diario de Investigación Fase: <?php echo $fasep[0]["fase"] . ". " . $fasep[0]["nom_fase"] ?></h4></div>
              		</div>
              		<div class="col-md-6 text-right">
                 		<!--<button id="btn_nuevobitacora" type="button" class="btn btn-primary" data-toggle="modal" data-target="#frm_modal_bitacora" <?php //if ($creab != 1){echo 'disabled="disabled"';} ?> >
                 		<span class="glyphicon glyphicon-plus"></span>Nueva bitácora</button> -->
              		</div>
            	 </div>

          		</div>

					<div class="panel-body">

						<div class="col-md-12">
							<div class="dataTable_wrapper">
				              <table class="display table table-striped table-bordered table-hover" id="tbl_bitacora">
				                  <thead>
				                      <tr>
				                          <th>Nombre</th>
                          				  <th>Fecha de Creación</th>
                          				  <th>Fase</th>
				                          <th data-orderable="false">Opciones</th>
				                      </tr>
				                  </thead>

				                  <tbody>

				                      <?php
if ($fase == null) {
    echo '<div class="alert alert-info">El proyecto no tiene una fase definida</div>';
} else {
    $bitacoraInst->getTablaBitacoraFase($fase);
    $bitacora = $bitacoraInst->getBitacoraIdFase($fase);
}
//print_r($bitacora); ?>
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

      </div>
      <!-- /.col-lg-12 -->

    </div>
    <!-- /.row -->

</div>
<!-- /#page-wrapper -->