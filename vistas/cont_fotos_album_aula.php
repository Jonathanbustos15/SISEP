<?php

include '../controller/aulasController.php'; 

include '../controller/docentesController.php';  

include '../conexion/datos.php';   

$aulaInst = new aulasController();

$arrPermisoss = $aulaInst->getPermisosModulo_Tipo(26, $_COOKIE[$NomCookiesApp . '_IDtipo']);

$docentesInst = new docentesController();

$arrPermisosD = $docentesInst->getPermisosModulo_Tipo($id_modulo, $_COOKIE[$NomCookiesApp . '_IDtipo']);

$creaD = $arrPermisosD[0]['crear'];  

$pkID_album = $_GET["id_album"];

$pkID_proyectoM = $_GET["id_proyectoM"];
$albumGrupo = $aulaInst->getAulaGaleria($pkID_album); 
$proyectoMGen   = $docentesInst->getProyectosMarcoId($pkID_proyectoM);

include 'form_fotos_aula.php';


?>

<div id="page-wrapper" style="margin: 0px;">

  <div class="row">

      <div class="col-lg-12">
          <h2 class="page-header titleprincipal"><img src="../img/botones/docentesonly.png"> Album  <?php echo $albumGrupo[0]["nombre_album"];?> - Fotos</h2>
      </div>

      <div class="col-lg-12">
          <ol class="breadcrumb migadepan">
            <li><a href="proyecto_marco.php" class="migadepan">Inicio</a></li>
            <li><a href="principal.php?id_proyectoM=<?php echo $albumGrupo[0]["fkID_proyecto"]; ?>" class="migadepan">Menú principal</a></li>
            <li><a href="cientifico.php?id_proyectoM=<?php echo $albumGrupo[0]["fkID_proyecto"]; ?>" class="migadepan">Cientifico</a></li>
            <li><a href="aulas.php?id_proyectoM=<?php echo $albumGrupo[0]["fkID_proyecto"]; ?>" class="migadepan">Aulas</a></li>
            <li><a href="detalles_aulas.php?id_aulas=<?php echo $albumGrupo[0]["fkID_aula"]; ?>" class="migadepan">Detalle Aula</a></li>
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
                  <div class="titleprincipal"><h4>Registro de Fotos - Album  <?php echo $albumGrupo[0]["nombre_album"];?> </h4></div>
              </div>
              <div class="col-md-6 text-right">
                 <button id="btn_nuevafoto" type="button" class="btn btn-primary botonnewgrupo" data-toggle="modal" data-target="#frm_modal_foto_aula" <?php if ($creaD != 1) {echo 'disabled="disabled"';}?> ><span class="glyphicon glyphicon-plus"></span> Nueva Foto</button>
              </div>
            </div>

          </div>
          <!-- /.panel-heading -->

        <div class="panel-body">
    
         <body>
    <div class='container' id="fotos">
    <div class="row">
      <div class="col-lg-12">
      <?php
        $nums=1;
        $fotos = $aulaInst->getFotosAula($pkID_album);
        if ($fotos[0]["pkID"]!="") { 
        for ($a = 0; $a < sizeof($fotos); $a++) {
          ?>
          
          <div class="col-lg-3 col-md-4 col-xs-6 thumb">
            <a class="thumbnail" href="../img/<?php echo $fotos[$a]["url_foto"];?>" data-lightbox="fotos_taller" data-title="<?php echo $fotos[$a]["descripcion"];?>"><img class="img-responsive" style="height: 200px" src="../img/<?php echo $fotos[$a]["url_foto"];?>" alt="" /><br>
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
  </div>
          </div>
          <!-- /.table-responsive -->

</div>
<!-- /#page-wrapper -->
