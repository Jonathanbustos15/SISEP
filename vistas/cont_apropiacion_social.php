<?php
	
	/**/
	
	include('../controller/apropiacion_socialController.php');
	
	include('../conexion/datos.php');
	
	$apropiacion_socialInst = new apropiacion_socialController();
	
	$arrPermisos = $apropiacion_socialInst->getPermisosModulo_Tipo($id_modulo,$_COOKIE[$NomCookiesApp.'_IDtipo']);
	
	$crea = $arrPermisos[0]['crear'];
	
  include("form_apropiacionS.php");
  include("form_lugarA.php");
  include("form_tematica.php");
  include("form_modal_archivos.php");
?>

<div id="page-wrapper" style="margin: 0px;">

  <div class="row">
    <!-- Campo que contiene el valor del id del modulo para auditoria con el nombre del modulo-->
      <input type="hidden" id="id_mod_page_apropiacionS" value=<?php echo $id_modulo ?>>

      <div class="col-lg-12">
          <h1 class="page-header titleprincipal"><img src="../img/botones/apropiacionsocialonly.png">Espacios de Apropiación Social</h1> 
      </div>        
      <!-- /.col-lg-12 -->

      <div class="col-lg-12">
          <ol class="breadcrumb migadepan">
            <li><a class="migadepan" <?php echo 'href="detalles_proyectoM.php?id_proyectoM='.$apropiacion_socialInst->getcpm().'&nom_proyectoM='.$apropiacion_socialInst->getCookieNombreProyectoM().'"';?>>Proyecto Marco <?php echo $apropiacion_socialInst->getCookieNombreProyectoM(); ?></a></li>            
            <li class="active migadepan">Espacios de Apropiación Social</li>
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
                  <div class="titleprincipal"><h4>Registros Espacios de Apropiación Social</h4></div>
              </div>
              <div class="col-md-6 text-right">
                 <button id="btn_nuevoApropiacionS" type="button" class="btn btn-primary botonnewgrupo" data-toggle="modal" data-target="#frm_modal_apropiacionS" <?php if ($crea != 1){echo 'disabled="disabled"';} ?> >
                 <span class="glyphicon glyphicon-plus"></span>Nuevo Espacio de Apropiación Social</button>  
              </div>
            </div>

          </div>
          <!-- /.panel-heading -->
        
        <div class="panel-body">

          <div class="dataTable_wrapper">
              <table class="display table table-striped table-bordered table-hover" id="tbl_apropiacionS">
                  <thead>
                      <tr>                         
                          <th>Nombre</th>
                          <th>Lugar</th>
                          <th>Fecha Inicial</th>                                                            
                          <th>Fecha Final</th>                       
                          <th data-orderable='false'>Opciones</th>                                               
                      </tr>
                  </thead>

                  <tbody>
                      <?php                          
                          $apropiacion_socialInst->getTablaApropiacionS();                        
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
