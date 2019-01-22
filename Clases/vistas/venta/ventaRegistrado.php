<?php
session_start();
require_once '../../POJOs/Automovil.php';
require_once '../../persistencia/Automoviles.php';
require_once '../../POJOs/Usuario.php';
require_once '../../persistencia/Usuarios.php';
require_once '../../POJOs/ImagenesCar.php';
require_once '../../POJOs/Venta.php';
require_once '../../persistencia/Ventas.php';
require_once '../../POJOs/Cliente.php';
require_once '../../persistencia/Clientes.php';

$submit = filter_input(INPUT_POST, 'submit');

$tCliente = Clientes::singletonClientes();
$tVenta = Ventas::singletonVentas();
$tAutos = Automoviles::singletonAutomoviles();
if (isset($submit)) {
    $modal = true;
    $dni = filter_input(INPUT_POST, 'dni');
    $codigoAutoVenta = filter_input(INPUT_POST, 'codigo');
    $buscar = $tCliente->getClienteDni($dni);
    $bajaCodigo = $tAutos->getCodAutomovil($codigoAutoVenta);

    date_default_timezone_set('Europe/Madrid');
    $fecha_venta = date("Y-m-d H:i:s");


    $v = new Venta(null, filter_input(INPUT_POST, 'codigo'), $buscar[0]['id'], filter_input(INPUT_POST, 'metodo_pago'), $fecha_venta);
    $venta = $tVenta->addVenta($v);
    if (!empty($venta)) {
        $codigoBaja = $bajaCodigo[0]['codigo'];
        $idCar = $bajaCodigo[0]['id'];
        $baja = $tAutos->bajaAutomovil($codigoBaja);
        header('Location:confirmacionVenta.php?id_automovil=' . $idCar);
    }
} else {
    $cod = $_GET['id'];
    $modal = false;
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
    <body style="background-color: transparent">
        <div class="allcontain container">
            <div>
                <div class="text-center" style="font-family: 'Cairo', serif;">
                    <h1 class="text-center" style="font-family: 'Bree Serif', serif; font-size: 40px; text-decoration: #000 ">DATOS DE LA VENTA</h1>
                    <p style="color: #FFF; margin-bottom: 45px; font-size: 20px; color: #f56c40">Rellenar el formularios con los datos necesarios para la venta</p>
                </div>
                <hr>
                <form name="formulario1" action="ventaRegistrado.php" method="POST" enctype="multipart/form-data" style="margin-top: 5%; font-family: 'Comfortaa', sans-serif; font-size: 14px">
                    <div class="form-group col-md-3">
                        <label for="exampleInputEmail1" style="font-size: 14px; font-family: 'Comfortaa', fantasy">Còdigo automovil<a style="color: red">*</a></label>
                        <input type="text" class="form-control" id="nombre" name="codigo" required value="<?php echo $cod ?>">
                    </div>
                    <br>
                    <br>
                    <br>
                    <br>

                    <div class="form-group">
                        <label for="exampleSelect1" style="font-size: 14px; font-family: 'Comfortaa', fantasy">Cliente</label>
                                <select style="padding: 1.5px 5px 1.5px 5px; margin-left: 5px " id="banco" name="dni"> 
                                    <option value="banco">Elige cliente a realizar la venta</option> 
                                    <?php
                                    $clientes = $tCliente->getAllClientes();

                                    foreach ($clientes as $row) {

                                        $c = $row['dni'];
                                        $v = $row['nombre'];
                                        $ap1 = $row['apellido1'];
                                        $ap2 = $row['apellido2'];
                                        $dni = $row['dni'];

                                        echo "<option value='$c'>$v  $ap1  $ap2 - $dni</option>";
                                    }
                                    ?> 
                                </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleSelect1" style="font-size: 14px; font-family: 'Comfortaa', fantasy">Método de pago<a style="color: red">*</a></label>
                        <select style="padding: 1.5px 5px 1.5px 5px; margin-left: 5px "  id="provincia" name="metodo_pago"> 
                            <option value="0">Elige método</option> 

                            <?php
                            $pago = array("Efectivo", "Tarjeta", "Transferencia", "Cheque");

                            foreach ($pago as $c => $v) {

                                echo "<option value='$v'>$v</option>";
                            }
                            ?> 
                        </select> 
                    </div>
                    <button class="btn-clases" type="submit" value="Confirmar" name="submit" style="margin-top: 20px; padding-bottom: 7px; padding-top: 7px; border-radius: 4px;">Confirmar</button>
                </form>
            </div>
        </div>
        <?php
        if ($modal == true) {
            ?>
            <script>

                $(document).ready(function () {

                    $("#myModal").modal();

                });
            </script>
            <?php
        }
        ?>
        <script type="text/javascript" src="../../../js/jquery.1.11.1.js"></script>
        <script type="text/javascript" src="../../../js/bootstrap.js"></script>
        <script type="text/javascript" src="../../../js/SmoothScroll.js"></script>
        <script type="text/javascript" src="../../../js/nivo-lightbox.js"></script>
        <script type="text/javascript" src="../../../js/jquery.isotope.js"></script>
        <script type="text/javascript" src="../../../js/jqBootstrapValidation.js"></script>

        <script type="text/javascript" src="../../../js/main.js"></script>
    </body>
</html>

