<?php
	
	/**/
	
	include('../controller/curso_formacionController.php');
	
	include('../conexion/datos.php');
	
	$curso_formacionInst = new curso_formacionController();
	
	$arrPermisos = $curso_formacionInst->getPermisosModulo_Tipo($id_modulo,$_COOKIE[$NomCookiesApp.'_IDtipo']);
	
	$crea = $arrPermisos[0]['crear'];

	include("form_curso_formacion.php");
	
?>

<!-- ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++  -->

<div id="page-wrapper" style="margin: 0px;">

  <div class="row">
      <!-- Campo que contiene el valor del id del modulo para auditoria con el nombre del modulo-->
      <input type="hidden" id="id_mod_page_cursof" value=<?php echo $id_modulo ?>>

      <div class="col-lg-12">
          <h1 class="page-header titleprincipal"><img src="../img/botones/cursosformaciononly.png">Cursos de Formación</h1> 
      </div>        
      <!-- /.col-lg-12 -->
      <div class="col-lg-12">
          <ol class="breadcrumb migadepan">
            <li><a class="migadepan" <?php echo 'href="detalles_proyectoM.php?id_proyectoM='.$curso_formacionInst->getcpm().'&nom_proyectoM='.$curso_formacionInst->getCookieNombreProyectoM().'"';?>>Proyecto Marco <?php echo $curso_formacionInst->getCookieNombreProyectoM(); ?></a></li>            
            <li class="active migadepan">Cursos de Formación</li>
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
                  <div class="titleprincipal"><h4>Registro de Cursos de Formación</h4></div>
              </div>
              <div class="col-md-6 text-right">
                 <button id="btn_nuevocursof" type="button" class="btn btn-primary botonnewgrupo" data-toggle="modal" data-target="#frm_modal_cursof" <?php if ($crea != 1){echo 'disabled="disabled"';} ?> >
                 <span class="glyphicon glyphicon-plus"></span>Nuevo Curso</button>  
              </div>
            </div>

          </div>
          <!-- /.panel-heading -->
        
        <div class="panel-body">

          <div class="dataTable_wrapper">
              <table class="display table table-striped table-bordered table-hover" id="tbl_grupo">
                  <thead>
                      <tr>
                         <!-- <th>ID Curso</th>-->
                          <th>Nombre</th>
                          <th>Objetivo</th>                                                                 
                          <th data-orderable="false">Opciones</th>                                               
                      </tr>
                  </thead>

                  <tbody>
                      <?php
                          //print_r($_COOKIE); 
                          //echo "valor de cookie de tipo ".$_COOKIE[$NomCookiesApp."_tipo"];
                          $curso_formacionInst->getTablaCursos();                        
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


