<?php

include '../controller/estudiantesController.php';

include '../conexion/datos.php';

$estudiantesInst = new estudiantesController();

$arrPermisos = $estudiantesInst->getPermisosModulo_Tipo($id_modulo, $_COOKIE[$NomCookiesApp . '_IDtipo']);

$crea = $arrPermisos[0]['crear'];

$pkID_proyectoM = $_GET["id_proyectoM"];
$proyectoMGen   = $estudiantesInst->getProyectosMarcoId($pkID_proyectoM);

include 'form_estudiantes.php';
?>

<div id="page-wrapper" style="margin: 0px;">

  <div class="row">

      <div class="col-lg-12">
          <h2 class="page-header titleprincipal"><img src="../img/botones/estudiantesonly.png"><?php echo $proyectoMGen[0]["nombre"] ?> - Estudiantes</h2>
      </div>
      <!-- /.col-lg-12 -->
      <div class="col-lg-12">
        <ol class="breadcrumb migadepan">
          <li><a href="proyecto_marco.php" class="migadepan">Inicio</a></li>
          <li><a href="descripcion.php?id_proyectoM=<?php echo $pkID_proyectoM; ?>" class="migadepan">Descripción</a></li>
          <li><a href="principal.php?id_proyectoM=<?php echo $pkID_proyectoM; ?>" class="migadepan">Menú principal</a></li>
          <li><a href="configuracion.php?id_proyectoM=<?php echo $pkID_proyectoM; ?>" class="migadepan">Configuración</a></li>
          <li class="active migadepan"> Estudiantes </li>
        </ol>
      </div>

  </div>
  <!-- /.row -->

  <div class="row">

      <div class="col-lg-12">

        <div class="panel panel-default">

          <div class="titulohead">

            <div class="row">
              <div class="col-md-6">
                  <div class="titleprincipal"><h4>Registro de Estudiantes - <?php echo $proyectoMGen[0]["nombre"] ?></h4></div>
              </div>
              <div class="col-md-6 text-right">
                 <button id="btn_nuevoestudiante" type="button" class="btn btn-primary botonnewgrupo" data-toggle="modal" data-target="#frm_modal_estudiante" <?php if ($crea != 1) {echo 'disabled="disabled"';}?> ><span class="glyphicon glyphicon-plus"></span> Nuevo Estudiante</button>
              </div>
            </div>

          </div>
          <!-- /.panel-heading -->

        <div class="panel-body">

          <div class="dataTable_wrapper">
              <table class="display table table-striped table-bordered table-hover" id="tbl_estudiantes">
                  <thead>
                      <tr>
                          <!--<th>ID usuario</th>-->
                          <th>Nombres</th>
                          <th>Documento</th>
                          <th>Grado</th>

                          <th data-orderable="false">Opciones</th>
                      </tr>
                  </thead>

                  <tbody>
                      <?php
$estudiantesInst->getTablaEstudiantes($pkID_proyectoM);
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

