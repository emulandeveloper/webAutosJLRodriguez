<?php
session_start();
$tipo = $_SESSION['tipo'];
if ($tipo == 0){
} else {
    header("Location:../index.php");    
}
require_once './POJOs/Automovil.php';
require_once './persistencia/Automoviles.php';
require_once './POJOs/Cliente.php';
require_once './persistencia/Clientes.php';
require_once './POJOs/Email.php';
require_once './persistencia/Emails.php';
require_once './POJOs/Telefono.php';
require_once './persistencia/Telefonos.php';
require_once './POJOs/Direccion.php';
require_once './persistencia/Direcciones.php';
require_once './POJOs/Poblacion.php';
require_once './persistencia/Poblaciones.php';
require_once './POJOs/Empleado.php';
require_once './persistencia/Empleados.php';
require_once './POJOs/Usuario.php';
require_once './persistencia/Usuarios.php';
require_once './POJOs/Venta.php';
require_once './persistencia/Ventas.php';
require_once './POJOs/Extras_automovil.php';
require_once './persistencia/Extra_automoviles.php';

$tAutos = Automoviles::singletonAutomoviles();
$tCliente = Clientes::singletonClientes();
$tDireccion = Direcciones::singletonDirecciones();
$tTelefono = Telefonos::singletonTelefonos();
$tEmail = Emails::singletonEmails();
$tPoblacion = Poblaciones::singletonPoblaciones();
$tEmpleado = Empleados::singletonEmpleados();
$tUsuario = Usuarios::singletonUsuarios();
$tVenta = Ventas::singletonVentas();
$tExtras = Extra_automoviles::singletonExtra_automoviles();


$login = $_SESSION['login'];
$usuario = $tUsuario->getClienteLogin($login);
$nombre = $usuario[0]['nombre'];
$apellido1 = $usuario[0]['apellido1'];
$apellido2 = $usuario[0]['apellido2'];

date_default_timezone_set('Europe/Madrid');
$fecha_venta = date("Y-m-d H:i:s");

$idCliente = $usuario[0]['id_cliente'];
$listCarCliente = $tVenta->datosVentaAuto($idCliente);

$submit = filter_input(INPUT_POST, 'submit');

if (isset($submit)) {
    session_destroy();
    header('Location:../index.php');
}
?>
<html lang="en">
    <head>
        <title>J&L Rodriguez </title>
        <meta name="description" content="">
        <meta name="author" content="">
        <link href="../img/icono.ico" rel="shortcut icon">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
        <link href="../estilo_Admin/styles/layout.css" rel="stylesheet" type="text/css" media="all">
        <!-- Favicons
            ================================================== -->
        <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">
        <link rel="apple-touch-icon" href="img/apple-touch-icon.png">
        <link rel="apple-touch-icon" sizes="72x72" href="img/apple-touch-icon-72x72.png">
        <link rel="apple-touch-icon" sizes="114x114" href="img/apple-touch-icon-114x114.png">
        <link href="img/icono.ico" rel="shortcut icon">
        <!-- Bootstrap -->
        <link rel="stylesheet" type="text/css"  href="../css/bootstrap.css">
        <link rel="stylesheet" type="text/css" href="../fonts/font-awesome/css/font-awesome.css">

        <!-- Stylesheet
            ================================================== -->
        <link rel="stylesheet" type="text/css"  href="../css/style.css">
        <link rel="stylesheet" type="text/css" href="../css/nivo-lightbox/nivo-lightbox.css">
        <link rel="stylesheet" type="text/css" href="../css/nivo-lightbox/default.css">
        <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,800,600,300' rel='stylesheet' type='text/css'>
        <script type="text/javascript" src="js/modernizr.custom.js"></script>
        <script src="http://code.jquery.com/jquery-1.10.1.min.js"></script>

    </head>
    <!-- ################################################################################################ -->
    <!-- ################################################################################################ -->
    <!-- ################################################################################################ -->
    <div class="wrapper row4">
        <nav id="mainav" class="hoc clear "> 
            <!--################################################################################################--> 
            <ul class="clear" style="margin: 0px 0px 0px 0px">
                <li><a style="margin-right: 116px; margin-left: -156px; margin-bottom: -35px; margin-top: -20px; padding-bottom: 30px" href="../index.php"><img src="../img/LOGO_J&LAdmin.png"></a></li>
                <li class="active text-center"><a href="viewCliente.php" style="margin-left: 156px">Home</a></li>
                <li><a href=vistas/cliente/updateCliente.php target="principalView" style="margin-right: -16px; margin-left: 0px">Editar Datos</a></li>
                <li><a href=vistas/venta/misCoches.php target="principalView" style="margin-right: -16px; margin-left: 0px">Mis coches</a></li>
                <li><a class="fa fa-sign-out" style="margin-left: 236px; margin-bottom: -35px; font-size: 22px" href="#modalExit" data-toggle="modal" method="POST"></a></li>

            </ul>
            <!--################################################################################################--> 
        </nav>

    </div>
    <header>
        <div class="modal fade bd-example-modal-sm" id="modalExit" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-sm" role="document" >

                <div class="modal-content" style="background-color: #FFF"> 
                    <div class="modal-header" style="color: #FFF; background-color: #414a52; border-radius: 5px 5px 0px 0px">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" >
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" style="color: #414a52">
                        <form method="post" action="viewCliente.php" name="formularioIndex">
                            <div class="modal-header" style="color: #414a52; margin-bottom: 5px; margin-top: -15px">
                                <h5 class="modal-title" id="exampleModalLabel" style="font-size: 18px">Cerrar Sesión</h5>
                            </div>
                            <div class="modal-body">
                                <p>Desea cerrar la sesión</p>
                            </div>
                            <div class="modal-footer" style="margin-bottom: -10px">
                                <input type="submit" id="submit" name="submit" value="Si" class="btn btn-custom" style="padding: 5px 20px; margin-bottom: -5px">
                                <input type="submit" id="" name="" value="No" class="btn btn-custom" style="padding: 5px 20px; margin-bottom: -5px; background-color: #f56c40">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div>
            <div style="height: 789px; background-color: transparent; " >
                <object  name="principalView" data="../principalView.html" width="100%" height="100%">
                    <!--Contenedor de información variada-->
                </object>
            </div>
        </div>
    </header>


    <!--        <div id="footer">
                <div class="container text-center">
                    <div class="fnav">
                        <p>Copyright &copy; 2016 Spectrum. Designed by <a href="http://www.templatewire.com" rel="nofollow">TemplateWire</a></p>
                    </div>
                </div>
            </div>-->
    <script type="text/javascript" src="../js/jquery.1.11.1.js"></script>
    <script type="text/javascript" src="../js/bootstrap.js"></script>
    <script type="text/javascript" src="../js/SmoothScroll.js"></script>
    <script type="text/javascript" src="../js/nivo-lightbox.js"></script>
    <script type="text/javascript" src="../js/jquery.isotope.js"></script>
    <script type="text/javascript" src="../js/jqBootstrapValidation.js"></script>
    <script type="text/javascript" src="../js/contact_me.js"></script>
    <script type="text/javascript" src="../js/main.js"></script>
    <script src="../estilo_Admin/scripts/jquery.min.js"></script>
    <script src="../estilo_Admin/scripts/jquery.backtotop.js"></script>
    <script src="../estilo_Admin/scripts/jquery.mobilemenu.js"></script>
    <script src="../estilo_Admin/scripts/jquery.flexslider-min.js"></script>
</html>