<?php

//instancia para el formulario departamentos y municipios
include '../controller/institucionController.php';
include '../controller/talento_humanoController.php';
include '../conexion/datos.php';

$talento_humanoInst = new talento_humanoController();

$pkID_proyectoM = $_GET["id_proyectoM"];

$proyectoMGen = $talento_humanoInst->getProyectosMarcoId($pkID_proyectoM);

$arrPermisos = $talento_humanoInst->getPermisosModulo_Tipo($id_modulo, $_COOKIE[$NomCookiesApp . '_IDtipo']);

$crea = $arrPermisos[0]['crear'];

include "form_talento_humano.php";

include "form_modal_archivos.php";

?>

<!-- ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++  -->

<div id="page-wrapper" style="margin: 0px;">

  <div class="row">
    <!-- Campo que contiene el valor del id del modulo para auditoria con el nombre del modulo-->
      <input type="hidden" id="id_mod_page_grupo" value=<?php echo $id_modulo ?>>


      <div class="col-lg-12">
          <h1 class="page-header titleprincipal"><img src="../img/botones/proyectosmarcoonly.png">Talento Humano - <?php echo $proyectoMGen[0]["nombre"] ?></h1>
      </div>
      <!-- /.col-lg-12 -->
      <div class="col-lg-12">
        <ol class="breadcrumb migadepan">
          <li><a href="proyecto_marco.php" class="migadepan">Inicio</a></li>
          <li><a href="principal.php?id_proyectoM=<?php echo $pkID_proyectoM; ?>" class="migadepan">Menú principal</a></li>
          <li class="active migadepan">Talento humano - <?php echo $proyectoMGen[0]["nombre"] ?> </li>
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
                  <div class="titleprincipal"><h4>Asignación de talento humano - <?php echo $proyectoMGen[0]["nombre"] ?></h4></div>
              </div>
              <div class="col-md-6 text-right">
                 <button id="btn_nuevoProyectoM" type="button" class="btn btn-primary botonnewgrupo" data-proyecto="<?php echo $pkID_proyectoM; ?>" data-toggle="modal" data-target="#frm_modal_proyectoM" <?php if ($crea != 1) {echo 'disabled="disabled"';}?> >
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
$talento_humanoInst->getTablaFuncionarioCargo($pkID_proyectoM);
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


