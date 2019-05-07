<?php
	
	/**/
	include('../controller/preguntas_bController.php');

	include('../controller/bitacoraController.php');

	include('../controller/UsuariosController.php');

	include('../conexion/datos.php');

	
	$bitacoraInst = new bitacoraController();
	
	$arrPermisos = $bitacoraInst->getPermisosModulo_Tipo($id_modulo,$_COOKIE[$NomCookiesApp.'_IDtipo']);
	
	$crea = $arrPermisos[0]['crear'];

	$pkID_bitacora = $_GET["id_bitacora"];

	$bitacoraGen = $bitacoraInst->getBitacoraId($pkID_bitacora);



	$preguntasbInst = new preguntas_bController();
	
	$arrPermisospb = $preguntasbInst->getPermisosModulo_Tipo(43,$_COOKIE[$NomCookiesApp.'_IDtipo']);
	
	$creapb = $arrPermisospb[0]['crear'];
	
	//print_r($docentesInst->getDocentesId($_GET["id_docente"]));

	$usuariosInst = new UsuariosController();
?>

<div id="page-wrapper" style="margin: 0px;">

  <div class="row">
  	<!-- Campo que contiene el valor del id del modulo para auditoria con el nombre del modulo-->
      <input type="hidden" id="id_mod_page_preguntab" value=<?php echo $id_modulo ?>>

      <div class="col-lg-12">
          <h1 class="page-header titleprincipal"><img src="../img/botones/bitacorasonly.png">Diario de Investigación</h1> 
      </div>        
      <!-- /.col-lg-12 -->

      <div class="col-lg-12">
          <ol class="breadcrumb migadepan">
            <li><a class="migadepan" <?php echo 'href="detalles_proyectoM.php?id_proyectoM='.$bitacoraInst->getcpm().'&nom_proyectoM='.$bitacoraInst->getCookieNombreProyectoM().'"';?>>Proyecto Marco <?php echo $bitacoraInst->getCookieNombreProyectoM(); ?></a></li>
            <li><a href="bitacora.php" class="migadepan">Diario de Investigación</a></li>
            <li class="active migadepan">Detalles Diario de Investigación -- <?php echo $bitacoraGen[0]["nombre"] ?> </li>
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
	    </ul>

	    <div class="tab-content">

			<div role="tabpanel" class="tab-pane" id="general">
				<br>
				<!-- contenido general -->
				<div class="panel panel-default proc-pan-def3">

					<div class="panel-body">

						<div class="col-md-12">
							<!-- instancia php controller -->
							<?php $bitacoraInst->getDataBitacoraGen($pkID_bitacora); ?>							
						</div>						

					</div>

				</div>
				<!-- /.contenido general -->

			</div>

			<!-- ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++  -->
			<?php 
				include("form_preguntab.php");
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
                 	<button id="btn_nuevoPreguntab" type="button" class="btn btn-primary botonnewgrupo" data-toggle="modal" data-target="#frm_modal_preguntab" <?php if ($creapb != 1){echo 'disabled="disabled"';} ?> >
                 	<span class="glyphicon glyphicon-plus"></span>Nueva Pregunta</button>  
              		</div>
            	 </div>

          		</div>

					<div class="panel-body">

						<div class="col-md-12">
							<div class="dataTable_wrapper">
				              <table class="display table table-striped table-bordered table-hover" id="tbl_preguntas_bitacora">
				                  <thead>
				                      <tr>				                          
				                          <th>Pregunta</th>
				                          <th>Tipo de Usuario</th>   
				                          <th>Estado</th>                       				  
				                          <th data-orderable="false">Opciones</th>                                               
				                      </tr>
				                  </thead>

				                  <tbody>
				                      <?php $preguntasbInst->getTablaPreguntasBitacora($pkID_bitacora);  ?>                     
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