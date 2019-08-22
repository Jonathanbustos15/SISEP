<?php

include '../controller/tiexController.php';
include '../controller/estudiantesController.php';
include '../conexion/datos.php';

$detalles_tiexInst = new tiexController();
$arrPermisos       = $detalles_tiexInst->getPermisosModulo_Tipo($id_modulo, $_COOKIE[$NomCookiesApp . '_IDtipo']);
$crea              = $arrPermisos[0]['crear'];
$pkID_tiex         = $_GET["id_tiex"];
$proyectoMGen      = $detalles_tiexInst->getProyectosMarcoGrupo($pkID_tiex);
$pkID_proyectoM    = $proyectoMGen[0]["fkID_proyecto_marco"];
//++++++++++++++++++++++++++++++++++
$estudiantesInst = new estudiantesController();
//++++++++++++++++++++++++++++++++++
include 'form_tiex_estudiante.php';
include 'form_tiex_sesion.php';
include 'form_estudiantes.php';
include 'form_album_tiex.php';
//++++++++++++++++++++++++++++++++++
?>

<div id="page-wrapper" style="margin: 0px;">

  <div class="row">
     <!-- Campo que contiene el valor del id del modulo para auditoria con el nombre del modulo-->
      <input type="hidden" id="id_mod_page_proyecto" value=<?php echo $id_modulo ?>>
      <input type="hidden" id="id_mod_page_docente" value=<?php echo $id_modulo ?>>
      <input type="hidden" id="id_mod_page_estudiante" value=<?php echo $id_modulo ?>>
      <div class="col-lg-12">
          <h1 class="page-header titleprincipal"><img src="../img/botones/grupoonly.png">Detalle TIEX - <?php echo $proyectoMGen[0]["nombre_proyecto"] ?></h1>
      </div>
      <!-- /.col-lg-12 -->

    <div class="col-md-9">
          <ol class="breadcrumb migadepan">
            <li><a href="proyecto_marco.php" class="migadepan">Inicio</a></li>
            <li><a href="principal.php?id_proyectoM=<?php echo $pkID_proyectoM; ?>" class="migadepan">Menú principal</a></li>
            <li><a href="cientifico.php?id_proyectoM=<?php echo $pkID_proyectoM; ?>" class="migadepan">Científico</a></li>
            <li><a href="tiex.php?id_proyectoM=<?php echo $pkID_proyectoM; ?>" class="migadepan">TIEX</a></li>
            <li class="active migadepan">Detalle TIEX - <?php echo $proyectoMGen[0]["nombre_proyecto"] ?> </li>
          </ol>
    </div>

  </div>
  <!-- /.row -->

  <div class="row">

      <div class="col-lg-12">

        <!-- Nav tabs -->
        <ul class="nav nav-tabs tabs-proc3" role="tablist">
          <li id="li_estudiantes" role="presentation"><a href="#estudiantes" aria-controls="estudiantes" role="tab" data-toggle="tab">Estudiantes</a></li>
          <li id="li_sesiones" role="presentation"><a href="#sesiones" aria-controls="estudiantes" role="tab" data-toggle="tab">Sesiones</a></li>
          <li id="li_album" role="presentation"><a href="#album" aria-controls="estudiantes" role="tab" data-toggle="tab">Galeria</a></li>
      </ul>

      <div class="tab-content">

      <div role="tabpanel" class="tab-pane active" id="estudiantes">
        <br>
        <!-- contenido general -->
        <div class="panel panel-default proc-pan-def3">

          <div class="titulohead">

                  <div class="row">
                    <div class="col-md-6">
                        <div class="titleprincipal"><h4>Estudiantes Asignados -   Detalle TIEX - <?php echo $proyectoMGen[0]["nombre_proyecto"] ?></h4></div>
                    </div>
                    <div class="col-md-6 text-right">
                   <button id="btn_tiex_estudiante" type="button" class="btn btn-primary botonnewgrupo" data-toggle="modal"  data-tiex="<?php echo $pkID_tiex ?>" data-target="#frm_modal_tiex_estudiante" <?php if ($crea != 1) {echo 'disabled="disabled"';}?> ><span class="glyphicon glyphicon-plus"></span> Asignar Estudiante</button>
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
                                  <th>Nombres</th>
                                  <th>Apellidos</th>
                                  <th>Documento</th>
                                  <th>Grado</th>
                                  <th data-orderable="false">Opciones</th>
                              </tr>
                          </thead>

                          <tbody>
                            <?php $detalles_tiexInst->getTablaTiexEstudiantes($pkID_tiex);?>
                          </tbody>
                      </table>
                  </div>
                  <!-- /.table-responsive -->
            </div>

          </div>

        </div>
        <!-- /.contenido general -->

      </div>

      <div role="tabpanel" class="tab-pane" id="sesiones">
        <br>
        <!-- contenido general -->
        <div class="panel panel-default proc-pan-def3">

          <div class="titulohead">

                  <div class="row">
                    <div class="col-md-6">
                        <div class="titleprincipal"><h4>Sesiones del Taller</h4></div>
                    </div>
                    <div class="col-md-6 text-right">
                   <button id="btn_nuevosesion" type="button" class="btn btn-primary botonnewgrupo" data-toggle="modal"  data-tiex="<?php echo $pkID_tiex ?>" data-target="#frm_modal_tiex_sesion"><span class="glyphicon glyphicon-plus"></span> Crear Sesion</button>
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
                                  <th>Descripción</th>
                                  <th>Lista de Asistencia</th>
                                  <th data-orderable="false">Opciones</th>
                              </tr>
                          </thead>

                          <tbody>
                              <?php $detalles_tiexInst->getTablasesiones($pkID_tiex);?>
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
                        <div class="titleprincipal"><h4>Galeria de Álbumes</h4></div>
                    </div>
                    <div class="col-md-6 text-right">
                   <button id="btn_album_tiex" type="button" class="btn btn-primary botonnewgrupo" data-toggle="modal"  data-biotecnologia="<?php echo $pkID_tiex ?>" data-target="#frm_modal_album_tiex"><span class="glyphicon glyphicon-plus"></span> 
                   Crear album</button>  

                   <div class="form-group " hidden>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="pkID_grup" name="pkID_grup" value=<?php echo $pkID_tiex; ?>>
                        </div>
                    </div>
                    </div>
                  </div>

                </div>
                <br><br>
                <!-- /.panel-heading -->

          <div class="container-fluid">
            <div class="row">
              <?php
                $detalles_tiexInst->getSelectAlbumTiex($pkID_tiex);
              ?>

            
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
                        <div class="titleprincipal"><h4>Asistencia TIEX - <?php echo $proyectoMGen[0]["nombre_proyecto"] ?></h4></div>
                    </div>
                    <div class="col-md-6 text-right">
                   <button id="btn_asistencia" type="button" class="btn btn-primary botonnewgrupo" data-toggle="modal"  data-acompanamiento="<?php echo $pkID_tiex ?>" data-target="#frm_modal_asistencia" <?php if (($creaeg != 1) || ($ne >= 30)) {echo 'disabled="disabled"';}?> ><span class="glyphicon glyphicon-plus"></span> Crear asistencia</button>
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
$detalles_tiexInst->getTablaAsistencia($pkID_tiex);
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