<?php

include '../controller/aibdController.php';
include '../conexion/datos.php';

$detalles_aibdInst = new aibdController();
$arrPermisos       = $detalles_aibdInst->getPermisosModulo_Tipo($id_modulo, $_COOKIE[$NomCookiesApp . '_IDtipo']);
$crea              = $arrPermisos[0]['crear'];
$pkID_proyectoM    = $_GET["id_proyectoM"];
$creap             = $arrPermisosp[0]['crear'];
$proyectoMGen      = $detalles_aibdInst->getProyectosMarcoGrupo($pkID_proyectoM);
//++++++++++++++++++++++++++++++++++
include 'form_aibd.php';
include 'form_documentos_aibd.php';
include 'form_fotos_aibd.php';
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
          <h1 class="page-header titleprincipal"><img src="../img/botones/aibdonly.png"> AIBD (Aula Investigación Básica Departamental) - <?php echo $proyectoMGen[0]["nombre_proyecto"] ?></h1>
      </div>
      <!-- /.col-lg-12 -->

    <div class="col-md-9">
          <ol class="breadcrumb migadepan">
            <li><a href="proyecto_marco.php" class="migadepan">Inicio</a></li>
            <li><a href="descripcion.php?id_proyectoM=<?php echo $pkID_proyectoM; ?>" class="migadepan">Descripción</a></li>
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
          <li id="li_proyectos" role="presentation"><a href="#proyectos" aria-controls="documentos" role="tab" data-toggle="tab">General</a></li>
          <li id="li_documentos" role="presentation"><a href="#documentos" aria-controls="documentos" role="tab" data-toggle="tab">Documentos</a></li>
          <li id="li_album" role="presentation"><a href="#album" aria-controls="documentos" role="tab" data-toggle="tab">Galeria</a></li>
      </ul>

      <div class="tab-content">

      <div role="tabpanel" class="tab-pane active" id="proyectos">
        <br>
        <!-- contenido general -->
        <br>
        <!-- contenido general -->
        <div class="panel panel-default proc-pan-def3">

          <div class="panel-body">

            <div class="col-md-12">
              <!-- instancia php controller -->
              <?php $detalles_aibdInst->getDataProyectoGen($pkID_proyectoM);?>
            </div>
            <div class="col-md-12" hidden="true">
              <input type="text" id="grupo_id" value=<?php echo $pkID_grupo; ?>>
              <input type="text" id="grado_grupo" value=<?php echo $pkID_grado; ?>>
              <input type="text" id="institucion_grupo" value=<?php echo $pkID_institucion; ?>>
            </div>
          </div>

        </div>
        <!-- /.contenido general -->

      </div>

      <div role="tabpanel" class="tab-pane" id="documentos">
        <br>
        <!-- contenido general -->
        <div class="panel panel-default proc-pan-def3">

          <div class="titulohead">

                  <div class="row">
                    <div class="col-md-6">
                        <div class="titleprincipal"><h4>Documentos AIBD (Aula Investigación Básica Departamental) - <?php echo $proyectoMGen[0]["nombre_proyecto"] ?></h4></div>
                    </div>
                    <div class="col-md-6 text-right">
                   <button id="btn_documento" type="button" class="btn btn-primary botonnewgrupo" data-toggle="modal"  data-id-proyecto="<?php echo $pkID_proyectoM ?>" data-target="#frm_modal_documento" <?php if (($crea != 1) || ($ne >= 30)) {echo 'disabled="disabled"';}?> ><span class="glyphicon glyphicon-plus"></span> Crear Documento</button>
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
                                  <th>Documento</th>
                                  <th data-orderable="false">Opciones</th>
                              </tr>
                          </thead>

                          <tbody>
                              <?php $detalles_aibdInst->getTablaDocumentos($pkID_proyectoM);?>
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
                        <div class="titleprincipal"><h4>Galeria de fotos - <?php echo $proyectoMGen[0]["nombre_proyecto"] ?></h4></div>
                    </div>
                    <div class="col-md-6 text-right">
                   <button id="btn_nuevafoto" type="button" class="btn btn-primary botonnewgrupo" data-toggle="modal"  data-aibd="<?php echo $pkID_proyectoM ?>" data-target="#frm_modal_foto_aibd" ><span class="glyphicon glyphicon-plus"></span>
                   Nueva Foto</button>

                   <div class="form-group " hidden>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="pkID_grup" name="pkID_grup" value=<?php echo $pkID_grupo; ?>>
                        </div>
                    </div>
                    </div>
                  </div>

                </div>
                <!-- /.panel-heading -->

          <div class="panel-body">

            <div class="col-md-12">
               <div class='container' id="fotos">
    <div class="row">
      <div class="col-lg-12">
      <?php
$nums  = 1;
$fotos = $detalles_aibdInst->getFotosAibd($pkID_proyectoM);
if ($fotos[0]["pkID"] != "") {
    for ($a = 0; $a < sizeof($fotos); $a++) {
        ?>

          <div class="col-lg-3 col-md-4 col-xs-6 thumb">
            <a class="thumbnail" href="../img/<?php echo $fotos[$a]["url_foto"]; ?>" data-lightbox="fotos_taller" data-title="<?php echo $fotos[$a]["descripcion"]; ?>"><img class="img-responsive" style="height: 200px" src="../img/<?php echo $fotos[$a]["url_foto"]; ?>" alt="" /><br>
            <div class="col-md-12 text-center"><button id="btn_elimina_foto" title="Eliminar" name="elimina_foto" type="button" class="btn btn-danger text center" data-id-foto = "<?php echo $fotos[$a]["pkID"]; ?>";
           ><span class="glyphicon glyphicon-remove"></span></button></div><br><br>

           </a>

          </div>
          <?php

        if ($nums % 4 == 0) {
            echo '<div class="clearfix"></div>';
        }
        $nums++;
    }
} else {
    echo '<div class="col-md-12 text-center">
            <h3>No Existen Fotos en este Álbum</h3>
            </div>';
}
?>

      </div>

    </div>
  </div>
                  </div>
                  <!-- /.table-responsive -->
            </div>

          </div>

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