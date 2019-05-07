<?php
	
	/**/
	
	include('../controller/infraestructuraController.php');
	
	include('../conexion/datos.php');
	
	$infraestructuraInst = new infraestructuraController();
	
	$arrPermisos = $infraestructuraInst->getPermisosModulo_Tipo($id_modulo,$_COOKIE[$NomCookiesApp.'_IDtipo']);
	
	$crea = $arrPermisos[0]['crear'];

	$pkID_infraestructura = $_GET["id_infraestructura"];

	$infraestructuraGen = $infraestructuraInst->getInfraestructuraId($pkID_infraestructura);
	
	//print_r($docentesInst->getDocentesId($_GET["id_docente"]));
?>

<div id="page-wrapper" style="margin: 0px;">

  <div class="row">

      <div class="col-lg-12">
          <h1 class="page-header titleprincipal">Infraestructuras</h1> 
      </div>        
      <!-- /.col-lg-12 -->

      <div class="col-lg-12">
          <ol class="breadcrumb migadepan">
            <li><a href="index.php" class="migadepan">Inicio</a></li>
            <li><a href="infraestructura.php" class="migadepan">Infraestructuras</a></li>
            <li class="active migadepan">Detalles Infraestructura-- <?php echo $infraestructuraGen[0]["nombre"] ?> </li>
          </ol>
      </div>
      
  </div>
  <!-- /.row -->

  <div class="row">    
      
      <div class="col-lg-12">
        
        <!-- Nav tabs -->
        <ul class="nav nav-tabs tabs-proc3" role="tablist">
	        <li id="li_general" role="presentation"><a href="#general" aria-controls="general" role="tab" data-toggle="tab">General</a></li>
          <!--	<li id="li_preguntas" role="presentation"><a href="#preguntas" aria-controls="general" role="tab" data-toggle="tab">Preguntas</a></li>-->
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
							<?php $infraestructuraInst->getDataInfraestructuraGen($pkID_infraestructura); ?>							
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
				                      <?php// $pruebaInst->getTablaPreguntasPrueba($pkID_prueba); ?>                     
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