 <?php

include '../controller/repositorioController.php';

include '../conexion/datos.php';

$repositorioInst = new repositorioController;

$arrPermisoss = $repositorioInst->getPermisosModulo_Tipo(26, $_COOKIE[$NomCookiesApp . '_IDtipo']);

$creaf = $arrPermisoss[0]['crear'];

$id_modulo =51;  

$tipo_user = $_COOKIE[$NomCookiesApp . '_IDtipo'];

$pkID_proyectoM = $_GET["id_proyectoM"];
$pkID_proyectoM = 2;

$proyectoMGen = $repositorioInst->getProyectosMarcoId($pkID_proyectoM);


//++++++++++++++++++++++++++++++++++
include 'form_documentos.php';
include 'form_actividad.php';
include 'form_subactividad.php';
//++++++++++++++++++++++++++++++++++/**/
?>


<div id="page-wrapper" style="margin: 0px;">

  <div class="row">  
     <!-- Campo que contiene el valor del id del modulo para auditoria con el nombre del modulo-->
      <input type="hidden" id="id_mod_page_financiera" value=<?php echo $id_modulo ?>>

      <input type="hidden" id="id_mod_page_docente" value=<?php echo $id_modulo ?>>

      <input type="hidden" id="id_mod_page_estudiante" value=<?php echo $id_modulo ?>>

      <div class="col-lg-12">
          <h1 class="page-header titleprincipal"><img src="../img/botones/repositorio2.png">&nbsp;<?php echo  $proyectoMGen[0]["nombre"] ?> - Repositorio Documental</h1>
      </div>
      <!-- /.col-lg-12 -->

    <div class="col-lg-12">
          <ol class="breadcrumb migadepan">
            <li><a href="proyecto_marco.php" class="migadepan">Inicio</a></li>
            <li><a href="descripcion.php?id_proyectoM=<?php echo $proyectoMGen[0]["pkID"]; ?>" class="migadepan">Descripción</a></li>
            <li><a href="principal.php?id_proyectoM=<?php echo $proyectoMGen[0]["pkID"]; ?>" class="migadepan">Menú principal</a></li>
            <li><a href="" data-toggle="tab" class="migadepan">Repositorio documental</a></li>
          </ol>
    </div>

  </div>
  <!-- /.row -->

  <div class="row">

      <div class="dataTable_wrapper">

             <!-- Nav tabs -->
            <ul class="nav nav-tabs admin-doc-proy" role="tablist">
              <li id="li_ver" class="active" ><a href="#ver" aria-controls="ver" role="tab" data-toggle="tab">Ver</a></li>
              <li id="li_admin"><a href="#admin" aria-controls="admin" role="tab" data-toggle="tab">Administrar</a></li>              
            </ul>

            <!-- Tab panes -->
            <div class="tab-content">
              <div role="tabpanel" class="tab-pane" id="admin">
                <br>
                <!-- ./filtro de documentos -->
                <div class="panel panel-default proyec-marg5">

                  <div class="panel-heading">
                    <div class="row">
                      <div class="col-md-6">
                          Administracion de Documentos del Proyecto - <?php echo  $proyectoMGen[0]["nombre"] ?>
                      </div>
                      <div class="col-md-6 text-right">
                        <button id="btn_nuevoDocumento" type="button" class="btn btn-primary botonnewgrupo" data-toggle="modal" data-target="#form_modal_documentos" <?php if ($creaf != 1){echo 'disabled="disabled"';} ?>><span class="glyphicon glyphicon-plus"></span>&nbspAñadir Documento</button>  
                      </div>
                    </div>
                  </div>
                  <!-- /.panel-heading -->
                  
                  <div class="panel-body">

                  <div class="dataTable_wrapper table-responsive">
                    <table class="table table-striped table-bordered table-hover" id="tbl_documentos">
                        <thead>
                            <tr>
                                <th class="tabla-form-ancho">Categoría</th>
                                <th class="tabla-form-ancho">Sub Categoría</th>
                                <th class="tabla-form-ancho">Nombre</th>                                                          
                                <th data-orderable="false"  class="tabla-form-ancho">Opciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $repositorioInst->getTablaDocumentos(); ?>
                        </tbody>
                    </table>
                  </div>
                  <!-- /.prueba muestra documentos treeview -->

                  </div>
                  <!-- /.panel-body -->
                
                </div>
                <!-- /.panel -->                

              </div>
              <div role="tabpanel" class="tab-pane active" id="ver">
                <br>
                <ul id="demo2" class="navi">
                  <?php $repositorioInst->getSelectArchivos($pkID_proyectoM); ?> 
                <!-- /.prueba muestra documentos treeview -->
              </div>

            </div>        
                
                
            </div>
</div>
</div>
