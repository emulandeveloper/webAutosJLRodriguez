<?php
session_start();
require_once '../../../Clases/POJOs/Automovil.php';
require_once '../../../Clases/persistencia/Automoviles.php';
require_once '../../../Clases/POJOs/Usuario.php';
require_once '../../../Clases/persistencia/Usuarios.php';
require_once '../../../Clases/POJOs/ImagenesCar.php';


//Lista de Coches con foto
$tAutos = Automoviles::singletonAutomoviles();
$automoviles = $tAutos->getAllAutos();
?>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Autos J&L Rodriguez </title>
        <meta name="description" content="">
        <meta name="author" content="">
        <link href="../img/icono.ico" rel="shortcut icon">
        <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,800,600,300' rel='stylesheet' type='text/css'>
        <!-- Bootstrap -->
        <link rel="stylesheet" type="text/css"  href="../../../css/bootstrap.css">
        <link rel="stylesheet" type="text/css" href="../../../fonts/font-awesome/css/font-awesome.css">

        <!-- Stylesheet
            ================================================== -->
        <link rel="stylesheet" type="text/css"  href="../../../css/style.css">
        <link rel="stylesheet" type="text/css" href="../../../css/nivo-lightbox/nivo-lightbox.css">
        <link rel="stylesheet" type="text/css" href="../../../css/nivo-lightbox/default.css">
        <link href="https://fonts.googleapis.com/css?family=Bree+Serif" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Comfortaa" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Cairo:400,600,700,900" rel="stylesheet"> 

    </head>
    <style>
        .btn-clases {
            text-transform: uppercase;
            color: #FFF;
            background-color: #f56c40;
            border: 0;
            padding: 14px 20px;
            margin: 0;
            font-size: 16px;
            border-radius: 0;
            margin-top: -200px;
            transition: all 0.3s;
        }
        .btn-clases:hover, .btn-clases:focus, .btn-clases.focus, .btn-clases:active, .btn-clases.active {
            color: #f56c40;
            background-color: #101010;
        }
        .elc-editar{
            color: #0E76A8;
            transition: all 0.5s;
            font-weight: 600;
        }
        .elc-editar:hover {
            color: #f56c40;
        }
    </style>
    <body style="background-color: #E7E7E7">
        <div style="margin-bottom: 15px; padding: 70px ">
            <div class="container">
                <div class="section-title text-center center" style="font-family: 'Cairo', serif;">
                    <h2 style="font-size: 65px; font-family: 'Cairo', serif; font-weight: 600">Catálogo de Venta</h2>
                    <p style="color: #FFF; margin-bottom: 45px; font-size: 20px; color: #f56c40">Selecciona el coche para realizar la venta</p>
                    <hr>
                </div>
                <div class="row">                   
                    <div class="portfolio-items">
                        <?php foreach ($automoviles as $auto) { ?>
                            <div class="col-sm-6 col-md-3 col-lg-3 web">
                                <div class="portfolio-item">
                                    <div class="hover-bg"> <a href="ventaNoRegistrados.php?id= <?php echo $auto['id'] ?>" title="Project title" data-lightbox-gallery="gallery2">
                                            <?php //echo $auto['foto'] ?>
                                            <div class="hover-text">
                                                <h2 style="font-size: 25px; margin-top: 7px; color: #00ACEE"><?php echo $auto['marca'] . " " . $auto['modelo'] ?></h2>
                                                <p><?php echo $auto['kilometros'] ?> km</p>
                                                <p><?php echo $auto['ano_mat'] ?></p>
                                                <p><?php echo $auto['potencia_cv'] ?>cv</p>
                                                <h6 style="font-size: 15px; color: #ff6600; font-weight: bold"><?php echo $auto['precio'] ?>&euro;</h6>
                                            </div>
                                            <img src="../../../<?php echo $auto['foto'] ?>" class="img-responsive" alt="Project Title"> </a> </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
        <hr>
        <script type="text/javascript" src="../../../js/jquery.1.11.1.js"></script>
        <script type="text/javascript" src="../../../js/bootstrap.js"></script>
        <script type="text/javascript" src="../../../js/SmoothScroll.js"></script>
        <script type="text/javascript" src="../../../js/nivo-lightbox.js"></script>
        <script type="text/javascript" src="../../../js/jquery.isotope.js"></script>
        <script type="text/javascript" src="../../../js/jqBootstrapValidation.js"></script>

        <script type="text/javascript" src="../../../js/main.js"></script>
    </body>
</html>
