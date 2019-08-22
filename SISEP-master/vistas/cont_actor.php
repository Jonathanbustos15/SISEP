<?php

/**/

include '../controller/actorController.php';

include '../controller/principalController.php';

include '../conexion/datos.php';

$actorInst = new actorController();

$arrPermisos = $actorInst->getPermisosModulo_Tipo($id_modulo, $_COOKIE[$NomCookiesApp . '_IDtipo']);

$crea = $arrPermisos[0]['crear'];

$principalInst  = new principalController();
$pkID_proyectoM = $_GET["id_proyectoM"];
$proyectoMGen   = $principalInst->getProyectosMarcoId($pkID_proyectoM);

if (isset($_GET["anio"])) {
    $filtro = $_GET["anio"];
} else {
    $filtro = "Todos";
}

if (isset($_GET["tipo"])) {
    $filtro2 = $_GET["tipo"];
} else {
    $filtro2 = "Todos";
}

include "form_actor.php";
include "form_modal_archivos.php";
?>

<div id="page-wrapper" style="margin: 0px;">

  <div class="row">
    <!-- Campo que contiene el valor del id del modulo para auditoria con el nombre del modulo-->
      <input type="hidden" id="id_mod_page_actor" value=<?php echo $id_modulo ?>>

      <div class="col-lg-12">
          <h1 class="page-header titleprincipal"><img src="../img/botones/actoronly.png"><?php echo $proyectoMGen[0]["nombre"] ?> - Actores</h1>
      </div>
      <!-- /.col-lg-12 -->
      <div class="col-md-6">
          <ol class="breadcrumb migadepan">
            <li><a href="proyecto_marco.php" class="migadepan">Inicio</a></li>
            <li><a href="descripcion.php?id_proyectoM=<?php echo $pkID_proyectoM; ?>" class="migadepan">Descripción</a></li>
             <li><a href="principal.php?id_proyectoM=<?php echo $pkID_proyectoM; ?>" class="migadepan">Menú principal</a></li>
             <li><a href="academico.php?id_proyectoM=<?php echo $pkID_proyectoM; ?>" class="migadepan">Academico</a></li>
              <li><a href="apropiacion.php?id_proyectoM=<?php echo $pkID_proyectoM; ?>" class="migadepan">Apropiacion social</a></li>
            <li class="active migadepan">Actores</li>
          </ol>
      </div>

      <div class="col-md-3 text-right form-inline">
                    <label for="grupo_filtrop" class="control-label">Tipo de Actor: </label>
                      <?php
$actorInst->getSelectTipoAFiltro();
?>
     </div>

      <div class="col-md-2 text-center form-inline">
                    <label for="grupo_filtrop" class="control-label">Año: </label>
                      <?php
$actorInst->getSelectAnioFiltro();
?>
     </div>
    <div class="col-md-1 text-left form-inline">
                     <button class="btn btn-success" id="btn_filtrara"><span class="glyphicon glyphicon-filter"></span> Filtrar</button>

                     <hr>

            </div>

  </div>
  <!-- /.row -->

  <div class="row">

      <div class="col-lg-12">

        <div class="panel panel-default">

          <div class="titulohead">

            <div class="row">
              <div class="col-md-6">
                  <div class="titleprincipal"><h4>Registro de Actores <?php echo $proyectoMGen[0]["nombre"] ?></h4></div>
              </div>
              <div class="col-md-6 text-right">
                 <button id="btn_nuevoActor" type="button" class="btn btn-primary botonnewgrupo" data-toggle="modal" data-proyecto="<?php echo $pkID_proyectoM; ?>" data-target="#frm_modal_actor" <?php if ($crea != 1) {echo 'disabled="disabled"';}?> >
                 <span class="glyphicon glyphicon-plus"></span>Nuevo Actor</button>
              </div>
            </div>

          </div>
          <!-- /.panel-heading -->

        <div class="panel-body">

          <div class="dataTable_wrapper">
              <table class="display table table-striped table-bordered table-hover" id="tbl_actor">
                  <thead>
                      <tr>
                         <!-- <th>ID Actor</th>-->
                          <th class="tabla-form-ancho-std">Nombre Actor</th>
                          <th class="tabla-form-ancho-std">Tipo de Actor</th>
                          <th class="tabla-form-ancho-std">Nombre Contacto</th>
                          <th class="tabla-form-ancho-std">Email Contacto</th>
                          <th class="tabla-form-ancho-std">Télefono Contacto</th>

                          <th class="tabla-form-ancho-sm" data-orderable="false">Opciones</th>
                      </tr>
                  </thead>

                  <tbody>
                      <?php
//print_r($_COOKIE);
//echo "valor de cookie de tipo ".$_COOKIE[$NomCookiesApp."_tipo"];
$actorInst->getTablaActor($pkID_proyectoM, $filtro, $filtro2);
?>
                  </tbody>
              </table>
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