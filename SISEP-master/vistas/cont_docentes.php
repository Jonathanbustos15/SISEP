<?php

include '../controller/docentesController.php';

include '../conexion/datos.php';

$docentesInst = new docentesController();

$arrPermisosD = $docentesInst->getPermisosModulo_Tipo($id_modulo, $_COOKIE[$NomCookiesApp . '_IDtipo']);

$creaD = $arrPermisosD[0]['crear'];

$pkID_proyectoM = $_GET["id_proyectoM"];
$proyectoMGen   = $docentesInst->getProyectosMarcoId($pkID_proyectoM);

include 'form_docentes.php';

?>

<div id="page-wrapper" style="margin: 0px;">

  <div class="row">

      <div class="col-lg-12">
          <h2 class="page-header titleprincipal"><img src="../img/botones/docentesonly.png"><?php echo $proyectoMGen[0]["nombre"] ?> - Docentes</h2>
      </div>
      <!-- /.col-lg-12 -->
      <div class="col-lg-12">
        <ol class="breadcrumb migadepan">
          <li><a href="proyecto_marco.php" class="migadepan">Inicio</a></li>
          <li><a href="descripcion.php?id_proyectoM=<?php echo $pkID_proyectoM; ?>" class="migadepan">Descripción</a></li>
          <li><a href="principal.php?id_proyectoM=<?php echo $pkID_proyectoM; ?>" class="migadepan">Menú principal</a></li>
          <li><a href="configuracion.php?id_proyectoM=<?php echo $pkID_proyectoM; ?>" class="migadepan">Configuración</a></li>
          <li class="active migadepan"> Docentes </li>
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
                  <div class="titleprincipal"><h4>Registro de Docentes - <?php echo $proyectoMGen[0]["nombre"] ?></h4></div>
              </div>
              <div class="col-md-6 text-right">
                 <button id="btn_nuevodocente" type="button" class="btn btn-primary botonnewgrupo" data-toggle="modal" data-target="#frm_modal_docente" <?php if ($creaD != 1) {echo 'disabled="disabled"';}?> ><span class="glyphicon glyphicon-plus"></span> Nuevo Docente</button>
              </div>
            </div>

          </div>
          <!-- /.panel-heading -->

        <div class="panel-body">

          <div class="dataTable_wrapper">
              <table class="display table table-striped table-bordered table-hover" id="tbl_docentes">
                  <thead>
                      <tr>
                          <!--<th>ID usuario</th>-->
                          <th>Nombres</th>
                          <th>Documento</th>
                          <th>Institución</th>
                          <th>Correo</th>

                          <th data-orderable="false">Opciones</th>
                      </tr>
                  </thead>

                  <tbody>
                      <?php
$docentesInst->getTablaDocentes($pkID_proyectoM);
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
