<?php
		
	include('../controller/institucionController.php');

	include('../controller/sedeController.php');
	
	include('../conexion/datos.php');
	
	$institucionInst = new institucionController();
	
	$arrPermisos = $institucionInst->getPermisosModulo_Tipo($id_modulo,$_COOKIE[$NomCookiesApp.'_IDtipo']);
	
	$crea = $arrPermisos[0]['crear'];

	$pkID_institucion = $_GET["id_institucion"];

	$institucionGen = $institucionInst->getInstitucionId($pkID_institucion);

	
	$sedeInst = new sedeController();

	$arrPermisosSede = $sedeInst->getPermisosModulo_Tipo(50,$_COOKIE[$NomCookiesApp.'_IDtipo']);
	
	$creaSede = $arrPermisosSede[0]['crear'];

	//print_r($docentesInst->getDocentesId($_GET["id_docente"]));
?>

<div id="page-wrapper" style="margin: 0px;">

  <div class="row">
  	<!-- Campo que contiene el valor del id del modulo para auditoria con el nombre del modulo-->
      <input type="hidden" id="id_mod_page_sede" value=<?php echo $id_modulo ?>>


      <div class="col-lg-12">
          <h1 class="page-header titleprincipal"><img src="../img/botones/institucionesonly.png">Instituciones</h1> 
      </div>        
      <!-- /.col-lg-12 -->

      <div class="col-lg-12">
          <ol class="breadcrumb migadepan">
          	<li><a class="migadepan" <?php echo 'href="detalles_proyectoM.php?id_proyectoM='.$institucionInst->getcpm().'&nom_proyectoM='.$institucionInst->getCookieNombreProyectoM().'"';?>>Proyecto Marco <?php echo $institucionInst->getCookieNombreProyectoM(); ?></a></li>            
            <li><a class="migadepan" href="institucion.php">Instituciones</a></li>
            <li class="active migadepan">Detalles Institución -- <?php echo $institucionGen[0]["nombre"] ?> </li>
          </ol>
      </div>
      
  </div>
  <!-- /.row -->

  <div class="row">    
      
      <div class="col-lg-12">
        
        <!-- Nav tabs -->
        <ul class="nav nav-tabs tabs-proc3" role="tablist">
	        <li id="li_sedes" role="presentation"><a href="#sedes" aria-controls="general" role="tab" data-toggle="tab">Sedes</a></li>
          	<!--<li id="li_sedes" role="presentation"><a href="#sedes" aria-controls="general" role="tab" data-toggle="tab">Sedes</a></li>-->
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
							<?php //$institucionInst->getDataInstitucionGen($pkID_institucion); ?>							
						</div>						

					</div>

				</div>
				<!-- /.contenido general -->

			</div>

			<!-- ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++  -->
			<?php 
				include("form_sede.php");
 			?>
			<!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++  -->

			<div role="tabpanel" class="tab-pane" id="sedes">
				<br>
				<!-- contenido general -->
				<div class="panel panel-default proc-pan-def3">

				<div class="titulohead">

            	 <div class="row">
              		<div class="col-md-6">
                  		<div class="titleprincipal"><h4>Registro de Sedes</h4></div>
              		</div>
              		<div class="col-md-6 text-right">
                 	<button id="btn_nuevosede" type="button" class="btn btn-primary botonnewgrupo" data-toggle="modal" data-target="#frm_modal_sede" <?php if ($creaSede != 1){echo 'disabled="disabled"';} ?> >
                 	<span class="glyphicon glyphicon-plus"></span>Nueva sede</button>  
              		</div>
            	 </div>

          		</div>

					<div class="panel-body">

						<div class="col-md-12">
							<div class="dataTable_wrapper">
				              <table class="display table table-striped table-bordered table-hover" id="tbl_sede">
				                  <thead>
				                      <tr>				                          
				                          <th>Nombre</th>
				                          <th>Dirección</th>
				                          <th>Teléfono</th>
				                          <th>Email</th>
				                          <th data-orderable="false">Opciones</th>                                               
				                      </tr>
				                  </thead>

				                  <tbody>
				                      <?php $sedeInst->getTablaSedesInstitucion($pkID_institucion); ?>                     
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