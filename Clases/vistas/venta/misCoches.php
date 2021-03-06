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
$listCarCliente = $tVenta->datosVentaAuto($idCliente);
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
            font-size: 20px; 
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
                <h1 style="font-family: 'Bree Serif', serif; font-size: 40px; text-decoration: #000 ">MIS VEHICULOS</h1>
                <p style="color: #FFF; margin-bottom: 45px; font-size: 20px; color: #f56c40">Información de vehiculos comprados en este concesionario</p>
                <hr>
                <br>
            </div>

            <div class="card text-center container-fluid">
                <p>
                    <?php foreach ($listCarCliente as $fila) {
                        ?>
                        <a class="btn btn-primary" data-toggle="collapse" href="#<?php echo $fila['codigo'] ?>" role="button" aria-expanded="false" aria-controls="collapseExample">
                            <?php echo $fila['marca'] . " " . $fila['modelo'] ?>
                        </a>
                        <?php
                    }
                    ?>
                </p>
                <?php
                foreach ($listCarCliente as $fila) {
                    $idAutom = $fila['id_automovil'];
                    $t = $tExtras->getExtrasId($idAutom);
                    $automoviles = $tAutos->getCodAutomovil($idAutom);
                    ?>
                    <div class="collapse container-fluid" id="<?php echo $fila['codigo'] ?>">
                        <h1 class="text-center center" style="font-weight:  800; font-family: 'Chakra Petch', sans-serif; text-decoration:  underline #000"><?php echo $fila['marca'] . " " . $fila['modelo'] ?></h1>
                        <div class="card card-body"> 
                            <div class="container-fluid col-md-6" style="margin-bottom: 222px; margin-top: 80px">
                                <h1 class="text-center center" style="font-size: 20px; font-weight:  800; font-family: 'Chakra Petch', sans-serif;">DETALLES DEL VEHICULO</h1>
                                <br>
                                <div>
                                    <p class="col-md-6 detalles">Año de matriculación: <a style="color: #245269; margin-left: 15px; font-weight:  400;"><?php echo $fila['ano_mat'] ?></a></p>
                                    <p class="col-md-6 detalles">Kilometros: <a style="color: #245269; margin-left: 15px; font-weight:  400;"><?php echo $fila['kilometros'] ?> km</a></p>
                                    <p class="col-md-6 detalles">Cambio: <a style="color: #245269; margin-left: 15px; font-weight:  400;"><?php echo $t[0]['cambio'] ?></a></p>
                                    <p class="col-md-6 detalles">Combustible: <a style="color: #245269; margin-left: 15px; font-weight:  400;"><?php echo $t[0]['combustible'] ?></a></p>
                                    <p class="col-md-6 detalles">Potencia (cv): <a style="color: #245269; margin-left: 15px; font-weight:  400;"><?php echo $fila['potencia_cv'] ?></a></p>
                                    <p class="col-md-6 detalles">Marchas: <a style="color: #245269; margin-left: 15px; font-weight:  400;"><?php echo $t[0]['num_marchas'] ?></a></p>
                                    <p class="col-md-6 detalles">Número de Plazas: <a style="color: #245269; margin-left: 15px; font-weight:  400;"><?php echo $t[0]['num_plazas'] ?></a></p>
                                    <p class="col-md-6 detalles">Número de Puertas: <a style="color: #245269; margin-left: 15px; font-weight:  400;"><?php echo $t[0]['num_puertas'] ?></a></p>
                                    <p class="col-md-6 detalles">Tracción: <a style="color: #245269; margin-left: 15px; font-weight:  400;"><?php echo $t[0]['traccion'] ?></a></p>
                                    <p class="col-md-6 detalles">Consumo Urbano: <a style="color: #245269; margin-left: 15px; font-weight:  400;"><?php echo $t[0]['c_urbano'] ?></a></p>
                                    <p class="col-md-6 detalles">Consumo Medio: <a style="color: #245269; margin-left: 15px; font-weight:  400;"><?php echo $t[0]['c_medio'] ?></a></p>
                                    <p class="col-md-6 detalles">Consumo Carretera: <a style="color: #245269; margin-left: 15px; font-weight:  400;"><?php echo $t[0]['c_carretera'] ?></a></p>
                                    <p class="col-md-6 detalles">Depósito (Litros): <a style="color: #245269; margin-left: 15px; font-weight:  400;"><?php echo $t[0]['deposito'] ?></a></p>                             

                                </div>
                                <p class="col-md-6 detalles">Descripción del vehiculo: <a style="color: #245269; margin-left: 15px; font-weight:  400;"><?php echo $t[0]['descripcion'] ?></a></p>
                            </div>
                            <br>
                            <div class="col-md-6" style="margin-top: 40px" >
                                <div class="portfolio-item">
                                    <div class="">
                                        <a href="../../../<?php echo $automoviles[0]['foto'] ?>" title="<?php echo $fila['marca'] . " " . $fila['modelo'] ?>" data-lightbox-gallery="gallery2">
                                            <img src="../../../<?php echo $automoviles[0]['foto'] ?>" class="img-responsive" alt="Project Title"> 
                                        </a> 
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
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

