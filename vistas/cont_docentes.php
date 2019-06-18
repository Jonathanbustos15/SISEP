<?php
	
	include('../controller/docentesController.php');
	
	include('../conexion/datos.php');
	
	$docentesInst = new docentesController();
	
	$arrPermisosD = $docentesInst->getPermisosModulo_Tipo($id_modulo,$_COOKIE[$NomCookiesApp.'_IDtipo']);
	
	$creaD = $arrPermisosD[0]['crear'];

	include('form_docentes.php');
	
?>

<div id="page-wrapper" style="margin: 0px;">

  <div class="row">

      <div class="col-lg-12">
          <h1 class="page-header titleprincipal"><img src="../img/botones/docentesonly.png">Docentes</h1> 
      </div>        
      <!-- /.col-lg-12 -->
      <div class="col-lg-12">
          <ol class="breadcrumb migadepan">
            <li><a class="migadepan" <?php echo 'href="proyecto_marco.php?id_proyectoM='.$docentesInst->getcpm().'"' ?>>Inicio</a></li>
          </ol>
      </div>
      
  </div>
  <!-- /.row -->

  <div class="row">    
      
      <div class="col-lg-12">
        
        <div class="panel panel-default">

          <div class="titulohead">

            <div class="row">
              <div class="col-md-6">
                  <div class="titleprincipal"><h4>Registro de Docentes</h4></div>
              </div>
              <div class="col-md-6 text-right">
                 <button id="btn_nuevodocente" type="button" class="btn btn-primary botonnewgrupo" data-toggle="modal" data-target="#frm_modal_docente" <?php if ($creaD != 1){echo 'disabled="disabled"';} ?> ><span class="glyphicon glyphicon-plus"></span> Nuevo Docente</button>  
              </div>
            </div>

          </div>
          <!-- /.panel-heading -->
        
        <div class="panel-body">

          <div class="dataTable_wrapper">
              <table class="display table table-striped table-bordered table-hover" id="tbl_docentes">
                  <thead>
                      <tr>
                          <!--<th>ID usuario</th>-->
                          <th>Nombres</th>
                          <th>Documento</th>
                          <th>Institución</th>
                          <th>Correo</th>                                                            
                          
                          <th data-orderable="false">Opciones</th>                                               
                      </tr>
                  </thead>

                  <tbody>
                      <?php                          
                          $docentesInst->getTablaDocentes();                           
                       ?>
                  </tbody>
              </table>
          </div>
          <!-- /.table-responsive -->
        
        </div>
        <!-- /.panel-body -->

        </div>
        <!-- /.panel -->
      
      </div>
      <!-- /.col-lg-12 -->
    
    </div>
    <!-- /.row -->
                
</div>
<!-- /#page-wrapper -->
