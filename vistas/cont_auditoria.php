<?php
	
	/**/
	
	include('../controller/auditoriaController.php');
	
	include('../conexion/datos.php');
	
	$auditoriaInst = new auditoriaController();
	
	$arrPermisos = $auditoriaInst->getPermisosModulo_Tipo($id_modulo,$_COOKIE[$NomCookiesApp.'_IDtipo']);
	
	$crea = $arrPermisos[0]['crear'];
	
?>
<div id="page-wrapper" style="margin: 0px;">

  <div class="row">

      <div class="col-lg-12">
          <h1 class="page-header titleprincipal"><img src="../img/botones/auditoriaonly.png">Auditoría</h1> 
      </div>       
      <!-- /.col-lg-12 -->
      <div class="col-lg-12">
          <ol class="breadcrumb migadepan">
            <li><a class="migadepan" <?php echo 'href="detalles_proyectoM.php?id_proyectoM='.$auditoriaInst->getcpm().'&nom_proyectoM='.$auditoriaInst->getCookieNombreProyectoM().'"';?>>Proyecto Marco <?php echo $auditoriaInst->getCookieNombreProyectoM(); ?></a></li>            
            <li class="active migadepan">Auditoría</li>
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
                  <div class="titleprincipal"><h4>Acciones Realizadas en el Sistema</h4></div>
              </div>
              <!--<div class="col-md-6 text-right">
                 <button id="btn_nuevoActor" type="button" class="btn btn-primary botonnewgrupo" data-toggle="modal" data-target="#frm_modal_actor" <?php //if ($crea != 1){echo 'disabled="disabled"';} ?> >
                 <span class="glyphicon glyphicon-plus"></span>Nuevo Actor</button>  
              </div>-->
            </div>

          </div>
          <!-- /.panel-heading -->
        
        <div class="panel-body">

          <div class="dataTable_wrapper table-responsive">
              <table class="display table table-striped table-bordered table-hover" id="tbl_auditoria">
                  <thead>
                      <tr>                         
                          <th class="tabla-form-ancho-std">Usuario</th>
                          <th class="tabla-form-ancho-std">Acción</th>
                          <th class="tabla-form-ancho-std">Modulo</th>
                          <th class="tabla-form-ancho-std">Fecha</th>
                          <th class="tabla-form-ancho-std">Consulta SQL</th>                    
                      </tr>
                  </thead>

                  <tbody>
                      <?php                          
                          $auditoriaInst->getTablaAuditoria();                        
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