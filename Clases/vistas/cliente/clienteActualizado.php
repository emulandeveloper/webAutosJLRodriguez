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
require_once '../../POJOs/Extras_automovil.php';
require_once '../../persistencia/Extra_automoviles.php';

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
$c = $tCliente->getClienteLogin($login);
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
    <body style="background-color: transparent">
        <div class="allcontain">
            <br>
            <div class="feturedsection text-center">
                <h1 style="font-family: 'Bree Serif', serif; font-size: 40px; text-decoration: #000 ">MIS DATOS</h1>
                <p style="color: #FFF; margin-bottom: 45px; font-size: 20px; color: #f56c40">Tus datos han sido actualizados correctamente</p>
                <hr>
                <br>
            </div>

            <div class="text-center container">
                <?php
                foreach ($c as $fila) {
                    $emails = $tEmail->getEmails($fila['id_email']);
                    $direccion = $tDireccion->getDireccion($fila['id_direccion']);
                    $poblacion = $tPoblacion->getPoblacion($direccion[0]['id_poblacion']);
                    $telefono = $tTelefono->getTelefono($fila['id_telefono']);
                    ?>
                    <div class="container">
                        <div class="container text-justify" style="margin-bottom: 222px; margin-top: 80px">
                            <br>
                            <div>
                                <p class="col-md-6 detalles">DNI: <a style="color: #245269; margin-left: 15px; font-weight:  400;"><?php echo $fila['dni'] ?></a></p>
                                <p class="col-md-6 detalles">Nombre: <a style="color: #245269; margin-left: 15px; font-weight:  400;"><?php echo $fila['nombre'] ?></a></p>
                                <p class="col-md-6 detalles">Apellidos: <a style="color: #245269; margin-left: 15px; font-weight:  400;"><?php echo $fila['apellido1'] . " " . $fila['apellido2'] ?></a></p>
                                <p class="col-md-6 detalles">Direccion: <a style="color: #245269; margin-left: 15px; font-weight:  400;"><?php echo $direccion[0]['tipo_via'] . " " . $direccion[0]['nombre_via'] . ", " . $direccion[0]['numero']?></a></p>
                                <p class="col-md-6 detalles">Piso: <a style="color: #245269; margin-left: 15px; font-weight:  400;"><?php echo $direccion[0]['piso'] . "" . $direccion[0]['letra'] ?></a></p>
                                <p class="col-md-6 detalles">Escalera: <a style="color: #245269; margin-left: 15px; font-weight:  400;"><?php echo $direccion[0]['escalera'] ?></a></p>
                                <p class="col-md-6 detalles">Código Postal: <a style="color: #245269; margin-left: 15px; font-weight:  400;">0<?php echo $direccion[0]['cod_postal'] ?></a></p>
                                <p class="col-md-6 detalles">Ciudad: <a style="color: #245269; margin-left: 15px; font-weight:  400;"><?php echo $poblacion[0]['municipio'] . " (" . $poblacion[0]['provincia'] . ")" ?></a></p>
                                <p class="col-md-6 detalles">Movil: <a style="color: #245269; margin-left: 15px; font-weight:  400;"><?php echo $telefono[0]['movil'] ?></a></p>
                                <p class="col-md-6 detalles">Fijo: <a style="color: #245269; margin-left: 15px; font-weight:  400;"><?php echo $telefono[0]['fijo'] ?></a></p>
                                <p class="col-md-6 detalles">Otro: <a style="color: #245269; margin-left: 15px; font-weight:  400;"><?php echo $telefono[0]['otro'] ?></a></p>
                                <p class="col-md-6 detalles">Correos Electrónicos: <a style="color: #245269; margin-left: 15px; font-weight:  400;"><?php echo $emails[0]['personal'] . ", " . $emails[0]['otro'] ?></a></p>

                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
        <script type="text/javascript" src="../../../js/jquery.1.11.1.js"></script>
        <script type="text/javascript" src="../../../js/bootstrap.js"></script>
        <script type="text/javascript" src="../../../js/SmoothScroll.js"></script>
        <script type="text/javascript" src="../../../js/nivo-lightbox.js"></script>
        <script type="text/javascript" src="../../../js/jquery.isotope.js"></script>
        <script type="text/javascript" src="../../../js/jqBootstrapValidation.js"></script>

        <script type="text/javascript" src="../../../js/main.js"></script>
    </body>
</html>

