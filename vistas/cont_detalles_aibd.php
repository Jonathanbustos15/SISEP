<?php

include '../controller/aibdController.php';
include '../conexion/datos.php';

$detalles_aibdInst = new aibdController();
$arrPermisos       = $detalles_aibdInst->getPermisosModulo_Tipo($id_modulo, $_COOKIE[$NomCookiesApp . '_IDtipo']);
$crea              = $arrPermisos[0]['crear'];
$pkID_aibd         = $_GET["id_aibd"];
$creap             = $arrPermisosp[0]['crear'];
$proyectoMGen      = $detalles_aibdInst->getProyectosMarcoGrupo($pkID_aibd);
$pkID_proyectoM    = $proyectoMGen[0]["fkID_proyecto_marco"];
//++++++++++++++++++++++++++++++++++
include 'form_inventario.php';
//include 'form_asistencia.php';
//++++++++++++++++++++++++++++++++++
?>

<div class="form-group " hidden>
    <div class="col-sm-10">
        <input type="text" class="form-control" id="grupo" name="grupo" value=<?php echo $pkID_aibd; ?>>
    </div>
</div>

<div class="form-group " hidden>
    <div class="col-sm-10">
        <input type="text" class="form-control" id="estado" name="estado" value=<?php echo $estadoG; ?>>
    </div>
</div>

<div class="form-group " hidden>
    <div class="col-sm-10">
        <input type="text" class="form-control" id="fecha" name="fecha" value=<?php echo date("Y-m-d"); ?>>
    </div>
</div>

<div class="form-group " hidden>
    <div class="col-sm-10">
        <input type="text" class="form-control" id="modulo" name="modulo" value=<?php echo $id_modulo; ?>>
    </div>
</div>

<div id="page-wrapper" style="margin: 0px;">

  <div class="row">
     <!-- Campo que contiene el valor del id del modulo para auditoria con el nombre del modulo-->
      <input type="hidden" id="id_mod_page_proyecto" value=<?php echo $id_modulo ?>>

      <input type="hidden" id="id_mod_page_docente" value=<?php echo $id_modulo ?>>

      <input type="hidden" id="id_mod_page_estudiante" value=<?php echo $id_modulo ?>>

      <div class="col-lg-12">
          <h1 class="page-header titleprincipal"><img src="../img/botones/grupoonly.png">AIBD (Aula Investigación Básica Departamental) - <?php echo $proyectoMGen[0]["nombre_proyecto"] ?></h1>
      </div>
      <!-- /.col-lg-12 -->

    <div class="col-md-9">
          <ol class="breadcrumb migadepan">
            <li><a href="proyecto_marco.php" class="migadepan">Inicio</a></li>
            <li><a href="principal.php?id_proyectoM=<?php echo $pkID_proyectoM; ?>" class="migadepan">Menú principal</a></li>
            <li><a href="cientifico.php?id_proyectoM=<?php echo $pkID_proyectoM; ?>" class="migadepan">Científico</a></li>
            <li><a href="aibd.php?id_proyectoM=<?php echo $pkID_proyectoM; ?>" class="migadepan">AIBD</a></li>
            <li class="active migadepan">Detalle AIBD (Aula Investigación Básica Departamental) - <?php echo $proyectoMGen[0]["nombre_proyecto"] ?> </li>
          </ol>
    </div>

  </div>
  <!-- /.row -->

  <div class="row">

      <div class="col-lg-12">

        <!-- Nav tabs -->
        <ul class="nav nav-tabs tabs-proc3" role="tablist">
          <li id="li_inventario" role="presentation"><a href="#inventario" aria-controls="inventario" role="tab" data-toggle="tab">Inventario</a></li>
          <li id="li_album" role="presentation"><a href="#album" aria-controls="inventario" role="tab" data-toggle="tab">Galeria</a></li>
      </ul>

      <div class="tab-content">

      <div role="tabpanel" class="tab-pane active" id="inventario">
        <br>
        <!-- contenido general -->
        <div class="panel panel-default proc-pan-def3">

          <div class="titulohead">

                  <div class="row">
                    <div class="col-md-6">
                        <div class="titleprincipal"><h4>Inventario AIBD (Aula Investigación Básica Departamental) - <?php echo $proyectoMGen[0]["nombre_proyecto"] ?></h4></div>
                    </div>
                    <div class="col-md-6 text-right">
                   <button id="btn_inventario" type="button" class="btn btn-primary botonnewgrupo" data-toggle="modal"  data-id-aibd="<?php echo $pkID_aibd ?>" data-target="#frm_modal_inventario" <?php if (($crea != 1) || ($ne >= 30)) {echo 'disabled="disabled"';}?> ><span class="glyphicon glyphicon-plus"></span> Crear Inventario</button>
                    </div>
                  </div>

                </div>
                <!-- /.panel-heading -->

          <div class="panel-body">

            <div class="col-md-12">
              <div class="dataTable_wrapper">
                      <table class="display table table-striped table-bordered table-hover" id="tbl_grupo_estudiante">
                          <thead>
                              <tr>
                                  <th>Fecha</th>
                                  <th>Nombre</th>
                                  <th>Cantidad</th>
                                  <th data-orderable="false">Opciones</th>
                              </tr>
                          </thead>

                          <tbody>
                              <?php
$detalles_aibdInst->getTablaInventario($pkID_aibd);
?>
                          </tbody>
                      </table>
                  </div>
                  <!-- /.table-responsive -->
            </div>

          </div>

        </div>
        <!-- /.contenido general -->

      </div>

      <div role="tabpanel" class="tab-pane" id="album">
        <br>
        <!-- contenido general -->

        <div class="panel panel-default proc-pan-def3">

          <div class="titulohead">

                  <div class="row">
                    <div class="col-md-6">
                        <div class="titleprincipal"><h4>Galeria de fotos - <?php echo $proyectoMGen[0]["nombre"] . ' - ' . $proyectoMGen[0]["nombre_proyecto"] ?></h4></div>
                    </div>
                    <div class="col-md-6 text-right">
                   <button id="btn_album_grupo" type="button" class="btn btn-primary botonnewgrupo" data-toggle="modal"  data-grupo="<?php echo $pkID_aibd ?>" data-target="#frm_modal_album_grupo" <?php if (($crea != 1) || ($ne >= 30)) {echo 'disabled="disabled"';}?> ><span class="glyphicon glyphicon-plus"></span>
                   Crear album</button>

                   <div class="form-group " hidden>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="pkID_grup" name="pkID_grup" value=<?php echo $pkID_aibd; ?>>
                        </div>
                    </div>
                    </div>
                  </div>

                </div>
                <!-- /.panel-heading -->

          <div class="panel-body">

            <div class="col-md-12">
              <div class="dataTable_wrapper">
                      <table class="display table table-striped table-bordered table-hover" id="tbl_grupo_album">
                          <thead>
                              <tr>
                                  <th>Nombre</th>
                                  <th>Fecha de Creación</th>
                                  <th>Observación</th>
                                  <th data-orderable="false">Opciones</th>
                              </tr>
                          </thead>

                          <tbody>
                              <?php
$detalles_aibdInst->getTablaAlbumGrupo($pkID_aibd);
?>
                          </tbody>
                      </table>
                  </div>
                  <!-- /.table-responsive -->
            </div>

          </div>

        </div>

        <!-- /.contenido general -->

      </div>


      <div role="tabpanel" class="tab-pane" id="asistencia">
        <br>
        <!-- contenido general -->
        <div class="panel panel-default proc-pan-def3">

          <div class="titulohead">

                  <div class="row">
                    <div class="col-md-6">
                        <div class="titleprincipal"><h4>Asistencia AIBD (Aula Investigación Básica Departamental) - <?php echo $proyectoMGen[0]["nombre_proyecto"] ?></h4></div>
                    </div>
                    <div class="col-md-6 text-right">
                   <button id="btn_asistencia" type="button" class="btn btn-primary botonnewgrupo" data-toggle="modal"  data-acompanamiento="<?php echo $pkID_aibd ?>" data-target="#frm_modal_asistencia" <?php if (($creaeg != 1) || ($ne >= 30)) {echo 'disabled="disabled"';}?> ><span class="glyphicon glyphicon-plus"></span> Crear asistencia</button>
                    </div>
                  </div>

                </div>
                <!-- /.panel-heading -->

          <div class="panel-body">

            <div class="col-md-12">
              <div class="dataTable_wrapper">
                      <table class="display table table-striped table-bordered table-hover" id="tbl_grupo_estudiante">
                          <thead>
                              <tr>
                                  <th>Fecha</th>
                                  <th>Documento</th>
                                  <th data-orderable="false">Opciones</th>
                              </tr>
                          </thead>

                          <tbody>
                              <?php
$detalles_aibdInst->getTablaAsistencia($pkID_aibd);
?>
                          </tbody>
                      </table>
                  </div>
                  <!-- /.table-responsive -->
            </div>

          </div>

        </div>
        <!-- /.contenido general -->


      </div>

      </div>
      <!-- /.col-lg-12 -->

    </div>
    <!-- /.row -->

</div>
<!-- /#page-wrapper -->