<?php

include '../controller/microbiologiaController.php';
include '../conexion/datos.php';

if (isset($_GET["anio"])) {
    $filtro = $_GET["anio"];
} else {
    $filtro = "'Todos'";
}

$microbiologiaInst = new microbiologiaController();

$arrPermisos = $microbiologiaInst->getPermisosModulo_Tipo($id_modulo, $_COOKIE[$NomCookiesApp . '_IDtipo']);
$crea        = $arrPermisos[0]['crear'];

$pkID_grupo     = $_GET["id_grupo"];
$pkID_proyectoM = $_GET["id_proyectoM"];
$proyectoMGen   = $microbiologiaInst->getProyectosMarcoId($pkID_proyectoM);

include "form_microbiologia.php";
?>

<!-- ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++  -->

<div id="page-wrapper" style="margin: 0px;">

  <div class="row">
    <!-- Campo que contiene el valor del id del modulo para auditoria con el nombre del modulo-->
      <input type="hidden" id="id_mod_page_grupo" value=<?php echo $id_modulo ?>>


      <div class="col-lg-12">
          <h1 class="page-header titleprincipal"><img src="../img/botones/grupoonly.png">Talleres de microbiología básica - <?php echo $proyectoMGen[0]["nombre"] ?></h1>
      </div>
      <!-- /.col-lg-12 -->
    <div class="col-md-9">
          <ol class="breadcrumb migadepan">
            <li><a href="proyecto_marco.php" class="migadepan">Inicio</a></li>
            <li><a href="principal.php?id_proyectoM=<?php echo $pkID_proyectoM; ?>" class="migadepan">Menú principal</a></li>
            <li><a href="cientifico.php?id_proyectoM=<?php echo $pkID_proyectoM; ?>" class="migadepan">Científico</a></li>
            <li class="active migadepan">Talleres de microbiología básica - <?php echo $proyectoMGen[0]["nombre"] ?> </li>
          </ol>
    </div>

    <div class="col-md-2 text-center form-inline">
                    <label for="grupo_filtrop" class="control-label">Año: </label>
                      <?php
$microbiologiaInst->getSelectAnioFiltro();
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
                  <div class="titleprincipal"><h4>Registro de Talleres de microbiología básica - <?php echo $proyectoMGen[0]["nombre"] ?></h4></div>
              </div>
              <div class="col-md-6 text-right">
                 <button id="btn_nuevomicrobiologia" type="button" class="btn btn-primary botonnewgrupo" data-toggle="modal" data-proyecto="<?php echo $pkID_proyectoM; ?>" data-target="#frm_modal_microbiologia" <?php if ($crea != 1) {echo 'disabled="disabled"';}?> >
                 <span class="glyphicon glyphicon-plus"></span>Nuevo Talleres de microbiología básica</button>
              </div>
            </div>

          </div>
          <!-- /.panel-heading -->

        <div class="panel-body">

          <div class="dataTable_wrapper">
              <table class="display table table-striped table-bordered table-hover" id="tbl_grupo">
                  <thead>
                      <tr>
                          <th>Fecha</th>
                          <th>Institución</th>
                          <th>Grado</th>
                          <th>Curso</th>
                          <th>Cantidad Estudiantes</th>
                          <th data-orderable="false">Opciones</th>
                      </tr>
                  </thead>

                  <tbody>
                      <?php
$microbiologiaInst->getTablaMicrobiologia($filtro, $pkID_proyectoM);
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