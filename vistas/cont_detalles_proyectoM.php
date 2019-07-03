<?php
include "../conexion/datos.php";
//--------------------------------------------------------------------
include '../controller/proyecto_marcoController.php';
include '../controller/grupoController.php';
//--------------------------------------------------------------------
//intancias proyecto marco
$proyectoMInst  = new proyecto_marcoController();
$pkID_proyectoM = $_GET["id_proyectoM"];
$proyectoMGen   = $proyectoMInst->getProyectosMarcoId($pkID_proyectoM);
//--------------------------------------------------------------------
//intancias grupo de investigacion
$id_modulo_grupo  = 25;
$grupoInst        = new grupoController();
$arrPermisosGrupo = $grupoInst->getPermisosModulo_Tipo($id_modulo_grupo, $_COOKIE[$NomCookiesApp . '_IDtipo']);
$creaGrupo        = $arrPermisosGrupo[0]['crear'];
$gruposI          = $grupoInst->getGruposInactivos();
$NumGruposInac    = $grupoInst->getNumGruposInactivos();
//$ngi = $NumGruposInac[0]['ngi']);
//print_r($ngi);
include "form_grupo.php";
include "form_novedades.php";
//--------------------------------------------------------------------
?>

<div id="page-wrapper" style="margin: 0px;">

             <!-- Contenido del Index -->
             <div class="row">
                <div class="col-lg-12">
                    <!--<h1 class="page-header">SISEP <h4>Sistema de Información, Seguimiento y Evaluación Permanente</h4>  </h1>--><br>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">

                        <div class="titulohead">
                            <div class="text-center titulo-menu"><h3>Menú Principal - <?php echo $proyectoMGen[0]["nombre"] ?></h3></div>
                        </div>
                        <div class="panel-body">

                            <div class="col-lg-12">
                                  <ol class="breadcrumb migadepan">
                                    <li><a href="proyecto_marco.php" class="migadepan">Inicio</a></li>
                                    <li class="active migadepan">Menu principal - <?php echo $proyectoMGen[0]["nombre"] ?> </li>
                                  </ol>
                              </div>

                            <!-- contenedor de los registros-->
                            <div class="col-lg-12">

                                <!-- contenido de las tablas -->
                                <div class="tab-content">

                                    <!-- Pestaña grupoInv -->
                                    <div role="tabpanel" class="tab-pane active" id="grupoInv">

                                        <br>

                                        <div class="panel panel-default proc-pan-def3">
                                            <div class="panel-body">
                                                <div class="col-md-2 zoom"><a class="" href="anio1.php"><img class="zoom" src="../img/anio1.png"></a></div>
                                                <div class="col-md-2 zoom"><a class="" href="anio2.php"><img  class="zoom" src="../img/anio2.png"></a></div>
                                                <div class="col-md-2 zoom"><a class="" href="anio3.php"><img  class="zoom" src="../img/anio3.png"></a></div>
                                                <div class="col-md-2 zoom"><a class="" href="anio4.php"><img class="zoom" src="../img/anio4.png"></a></div>
                                                <div class="col-md-2 zoom"><a class="" href="acumulado.php"><img class="zoom" src=""><img class="zoom" src="../img/acumulado.png"></a></div>
                                                <div class="col-md-2 zoom"><a class="" href="configuracion.php"><img class="zoom" src=""><img class="zoom" src="../img/configuracion.png"></a></div>
                                            </div>
                                        </div>


                                    </div>
                                    <!-- /.Pestaña grupoInv -->

                                    <!-- Pestaña config -->
                                    <div role="tabpanel" class="tab-pane" id="config">

                                        <br>

                                        <div class="panel panel-default proc-pan-def3">
                                            <div class="panel-body">
                                                <div class="col-md-2 zoom"><a class="" href="bitacora.php"><img class="zoom" src="../img/botones/bitacoras.jpg"></a></div>
                                                <div class="col-md-2 zoom"><a class="" href="institucion.php"><img  class="zoom" src="../img/botones/instituciones.jpg"></a></div>
                                                <div class="col-md-2 zoom"><a class="" href="prueba.php"><img class="zoom" src="../img/botones/pruebas.jpg"></a></div>
                                                <div class="col-md-2 zoom"><a class="" href="curso_formacion.php"><img class="zoom" src=""><img class="zoom" src="../img/botones/cursosformacion.jpg"></a><br><br><br></div>

                                                <div class="col-md-2 text-center" <?php if ($_COOKIE["log_sisep_IDtipo"] != 1) {echo "hidden='true'";}?>>
                                                    <button type="button" id="btnD" class="btn btn-danger">Cierre de Año</button>
                                                    <hr>
                                                    <?php echo '<a target="_blank" href="registro_docente.php?id_proyectoM=' . $pkID_proyectoM . '"><strong>Registro de Docentes en este Proyecto</strong></a>'; ?>
                                                </div>

                                               <div class="form-group " hidden>
                                                    <div class="col-sm-10">
                                                      <input type="text" class="form-control" id="fecha_a" name="fecha_a" value= <?php echo date("Y-m-d"); ?>>
                                                    </div>
                                               </div>


                                            </div>
                                        </div>


                                    </div>
                                    <!-- /.Pestaña config -->

                                </div>
                                <!-- ./contenido de las tablas -->

                            </div>
                            <!-- ./contenedor de los registros-->

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