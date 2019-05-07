<?php
	
	/**/
	
	include('../controller/bitacoraController.php');
	
	include('../conexion/datos.php');
	
	$bitacoraInst = new bitacoraController();
	
	$arrPermisos = $bitacoraInst->getPermisosModulo_Tipo($id_modulo,$_COOKIE[$NomCookiesApp.'_IDtipo']);
	
	$crea = $arrPermisos[0]['crear'];

  $numBitacoras = $bitacoraInst->getNumBitacorasProyectoM($_COOKIE['id_proyectoM']);

  $numeroBPM = $numBitacoras[0]['numBPM'];

  //print_r($numeroBPM);

 include("form_bitacora.php");	
?>

<div id="page-wrapper" style="margin: 0px;">

  <div class="row">
    <!-- Campo que contiene el valor del id del modulo para auditoria con el nombre del modulo-->
      <input type="hidden" id="id_mod_page_bitacora" value=<?php echo $id_modulo ?>>

      <div class="col-lg-12">
          <h1 class="page-header titleprincipal"><img src="../img/botones/bitacorasonly.png">Diario de Investigación</h1> 
      </div>        
      <!-- /.col-lg-12 -->
      <div class="col-lg-12">
          <ol class="breadcrumb migadepan">
            <li><a class="migadepan" <?php echo 'href="detalles_proyectoM.php?id_proyectoM='.$bitacoraInst->getcpm().'&nom_proyectoM='.$bitacoraInst->getCookieNombreProyectoM().'"';?>>Proyecto Marco <?php echo $bitacoraInst->getCookieNombreProyectoM(); ?></a></li>            
            <li class="active migadepan">Diario de Investigación</li>
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
                  <div class="fuente"><h4>Registro de Diario de Investigación</h4></div>
              </div>
              <div class="col-md-6 text-right">
                 <button id="btn_nuevobitacora" type="button" class="btn btn-primary botonnewgrupo" data-toggle="modal" data-target="#frm_modal_bitacora" <?php if (($crea != 1)||($numeroBPM >=8)){echo 'disabled="disabled"';} ?> >
                 <span class="glyphicon glyphicon-plus"></span>Nuevo Diario de Investigación</button>  
              </div>
            </div>

          </div>
          <!-- /.panel-heading -->
        
        <div class="panel-body">

          <div class="dataTable_wrapper">
              <table class="display table table-striped table-bordered table-hover" id="tbl_bitacora">
                  <thead>
                      <tr>
                         <!-- <th>ID Proyecto Marco</th>-->
                          <th>Nombre</th>
                          <th>Fecha de Creación</th> 
                          <th>Fase</th>                            
                          <th>Opciones</th>                                               
                      </tr>
                  </thead>

                  <tbody>
                      <?php
                          //print_r($_COOKIE); 
                          //echo "valor de cookie de tipo ".$_COOKIE[$NomCookiesApp."_tipo"];
                          $bitacoraInst->getTablaBitacora();                        
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


