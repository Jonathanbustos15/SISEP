<?php
	
	/**/
	
	include('../controller/docentesController.php');
	
	include('../conexion/datos.php');
	
	$docentesInst = new docentesController();
	
	$arrPermisos = $docentesInst->getPermisosModulo_Tipo($id_modulo,$_COOKIE[$NomCookiesApp.'_IDtipo']);
	
	$crea = $arrPermisos[0]['crear'];

	$pkID_docente = $_GET["id_docente"];

	$docenteGen = $docentesInst->getDocentesId($pkID_docente);
	
	//print_r($docentesInst->getDocentesId($_GET["id_docente"]));
?>

<div id="page-wrapper" style="margin: 0px;">

  <div class="row">

      <div class="col-lg-12">
          <h1 class="page-header titleprincipal"><img src="../img/botones/docentesonly.png">Docentes</h1> 
      </div>        
      <!-- /.col-lg-12 -->

      <div class="col-lg-12">
          <ol class="breadcrumb migadepan">
            <li><a <?php echo 'href="index.php?id_proyectoM='.$docentesInst->getcpm().'"'; ?> class="migadepan">Inicio</a></li>
            <li><a href="docentes.php" class="migadepan">Docentes</a></li>
            <li class="active migadepan">Detalles Docente - <?php echo $docenteGen[0]["nombre"]." ".$docenteGen[0]["apellido"] ?> </li>
          </ol>
      </div>
      
  </div>
  <!-- /.row -->

  <div class="row">    
      
      <div class="col-lg-12">
        
        <!-- Nav tabs -->
        <ul class="nav nav-tabs tabs-proc3" role="tablist">
	        <li id="li_general" role="presentation"><a href="#general" aria-controls="general" role="tab" data-toggle="tab">General</a></li>
          	<li id="li_materias" role="presentation"><a href="#materias" aria-controls="general" role="tab" data-toggle="tab">Materias</a></li>
          	<li id="li_grados" role="presentation"><a href="#grados" aria-controls="general" role="tab" data-toggle="tab">Grados</a></li>	        
	    </ul>

	    <div class="tab-content">

			<div role="tabpanel" class="tab-pane" id="general">
				<br>
				<!-- contenido general -->
				<div class="panel panel-default proc-pan-def3">

					<div class="panel-body">

						<div class="col-md-12">
							<!-- instancia php controller -->
							<?php $docentesInst->getDataDocenteGen($pkID_docente); ?>							
						</div>						

					</div>

				</div>
				<!-- /.contenido general -->

			</div>

			<div role="tabpanel" class="tab-pane" id="materias">
				<br>
				<!-- contenido general -->
				<div class="panel panel-default proc-pan-def3">

					<div class="panel-body">

						<div class="col-md-12">
							<div class="dataTable_wrapper">
				              <table class="display table table-striped table-bordered table-hover" id="tbl_docentes_materias">
				                  <thead>
				                      <tr>				                          
				                          <th>Nombre</th>
				                          <th data-orderable="false">Opciones</th>                                               
				                      </tr>
				                  </thead>

				                  <tbody>
				                      <?php                          
				                          $docentesInst->getTablaDocentesMaterias($pkID_docente);                           
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

			<div role="tabpanel" class="tab-pane" id="grados">
				<br>
				<!-- contenido general -->
				<div class="panel panel-default proc-pan-def3">

					<div class="panel-body">

						<div class="col-md-12">
							<div class="dataTable_wrapper">
				              <table class="display table table-striped table-bordered table-hover" id="tbl_grados_materias">
				                  <thead>
				                      <tr>				                          
				                          <th>Nombre</th>
				                          <th data-orderable="false">Opciones</th>                                               
				                      </tr>
				                  </thead>

				                  <tbody>
				                      <?php                          
				                          $docentesInst->getTablaGradosMaterias($pkID_docente);                           
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
      
      </div>
      <!-- /.col-lg-12 -->
    
    </div>
    <!-- /.row -->
                
</div>
<!-- /#page-wrapper -->
