<?php

include '../controller/reporteController.php';
include '../conexion/datos.php';

$reportesInst = new reporteController();
$arrPermisos  = $reportesInst->getPermisosModulo_Tipo($id_modulo, $_COOKIE[$NomCookiesApp . '_IDtipo']);
$crea         = $arrPermisos[0]['crear'];
$id_proyecto  = $_GET['id_proyectoM'];
?>
<!-- ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++  -->

<div id="page-wrapper" style="margin: 0px;">

  <div class="row">
    <!-- Campo que contiene el valor del id del modulo para auditoria con el nombre del modulo-->
      <input type="hidden" id="id_mod_page_grupo" value=<?php echo $id_modulo ?>>


      <div class="col-lg-12">
          <h2 class="page-header titleprincipal"><img src="../img/botones/proyectosmarcoonly.png">Reporte Indicadores</h2>
      </div>
      <!-- /.col-lg-12 -->
      <div class="col-lg-12">
          <ol class="breadcrumb migadepan">
            <li><a class="migadepan">Reporte Indicadores</a></li>
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
                  <div class="titleprincipal"><h4>Creación de indicadores</h4></div>
              </div>
              <div class="col-md-6 text-right">
                 <button id="btn_nuevoProyectoM" type="button" class="btn btn-primary botonnewgrupo" data-toggle="modal" data-target="#frm_modal_proyectoM" <?php if ($crea != 1) {echo 'disabled="disabled"';}?> >
                 <span class="glyphicon glyphicon-plus"></span>Nuevo Indicador</button>
              </div>
            </div>

          </div>
          <!-- /.panel-heading -->

        <div class="panel-body">

          <div class="dataTable_wrapper">
              <table class="display table table-striped table-bordered table-hover" id="tbl_grupo">
                  <thead>
                      <tr>
                          <th colspan="5">Indicadores y metas</th>
                          <th colspan="3">Año 1</th>
                          <th colspan="3">Año 2</th>
                          <th colspan="3">Año 3</th>
                          <th colspan="3">Año 4</th>
                          <th colspan="3">Total</th>
                          <th data-orderable="false">Grafica</th>
                      </tr>
                  </thead>
                      <tr>
                          <td colspan="5"></td>
                          <td >Meta</td>
                          <td >Cump</td>
                          <td >Pdte</td>
                          <td >Meta</td>
                          <td >Cump</td>
                          <td >Pdte</td>
                          <td >Meta</td>
                          <td >Cump</td>
                          <td >Pdte</td>
                          <td >Meta</td>
                          <td >Cump</td>
                          <td >Pdte</td>
                          <td >Meta</td>
                          <td >Cump</td>
                          <td >Pdte</td>
                          <td></td>
                      </tr>

                  <tbody>
                      <?php echo $reportesInst->getTablaReporte($id_proyecto); ?>
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


