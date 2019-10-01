<?php

//ini_set('error_reporting', E_ALL|E_STRICT);
//ini_set('display_errors', 1);

include '../controller/cambio_estado_grupo_invController.php';

include '../controller/proyectoController.php';

include '../controller/docentesController.php';

include '../controller/estudiantesController.php';

include '../controller/acompanamientoController.php';

include '../conexion/datos.php';

$cambia_estadoGInst = new cambio_estado_grupo_invController();

$arrPermisosEG = $cambia_estadoGInst->getPermisosModulo_Tipo(57, $_COOKIE[$NomCookiesApp . '_IDtipo']);

$creaEG = $arrPermisosEG[0]['crear'];

$docentesInst = new docentesController();

$arrPermisosD = $docentesInst->getPermisosModulo_Tipo(26, $_COOKIE[$NomCookiesApp . '_IDtipo']);

$creaD = $arrPermisosD[0]['crear'];

$estudiantesInst = new estudiantesController();

$arrPermisoseg = $estudiantesInst->getPermisosModulo_Tipo(30, $_COOKIE[$NomCookiesApp . '_IDtipo']);

$creaeg = $arrPermisoseg[0]['crear'];

$rolEstudiante = $estudiantesInst->getRolEstudiante();

$re = $rolEstudiante[0]["pkID_rol"];

//print_r($re);

$detalles_grupoInst = new acompanamientoController();

$arrPermisos = $detalles_grupoInst->getPermisosModulo_Tipo($id_modulo, $_COOKIE[$NomCookiesApp . '_IDtipo']);

$crea = $arrPermisos[0]['crear'];

$pkID_acompanamiento = $_GET["id_acompanamiento"];

$estado = $detalles_grupoInst->getEstadoGrupo($pkID_acompanamiento);

$estadoG = $estado[0]['fkID_estado'];

$proyectoInst = new proyectoController();

$arrPermisosp = $proyectoInst->getPermisosModulo_Tipo(32, $_COOKIE[$NomCookiesApp . '_IDtipo']);

$creap = $arrPermisosp[0]['crear'];

$tipo_user = $_COOKIE[$NomCookiesApp . '_IDtipo'];

//print_r($tipo_user);

//++++++++++++++++++++++++++++++

$grupoGen = $detalles_grupoInst->getGruposId($pkID_acompanamiento);

//variables grado
$pkID_grado = $grupoGen[0]["fkID_grado"];
$nom_grado  = $grupoGen[0]["nom_grado"];
//variables de institucion
$pkID_institucion = $grupoGen[0]["fkID_institucion"];
$nom_institucion  = $grupoGen[0]["nom_institucion"];
//------------------------------------------
$arrPermisosEstudiantes = $detalles_grupoInst->getPermisosModulo_Tipo(38, $_COOKIE[$NomCookiesApp . '_IDtipo']);
$creaEstudiante         = $arrPermisosEstudiantes[0]['crear'];
//+++++++++++++++++++++++++++++++
$arrPermisosDocentes = $detalles_grupoInst->getPermisosModulo_Tipo(39, $_COOKIE[$NomCookiesApp . '_IDtipo']);
$creaDocente         = $arrPermisosDocentes[0]['crear'];
//------------------------------------------

$numeroEstudiantes = $detalles_grupoInst->getNumEstudiantesGrupo(9, $pkID_acompanamiento, $pkID_grado);

$ne = $numeroEstudiantes[0]['num_estudiantes'];

$proyectoMGen = $detalles_grupoInst->getProyectosMarcoGrupo($pkID_acompanamiento);

$pkID_proyectoM = $proyectoMGen[0]["fkID_proyecto_marco"];


//echo date("Y-m-d");

//print_r($fecha);
//++++++++++++++++++++++++++++++++++
include 'form_asignacion_participantes.php';
include 'form_estado_participante.php';
include 'form_docentes.php';
include 'form_asistencia.php';
include 'form_album_acompanamiento.php';
include "form_acompanamiento.php"; 
//++++++++++++++++++++++++++++++++++/**/
?>

<div class="form-group " hidden>
    <div class="col-sm-10">
        <input type="text" class="form-control" id="grupo" name="grupo" value=<?php echo $pkID_acompanamiento; ?>>
    </div>
</div>

<div class="form-group " hidden>
    <div class="col-sm-10">
        <input type="text" class="form-control" id="estado" name="estado" value=<?php echo $estadoG; ?>>
    </div>
</div>

<div class="form-group " hidden>
    <div class="col-sm-10">
        <input type="text" class="form-control" id="fecha" name="fecha" value=<?php echo date("Y-m-d"); ?>>
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
          <h1 class="page-header titleprincipal"><img src="../img/botones/acompanamientoonly.png">Maestros Formados - <?php echo $proyectoMGen[0]["nombre_proyecto"] ?></h1>
      </div>
      <!-- /.col-lg-12 -->

    <div class="col-lg-12">
          <ol class="breadcrumb migadepan">
            <li><a href="proyecto_marco.php" class="migadepan">Inicio</a></li>
            <li><a href="principal.php?id_proyectoM=<?php echo $pkID_proyectoM; ?>" class="migadepan">Menú principal</a></li>
            <li><a href="academico.php?id_proyectoM=<?php echo $pkID_proyectoM; ?>" class="migadepan">Académico</a></li>
            <li><a href="formacion.php?id_proyectoM=<?php echo $pkID_proyectoM; ?>" class="migadepan">Formación a maestros</a></li>
            <li><a href="acompanamiento.php?id_proyectoM=<?php echo $pkID_proyectoM; ?>" class="migadepan">Maestros Formados</a></li>
            <li class="active migadepan">Detalle Maestros Formados </li>
          </ol>
    </div>

  </div>
  <!-- /.row -->

  <div class="row">

      <div class="col-lg-12">   

        <!-- Nav tabs -->
        

	    
				<div class="row">

    <?php //echo 'el perfil es '.$_COOKIE["log_lunelAdmin_tipo"];; ?>

      <div class="col-lg-12">

        <div class="panel panel-default">

          <div class="titulohead">

            <div class="row">
              <div class="col-md-6">
                  <div class="titleprincipal"><h4>Sesiones de Maestros Formados - <?php echo $proyectoMGen[0]["nombre"] ?></h4></div>
              </div>
              <div class="col-md-6 text-right">
                 <button id="btn_nuevoAcompanamiento" type="button" class="btn btn-primary botonnewgrupo" data-toggle="modal" data-proyecto="<?php echo $pkID_proyectoM; ?>" data-target="#frm_modal_acompanamiento" <?php if ($creaeg != 1) {echo 'disabled="disabled"';}?> >
                 <span class="glyphicon glyphicon-plus"></span>Nueva Sesión Maestros Formados</button>
              </div>
            </div>

          </div>
          <!-- /.panel-heading -->

        <div class="panel-body">

          <div class="dataTable_wrapper">
              <table class="display table table-striped table-bordered table-hover" id="tbl_grupo">
                  <thead>
                      <tr>
                         <!-- <th>ID Grupo</th>-->
                          <th>Fecha</th>
                          <th>Descripcion</th>
                          <th>Cantidad de asistentes</th>
                          <th>Lista de Asistencia</th>
                          <th data-orderable="false">Opciones</th>
                      </tr>
                  </thead>

                  <tbody>
                      <?php
//print_r($_COOKIE);
//echo "valor de cookie de tipo ".$_COOKIE[$NomCookiesApp."_tipo"];
    $detalles_grupoInst->getTablaAcompanamiento($pkID_acompanamiento);
?>
                  </tbody>
              </table>
              <div class="col-md-6 text-right">
                                <label for="total_ingresos" class="control-label"><B>Total Participantes</B></label>
              </div>
                                <div class="input-group col-md-2 text-left">
                                   <?php $detalles_grupoInst->getSelectTotaldocentes($pkID_acompanamiento);?>
                                </div>
                            </div>
          </div>
          <!-- /.table-responsive -->

        </div>
        <!-- /.panel-body -->

        </div>
        <!-- /.panel -->

      </div>

      </div>
      <!-- /.col-lg-12 -->

    </div>
    <!-- /.row -->

</div>
<!-- /#page-wrapper -->