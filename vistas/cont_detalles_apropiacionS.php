<?php
	
	/**/
	
	include('../controller/apropiacion_socialController.php');
	
	include('../conexion/datos.php');
	
	$apropiacionSInst = new apropiacion_socialController();
	
	$arrPermisos = $apropiacionSInst->getPermisosModulo_Tipo($id_modulo,$_COOKIE[$NomCookiesApp.'_IDtipo']);
	
	$crea = $arrPermisos[0]['crear'];

	$pkID_apropiacionS = $_GET["id_apropiacionS"];

	$apropiacionSGen = $apropiacionSInst->getAproS($pkID_apropiacionS);
	
	//print_r($docentesInst->getDocentesId($_GET["id_docente"]));
?>

<div id="page-wrapper" style="margin: 0px;">

  <div class="row">

      <div class="col-lg-12">
          <h1 class="page-header titleprincipal"><img src="../img/botones/apropiacionsocialonly.png">Espacios de Apropiación Social</h1> 
      </div>        
      <!-- /.col-lg-12 -->

      <div class="col-lg-12">
          <ol class="breadcrumb migadepan">
          	<li><a class="migadepan" <?php echo 'href="detalles_proyectoM.php?id_proyectoM='.$apropiacionSInst->getcpm().'&nom_proyectoM='.$apropiacionSInst->getCookieNombreProyectoM().'"';?>>Proyecto Marco <?php echo $apropiacionSInst->getCookieNombreProyectoM(); ?></a></li>            
            <li><a href="apropiacion_social.php" class="migadepan">Espacios de Apropiación Social</a></li>
            <li class="active migadepan">Detalles Apropiación Social -- <?php echo $apropiacionSGen[0]["nombre"] ?> </li>
          </ol>
      </div>
      
  </div>
  <!-- /.row -->

  <div class="row">    
      
      <div class="col-lg-12">
        
        <!-- Nav tabs -->
        <ul class="nav nav-tabs tabs-proc3" role="tablist">
	        <li id="li_general" role="presentation"><a href="#general" aria-controls="general" role="tab" data-toggle="tab">General</a></li>
          	<!--<li id="li_preguntas" role="presentation"><a href="#preguntas" aria-controls="general" role="tab" data-toggle="tab">Preguntas</a></li>-->
          	<!--<li id="li_grados" role="presentation"><a href="#grados" aria-controls="general" role="tab" data-toggle="tab">Grados</a></li>
          	-->	        
	    </ul>

	    <div class="tab-content">

			<div role="tabpanel" class="tab-pane" id="general">
				<br>
				<!-- contenido general -->
				<div class="panel panel-default proc-pan-def3">

					<div class="panel-body">

						<div class="col-md-12">
							<!-- instancia php controller -->
							<?php $apropiacionSInst->getDataApropiacionSGen($pkID_apropiacionS); ?>							
						</div>						

					</div>

				</div>
				<!-- /.contenido general -->

			</div>

			<!-- ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++  -->
			<?php 
			//include("form_pregunta.php");
 			?>
			<!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++  -->

			<div role="tabpanel" class="tab-pane" id="preguntas">
				<br>
				<!-- contenido general -->
				<div class="panel panel-default proc-pan-def3">

				<div class="panel-heading">

            	 <div class="row">
              		<div class="col-md-6">
                  		Registro de Preguntas
              		</div>
              		<div class="col-md-6 text-right">
                 	<button id="btn_nuevoPregunta" type="button" class="btn btn-primary" data-toggle="modal" data-target="#frm_modal_pregunta" <?php if ($crea != 1){echo 'disabled="disabled"';} ?> >
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
				                          <th>Prueba</th>
				                          <th data-orderable="false">Opciones</th>                                               
				                      </tr>
				                  </thead>

				                  <tbody>
				                      <?php //$pruebaInst->getTablaPreguntasPrueba($pkID_prueba); ?>                     
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