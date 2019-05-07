<?php

//ini_set('error_reporting', E_ALL|E_STRICT);
  //  ini_set('display_errors', 1);

		
	include('../controller/indicadorController.php');

	include('../controller/metaController.php');

	include('../controller/valores_metaController.php');
	
	include('../conexion/datos.php');


	$valores_metaInst = new valores_metaController();

	$arrPermisosvm = $valores_metaInst->getPermisosModulo_Tipo(56, $_COOKIE[$NomCookiesApp.'_IDtipo']);

	$creavm = $arrPermisosvm[0]['crear'];





	$metaInst = new metaController();
	
	$arrPermisosm = $metaInst->getPermisosModulo_Tipo(55,$_COOKIE[$NomCookiesApp.'_IDtipo']);
	
	$cream = $arrPermisosm[0]['crear'];
	


	
	$indicadorInst = new indicadorController();
	
	$arrPermisos = $indicadorInst->getPermisosModulo_Tipo($id_modulo,$_COOKIE[$NomCookiesApp.'_IDtipo']);
	
	$crea = $arrPermisos[0]['crear'];

	$pkID_indicador = $_GET["id_indicador"];

	$indicadorGen = $indicadorInst->getIndicadorId($pkID_indicador);

	$meta = $indicadorGen[0]["fkID_meta"];
	
//	print_r($meta);
 
	       
?>

<div class="form-group " hidden>                     
    <div class="col-sm-10">
        <input type="text" class="form-control" id="meta" name="meta" value=<?php echo $meta; ?>>
    </div>
</div>

<div id="page-wrapper" style="margin: 0px;">

  <div class="row">
  	<!-- Campo que contiene el valor del id del modulo para auditoria con el nombre del modulo-->
      <input type="hidden" id="id_mod_page_meta" value=<?php echo $id_modulo ?>>

       <input type="hidden" id="id_mod_page_valoresM" value=<?php echo $id_modulo ?>>

      <div class="col-lg-12">
          <h1 class="page-header titleprincipal"><img src="../img/botones/indicadoresonly.png">Indicadores</h1> 
      </div>        
      <!-- /.col-lg-12 -->

      <div class="col-lg-12">
          <ol class="breadcrumb migadepan">
          	<li><a class="migadepan" <?php echo 'href="detalles_proyectoM.php?id_proyectoM='.$indicadorInst->getcpm().'&nom_proyectoM='.$indicadorInst->getCookieNombreProyectoM().'"';?>>Proyecto Marco <?php echo $indicadorInst->getCookieNombreProyectoM(); ?></a></li>            
            <li><a href="indicador.php" class="migadepan">Indicadores</a></li>
            <li class="active migadepan">Detalles Indicador -- <?php echo $indicadorGen[0]["nombre"] ?> </li>
          </ol>
      </div>
      
  </div>
  <!-- /.row -->

  <div class="row">    
      
      <div class="col-lg-12">
        
        <!-- Nav tabs -->
        <ul class="nav nav-tabs tabs-proc3" role="tablist">
	        <li id="li_general" role="presentation"><a href="#general" aria-controls="general" role="tab" data-toggle="tab">General</a></li>
          	<li id="li_metas" role="presentation"><a href="#metas" aria-controls="general" role="tab" data-toggle="tab">Metas</a></li>
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
							<?php $indicadorInst->getDataIndicadorGen($pkID_indicador); ?>							
						</div>						

					</div>

				</div>
				<!-- /.contenido general -->

			</div>

			<!-- ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++  -->
			<?php 
			include("form_meta.php");
			include("form_valoresM.php");
 			?>
			<!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++  -->

			<div role="tabpanel" class="tab-pane" id="metas">
				<br>
				<!-- contenido general -->
				<div class="panel panel-default proc-pan-def3">

				<div class="titulohead">

            	 <div class="row">
              		<div class="col-md-6">
                  		<div class="fuente"><h4>Registro de Metas</h4></div>
              		</div>
              		<div class="col-md-6 text-right">
                 	<button id="btn_nuevometa" type="button" class="btn btn-primary botonnewgrupo" data-toggle="modal" data-target="#frm_modal_meta" <?php if (($cream != 1)||($meta != null)){echo 'disabled="disabled"';} ?> >
                 	<span class="glyphicon glyphicon-plus"></span>Nueva meta</button>  
              		</div>
            	 </div>

          		</div>

					<div class="panel-body">

						<div class="col-md-12">
							<div class="dataTable_wrapper">
				              <table class="display table table-striped table-bordered table-hover" id="tbl_metas">
				                  <thead>
				                      <tr>				                          
				                          <th>Nombre</th>
				                          <th>Total</th>
				                          <th>Valores de la Metas</th>
				                          <!--<th>Nombre del valor</th>
				                          <th>Valor</th>-->
				                          <!--<th>Prueba</th>-->
				                          <th data-orderable="false">Opciones</th>                                               
				                      </tr>
				                  </thead>

				                  <tbody>
				                      <?php 
				                      		if($meta == null){
				                      			echo '<p class="alert alert-danger">El indicador no tiene una meta.</p>';
				                      		}else{	
				                      			$indicadorInst->getTablaMetasIndicador($meta,$pkID_indicador);
				                      		};
              //echo $pkID_indicador; ?>                     
				                  </tbody>
				              </table>
					        </div>
					        <!-- /.table-responsive -->						
						</div>						

					</div>

				</div>
				<!-- /.contenido general -->

			</div>


			<div role="tabpanel" class="tab-pane" id="resultados">
				<br>
				<!-- contenido general -->
				<div class="panel panel-default proc-pan-def3">

					<div class="panel-body">

						<div class="col-md-12">
							<!-- instancia php controller -->
							<?php 
							 	if($meta == null){
				                   //echo "El indicador no tiene meta";
				                   echo '<p class="alert alert-danger">El indicador no tiene una meta.</p>';
				                }else{	
									$indicadorInst->getTablaValoresMetasIndicador($meta,$pkID_indicador);
								};	 
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





