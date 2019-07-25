<?php

include '../controller/tallerescontroller.php';

include '../controller/docentesController.php';

include '../conexion/datos.php';

$tallerInst = new talleresController();

$arrPermisoss = $tallerInst->getPermisosModulo_Tipo(26, $_COOKIE[$NomCookiesApp . '_IDtipo']);

$docentesInst = new docentesController();

$arrPermisosD = $docentesInst->getPermisosModulo_Tipo($id_modulo, $_COOKIE[$NomCookiesApp . '_IDtipo']);

$creaD = $arrPermisosD[0]['crear'];  

$pkID_album = $_GET["id_album"];

$pkID_proyectoM = $_GET["id_proyectoM"];
$albumTaller = $tallerInst->getTaller($pkID_album);
$proyectoMGen   = $docentesInst->getProyectosMarcoId($pkID_proyectoM);

include 'form_fotos_taller.php';


?>

<div id="page-wrapper" style="margin: 0px;">

  <div class="row">

      <div class="col-lg-12">
          <h2 class="page-header titleprincipal"><img src="../img/botones/docentesonly.png"> Album  <?php echo $albumTaller[0]["nombre_album"];?> - Fotos</h2>
      </div>

      <div class="col-lg-12">
          <ol class="breadcrumb migadepan">
            <li><a href="proyecto_marco.php" class="migadepan">Inicio</a></li>
            <li><a href="principal.php?id_proyectoM=<?php echo $albumTaller[0]["fkID_proyecto"]; ?>" class="migadepan">Menú principal</a></li>
            <li><a href="academico.php?id_proyectoM=<?php echo $albumTaller[0]["fkID_proyecto"]; ?>" class="migadepan">Académico</a></li>
            <li><a href="apropiacion.php?id_proyectoM=<?php echo $albumTaller[0]["fkID_proyecto"]; ?>" class="migadepan">Apropiacion social</a></li> 
            <li><a href="taller_formacion.php?id_proyectoM=<?php echo $albumTaller[0]["fkID_proyecto"]; ?>" class="migadepan">Taller de formación</a></li>
            <li><a href="detalle_taller_formacion.php?id_taller_formacion=<?php echo $albumTaller[0]["fkID_taller"]; ?>" class="migadepan">Detalle Talleres de Formación</a></li>
            <li class="active migadepan">Fotos del Álbum</li>
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
                  <div class="titleprincipal"><h4>Registro de Fotos - Album  <?php echo $albumTaller[0]["nombre_album"];?> </h4></div>
              </div>
              <div class="col-md-6 text-right">
                 <button id="btn_nuevafoto" type="button" class="btn btn-primary botonnewgrupo" data-toggle="modal" data-target="#frm_modal_foto_taller" <?php if ($creaD != 1) {echo 'disabled="disabled"';}?> ><span class="glyphicon glyphicon-plus"></span> Nueva Foto</button>
              </div>
            </div>

          </div>
          <!-- /.panel-heading -->

        <div class="panel-body">
    
         <body>
    <div class='container'>
    <div class="row">
      <div class="col-lg-12">
      <?php
        $nums=1;
        $fotos = $tallerInst->getFotosTaller($pkID_album);
        if ($fotos[0]["pkID"]!="") { 
        for ($a = 0; $a < sizeof($fotos); $a++) {
          ?>
          
          <div class="col-lg-3 col-md-4 col-xs-6 thumb">
            <a class="thumbnail" href="#" data-image-id="" data-toggle="modal" data-title="<?php echo $fotos[$a]["descripcion"];?>" data-caption="" data-image="../img/<?php echo $fotos[$a]["url_foto"];?>" data-target="#imagen_galeria">
              <img class="img-responsive" style="height: 200px" src="../img/<?php echo $fotos[$a]["url_foto"];?>" alt="Another alt text"><br>
            <div class="col-md-12 text-center"><button id="btn_elimina_foto" title="Eliminar" name="elimina_foto" type="button" class="btn btn-danger text center" data-id-foto = "<?php echo $fotos[$a]["pkID"];  ?>";
           ><span class="glyphicon glyphicon-remove"></span></button></div><br><br>
            
           </a>
          </div>
          <?php
          
          if ($nums%4==0){
            echo '<div class="clearfix"></div>';
          }
          $nums++;
        }
      } else {
            echo '<div class="col-md-12 text-center">
            <h3>No Existen Fotos en este Álbum</h3>
            </div>';
        }
      ?>
            
      </div>
    </div>
<div class="modal fade" id="imagen_galeria" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
              <div class="col-md-4"><h4 class="modal-title" id="imagen_galeria-title"></h4></div>
              <div class="col-md-8 text-right"><button type="button" class=" btn btn-danger" data-dismiss="modal"><span aria-hidden="true"></span><span class="glyphicon glyphicon-remove"></span></button></div>
            </div>
            <div class="modal-body">
      <center>
                <img id="imagen_galeria-image" class="img-responsive" src="">
      </center> 
            </div>
            <div class="modal-footer">

                <div class="col-md-2">
                    <button type="button" class="btn btn-info" id="btn_anterior">Anterior</button>
                </div>

                <div class="col-md-8 text-justify" id="imagen_galeria-caption">
                    This text will be overwritten by jQuery
                </div>

                <div class="col-md-2">
                    <button type="button" id="btn_siguiente" class="btn btn-info">Siguiente</button>
                </div>
            </div>
        </div>
    </div>
</div>
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
