<?php

//instancia para el formulario departamentos y municipios
include '../controller/institucionController.php';
include '../controller/proyecto_marcoController.php';
include '../conexion/datos.php';

$institucionInst    = new institucionController();
$proyecto_marcoInst = new proyecto_marcoController();
$arrPermisos        = $proyecto_marcoInst->getPermisosModulo_Tipo($id_modulo, $_COOKIE[$NomCookiesApp . '_IDtipo']);
$crea               = $arrPermisos[0]['crear'];

include "form_proyectosM.php";
include "form_modal_archivos.php";
?>
<!-- ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++  -->

<div id="page-general" style="margin: 0px;">

  <div class="row">
    <!-- Campo que contiene el valor del id del modulo para auditoria con el nombre del modulo-->
      <input type="hidden" id="id_mod_page_grupo" value=<?php echo $id_modulo ?>>


      <div class="col-lg-12">
          <h2 class="page-header titleprincipal"><img src="../img/botones/proyectosmarco.png"> Proyectos Marco</h2>
      </div>
      <!-- /.col-lg-12 -->
      <div class="col-lg-12">
          <ol class="breadcrumb migadepan">
            <li><a class="migadepan">Proyectos Marco </a></li>
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
                  <div class="titleprincipal"><h4>Registro de Proyectos</h4></div>
              </div>
              <div class="col-md-6 text-right">
                 <button id="btn_nuevoProyectoM" type="button" class="btn btn-primary botonnewgrupo" data-toggle="modal" data-target="#frm_modal_proyectoM" <?php if ($crea != 1) {echo 'disabled="disabled"';}?> >
                 <span class="glyphicon glyphicon-plus"></span>Nuevo proyecto marco</button>
              </div>
            </div>

          </div>
          <!-- /.panel-heading -->

        <div class="panel-body">

          <div class="dataTable_wrapper">
              <table class="display table table-striped table-bordered table-hover" id="tbl_grupo">
                  <thead>
                      <tr>
                          <th>Nombre</th>
                          <th>Fecha inicio</th>
                          <th>Fecha fin</th>
                          <th>Operador</th>
                          <th>Valor</th>
                          <th data-orderable="false">Opciones</th>
                      </tr>
                  </thead>

                  <tbody>
                      <?php echo $proyecto_marcoInst->getTablaProyectoMarco(); ?>
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


