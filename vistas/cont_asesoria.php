<?php
	
	/**/
	
	include('../controller/asesoriaController.php');
	
	include('../conexion/datos.php');
	
	$asesoriaInst = new asesoriaController();
	
	$arrPermisos = $asesoriaInst->getPermisosModulo_Tipo($id_modulo,$_COOKIE[$NomCookiesApp.'_IDtipo']);
	
	$crea = $arrPermisos[0]['crear'];
	
  include("form_asesoria.php");
  
?>

<div id="page-wrapper" style="margin: 0px;">

  <div class="row">

      <div class="col-lg-12">
          <h1 class="page-header titleprincipal"><img src="../img/botones/asesoriasonly.png">Asesorías</h1> 
      </div>        
      <!-- /.col-lg-12 -->
      <div class="col-lg-12">
          <ol class="breadcrumb migadepan">
            <li><a class="migadepan" <?php echo 'href="index.php?id_proyectoM='.$asesoriaInst->getcpm().'"' ?>>Inicio</a></li>
            <li class="active migadepan">Asesorías</li>
          </ol>
      </div>
      
  </div>
  <!-- /.row -->

  <div class="row">

    <?php //echo 'el perfil es '.$_COOKIE["log_lunelAdmin_tipo"];; ?>
      
      <div class="col-lg-12">
        
        <div class="panel panel-default">

          <div class="titulohead">

            <div class="row">
              <div class="col-md-6">
                  <div class="fuente"><h4>Registro de Asesorías</h4></div>
              </div>
              <div class="col-md-6 text-right">
                 <button id="btn_nuevoasesoria" type="button" class="btn btn-primary botonnewgrupo" data-toggle="modal" data-target="#frm_modal_asesoria" <?php if ($crea != 1){echo 'disabled="disabled"';} ?> >
                 <span class="glyphicon glyphicon-plus"></span>Nueva asesoría</button>  
              </div>
            </div>

          </div>
          <!-- /.panel-heading -->
        
        <div class="panel-body">

          <div class="dataTable_wrapper">
              <table class="display table table-striped table-bordered table-hover" id="tbl_asesoria">
                  <thead>
                      <tr>
                         <!-- <th>ID Proyecto Marco</th>-->
                          <th>Fecha de la Asesoría</th>
                          <th>Logros</th>
                          <th>Dificultades</th>                             
                          <th>Opciones</th>                                               
                      </tr>
                  </thead>

                  <tbody>
                      <?php
                          //print_r($_COOKIE); 
                          //echo "valor de cookie de tipo ".$_COOKIE[$NomCookiesApp."_tipo"];
                          $asesoriaInst->getTablaAsesorias();                        
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

