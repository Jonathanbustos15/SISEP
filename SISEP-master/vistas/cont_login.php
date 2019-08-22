<?php
include "../conexion/datos.php";
include "../controller/scripts_cont.php";
?>

<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" type="image/x-icon" href="../img/favicon.ico" />
    <link href="../bower_components/lightbox2-master/adipoli.css" rel="stylesheet" type="text/css"/>
    <title>SISEP</title>
    <link href="../bower_components/lightbox2-master/adipoli.css" rel="stylesheet" type="text/css"/>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js" type="text/javascript">
    </script>
    <script src="../bower_components/lightbox2-master/jquery.adipoli.min.js" type="text/javascript">
    </script>
    <script src="../js/scripts_cont/cont_login.js"></script>
    <?php
$scripts = new scripts_pag();
$scripts->standarCss();
?>

</head>

<body id="login_fondo" >
        <div class="row">
           <div class="col-md-2">

           </div>
           <div class="col-md-10">
        <table id="tabla-login" class="table-borderless">
            <tr id="fila-login">
              <td ><img alt="Ondas Guainía" id="imagen-login" src="../img/caja.png"></td><br><br>
              <td BGCOLOR="#FFFFFF" id="columna-login" style=""><br><form role="form" action="../controller/login_autentica.php" method="POST">
                            <fieldset><br><br><br><br><br><br>
                                <div class="form-group" id="input_login">
                                    <input id="username" name="username" class="form-control" placeholder="Usuario" type="text" autofocus>
                                </div>
                                <div class="form-group"id="input_login">
                                    <input id="password" name="password" class="form-control" placeholder="Contraseña" type="password" value="">
                                </div>

                                <!-- Change this to a button or input when using this as a form -->
                                <button id="btn_login" class="btn btn-lg btn-success btn-block ladda-button botonlogin"  data-style="slide-up" style="padding: 7px;"><span class="ladda-label">Ingresar</span></button>
                            </fieldset>
                            <div class="form-group text-center">

                                <!--<a href="registro.php">Registrarse <span class="glyphicon glyphicon-log-in"></span> </a>-->
                            </div>
                        </form></td>
            </tr>
        </table><br><br><br><br><br>
        </div>
        </div>
<br><br><br><br><br>
    <!-- BEGIN FOOTER -->
            <div class="page-footer" style="background-color: #FFFFFF;" >

                    <div class="col-md-9 text-right" style="background-color: #FFFFFF;">
                        <a href="http://ondasguainia.com/" target="_blank" id=""><img id="image2" alt="Ondas Guainía"  src="../img/ondas.png"></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <a href="https://www.colciencias.gov.co/" target="_blank" id=""><img id="image6" alt="Ondas Guainía"  src="../img/colciencias.png"></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <a href="https://www.sgr.gov.co/" target="_blank"  ><img id="image1" alt="Ondas Guainía"  src="../img/regalias.png"></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <a href="https://www.dnp.gov.co/Paginas/%E2%80%9CTodos-por-un-nuevo-pa%C3%ADs%E2%80%9D,-la-ruta-para-cumplir-las-metas-del-Plan-Nacional-de-Desarrollo-2014-2018.aspx" target="_blank"  id=""><img id="image3" alt="Ondas Guainía"  src="../img/nuevopais.png"></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <a href="http://www.guainia.gov.co/" target="_blank" id=""><img id="image4" alt="Ondas Guainía"  src="../img/gobernacion.png"></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <a href="http://www.funtecso.com/" target="_blank"  id=""><img id="image5" alt="Ondas Guainía"  src="../img/fundacion.png"></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    </div>

                        <div class="page-footer-inner col-md-3" style="background-color: #FFFFFF;">
                            © 2017 - <span class="page-footer-rojo">Gobernación Guainía</span> - Todos los Derechos Reservados
                        </div>
            </div>

</body>



</html>