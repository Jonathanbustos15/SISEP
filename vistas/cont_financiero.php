 <?php


include '../controller/financieroController.php';

include '../conexion/datos.php';


$financieroInst = new financieroController;

$arrPermisoss = $financieroInst->getPermisosModulo_Tipo(26, $_COOKIE[$NomCookiesApp . '_IDtipo']);

$creaf = $arrPermisoss[0]['crear'];

$id_modulo =51;  

$tipo_user = $_COOKIE[$NomCookiesApp . '_IDtipo'];

$pkID_proyectoM = $_GET["id_proyectoM"];

$proyectoMGen = $financieroInst->getProyectosMarcoId($pkID_proyectoM);


//++++++++++++++++++++++++++++++++++
include '';
//++++++++++++++++++++++++++++++++++/**/
?>

<div id="container">
<div id="page-wrapper" style="margin: 0px;">

  <div class="row">
     <!-- Campo que contiene el valor del id del modulo para auditoria con el nombre del modulo-->
      <input type="hidden" id="id_mod_page_financiera" value=<?php echo $id_modulo ?>>

      <div class="col-lg-12">
          <h1 class="page-header titleprincipal"><img src="../img/botones/grupoonly.png"><?php echo  $proyectoMGen[0]["nombre"] ?> - Financiero</h1>
      </div>
      <!-- /.col-lg-12 -->

    <div class="col-lg-12">
          <ol class="breadcrumb migadepan">
            <li><a href="proyecto_marco.php" class="migadepan">Inicio</a></li>
            <li><a href="principal.php?id_proyectoM=<?php echo $proyectoMGen[0]["pkID"]; ?>" class="migadepan">Menú principal</a></li>
            <li><a href="" class="migadepan">Financiero</a></li>
          </ol>
    </div>

  </div>
  <!-- /.row -->

  <div class="row">

      <div class="col-lg-12">

        <!-- Nav tabs -->
        <ul class="nav nav-tabs tabs-proc3" role="tablist">
          <li id="" role="presentation"><a href="#general" aria-controls="general" role="tab" data-toggle="tab">General</a></li>
            <li id="li_detalle_financiero" role="presentation"><a href="#detalle_financiero" aria-controls="general" role="tab" data-toggle="tab">Detalle Financiero</a></li>
          <li id="li_facturacion" role="presentation"><a href="#facturacion" aria-controls="general" role="tab" data-toggle="tab">Facturación</a></li>
          <li id="li_anticipo" role="presentation"><a href="#anticipo" aria-controls="general" role="tab" data-toggle="tab">Anticipo</a></li>
      </ul>

      <div class="tab-content">

      <div role="tabpanel" class="tab-pane" id="general">
        <br>
        <!-- contenido general -->
        <div class="panel panel-default proc-pan-def3">
          <div class="titulohead">

                  <div class="row">
                    <div class="col-md-6">
                        <div class="titleprincipal"><h4>Financiero - <?php echo $proyectoMGen[0]["nombre"] ?></h4></div>
                    </div>
                    <div class="col-md-6 text-right">
                    </div>
                  </div>

                </div>
                <!-- /.panel-heading -->

          <div class="panel-body">  

            <div class="col-md-12">
              <div class="">
                      <table class="display table table-striped table-bordered table-hover" id="tbl_grupo">
                  <thead>
                      <tr>
                          <th colspan="5" class="text-center">Valor del Proyecto</th>
                          <th colspan="5" class="text-center">Valor Ejecutado</th>
                          <th colspan="5" class="text-center">Saldo por Ejecutar</th>
                      </tr>  
                  </thead>
                      <tr>
                          <td colspan="5" class="text-center" style="background-color: #A3C7EE"><h4>$15.765.675.990</h4></td>
                          <td colspan="5" class="text-center" style="background-color: #95F388"><h4>$65.675.990</h4></td>
                          <td colspan="5" class="text-center" style="background-color: #FD7F77"><h4>$15.700.000.000</h4></td>
                      </tr>
                  <tbody>
                      
                  </tbody>
              </table>
                  </div>
                  <!-- /.table-responsive -->
            </div>

          </div>

          
        </div> 
        <!-- /.contenido general -->

      </div>

      <div role="tabpanel" class="tab-pane" id="detalle_financiero">
        <br>
        <!-- contenido general -->
        

        </div>
        <!-- /.contenido general -->

      </div>

      <div role="tabpanel" class="tab-pane" id="facturacion">
        <br>
        <!-- contenido general -->


        </div>

      <div role="tabpanel" class="tab-pane" id="anticipo">
        <br>
        <!-- contenido general -->


        </div>

        
      <!-- /.col-lg-12 -->

    </div>
    <!-- /.row -->

</div>
</div>
</div>

<!-- /#page-wrapper -->