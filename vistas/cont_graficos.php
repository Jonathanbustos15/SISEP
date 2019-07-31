<?php

include '../controller/docentesController.php';

include '../conexion/datos.php';

$docentesInst   = new docentesController();
$arrPermisosD   = $docentesInst->getPermisosModulo_Tipo($id_modulo, $_COOKIE[$NomCookiesApp . '_IDtipo']);
$creaD          = $arrPermisosD[0]['crear'];
$pkID_proyectoM = $_GET["id_proyectoM"];
$proyectoMGen   = $docentesInst->getProyectosMarcoId($pkID_proyectoM);

include 'form_docentes.php';
?>

<div id="page-wrapper" style="margin: 0px;">

  <div class="row">

      <div class="col-lg-12">
          <h2 class="page-header titleprincipal"><img src="../img/botones/docentesonly.png"><?php echo $proyectoMGen[0]["nombre"] ?> - Graficos</h2>
      </div>
      <!-- /.col-lg-12 -->
      <div class="col-lg-12">
        <ol class="breadcrumb migadepan">
          <li><a href="proyecto_marco.php" class="migadepan">Inicio</a></li>
          <li class="active migadepan"> Graficos </li>
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
                  <div class="titleprincipal"><h4>Graficos - <?php echo $proyectoMGen[0]["nombre"] ?></h4></div>
              </div>
              <div class="col-md-6 text-right">
              </div>
            </div>

          </div>

        <div class="panel-body">
          <div class="col-sm-12 panel panel-default">
                <h3><strong>Graficos</strong></h3><br>
                  <div class=""><h4>Niños, niñas y jóvenes participantes del Programa Ondas</h4></div>
                    <div id="container" style="min-width: 310px; height: 400px; margin: 0 auto">
        </div>
              </div>
        <script src="https://code.highcharts.com/highcharts.js">
        </script>
        <script src="https://code.highcharts.com/modules/exporting.js">
        </script>
        <script src="https://code.highcharts.com/modules/export-data.js">
        </script>
        <script src="../js/index.js">
        </script>


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