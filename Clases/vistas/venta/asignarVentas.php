<?php
session_start();
require_once '../../POJOs/Cliente.php';
require_once '../../persistencia/Clientes.php';

$submit = filter_input(INPUT_POST, 'submit');

if (isset($submit)) {

    /* @var $dni type */
    $dni = $_POST['dni'];
    $tCliente = Clientes::singletonClientes();
    $c = $tCliente->getUnCliente($dni);


    if (is_null($c)) {
        header('location:ventaCoche.php');
    } else {
        header('location:ventaCocheRegistrado.php');
    }
} else {
    $modal = true;
}
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
        <script src="//code.jquery.com/jquery-1.12.0.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

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
        .btn-opcion {
            color: #269abc;
            background-color:

                background: rgba(54,147,194,0.85);
            background: -moz-radial-gradient(center, ellipse cover, rgba(54,147,194,0.85) 0%, rgba(255,255,255,0.22) 66%, rgba(255,255,255,0.07) 82%, rgba(255,255,255,0) 89%);
            background: -webkit-gradient(radial, center center, 0px, center center, 100%, color-stop(0%, rgba(54,147,194,0.85)), color-stop(66%, rgba(255,255,255,0.22)), color-stop(82%, rgba(255,255,255,0.07)), color-stop(89%, rgba(255,255,255,0)));
            background: -webkit-radial-gradient(center, ellipse cover, rgba(54,147,194,0.85) 0%, rgba(255,255,255,0.22) 66%, rgba(255,255,255,0.07) 82%, rgba(255,255,255,0) 89%);
            background: -o-radial-gradient(center, ellipse cover, rgba(54,147,194,0.85) 0%, rgba(255,255,255,0.22) 66%, rgba(255,255,255,0.07) 82%, rgba(255,255,255,0) 89%);
            background: -ms-radial-gradient(center, ellipse cover, rgba(54,147,194,0.85) 0%, rgba(255,255,255,0.22) 66%, rgba(255,255,255,0.07) 82%, rgba(255,255,255,0) 89%);
            background: radial-gradient(ellipse at center, rgba(54,147,194,0.85) 0%, rgba(255,255,255,0.22) 66%, rgba(255,255,255,0.07) 82%, rgba(255,255,255,0) 89%);
            filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#3693c2', endColorstr='#ffffff', GradientType=1 );


            border-color: transparent;
        }
        .btn-opcion:hover,
        .btn-opcion:focus,
        .btn-opcion.focus,
        .btn-opcion:active,
        .btn-opcion.active,
        .open > .dropdown-toggle.btn-opcion {
            color: #269abc;
        }
    </style>
    <body style="background-color: transparent">
        <br>
        <br>

        <div class="allcontain container" style="padding: 70px">
            <div class="modal fade bd-example-modal-sm" id="myModal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-sm" role="document" >

                    <div class="modal-content" style="background-color: #FFF"> 
                        <div class="modal-header" style="color: #FFF; background-color: #414a52; border-radius: 5px 5px 0px 0px">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close" >
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body" style="color: #414a52">
                            <form method="post" action="asignarVentas.php" name="form">
                                <div class="modal-header" style="color: #414a52; margin-bottom: 5px; margin-top: -15px">
                                    <h5 class="modal-title" id="exampleModalLabel" style="font-size: 18px">Acceso Ventas</h5>
                                    <a style="margin-left: 27.5%; color: #414a52">Portal de ventas</a>
                                </div>
                                <div class="form-group" style="margin-top: 10px">
                                    <label for="dni" class="col-form-label" style="font-size: 15px">Dni del cliente:</label>
                                    <input type="text" name="dni" class="form-control" id="dni" style="background-color: #54d0dd" placeholder="Introducir DNI del cliente">
                                </div>
                                <div class="modal-footer" style="margin-bottom: -10px">
                                    <input type="submit" id="submit" name="submit" value="Confirmar" class="btn btn-custom" style="padding: 5px 20px; margin-bottom: -5px">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="text-center" style="font-family: 'Cairo', serif;">
                <h1 class="text-center" style=" font-size: 45px; text-decoration: #000; font-weight: 600 ">VENTA</h1>
                <p style="color: #FFF; margin-bottom: 45px; font-size: 20px; color: #f56c40">Introducir el DNI del cliente requerido</p>
            </div>
        </div>
        <?php
        if ($modal === true) {
            ?>
            <script>

                $(document).ready(function () {

                    $("#myModal").modal();

                });
            </script>
            <?php
        }
        ?>
    <!--        <script type="text/javascript" src="../../../js/jquery.1.11.1.js"></script>
        <script type="text/javascript" src="../../../js/bootstrap.js"></script>
        <script type="text/javascript" src="../../../js/SmoothScroll.js"></script>
        <script type="text/javascript" src="../../../js/nivo-lightbox.js"></script>
        <script type="text/javascript" src="../../../js/jquery.isotope.js"></script>
        <script type="text/javascript" src="../../../js/jqBootstrapValidation.js"></script>
        <script type="text/javascript" src="../../../js/main.js"></script>-->
    </body>
</html>

