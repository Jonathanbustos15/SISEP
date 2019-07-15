<?php
  
  /**/
  
  include('../controller/feriaController.php');
  
  include('../conexion/datos.php');
  
  $FeriaInst = new feriaController();
  
  $arrPermisos = $FeriaInst->getPermisosModulo_Tipo($id_modulo,$_COOKIE[$NomCookiesApp.'_IDtipo']);
  
  $crea = $arrPermisos[0]['crear'];
  
  include("form_feria.php");
  //include("form_modal_archivos.php");
?>

<div id="page-wrapper" style="margin: 0px;">

  <div class="row">
    <!-- Campo que contiene el valor del id del modulo para auditoria con el nombre del modulo-->
      <input type="hidden" id="id_mod_page_actor" value=<?php echo $id_modulo ?>>

      <div class="col-lg-12">
          <h1 class="page-header titleprincipal"><img src="../img/botones/actoronly.png">Feria de Ciencias</h1> 
      </div>       
      <!-- /.col-lg-12 -->
      <div class="col-md-8">
          <ol class="breadcrumb migadepan">
            <li><a href="principal.php?id_proyectoM=<?php echo $pkID_proyectoM; ?>" class="migadepan">Menú principal</a></li>
            <li><a href="academico.php?id_proyectoM=<?php echo $pkID_proyectoM; ?>" class="migadepan">Académico</a></li>
            <li><a href="" class="migadepan">Feria de Ciencias</a></li>
          </ol>
      </div>

      <div class="col-md-2 text-right form-inline">                        
                    <label for="grupo_filtrop" class="control-label">Año: </label>      
                      <?php
                             $FeriaInst->getSelectAnioFiltro();
                      ?>  
     </div>
    <div class="col-md-1 text-left form-inline">                                             
                     <button class="btn btn-success" id="btn_filtrarg"><span class="glyphicon glyphicon-filter"></span> Filtrar</button>
                
                     <hr>

            </div>
      
  </div>
  <!-- /.row -->

  <div class="row">    
      
      <div class="col-lg-12">
        
        <div class="panel panel-default">

          <div class="titulohead">

            <div class="row">
              <div class="col-md-6">
                  <div class="titleprincipal"><h4>Registro de Feria de Ciencia</h4></div>
              </div>
              <div class="col-md-6 text-right">
                 <button id="btn_nuevoferia" type="button" class="btn btn-primary botonnewgrupo" data-toggle="modal" data-target="#frm_modal_feria" <?php if ($crea != 1){echo 'disabled="disabled"';} ?> >
                 <span class="glyphicon glyphicon-plus"></span>Nueva Feria de Ciencias</button>  
              </div>
            </div>

          </div>
          <!-- /.panel-heading -->
        
        <div class="panel-body">

          <div class="dataTable_wrapper">
              <table class="display table table-striped table-bordered table-hover" id="tbl_actor">
                  <thead>
                      <tr>
                         <!-- <th>ID Actor</th>-->
                          <th class="tabla-form-ancho-std">Fecha de la Feria</th>
                          <th class="tabla-form-ancho-std">Tipo de Feria</th>
                          <th class="tabla-form-ancho-std">Descripción</th>
                          <th class="tabla-form-ancho-std">Número de participantes</th>
                          <th class="tabla-form-ancho-std">Asesor</th>                    

                          <th class="tabla-form-ancho-sm" data-orderable="false">Opciones</th>                                               
                      </tr>
                  </thead>

                  <tbody>
                      <?php
                          //print_r($_COOKIE); 
                          //echo "valor de cookie de tipo ".$_COOKIE[$NomCookiesApp."_tipo"];
                          $FeriaInst->getTablaFeria();                        
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