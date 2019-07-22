<?php

include '../controller/docentesController.php';

include '../controller/aibdController.php';

include '../conexion/datos.php';

$docentesInst = new docentesController();

$arrPermisosD = $docentesInst->getPermisosModulo_Tipo(26, $_COOKIE[$NomCookiesApp . '_IDtipo']);

$creaD = $arrPermisosD[0]['crear'];

$pkID_user = $_COOKIE[$NomCookiesApp . '_id'];

if (isset($_GET["anio"])) {
    $filtro = $_GET["anio"];
} else {
    $filtro = "'Todos'";
}

$pkID_tipo_user = $_COOKIE[$NomCookiesApp . '_IDtipo'];

//print_r($pkID_tipo_user);
$pkID_grupo = $_GET["id_grupo"];

$aibdInst = new aibdController();

$arrPermisos = $aibdInst->getPermisosModulo_Tipo($id_modulo, $_COOKIE[$NomCookiesApp . '_IDtipo']);

$crea = $arrPermisos[0]['crear'];

$pkID_proyectoM = $_GET["id_proyectoM"];
$proyectoMGen   = $docentesInst->getProyectosMarcoId($pkID_proyectoM);

include "form_aibd.php";

?>

<!-- ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++  -->

<div id="page-wrapper" style="margin: 0px;">

  <div class="row">
    <!-- Campo que contiene el valor del id del modulo para auditoria con el nombre del modulo-->
      <input type="hidden" id="id_mod_page_grupo" value=<?php echo $id_modulo ?>>


      <div class="col-lg-12">
          <h1 class="page-header titleprincipal"><img src="../img/botones/grupoonly.png">AIBD (Aula Investigación Básica Departamental) - <?php echo $proyectoMGen[0]["nombre"] ?></h1>
      </div>
      <!-- /.col-lg-12 -->
    <div class="col-md-9">
          <ol class="breadcrumb migadepan">
            <li><a href="proyecto_marco.php" class="migadepan">Inicio</a></li>
            <li><a href="principal.php?id_proyectoM=<?php echo $pkID_proyectoM; ?>" class="migadepan">Menú principal</a></li>
            <li><a href="cientifico.php?id_proyectoM=<?php echo $pkID_proyectoM; ?>" class="migadepan">Científico</a></li>
            <li class="active migadepan">AIBD (Aula Investigación Básica Departamental) - <?php echo $proyectoMGen[0]["nombre"] ?> </li>
          </ol>
    </div>

    <div class="col-md-2 text-center form-inline">
                    <label for="grupo_filtrop" class="control-label">Año: </label>
                      <?php
$aibdInst->getSelectAnioFiltro();
?>
     </div>
    <div class="col-md-1 text-left form-inline">
                     <button class="btn btn-success" name="btn_filtro_anio" id="btn_filtro_anio"><span class="glyphicon glyphicon-filter"></span> Filtrar</button>

                     <hr>

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
                  <div class="titleprincipal"><h4>Registro de AIBD (Aula Investigación Básica Departamental) - <?php echo $proyectoMGen[0]["nombre"] ?></h4></div>
              </div>
              <div class="col-md-6 text-right">
                 <button id="btn_nuevoaibd" type="button" class="btn btn-primary botonnewgrupo" data-toggle="modal" data-proyecto="<?php echo $pkID_proyectoM; ?>" data-target="#frm_modal_aibd" <?php if ($crea != 1) {echo 'disabled="disabled"';}?> >
                 <span class="glyphicon glyphicon-plus"></span>Nuevo AIBD (Aula Investigación Básica Departamental)</button>
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
                          <th>Fecha</th>
                          <th>Descripcion</th>
                          <th>Acta</th>
                          <th>Ingreso Almacen</th>
                          <th data-orderable="false">Opciones</th>
                      </tr>
                  </thead>

                  <tbody>
                      <?php
$aibdInst->getTablaAibd($filtro, $pkID_proyectoM);
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


