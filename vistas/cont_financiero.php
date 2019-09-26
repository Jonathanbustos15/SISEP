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

$valort= $financieroInst->getValorTotal($pkID_proyectoM);

$valore = $financieroInst->getValor($pkID_proyectoM);

$valorpe = $valort[0]["total"] - $valore[0]["total"] ;






//++++++++++++++++++++++++++++++++++
include 'form_factura.php';
include 'form_anticipo.php';
//++++++++++++++++++++++++++++++++++/**/
?>


<div id="page-wrapper" style="margin: 0px;">

  <div class="row">  
     <!-- Campo que contiene el valor del id del modulo para auditoria con el nombre del modulo-->
      <input type="hidden" id="id_mod_page_financiera" value=<?php echo $id_modulo ?>>

      <input type="hidden" id="id_mod_page_docente" value=<?php echo $id_modulo ?>>

      <input type="hidden" id="id_mod_page_estudiante" value=<?php echo $id_modulo ?>>

      <div class="col-lg-12">
          <h1 class="page-header titleprincipal"><img src="../img/botones/grupoonly.png"><?php echo  $proyectoMGen[0]["nombre"] ?> - Financiero</h1>
      </div>
      <!-- /.col-lg-12 -->

    <div class="col-lg-12">
          <ol class="breadcrumb migadepan">
            <li><a href="proyecto_marco.php" class="migadepan">Inicio</a></li>
            <li><a href="descripcion.php?id_proyectoM=<?php echo $proyectoMGen[0]["pkID"]; ?>" class="migadepan">Descripción</a></li>
            <li><a href="principal.php?id_proyectoM=<?php echo $proyectoMGen[0]["pkID"]; ?>" class="migadepan">Menú principal</a></li>
            <li><a href="#general" data-toggle="tab" class="migadepan">Financiero</a></li>
          </ol>
    </div>

  </div>
  <!-- /.row -->

  <div class="row">

      <div class="dataTable_wrapper">

             <!-- Nav tabs -->
      <ul class="nav nav-tabs admin-doc-proy" role="tablist">
          <li id="li_general" class="active"><a href="#general" aria-controls="general" role="tab" data-toggle="tab">General</a></li> 
          <li id="li_detalle_financiero" role="presentation"><a href="#detalle_financiero" aria-controls="general" role="tab" data-toggle="tab">Detalle Financiero</a></li>
          <li id="li_facturacion"><a href="#facturacion" aria-controls="general" role="tab" data-toggle="tab">Facturación</a></li>
          <li id="li_anticipo"><a href="#anticipo" aria-controls="general" role="tab" data-toggle="tab">Anticipo</a></li>
      </ul>

      <div class="tab-content">

      <div role="tabpanel" class="tab-pane active" id="general">
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
                          <td colspan="5" class="text-center" style="background-color: #A3C7EE"><h4> $<?php echo number_format($valort[0]["total"],0,'.', '.'); ?></h4></td>
                          <td colspan="5" class="text-center" style="background-color: #95F388"><h4>$<?php echo number_format($valore[0]["total"],0,'.', '.'); ?></h4></td>
                          <td colspan="5" class="text-center" style="background-color: #FD7F77"><h4>$<?php echo number_format($valorpe,0,'.', '.'); ?></h4></td>
                      </tr>
                  <tbody>
                      
                  </tbody>
              </table>
              <div class="col-md-4 ">
               <div class="text-center">
                  <h2> Porcentaje </h2>
                </div>
                </div>
              <div class="col-md-4 ">
               <div class="text-center">
                  <?php $porcentaje = (100 * $valore[0]["total"]) / $valort[0]["total"]; ?>
                  <h2> <?php echo round($porcentaje,2) ?>%</h2>
                </div>
                </div>
                <div class="col-md-4 ">
                <div class="text-center">
                  <?php  $porcentaje2 = (100 * $valorpe) / $valort[0]["total"]; ?>
                  <h2> <?php echo round($porcentaje2,2) ?>%</h2>
                </div>
              </div>
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
        <div class="panel panel-default proc-pan-def3">
          <div class="titulohead">

                  <div class="row">
                    <div class="col-md-6">
                        <div class="titleprincipal"><h4>Detalle Financiero - <?php echo $proyectoMGen[0]["nombre"] ?></h4></div>
                    </div>
                    <div class="col-md-6 text-right">
                    </div>
                  </div>

                </div>
                <!-- /.panel-heading -->

          <div class="panel-body">  
            <div class="col-md-12">
              <div class="">
                      <?php
                        $financieroInst->getDetallefinanciero();
                      ?>
                  </div>
                  <!-- /.table-responsive -->
            </div>

          </div>

        </div>
    
        </div>
        <!-- /.contenido general -->

      <div role="tabpanel" class="tab-pane" id="facturacion">
        <br>
        <div class="panel panel-default proc-pan-def3">
          <div class="titulohead">

                  <div class="row">
                    <div class="col-md-6">
                  <div class="titleprincipal"><h4>Registro de Factura - <?php echo $proyectoMGen[0]["nombre"] ?></h4></div>
              </div>
              <div class="col-md-6 text-right">
                 <button id="btn_nuevofactura" type="button" class="btn btn-primary botonnewgrupo" data-toggle="modal" data-proyecto="<?php echo $pkID_proyectoM; ?>" data-target="#frm_modal_factura" <?php if ($creaf != 1) {echo 'disabled="disabled"';}?> >
                 <span class="glyphicon glyphicon-plus"></span>Nueva Factura</button>
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
                         <!-- <th>ID Grupo</th>-->
                          <th>Número de Factura</th>
                          <th >Valor Factura</th>
                          <th>Fecha</th>
                          <th data-orderable="false">Opciones</th>
                      </tr>
                  </thead>

                  <tbody>
                      <?php
                          $financieroInst->getTablafinancieroFactura($pkID_proyectoM);

                      ?>
                  </tbody>
              </table>
                  </div>
                  <!-- /.table-responsive -->
            </div>

          </div>

        </div>
      </div>

      <div role="tabpanel" class="tab-pane" id="anticipo">
        <br>
        <!-- contenido general -->
        <div class="panel panel-default proc-pan-def3">
          <div class="titulohead">

                  <div class="row">
                    <div class="col-md-6">
                  <div class="titleprincipal"><h4>Registro de Anticipo - <?php echo $proyectoMGen[0]["nombre"] ?></h4></div>
              </div>
              <div class="col-md-6 text-right">
                 <button id="btn_nuevoanticipo" type="button" class="btn btn-primary botonnewgrupo" data-toggle="modal" data-proyecto="<?php echo $pkID_proyectoM; ?>" data-target="#frm_modal_anticipo" <?php if ($creaf != 1) {echo 'disabled="disabled"';}?> >
                 <span class="glyphicon glyphicon-plus"></span>Nuevo Anticipo</button>
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
                         <!-- <th>ID Grupo</th>-->
                         <th>Fecha de Anticipo</th>
                          <th>Valor Anticipo</th>
                          <th >Valor Anticipo Legalizado</th>
                          <th >Fecha Anticipo Legalizado</th>
                          <th>Valor pendiente por legalizar</th> 
                          <th data-orderable="false">Opciones</th>
                      </tr>
                  </thead>

                  <tbody>
                      <?php
                          $financieroInst->getTablafinancieroAnticipo($pkID_proyectoM);

                      ?>
                  </tbody>
              </table>
                  </div>
                  <!-- /.table-responsive -->
            </div>

          </div>

        </div>

        </div>

        
      <!-- /.col-lg-12 -->

    </div>
    <!-- /.row -->

</div>
</div>
</div>
