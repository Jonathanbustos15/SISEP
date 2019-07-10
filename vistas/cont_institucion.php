<?php

/**/

include '../controller/institucionController.php';

$institucionInst = new institucionController();

$arrPermisos = $institucionInst->getPermisosModulo_Tipo($id_modulo, $_COOKIE[$NomCookiesApp . '_IDtipo']);

$crea = $arrPermisos[0]['crear'];

$pkID_proyectoM = $_GET["id_proyectoM"];
$proyectoMGen   = $institucionInst->getProyectosMarcoId($pkID_proyectoM);

include "form_institucion.php";
?>

<div id="page-wrapper" style="margin: 0px;">

  <div class="row">

      <input type="hidden" id="id_mod_page_institucion" value=<?php echo $id_modulo ?>>

      <div class="col-lg-12">
          <h2 class="page-header titleprincipal"><img src="../img/botones/institucionesonly.png">Instituciones - <?php echo $proyectoMGen[0]["nombre"] ?></h2>
      </div>

      <div class="col-lg-12">
        <ol class="breadcrumb migadepan">
          <li><a href="proyecto_marco.php" class="migadepan">Inicio</a></li>
          <li><a href="principal.php?id_proyectoM=<?php echo $pkID_proyectoM; ?>" class="migadepan">Menú principal</a></li>
          <li><a href="configuracion.php?id_proyectoM=<?php echo $pkID_proyectoM; ?>" class="migadepan">Configuración</a></li>
          <li class="active migadepan">Institución - <?php echo $proyectoMGen[0]["nombre"] ?> </li>
        </ol>
      </div>

  </div>
  <div class="row">

      <div class="col-lg-12">

        <div class="panel panel-default">

          <div class="panel-heading" style="background-image: linear-gradient(to bottom,#FFBF00 0,#FFBF00 100%); padding: 5px 15px;">

            <div class="row">
              <div class="col-md-6">
                  <div class="titleprincipal"><h4>Registro de Instituciones - <?php echo $proyectoMGen[0]["nombre"] ?></h4></div>
              </div>
              <div class="col-md-6 text-right">
                 <button id="btn_nuevoInstitucion" type="button"  class="btn btn-primary botonnewgrupo" data-toggle="modal" data-target="#frm_modal_institucion"  >
                 <span class="glyphicon glyphicon-plus"></span>Nueva Institución</button>
              </div>
            </div>

          </div>
          <!-- /.panel-heading -->

        <div class="panel-body">

          <div class="dataTable_wrapper">
              <table class="display table table-striped table-bordered table-hover" id="tbl_institucion">
                  <thead>
                      <tr>
                          <th>Nombre</th>
                          <th>Código DANE</th>
                          <th>Municipio</th>
                          <th>Email</th>
                          <th>Persona de Contacto</th>
                          <th data-orderable="false">Opciones</th>
                      </tr>
                  </thead>

                  <tbody>
                      <?php
$institucionInst->getTablaInstitucion();
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