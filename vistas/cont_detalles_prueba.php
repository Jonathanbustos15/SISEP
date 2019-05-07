<?php

/**/
include '../controller/pregunta_pController.php';

include '../controller/pruebaController.php';

include '../controller/UsuariosController.php';

include '../conexion/datos.php';

$preguntapInst = new pregunta_pController();

$arrPermisospp = $preguntapInst->getPermisosModulo_Tipo(24, $_COOKIE[$NomCookiesApp . '_IDtipo']);

$creapp = $arrPermisospp[0]['crear'];

$pruebaInst = new pruebaController();

$usuariosInst = new UsuariosController();

$arrPermisos = $pruebaInst->getPermisosModulo_Tipo($id_modulo, $_COOKIE[$NomCookiesApp . '_IDtipo']);

$crea = $arrPermisos[0]['crear'];

$pkID_prueba = $_GET["id_prueba"];

$pruebaGen = $pruebaInst->getPruebaId($pkID_prueba);

//print_r($pruebaGen);
?>

<div id="page-wrapper" style="margin: 0px;">

  <div class="row">
  	<!-- Campo que contiene el valor del id del modulo para auditoria con el nombre del modulo-->
      <input type="hidden" id="id_mod_page_preguntap" value=<?php echo $id_modulo ?>>


      <div class="col-lg-12">
          <h1 class="page-header titleprincipal"><img src="../img/botones/pruebasonly.png">Pruebas</h1>
      </div>
      <!-- /.col-lg-12 -->

      <div class="col-lg-12">
          <ol class="breadcrumb migadepan">
            <li><a class="migadepan" <?php echo 'href="detalles_proyectoM.php?id_proyectoM=' . $pruebaInst->getcpm() . '&nom_proyectoM=' . $pruebaInst->getCookieNombreProyectoM() . '"'; ?>>Proyecto Marco <?php echo $pruebaInst->getCookieNombreProyectoM(); ?></a></li>
            <li><a href="prueba.php" class="migadepan">Pruebas</a></li>
            <li class="active migadepan">Detalles Prueba -- <?php echo $pruebaGen[0]["nombre"]; ?> </li>
          </ol>
      </div>

  </div>
  <!-- /.row -->

  <div class="row">

      <div class="col-lg-12">

        <!-- Nav tabs -->
        <ul class="nav nav-tabs tabs-proc3" role="tablist">
	        <li id="li_general" role="presentation"><a href="#general" aria-controls="general" role="tab" data-toggle="tab">General</a></li>
          	<li id="li_preguntas" role="presentation"><a href="#preguntas" aria-controls="general" role="tab" data-toggle="tab">Preguntas</a></li>
          	<li id="li_resultados" role="presentation"><a href="#resultados" aria-controls="general" role="tab" data-toggle="tab">Resultados</a></li>
	    </ul>

	    <div class="tab-content">

			<div role="tabpanel" class="tab-pane" id="general">
				<br>
				<!-- contenido general -->
				<div class="panel panel-default proc-pan-def3">

					<div class="panel-body">

						<div class="col-md-12">
							<!-- instancia php controller -->
							<?php $pruebaInst->getDataPruebaGen($pkID_prueba);?>
						</div>

					</div>

				</div>
				<!-- /.contenido general -->

			</div>

			<!-- ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++  -->
			<?php
include "form_preguntap.php";
?>
			<!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++  -->

			<div role="tabpanel" class="tab-pane" id="preguntas">
				<br>
				<!-- contenido general -->
				<div class="panel panel-default proc-pan-def3">

				<div class="titulohead">

            	 <div class="row">
              		<div class="col-md-6">
                  		<div class="titleprincipal"><h4>Registro de Preguntas</h4></div>
              		</div>
              		<div class="col-md-6 text-right">
                 	<button id="btn_nuevoPreguntap" type="button" class="btn btn-primary botonnewgrupo" data-toggle="modal" data-target="#frm_modal_preguntap" <?php if ($creapp != 1) {echo 'disabled="disabled"';}?> data-num-pregunta = <?php echo $pruebaInst->getCantPreguntas($pkID_prueba); ?> >
                 	<span class="glyphicon glyphicon-plus"></span>Nueva pregunta</button>
              		</div>
            	 </div>

          		</div>

					<div class="panel-body">

						<div class="col-md-12">
							<div class="dataTable_wrapper">
				              <table class="display table table-striped table-bordered table-hover" id="tbl_preguntas_prueba">
				                  <thead>
				                      <tr>
				                          <th>Nombre</th>
				                          <th>Tipo de Pregunta</th>
				                          <!--<th>Prueba</th>-->
				                          <th data-orderable="false">Opciones</th>
				                      </tr>
				                  </thead>

				                  <tbody>
				                      <?php $pruebaInst->getTablaPreguntasPrueba($pkID_prueba);?>
				                  </tbody>
				              </table>
					        </div>
					        <!-- /.table-responsive -->
						</div>

					</div>

				</div>
				<!-- /.contenido general -->

			</div>

			<?php
$id_modulo_resultados   = 57;
$arrPermisos_resultados = $pruebaInst->getPermisosModulo_Tipo($id_modulo_resultados, $_COOKIE[$NomCookiesApp . '_IDtipo']);
$consultar_resultados   = $arrPermisos_resultados[0]['consultar'];
//print_r($arrPermisos_resultados);
?>

			<div role="tabpanel" class="tab-pane" id="resultados">
				<br>
				<!-- contenido general -->
				<div class="panel panel-default proc-pan-def3">

					<div class="panel-body">

						<div class="col-md-12">
							<h3>Generar Resultados</h3>
							<hr>
							<h4>General</h4>
								<!-- resultados de la prueba -->
								<a target="_blank" class="btn btn-primary" <?php echo "href='../controller/reporte_prueba.php?id_prueba=" . $_GET["id_prueba"] . "&id_usuario='"; ?> ><span class="glyphicon glyphicon-import"></span> Generar Resultados Excel</a>
								<a target="_blank" class="btn btn-primary" <?php echo "href='../controller/reporte_prueba_fpdf.php?id_prueba=" . $_GET["id_prueba"] . "&id_usuario='"; ?> ><span class="glyphicon glyphicon-import"></span> Generar Resultados PDF</a>
							<hr>
							<h4>Por Usuario</h4>

							<div class="dataTable_wrapper">
					              <table class="display table table-striped table-bordered table-hover" id="tbl_asesoria">
					                  <thead>
					                      <tr>
					                          <th>Documento</th>
					                          <th>Nombre</th>
					                          <th>Apellido</th>
					                          <th data-orderable="false">Generar Resultados</th>
					                      </tr>
					                  </thead>

					                  <tbody>
					                      <?php
$pruebaInst->resTableUsersPrueba($_GET["id_prueba"]);
?>
					                  </tbody>
					              </table>
					          </div>

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