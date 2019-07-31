<?php

include '../controller/aulasController.php';
include '../conexion/datos.php';

$detalles_aulasInst = new aulasController();
$arrPermisos        = $detalles_aulasInst->getPermisosModulo_Tipo($id_modulo, $_COOKIE[$NomCookiesApp . '_IDtipo']);
$crea               = $arrPermisos[0]['crear'];
$pkID_aulas         = $_GET["id_aulas"];
$proyectoMGen       = $detalles_aulasInst->getProyectosMarcoGrupo($pkID_aulas);
$pkID_proyectoM     = $proyectoMGen[0]["fkID_proyecto_marco"];
//++++++++++++++++++++++++++++++++++
include 'form_aulas_tecnologia.php';
include 'form_aulas_cientifico.php';
include 'form_aulas_wifi.php';
include 'form_aulas_actas.php';
include 'form_album_aula.php';
//++++++++++++++++++++++++++++++++++
?>

<div id="page-wrapper" style="margin: 0px;">

  <div class="row">
     <!-- Campo que contiene el valor del id del modulo para auditoria con el nombre del modulo-->
      <input type="hidden" id="id_mod_page_proyecto" value=<?php echo $id_modulo ?>>
      <input type="hidden" id="id_mod_page_docente" value=<?php echo $id_modulo ?>>
      <input type="hidden" id="id_mod_page_estudiante" value=<?php echo $id_modulo ?>>
      <div class="col-lg-12">
          <h1 class="page-header titleprincipal"><img src="../img/botones/grupoonly.png">Detalle aulas - <?php echo $proyectoMGen[0]["nombre_proyecto"] ?></h1>
      </div>
      <!-- /.col-lg-12 -->

    <div class="col-md-9">
          <ol class="breadcrumb migadepan">
            <li><a href="proyecto_marco.php" class="migadepan">Inicio</a></li>
            <li><a href="principal.php?id_proyectoM=<?php echo $pkID_proyectoM; ?>" class="migadepan">Menú principal</a></li>
            <li><a href="cientifico.php?id_proyectoM=<?php echo $pkID_proyectoM; ?>" class="migadepan">Científico</a></li>
            <li><a href="aulas.php?id_proyectoM=<?php echo $pkID_proyectoM; ?>" class="migadepan">Aulas</a></li>
            <li class="active migadepan">Detalle aulas - <?php echo $proyectoMGen[0]["nombre_proyecto"] ?> </li>
          </ol>
    </div>

  </div>
  <!-- /.row -->

  <div class="row">

      <div class="col-lg-12">

        <!-- Nav tabs -->
        <ul class="nav nav-tabs tabs-proc3" role="tablist">
          <li id="li_general" role="presentation"><a href="#general" aria-controls="general" role="tab" data-toggle="tab">General</a></li>
          <li id="li_tecnologia" role="presentation"><a href="#tecnologia" aria-controls="general" role="tab" data-toggle="tab">Inventario Tecnología</a></li>
          <li id="li_cientifico" role="presentation"><a href="#cientifico" aria-controls="general" role="tab" data-toggle="tab">Inventario Cientifico</a></li>
          <li id="li_wifi" role="presentation"><a href="#wifi" aria-controls="general" role="tab" data-toggle="tab">Inventario Wifi</a></li>
          <li id="li_actas" role="presentation"><a href="#actas" aria-controls="estudiantes" role="tab" data-toggle="tab">Actas</a></li>
          <li id="li_album" role="presentation"><a href="#album" aria-controls="general" role="tab" data-toggle="tab">Galeria</a></li>
      </ul>

      <div class="tab-content">

      <div role="tabpanel" class="tab-pane active" id="general">
        <br>
        <!-- contenido general -->
        <div class="panel panel-default proc-pan-def3">

          <div class="panel-body">

            <div class="col-md-12">
              <!-- instanciFa php controller -->
              <?php $detalles_aulasInst->getTablaGeneral($pkID_aulas);?>
            </div>

          </div>

        </div>
        <!-- /.contenido general -->

      </div>

      <div role="tabpanel" class="tab-pane" id="tecnologia">
        <br>
        <!-- contenido general -->
        <div class="panel panel-default proc-pan-def3">

          <div class="titulohead">

                  <div class="row">
                    <div class="col-md-6">
                        <div class="titleprincipal"><h4>Inventario Tecnología -   Detalle aulas - <?php echo $proyectoMGen[0]["nombre_proyecto"] ?></h4></div>
                    </div>
                    <div class="col-md-6 text-right">
                   <button id="btn_aulas_tecnologia" type="button" class="btn btn-primary botonnewgrupo" data-toggle="modal"  data-aulas="<?php echo $pkID_aulas ?>" data-target="#frm_modal_aulas_tecnologia" <?php if ($crea != 1) {echo 'disabled="disabled"';}?> ><span class="glyphicon glyphicon-plus"></span> Crear Inventario Tecnología</button>
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
                                  <th>Nombre</th>
                                  <th>Elemento</th>
                                  <th>Cantidad</th>
                                  <th data-orderable="false">Opciones</th>
                              </tr>
                          </thead>

                          <tbody>
                            <?php $detalles_aulasInst->getTablaTecnologia($pkID_aulas);?>
                          </tbody>
                      </table>
                  </div>
                  <!-- /.table-responsive -->
            </div>

          </div>

        </div>
        <!-- /.contenido general -->

      </div>

      <div role="tabpanel" class="tab-pane" id="cientifico">
        <br>
        <!-- contenido general -->
        <div class="panel panel-default proc-pan-def3">

          <div class="titulohead">

                  <div class="row">
                    <div class="col-md-6">
                        <div class="titleprincipal"><h4>Inventario Cientifico -   Detalle aulas - <?php echo $proyectoMGen[0]["nombre_proyecto"] ?></h4></div>
                    </div>
                    <div class="col-md-6 text-right">
                   <button id="btn_aulas_cientifico" type="button" class="btn btn-primary botonnewgrupo" data-toggle="modal"  data-aulas="<?php echo $pkID_aulas ?>" data-target="#frm_modal_aulas_cientifico" <?php if ($crea != 1) {echo 'disabled="disabled"';}?> ><span class="glyphicon glyphicon-plus"></span> Crear Inventario Cientifico</button>
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
                                  <th>Nombre</th>
                                  <th>Elemento</th>
                                  <th>Cantidad</th>
                                  <th data-orderable="false">Opciones</th>
                              </tr>
                          </thead>

                          <tbody>
                            <?php $detalles_aulasInst->getTablaCientifico($pkID_aulas);?>
                          </tbody>
                      </table>
                  </div>
                  <!-- /.table-responsive -->
            </div>

          </div>

        </div>
        <!-- /.contenido general -->

      </div>

      <div role="tabpanel" class="tab-pane" id="wifi">
        <br>
        <!-- contenido general -->
        <div class="panel panel-default proc-pan-def3">

          <div class="titulohead">

                  <div class="row">
                    <div class="col-md-6">
                        <div class="titleprincipal"><h4>Inventario WIFI -   Detalle aulas - <?php echo $proyectoMGen[0]["nombre_proyecto"] ?></h4></div>
                    </div>
                    <div class="col-md-6 text-right">
                   <button id="btn_aulas_wifi" type="button" class="btn btn-primary botonnewgrupo" data-toggle="modal"  data-aulas="<?php echo $pkID_aulas ?>" data-target="#frm_modal_aulas_wifi" <?php if ($crea != 1) {echo 'disabled="disabled"';}?> ><span class="glyphicon glyphicon-plus"></span> Crear Inventario WIFI</button>
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
                                  <th>Nombre</th>
                                  <th>Elemento</th>
                                  <th>Cantidad</th>
                                  <th data-orderable="false">Opciones</th>
                              </tr>
                          </thead>

                          <tbody>
                            <?php $detalles_aulasInst->getTablaWifi($pkID_aulas);?>
                          </tbody>
                      </table>
                  </div>
                  <!-- /.table-responsive -->
            </div>

          </div>

        </div>
        <!-- /.contenido general -->

      </div>

      <div role="tabpanel" class="tab-pane" id="actas">
        <br>
        <!-- contenido general -->
        <div class="panel panel-default proc-pan-def3">

          <div class="titulohead">

                  <div class="row">
                    <div class="col-md-6">
                        <div class="titleprincipal"><h4>Actas -   Detalle aulas - <?php echo $proyectoMGen[0]["nombre_proyecto"] ?></h4></div>
                    </div>
                    <div class="col-md-6 text-right">
                   <button id="btn_aulas_actas" type="button" class="btn btn-primary botonnewgrupo" data-toggle="modal"  data-aula="<?php echo $pkID_aulas ?>" data-target="#frm_modal_aulas_actas"><span class="glyphicon glyphicon-plus"></span> Crear Acta</button>
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
                              <?php $detalles_aulasInst->getTablaActas($pkID_aulas);?>
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
                   <button id="btn_album_aula" type="button" class="btn btn-primary botonnewgrupo" data-toggle="modal"  data-biotecnologia="<?php echo $pkID_aulas ?>" data-target="#frm_modal_album_aula"><span class="glyphicon glyphicon-plus"></span> 
                   Crear album</button>  

                   <div class="form-group " hidden>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="pkID_grup" name="pkID_grup" value=<?php echo $$pkID_aulas; ?>>
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
                $detalles_aulasInst->getSelectAlbumAula($pkID_aulas);
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
                        <div class="titleprincipal"><h4>Asistencia aulas - <?php echo $proyectoMGen[0]["nombre_proyecto"] ?></h4></div>
                    </div>
                    <div class="col-md-6 text-right">
                   <button id="btn_asistencia" type="button" class="btn btn-primary botonnewgrupo" data-toggle="modal"  data-acompanamiento="<?php echo $pkID_aulas ?>" data-target="#frm_modal_asistencia" <?php if (($creaeg != 1) || ($ne >= 30)) {echo 'disabled="disabled"';}?> ><span class="glyphicon glyphicon-plus"></span> Crear asistencia</button>
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
$detalles_aulasInst->getTablaAsistencia($pkID_aulas);
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