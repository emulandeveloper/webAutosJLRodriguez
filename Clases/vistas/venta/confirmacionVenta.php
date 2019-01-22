<?php
session_start();
require_once '../../POJOs/Automovil.php';
require_once '../../persistencia/Automoviles.php';
require_once '../../POJOs/Cliente.php';
require_once '../../persistencia/Clientes.php';
require_once '../../POJOs/Email.php';
require_once '../../persistencia/Emails.php';
require_once '../../POJOs/Telefono.php';
require_once '../../persistencia/Telefonos.php';
require_once '../../POJOs/Direccion.php';
require_once '../../persistencia/Direcciones.php';
require_once '../../POJOs/Poblacion.php';
require_once '../../persistencia/Poblaciones.php';
require_once '../../POJOs/Empleado.php';
require_once '../../persistencia/Empleados.php';
require_once '../../POJOs/Usuario.php';
require_once '../../persistencia/Usuarios.php';
require_once '../../POJOs/Venta.php';
require_once '../../persistencia/Ventas.php';

$tAutos = Automoviles::singletonAutomoviles();
$tCliente = Clientes::singletonClientes();
$tDireccion = Direcciones::singletonDirecciones();
$tTelefono = Telefonos::singletonTelefonos();
$tEmail = Emails::singletonEmails();
$tPoblacion = Poblaciones::singletonPoblaciones();
$tEmpleado = Empleados::singletonEmpleados();
$tUsuario = Usuarios::singletonUsuarios();
$tVenta = Ventas::singletonVentas();

$id = $_GET['id_automovil'];
$confirmacion = $tVenta->confirmacionVenta($id);
$cliente = $tCliente->getCodigoCliente($id);
$usuario = $tUsuario->getUsuario($cliente[0]['id_cliente']);

$modal = true;
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

        <!-- Stylesheet ================================================== -->
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
        <br><br>
        <div class="modal fade bd-example-modal-sm" id="myModal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" style="margin: 10px 360px 10px 360px">
            <!--<div class="modal-dialog modal-sm" role="document" >-->
            <div class="modal-content " style="background-color: #FFF"> 
                <div class="modal-header" style="color: #FFF; background-color: #414a52; border-radius: 5px 5px 0px 0px">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" >
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class= "modal-body" style= "color: #414a52">
                    <div class= "container">
                        <div class= "jumbotron">
                            <img class= "col-lg-2" src="../../../img/check_confirmacion.jpg"><h1 class= "col-lg-10 display-4" style= "margin-bottom: 70px">Venta Realizada</h1>
                            <p class= "lead">Se ha realizado la venta del <a style="color: #080808; font-size: 20px; font-weight: 700"><?php echo $confirmacion[0]['marca'] . " " . $confirmacion[0]['modelo'] ?></a> correctamente a <?php ?><a style="color: #DB4A39; font-size: 20px; font-weight: 700"><?php echo $cliente[0]['nombre'] . " " . $cliente[0]['apellido1'] . " " . $cliente[0]['apellido2'] ?></a>.</p>
                            <hr class= "my-4">
                            <p><a style="color: #080808; font-size: 20px; font-weight: 700"><?php echo $cliente[0]['nombre'] . " " . $cliente[0]['apellido1'] . " " . $cliente[0]['apellido2'] ?></a> puede acceder a los datos del vehiculo comprado atraves de su: <br> <br>
                                <a style="color: #414a52; font-weight: bold">Usuario: <?php echo $usuario[0]['login'] ?> </a><br>
                                <a style="color: #414a52; font-weight: bold"> Contraseña: <?php echo $cliente[0]['dni'] ?></a><br><a style="color: #DB4A39; font-size: 12px">Cambiar la conraseña lo antes posible</a></p>
                            <a class= "btn btn-primary btn-lg" href= "../cliente/listClientes.php" role= "button" style= "margin-right: 105px">Ir a Lista de Clientes</a>
                        </div>
                    </div>
                </div>
            </div>
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



