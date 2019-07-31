<?php

include '../controller/docentesController.php';

include '../conexion/datos.php';

$docentesInst = new docentesController();

$arrPermisosD = $docentesInst->getPermisosModulo_Tipo($id_modulo, $_COOKIE[$NomCookiesApp . '_IDtipo']);

$creaD = $arrPermisosD[0]['crear'];

$pkID_proyectoM = $_GET["id_proyectoM"];
$proyectoMGen   = $docentesInst->getProyectosMarcoId($pkID_proyectoM);

include 'form_docentes.php';

?>

<div id="page-wrapper" style="margin: 0px;">

  <div class="row">

      <div class="col-lg-12">
          <h2 class="page-header titleprincipal"><img src="../img/botones/docentesonly.png"><?php echo $proyectoMGen[0]["nombre"] ?> - Descripción</h2>
      </div>
      <!-- /.col-lg-12 -->
      <div class="col-lg-12">
        <ol class="breadcrumb migadepan">
          <li><a href="proyecto_marco.php" class="migadepan">Inicio</a></li>
          <li class="active migadepan"> Descripción </li>
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
                  <div class="titleprincipal"><h4>Descripción - <?php echo $proyectoMGen[0]["nombre"] ?></h4></div>
              </div>
              <div class="col-md-6 text-right">
              </div>
            </div>

          </div>

        <div class="panel-body">
          <div class="col-sm-12 panel panel-default">
                <h3><strong>Descripción</strong></h3><br>
                  <div class=""><h4>Gran parte de los trabajos de investigación y desarrollo que están siendo llevados a cabo en distintas instituciones [1 – 6] se concentran en los aspectos de almacenamiento y búsqueda de información en las bibliotecas digitales y proponen la utilización de navegadores de Internet como la aplicación utilizada por los lectores para acceder a los libros. Si bien la estrategia de relegar la actividad de recuperación y visualización de libros digitales a los navegadores de Internet tiene varias ventajas, también cuenta con una cierta cantidad de factores negativos. </h4></div>
              </div>
  <div class="col-sm-12 ">
  <a class="btn btn-primary col-sm-12 display-1 btn-lg" data-toggle="collapse" href="#objetivo_1" role="button" aria-expanded="false" aria-controls="objetivo_1">Objetivo 1</a><br>
  <div class="col">
    <div class="collapse multi-collapse" id="objetivo_1">
      <div class="card card-body"><br>
        <div class="col-sm-2 panel panel-default mt-0">
            <h5>01 - A1 </h5>
              </div>
          <div class="col-sm-10 panel panel-default mt-0">
                  <div class=""><h5><a href="grupo.php?id_proyectoM=<?php echo $pkID_proyectoM; ?>">Formación, acompañamiento y seguimiento de grupos Ondas.</a> </h5></div>
              </div>
          <div class="col-sm-2 panel panel-default mt-0">
            <h5>01 - A2 </h5>
              </div>
          <div class="col-sm-10 panel panel-default mt-0">
                  <div class=""><h5><a href="saberes_propios.php?id_proyectoM=<?php echo $pkID_proyectoM; ?>">Entrenamiento en saberes propios en Ciencia e Innovación.</a></h5></div>
              </div>
          <div class="col-sm-2 panel panel-default mt-0">
            <h5>01 - A3 </h5>
              </div>
          <div class="col-sm-10 panel panel-default mt-0">
                  <div class=""><h5><a href="cientifico.php?id_proyectoM=<?php echo $pkID_proyectoM; ?>">Fortalecimiento del pensamiento científico a través de Talleres de Investigación Experimental en el Aula. </a> </h5></div>
              </div>
          <div class="col-sm-2 panel panel-default mt-0">
            <h5>01 - A4 </h5>
              </div>
          <div class="col-sm-10 panel panel-default mt-0">
                  <div class=""><h5><a href="apropiacion.php?id_proyectoM=<?php echo $pkID_proyectoM; ?>">Formación, Apropiación social, y producción de saber y conocimiento para maestros apoyada en las TIC.</a> </h5></div>
              </div>
          <div class="col-sm-2 panel panel-default mt-0">
            <h5>01 - A5 </h5>
              </div>
          <div class="col-sm-10 panel panel-default mt-0">
                  <div class=""><h5><a href="principal.php?id_proyectoM=<?php echo $pkID_proyectoM; ?>">Diseño, implementación y Operación de la comunidad Virtual Ondas Guainía.</a> </h5></div>
              </div>
          <div class="col-sm-2 panel panel-default mt-0">
            <h5>01 - A6 </h5>
              </div>
          <div class="col-sm-10 panel panel-default mt-0">
                  <div class=""><h5><a href="principal.php?id_proyectoM=<?php echo $pkID_proyectoM; ?>">Diseño, implementación y operación de un Sistema de información, seguimiento y evaluación permanente - SISEP. </a></h5></div>
              </div>
      </div>
    </div>
</div><br><br>
 <a class="btn btn-primary col-sm-12 display-1 btn-lg" data-toggle="collapse" href="#ejemplo_2" role="button" aria-expanded="false" aria-controls="ejemplo_2">Objetivo 2</a><br>
  <div class="col">
    <div class="collapse multi-collapse" id="ejemplo_2">
      <div class="card card-body"><br>
        <div class="col-sm-2 panel panel-default mt-0">
            <h5>02 - A1 </h5>
              </div>
          <div class="col-sm-10 panel panel-default mt-0">
                  <div class=""><h5><a href="actor.php?id_proyectoM=<?php echo $pkID_proyectoM; ?>">Identificación y vinculación de Actores.</a> </h5></div>
              </div>
          <div class="col-sm-2 panel panel-default mt-0">
            <h5>02 - A2 </h5>
              </div>
          <div class="col-sm-10 panel panel-default mt-0">
                  <div class=""><h5><a href="cientifico.php?id_proyectoM=<?php echo $pkID_proyectoM; ?>">Implementación de Aulas de Ciencia y Tecnología (ACyT) para el apoyo de los grupos ondas.</a></h5></div>
              </div>
          <div class="col-sm-2 panel panel-default mt-0">
            <h5>02 - A3 </h5>
              </div>
          <div class="col-sm-10 panel panel-default mt-0">
                  <div class=""><h5><a href="apropiacion.php?id_proyectoM=<?php echo $pkID_proyectoM; ?>">Actividades de Apropiación Social del Conocimiento en CTI.</a> </h5></div>
              </div>
          <div class="col-sm-2 panel panel-default mt-0">
            <h5>02 - A4 </h5>
              </div>
          <div class="col-sm-10 panel panel-default mt-0">
                  <div class=""><h5><a href="principal.php?id_proyectoM=<?php echo $pkID_proyectoM; ?>">Gerencia y administración del proyecto Actividades de socialización y divulgación.</a> </h5></div>
              </div>
          <div class="col-sm-2 panel panel-default mt-0">
            <h5>02 - A5 </h5>
              </div>
          <div class="col-sm-10 panel panel-default mt-0">
                  <div class=""><h5><a href="principal.php?id_proyectoM=<?php echo $pkID_proyectoM; ?>">Interventoría.</a> </h5></div>
              </div>
          <div class="col-sm-2 panel panel-default mt-0">
            <h5>02 - A6 </h5>
              </div>
          <div class="col-sm-10 panel panel-default mt-0">
                  <div class=""><h5><a href="principal.php?id_proyectoM=<?php echo $pkID_proyectoM; ?>">Imprevistos. </a></h5></div>
              </div>
      </div>
    </div><br><br>

  <a class="btn btn-primary col-sm-12 display-1 btn-lg" data-toggle="collapse" href="#ejemplo_3" role="button" aria-expanded="false" aria-controls="ejemplo_3">Objetivo 3</a><br>
  <div class="col">
    <div class="collapse multi-collapse" id="ejemplo_3">
      <div class="card card-body"><br>
        <div class="col-sm-2 panel panel-default mt-0">
            <h5>03 - A1 </h5>
              </div>
          <div class="col-sm-10 panel panel-default mt-0">
                  <div class=""><h5><a href="cientifico.php?id_proyectoM=<?php echo $pkID_proyectoM; ?>">Implementación del Aula de Investigación Básica Departamental (AIBD). </a></h5></div>
              </div>
          <div class="col-sm-2 panel panel-default mt-0">
            <h5>03 - A2 </h5>
              </div>
          <div class="col-sm-10 panel panel-default mt-0">
                  <div class=""><h5><a href="grupo.php?id_proyectoM=<?php echo $pkID_proyectoM; ?>">Formación, Acompañamiento y seguimiento a Grupos Ondas de Innovación Y Emprendimiento.</a></h5></div>
              </div>
      </div> 
        </div>
    </div><br><br>
      </p><br>
    </div>
    <div class="col-sm-12  mt-0 text-center">
            <a href="principal.php?id_proyectoM=<?php echo $pkID_proyectoM; ?>"><button class="btn btn-success btn-lg " type="button">Menu Principal</button></a>
              </div>
    </div>



          </div>





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