<?php

//instancia para el formulario departamentos y municipios
include '../controller/institucionController.php';
include '../controller/talento_humanoController.php';
include '../controller/funcionarioController.php';
include '../conexion/datos.php';

$talento_humanoInst = new talento_humanoController();

$funcionarioInst = new funcionarioController();

$pkID_proyectoM = $_GET["id_proyectoM"];

$proyectoMGen = $talento_humanoInst->getProyectosMarcoId($pkID_proyectoM);

$arrPermisos = $talento_humanoInst->getPermisosModulo_Tipo($id_modulo, $_COOKIE[$NomCookiesApp . '_IDtipo']);

$crea = $arrPermisos[0]['crear'];

if (isset($_GET["anio"])) {
    $filtro = $_GET["anio"];
} else {
    $filtro = "Todos";
}
if (isset($_GET["estado"])) {
    $filtro2 = $_GET["estado"];
} else {
    $filtro2 = "Todos";
}

include "form_talento_humano.php";

include 'form_funcionario.php';

include "form_modal_archivos.php";

?>

<!-- ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++  -->

<div id="page-wrapper" style="margin: 0px;">

  <div class="row">
    <!-- Campo que contiene el valor del id del modulo para auditoria con el nombre del modulo-->
      <input type="hidden" id="id_mod_page_grupo" value=<?php echo $id_modulo ?>>


      <div class="col-lg-12">
          <h1 class="page-header titleprincipal"><img src="../img/botones/talento_humanoonly.png">Talento Humano - <?php echo $proyectoMGen[0]["nombre"] ?></h1>
      </div>
      <!-- /.col-lg-12 -->
      <div class="col-md-7">
        <ol class="breadcrumb migadepan">
          <li><a href="proyecto_marco.php" class="migadepan">Inicio</a></li>
          <li><a href="descripcion.php?id_proyectoM=<?php echo $pkID_proyectoM; ?>" class="migadepan">Descripción</a></li>
          <li><a href="principal.php?id_proyectoM=<?php echo $pkID_proyectoM; ?>" class="migadepan">Menú principal</a></li>
          <li class="active migadepan">Talento humano </li>
        </ol>
      </div>

      <div class="col-md-2 text-right form-inline">
        <label for="nombre" class="control-label">Estado</label>
                        <select class="form-control" id="estado_filtro" name="estado_filtro" required = "true">
                          <option value="" selected>Todos</option>
                          <option >Activo</option>
                          <option >Inactivo</option>
                        </select>
      </div>

      <div class="col-md-2 text-center form-inline">
        <label for="grupo_filtrop" class="control-label">Año: </label>
        <?php $talento_humanoInst->getSelectAnioFiltro();?>
      </div>

      <div class="col-md-1 text-center form-inline">
        <button class="btn btn-success" name="btn_filtro_anio" id="btn_filtro_anio"><span class="glyphicon glyphicon-filter"></span> Filtrar</button>
        <hr>
      </div>
  <!-- /.row -->

  <div class="row">

    <?php //echo 'el perfil es '.$_COOKIE["log_lunelAdmin_tipo"];; ?>

      <div class="col-lg-12">

        <div class="panel panel-default">

          <div class="titulohead">

            <div class="row">
              <div class="col-md-6">
                  <div class="titleprincipal"><h4>Asignación de talento humano - <?php echo $proyectoMGen[0]["nombre"] ?></h4></div>
              </div>
              <div class="col-md-6 text-right">
                 <button id="btn_nuevotalento_humano" type="button" class="btn btn-primary botonnewgrupo" data-proyecto="<?php echo $pkID_proyectoM; ?>" data-toggle="modal" data-target="#frm_modal_talento_humano" <?php if ($crea != 1) {echo 'disabled="disabled"';}?> >
                 <span class="glyphicon glyphicon-plus"></span>Asignar Talento Humano</button>
              </div>
            </div>

          </div>
          <!-- /.panel-heading -->

        <div class="panel-body">

          <div class="dataTable_wrapper">
              <table class="display table table-striped table-bordered table-hover" id="tbl_grupo">
                  <thead>
                      <tr>
                          <th>Nombres</th>
                          <th>Apellidos</th>
                          <th>Cargo</th>
                          <th>Año</th>
                          <th>Estado</th>
                          <th data-orderable="false">Opciones</th>
                      </tr>
                  </thead>

                  <tbody>
                      <?php
$talento_humanoInst->getTablaFuncionarioCargo($pkID_proyectoM, $filtro, $filtro2);
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


