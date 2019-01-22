<!DOCTYPE html>
<?php
session_start();
require_once './Clases/POJOs/Automovil.php';
require_once './Clases/persistencia/Automoviles.php';
require_once './Clases/POJOs/Usuario.php';
require_once './Clases/persistencia/Usuarios.php';
require_once './Clases/POJOs/ImagenesCar.php';

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


        <!-- Favicons
            ================================================== -->
        <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">
        <link rel="apple-touch-icon" href="img/apple-touch-icon.png">
        <link rel="apple-touch-icon" sizes="72x72" href="img/apple-touch-icon-72x72.png">
        <link rel="apple-touch-icon" sizes="114x114" href="img/apple-touch-icon-114x114.png">
        <link href="img/icono.ico" rel="shortcut icon">
        <!-- Bootstrap -->
        <link rel="stylesheet" type="text/css"  href="css/bootstrap.css">
        <link rel="stylesheet" type="text/css" href="fonts/font-awesome/css/font-awesome.css">

        <!-- Stylesheet
            ================================================== -->
        <link rel="stylesheet" type="text/css"  href="css/style.css">
        <link rel="stylesheet" type="text/css" href="css/nivo-lightbox/nivo-lightbox.css">
        <link rel="stylesheet" type="text/css" href="css/nivo-lightbox/default.css">
        <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,800,600,300' rel='stylesheet' type='text/css'>
        <script type="text/javascript" src="js/modernizr.custom.js"></script>
        <script src="http://code.jquery.com/jquery-1.10.1.min.js"></script>

    </head>
    <body id="page-top" data-spy="scroll" data-target=".navbar-fixed-top">
        <!-- Navigation
            ==========================================-->
        <nav id="menu" class="navbar navbar-default navbar-fixed-top">
            <div class="container"> 
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
                    <a class="navbar-brand page-scroll" href="#page-top"><img src="img/LOGO_J&L22.png" style="margin-top: -6%"></a> </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="#page-top" class="page-scroll">Home</a></li>
                        <li><a href="#about" class="page-scroll">¿Quienes somos?</a></li>
                        <li><a href="#portfolio" class="page-scroll">Oferta</a></li>
                        <li><a href="#contact" class="page-scroll">Contactar</a></li>
                        <li><a href="#exampleModal" data-toggle="modal" class="fa fa-sign-in" style="font-size: 23px; margin-bottom: -20px"></a></li>
                    </ul>
                </div>
                <!-- /.navbar-collapse --> 
            </div>
            <!-- /.container-fluid --> 
        </nav>
        <!-- Header -->
        <header id="header" style="background-color: #000">
            <div class="row" style="height: 100%; width: 100%;">
                    <img src="img/logo_web_J&L.jpg" class="img-responsive" alt="">
            </div>

        </header>
        <!-- About Section -->
        <div id="about">
            <div class="container">
                <div class="section-title text-center center">
                    <h2>Sobre Nosotros</h2>
                    <hr>
                </div>
                <div class="row">
                    <div class="col-xs-12 col-md-6"> <img src="img/about.JPG" class="img-responsive" alt=""> </div>
                    <div class="col-xs-12 col-md-6">
                        <div class="about-text">
                            <p>Concesionario J&L RODRIGUEZ dedicados al servicio de venta de vehiculos desde el 2017, tenemos una gran variedad de vehiculos a sus servicios y si no le gusta ninguno de ellos nosotros mismos nos encargamos sin ningun coste adicional de la busqueda de ese vehiculo en concreto.</p>
                            <p>Ademas somos sede de una empresa de alquileres de coches como es VITALQUILER, nosotros le tramitamos todos los papeles para el alquiler de su vehiculo.</p>
                            <p>Nos situamos en: C/ Francisco Pizarro,38 - Puebla de la Calzada (Badajoz) <br> Teléfono de contacto: 678781343</p>
                            <a href="#portfolio" class="btn btn-default btn-lg page-scroll">Nuestro Catálogo</a> </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Portfolio Section -->
        <div id="portfolio">
            <div class="container">
                <div class="section-title text-center center">
                    <h2 style="font-size: 45px">Catálogo</h2>
                    <p style="color: #FFF; margin-bottom: 45px">Cartera de automóviles disponibles en nuestro concesionario</p>
                    <hr>
                </div>
                <div class="row">                   
                    <div class="portfolio-items">
                        <?php foreach ($automoviles as $auto) { ?>
                            <div class="col-sm-6 col-md-3 col-lg-3 web">
                                <div class="portfolio-item">
                                    <div class="hover-bg"> <a href="carIndex.php?id= <?php echo $auto['id'] ?>" title="Project title" data-lightbox-gallery="gallery2">
                                            <?php //echo $auto['foto']    ?>
                                            <div class="hover-text">
                                                <h2 style="font-size: 25px; margin-top: 7px"><?php echo $auto['marca'] . " " . $auto['modelo'] ?></h2>
                                                <p><?php echo $auto['kilometros'] ?> km</p>
                                                <p><?php echo $auto['ano_mat'] ?></p>
                                                <p><?php echo $auto['potencia_cv'] ?>cv</p>
                                                <h6 style="font-size: 15px; color: #ff6600; font-weight: bold"><?php echo $auto['precio'] ?>&euro;</h6>
                                            </div>
                                            <img src="<?php echo $auto['foto'] ?>" class="img-responsive" alt="Project Title"> </a> </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
        <!-- Contact Section -->
        <div id="contact" class="text-center">
            <div class="container">
                <div class="section-title center">
                    <h2>Donde nos encontramos</h2>
                    <hr>
                </div>
                <div style="width: 100%">
                    <iframe width="100%" height="400" src="https://maps.google.com/maps?width=100%&height=600&hl=es&q=Calle%20Francisco%20Pizarro%2C%2038%2C%20Puebla%20de%20la%20Calzada+(autos%20rs)&ie=UTF8&t=&z=15&iwloc=B&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"><a href="https://www.mapsdirections.info/calcular-ruta.html">Calcular Ruta</a>
                    </iframe>
                </div><br>
               
                    <div class="social">
                        <ul>
                            <li><a href="https://www.facebook.com/AutosJLRodriguez/"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="https://www.instagram.com/larodriguezsanchez/?hl=es"><i class="fa fa-instagram"></i></a></li>
                            <li><a href="#numberModal" data-toggle="modal"><i class="fa fa-phone"></i></a></li>

                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal " tabindex="-1" role="dialog" id="numberModal">
            <div class="modal-dialog " role="document">
                <div class="modal-content ">
                    <div class="modal-header ">
                        <h4 class="modal-title">Número de Teléfono</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body ">
                        <h2>655 215 445</h2>
                    </div>
                </div>
            </div>
        </div>
        <div id="footer">
            <div class="container text-center">
                <div class="fnav">
                    <p>Copyright &copy; 2018 J&L. Designed by <a href="" rel="nofollow">ÉmulanDeveloper</a></p>
                </div>
            </div>
        </div>

        <script type="text/javascript" src="js/jquery.1.11.1.js"></script> 
        <script type="text/javascript" src="js/bootstrap.js"></script> 
        <script type="text/javascript" src="js/SmoothScroll.js"></script> 
        <script type="text/javascript" src="js/nivo-lightbox.js"></script> 
        <script type="text/javascript" src="js/jquery.isotope.js"></script> 
        <script type="text/javascript" src="js/jqBootstrapValidation.js"></script> 
        <script type="text/javascript" src="js/main.js"></script>        
    </body>
</html>