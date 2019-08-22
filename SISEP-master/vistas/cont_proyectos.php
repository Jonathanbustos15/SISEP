<?php

//ini_set('error_reporting', E_ALL|E_STRICT);
//ini_set('display_errors', 1);
include '../controller/institucionController.php';
include '../controller/proyecto_marcoController.php';
include '../conexion/datos.php';

$docentesInst = new docentesController();

$arrPermisosD = $docentesInst->getPermisosModulo_Tipo(26, $_COOKIE[$NomCookiesApp . '_IDtipo']);

$creaD = $arrPermisosD[0]['crear'];

$pkID_user = $_COOKIE[$NomCookiesApp . '_id'];

//print_r($pkID_user);

$pkID_tipo_user = $_COOKIE[$NomCookiesApp . '_IDtipo'];

//print_r($pkID_tipo_user);

$grupoInst = new grupoController();

$arrPermisos = $grupoInst->getPermisosModulo_Tipo($id_modulo, $_COOKIE[$NomCookiesApp . '_IDtipo']);

$crea = $arrPermisos[0]['crear'];

include "form_grupo.php";
include "form_novedades.php";

?>

<!-- ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++  -->

<div id="page-wrapper" style="margin: 0px;">

  <div class="row">
    <!-- Campo que contiene el valor del id del modulo para auditoria con el nombre del modulo-->
      <input type="hidden" id="id_mod_page_grupo" value=<?php echo $id_modulo ?>>


      <div class="col-lg-12">
          <h1 class="page-header titleprincipal"><img src="../img/botones/grupoonly.png">Grupos</h1>
      </div>
      <!-- /.col-lg-12 -->
      <div class="col-lg-12">
          <ol class="breadcrumb migadepan">
            <li><a class="migadepan" <?php echo 'href="detalles_proyectoM.php?id_proyectoM=' . $grupoInst->getcpm() . '&nom_proyectoM=' . $grupoInst->getCookieNombreProyectoM() . '"'; ?>>Proyecto Marco <?php echo $grupoInst->getCookieNombreProyectoM(); ?></a></li>
            <li class="active migadepan">Grupos</li>
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
                  <div class="titleprincipal"><h4>Registro de Grupos</h4></div>
              </div>
              <div class="col-md-6 text-right">
                 <button id="btn_nuevogrupo" type="button" class="btn btn-primary botonnewgrupo" data-toggle="modal" data-target="#frm_modal_grupo" <?php if ($crea != 1) {echo 'disabled="disabled"';}?> >
                 <span class="glyphicon glyphicon-plus"></span>Nuevo Grupo</button>
              </div>
            </div>

          </div>
          <!-- /.panel-heading -->

        <div class="panel-body">

          <div class="dataTable_wrapper">
              <table class="display table table-striped table-bordered table-hover" id="tbl_grupo">
                  <thead>
                      <tr>
                         <!-- <th>ID Grupo</th>-->
                          <th>Nombre</th>
                          <th>Descripción</th>
                          <th data-orderable="false">Logo</th>
                          <th>Lema</th>
                          <th>Fecha de Creación</th>
                          <th>Institución</th>
                          <th>Grado</th>
                          <th data-orderable="false">Opciones</th>
                      </tr>
                  </thead>

                  <tbody>
                      <?php
//print_r($_COOKIE);
//echo "valor de cookie de tipo ".$_COOKIE[$NomCookiesApp."_tipo"];
if (($pkID_tipo_user == 8) || ($pkID_tipo_user == 9)) {
    $grupoInst->getTablaGruposUsuario($pkID_user);
} else {
    $grupoInst->getTablaGrupo();
}
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


