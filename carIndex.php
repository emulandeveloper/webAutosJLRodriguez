<?php
session_start();
require_once './Clases/POJOs/Automovil.php';
require_once './Clases/persistencia/Automoviles.php';
require_once './Clases/POJOs/Usuario.php';
require_once './Clases/persistencia/Usuarios.php';
require_once './Clases/POJOs/ImagenesCar.php';
require_once './Clases/POJOs/Extras_automovil.php';
require_once './Clases/persistencia/Extra_automoviles.php';


//Lista de Coches con foto
$tAutos = Automoviles::singletonAutomoviles();
$tExtras = Extra_automoviles::singletonExtra_automoviles();

$id = $_GET['id'];
$autos = $tAutos->getCodAutomovil($id);
$t = $tExtras->getExtrasId($id);
$automoviles = $tAutos->viewCar($id);
?>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Autos J&L Rodriguez </title>
        <meta name="description" content="">
        <meta name="author" content="">


        <!--Favicons-->
        <!--==================================================--> 
        <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">
        <link rel="apple-touch-icon" href="img/apple-touch-icon.png">
        <link rel="apple-touch-icon" sizes="72x72" href="img/apple-touch-icon-72x72.png">
        <link rel="apple-touch-icon" sizes="114x114" href="img/apple-touch-icon-114x114.png">
        <link href="img/icono.ico" rel="shortcut icon">
        <!--Bootstrap--> 
        <link rel="stylesheet" type="text/css"  href="css/bootstrap.css">
        <link rel="stylesheet" type="text/css" href="fonts/font-awesome/css/font-awesome.css">

        <!--         Stylesheet
                    ================================================== -->
        <link rel="stylesheet" type="text/css"  href="css/style.css">
        <link rel="stylesheet" type="text/css" href="css/nivo-lightbox/nivo-lightbox.css">
        <link rel="stylesheet" type="text/css" href="css/nivo-lightbox/default.css">
        <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,800,600,300' rel='stylesheet' type='text/css'>
        <link href="https://fonts.googleapis.com/css?family=Chakra+Petch:400,700,800" rel="stylesheet"> 
        <link href="https://fonts.googleapis.com/css?family=Arvo" rel="stylesheet"> 
        <link href="https://fonts.googleapis.com/css?family=Cairo:400,600,700,900" rel="stylesheet"> 
        <script type="text/javascript" src="js/modernizr.custom.js"></script>
        <script src="http://code.jquery.com/jquery-1.10.1.min.js"></script>

    </head>
    <style>
        .detalles{
            font-family: 'Cairo', sans-serif; 
            font-weight:  600; 
            font-size: 25px; 
            padding: 5px 10px 5px 10px;
            color: #000
        }
    </style>
    <body style="background-color: #E7E7E7">
        <!-- Navigation
            ==========================================-->
        <nav id="menu" class="navbar navbar-default navbar-fixed-top" style="background-color: #245269; padding: 3px 10px 5px 10px">
            <div class="container"> 
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
                    <a class="navbar-brand page-scroll" href="#page-top"><img src="img/LOGO_J&L22.png" style="margin-top: -6%"></a> </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="index.php" class="page-scroll">Home</a></li>
                        <li><a href="index.php?#about" class="page-scroll">¿Quienes somos?</a></li>
                        <li><a href="index.php?#portfolio" class="page-scroll">Oferta</a></li>
                        <li><a href="index.php?#contact" class="page-scroll">Contactar</a></li>
                    </ul>
                </div>
                <!-- /.navbar-collapse --> 
            </div>
            <!-- /.container-fluid --> 
        </nav>
        <br>
        <br>
        <div  style="padding-top: 105px">
            <div class="container">
                <div class="section-title" style="margin-bottom: -65px">
                    <h2 class="col-lg-6" style="font-size: 45px; font-weight: 800; color: #ff4d00; text-align: left; font-family: 'Arvo', serif;"><?php echo $autos[0]['marca'] . " " . $autos[0]['modelo'] ?></h2>
                    <h2 style="font-size: 50px; color: #245269; text-align: right; font-weight: lighter;" ><?php echo $autos[0]['precio'] ?> &euro;</h2>
                    <p style="text-align: right; margin-right: 20px; margin-top: -20px">CON FINANCIACIÓN</p>
                </div>
            </div>
            <div class="container">
                <div class="row" style="margin-bottom: 40px; margin-top: 30px; margin-left: 10px">                   
                    <div class="portfolio-items">
                        <?php foreach ($automoviles as $auto) { ?>
                            <div class="col-sm-3" >
                                <div class="portfolio-item">
                                    <div class=""> 
                                        <a href="<?php echo $auto['foto'] ?>" title="<?php echo $autos[0]['marca'] . " " . $autos[0]['modelo'] ?>" data-lightbox-gallery="gallery2">
                                            <img src="<?php echo $auto['foto'] ?>" class="img-responsive" alt="<?php echo $autos[0]['marca'] . " " . $autos[0]['modelo'] ?>"> 
                                        </a> 
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
            <hr>
            <div class="container" style="margin-bottom: 162px; margin-top: 45px">
                <h1 class="text-center center" style="font-weight:  800; font-family: 'Chakra Petch', sans-serif; text-decoration:  underline #000">DETALLES DEL VEHICULO</h1>
                <br>
                <div>
                    <p class="col-lg-4 detalles">Año de matriculación: <a style="color: #245269; margin-left: 15px; font-weight:  400;"><?php echo $autos[0]['ano_mat'] ?></a></p>
                    <p class="col-lg-4 detalles">Kilometros: <a style="color: #245269; margin-left: 15px; font-weight:  400;"><?php echo $autos[0]['kilometros'] ?> km</a></p>
                    <p class="col-lg-4 detalles">Cambio: <a style="color: #245269; margin-left: 15px; font-weight:  400;"><?php echo $t[0]['cambio'] ?></a></p>
                    <p class="col-lg-4 detalles">Combustible: <a style="color: #245269; margin-left: 15px; font-weight:  400;"><?php echo $t[0]['combustible'] ?></a></p>
                    <p class="col-lg-4 detalles">Marchas: <a style="color: #245269; margin-left: 15px; font-weight:  400;"><?php echo $t[0]['num_marchas'] ?></a></p>
                    <p class="col-lg-4 detalles">Potencia (cv): <a style="color: #245269; margin-left: 15px; font-weight:  400;"><?php echo $autos[0]['potencia_cv'] ?></a></p>
                    <p class="col-lg-4 detalles">Marchas: <a style="color: #245269; margin-left: 15px; font-weight:  400;"><?php echo $t[0]['num_marchas'] ?></a></p>
                    <p class="col-lg-4 detalles">Número de Plazas: <a style="color: #245269; margin-left: 15px; font-weight:  400;"><?php echo $t[0]['num_plazas'] ?></a></p>
                    <p class="col-lg-4 detalles">Número de Puertas: <a style="color: #245269; margin-left: 15px; font-weight:  400;"><?php echo $t[0]['num_puertas'] ?></a></p>
                    <p class="col-lg-4 detalles">Tracción: <a style="color: #245269; margin-left: 15px; font-weight:  400;"><?php echo $t[0]['traccion'] ?></a></p>
                    <p class="col-lg-4 detalles">Consumo Urbano: <a style="color: #245269; margin-left: 15px; font-weight:  400;"><?php echo $t[0]['c_urbano'] ?></a></p>
                    <p class="col-lg-4 detalles">Consumo Medio: <a style="color: #245269; margin-left: 15px; font-weight:  400;"><?php echo $t[0]['c_medio'] ?></a></p>
                    <p class="col-lg-4 detalles">Consumo Carretera: <a style="color: #245269; margin-left: 15px; font-weight:  400;"><?php echo $t[0]['c_carretera'] ?></a></p>
                    <p class="col-lg-4 detalles">Depósito (Litros): <a style="color: #245269; margin-left: 15px; font-weight:  400;"><?php echo $t[0]['deposito'] ?></a></p>

                </div>
            </div>
            <hr>
            <div class="container" style="margin-bottom: 222px; margin-top: 00px">
                <h1 class="text-center center" style="font-weight:  800; font-family: 'Chakra Petch', sans-serif; font-size: 30px;">DESCRIPCIÓN DEL VEHICULO</h1>
                <div>
                    <p class="detalles"><a style="color: #245269; margin-left: 15px; font-weight:  400; font-size: 22px"><?php echo $t[0]['descripcion'] ?></a></p>

                </div>
            </div>
        </div>


        <div id="footer" style="background-color: #245269">
            <div class="container text-center">
                <div class="fnav">
                    <p>Copyright &copy; 2016 Spectrum. Designed by <a href="http://www.templatewire.com" rel="nofollow">TemplateWire</a></p>
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