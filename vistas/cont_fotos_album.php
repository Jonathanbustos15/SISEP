<?php

include '../controller/docentesController.php';

include '../conexion/datos.php';

$docentesInst = new docentesController();

$arrPermisosD = $docentesInst->getPermisosModulo_Tipo($id_modulo, $_COOKIE[$NomCookiesApp . '_IDtipo']);

$creaD = $arrPermisosD[0]['crear'];

$pkID_proyectoM = $_GET["id_proyectoM"];
$proyectoMGen   = $docentesInst->getProyectosMarcoId($pkID_proyectoM);


?>

<div id="page-wrapper" style="margin: 0px;">

  <div class="row">

      <div class="col-lg-12">
          <h2 class="page-header titleprincipal"><img src="../img/botones/docentesonly.png"> Fotos</h2>
      </div>


  </div>
  <!-- /.row -->

  <div class="row">

      <div class="col-lg-12">

        <div class="panel panel-default">

          <div class="titulohead">

            <div class="row">
              <div class="col-md-6">
                  <div class="titleprincipal"><h4>Registro de Fotos </h4></div>
              </div>
              <div class="col-md-6 text-right">
                 <button id="btn_nuevodocente" type="button" class="btn btn-primary botonnewgrupo" data-toggle="modal" data-target="#frm_modal_docente" <?php if ($creaD != 1) {echo 'disabled="disabled"';}?> ><span class="glyphicon glyphicon-plus"></span> Nueva Foto</button>
              </div>
            </div>

          </div>
          <!-- /.panel-heading -->

        <div class="panel-body">
          <div class="col-12 pt-0 alert alert-info text-center">

                  <div class="titleprincipal"><h4>Objetivo 1 </h4></div>
              </div>
            <div class="col-sm-2 panel panel-default mt-0">
            <h4>01 - A1 </h4>
              </div>
          <div class="col-sm-10 panel panel-default mt-0">
                  <div class=""><h4>Formación, acompañamiento y seguimiento de grupos Ondas. </h4></div>
              </div>
          <div class="col-sm-2 panel panel-default mt-0">
            <h4>01 - A2 </h4>
              </div>
          <div class="col-sm-10 panel panel-default mt-0">
                  <div class=""><h4>Entrenamiento en saberes propios en Ciencia e Innovación</h4></div>
              </div>
          <div class="col-sm-2 panel panel-default mt-0">
            <h4>01 - A3 </h4>
              </div>
          <div class="col-sm-10 panel panel-default mt-0">
                  <div class=""><h4>Fortalecimiento del pensamiento cientifico a tráves de Talleres de Investigación Experimental en el Aula </h4></div>
              </div>
          <div class="col-sm-2 panel panel-default mt-0">
            <h4>01 - A4 </h4>
              </div>
          <div class="col-sm-10 panel panel-default mt-0">
                  <div class=""><h4>Formación, Apropiación social, y producción de saber y conocimiento para maestros apoyada en las TIC  </h4></div>
              </div>
          <div class="col-sm-2 panel panel-default mt-0">
            <h4>01 - A5 </h4>
              </div>
          <div class="col-sm-10 panel panel-default mt-0">
                  <div class=""><h4>Diseño, implementación y Operación de la comunidad Virtual Ondas Guainía </h4></div>
              </div>
          <div class="col-sm-2 panel panel-default mt-0">
            <h4>01 - A6 </h4>
              </div>
          <div class="col-sm-10 panel panel-default mt-0">
                  <div class=""><h4>Diseño, implementación y operación de un Sistema de información, seguimiento y evaluación permanente - SISEP </h4></div>
              </div>
          


      
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
