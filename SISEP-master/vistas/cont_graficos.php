<?php

include '../controller/graficoController.php';

include '../conexion/datos.php';

$docentesInst  = new graficoController();
$arrPermisosD  = $docentesInst->getPermisosModulo_Tipo($id_modulo, $_COOKIE[$NomCookiesApp . '_IDtipo']);
$creaD         = $arrPermisosD[0]['crear'];
$id_indicador  = $_GET["id_indicador"];
$cumplimiento1 = $_GET["cumplimiento1"];
$cumplimiento2 = $_GET["cumplimiento2"];
$cumplimiento3 = $_GET["cumplimiento3"];
$cumplimiento4 = $_GET["cumplimiento4"];

include 'form_docentes.php';
?>

<div id="page-wrapper" style="margin: 0px;">

  <div class="row">

      <div class="col-lg-12">
          <h2 class="page-header titleprincipal"><img src="../img/botones/docentesonly.png"><?php echo $proyectoMGen[0]["nombre"] ?> - Grafica</h2>
      </div>
      <!-- /.col-lg-12 -->
      <div class="col-lg-12">
        <ol class="breadcrumb migadepan">
          <li><a href="proyecto_marco.php" class="migadepan">Inicio</a></li>
          <li><a href="reportes.php?id_proyectoM=<?php echo $pkID_proyectoM; ?>" class="migadepan">Reportes</a></li>
          <li class="active migadepan"> Grafica</li>
        </ol>
      </div>

  </div>
  <!-- /.row -->

  <div class="row">

      <div class="col-lg-12">

        <div class="panel panel-default">

        <input type="hidden" id="id_indicador" value="<?php echo $id_indicador ?>">
        <input type="hidden" id="cumplimiento1" value="<?php echo $cumplimiento1 ?>">
        <input type="hidden" id="cumplimiento2" value="<?php echo $cumplimiento2 ?>">
        <input type="hidden" id="cumplimiento3" value="<?php echo $cumplimiento3 ?>">
        <input type="hidden" id="cumplimiento4" value="<?php echo $cumplimiento4 ?>">

        <div class="panel-body">
          <div class="col-sm-12 panel panel-default text-center">
                <h3><strong>Grafica</strong></h3><br>
                    <div id="container" style="min-width: 310px; height: 400px; margin: 0 auto">
        </div>
              </div>
        <script src="https://code.highcharts.com/highcharts.js">
        </script>
        <script src="https://code.highcharts.com/modules/exporting.js">
        </script>
        <script src="https://code.highcharts.com/modules/export-data.js">
        </script>
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
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