<?php 
    include("../conexion/datos.php");
    include("../controller/helper_controller/scripts_cont.php");
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
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
    



    <!--<title><?php echo $directorio_raiz; ?></title>-->
    <title>SISEP</title>


    <?php 

        $scripts = new scripts_pag();
        $scripts->standarCss();
     ?>

</head>

<body>

    <div id="wrapper">
        
