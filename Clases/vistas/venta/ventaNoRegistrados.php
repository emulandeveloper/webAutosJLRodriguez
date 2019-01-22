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

$submit = filter_input(INPUT_POST, 'submit');
if (isset($submit)) {

    $e = new Email(null, filter_input(INPUT_POST, 'personal'), filter_input(INPUT_POST, 'otro'));
    $insert = $tEmail->addEmails($e);

    if (!empty($insert)) {

        $t = new Telefono(null, filter_input(INPUT_POST, 'movil'), filter_input(INPUT_POST, 'fijo'), filter_input(INPUT_POST, 'otros'));
        $insertT = $tTelefono->addTelefono($t);

        if (!empty($insertT)) {

            $po = new Poblacion(null, filter_input(INPUT_POST, 'poblacion'), filter_input(INPUT_POST, 'provincia'));
            $insertP = $tPoblacion->addPoblacion($po);

            if (!empty($insertP)) {
                $id_poblacion = $tPoblacion->getUltimoIdPob();
                $d = new Direccion(null, filter_input(INPUT_POST, 'tipo_via'), filter_input(INPUT_POST, 'nombre_via'), filter_input(INPUT_POST, 'numero'), filter_input(INPUT_POST, 'piso'), filter_input(INPUT_POST, 'letra'), filter_input(INPUT_POST, 'escalera'), filter_input(INPUT_POST, 'codPostal'), $id_poblacion);
                $insertD = $tDireccion->addDirecciones($d);

                if (!empty($insertD)) {
                    $email = $tEmail->getUltimoIdEm();
                    $telefono = $tTelefono->getUltimoIdTel();
                    $direccion = $tDireccion->getUltimoIdDir();

                    $nombre = filter_input(INPUT_POST, 'nombre');
                    $apellido1 = filter_input(INPUT_POST, 'apellido1');
                    $dni = filter_input(INPUT_POST, 'dni');
                    $c = new Cliente(NULL, $dni, $nombre, $apellido1, filter_input(INPUT_POST, 'apellido2'), $dni, $direccion, $telefono, $email);
                    $insertC = $tCliente->addCliente($c);

                    if (!empty($insertC)) {

                        $cliente = $tCliente->getUltimoIdClient();
                        $letra_nombre = substr($nombre, 0, 1);
                        $codigo_sn = $letra_nombre . $apellido1 . 00;
                        $password = hash('sha256', $_POST['dni']);
                        $u = new Usuario(null, $codigo_sn, $password, null, $cliente, 0, 1);
                        $insertado = $tUsuario->addUsuario($u);

                        date_default_timezone_set('Europe/Madrid');
                        $fecha_venta = date("Y-m-d H:i:s");
                        $codigoAutoVenta = filter_input(INPUT_POST, 'codigo');
                        $v = new Venta(null, $codigoAutoVenta, $cliente, filter_input(INPUT_POST, 'metodo_pago'), $fecha_venta);
                        $venta = $tVenta->addVenta($v);

                        if (!empty($venta)) {
                            $bajaCodigo = $tAutos->getCodAutomovil($codigoAutoVenta);
                            $codigoBaja = $bajaCodigo[0]['codigo'];
                            $baja = $tAutos->bajaAutomovil($codigoBaja);
                            $idCar = $bajaCodigo[0]['id'];
                            header('Location:confirmacionVenta.php?id_automovil=' . $idCar);
                        }
                    }
                }
            }
        }
    }
} else {
    $id = $_GET['id'];
    $autos = $tAutos->getCodAutomovil($id);
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
    </style>
    <body style="background-color: transparent">

        <div class="allcontain container" style="padding: 70px">
            <div class="text-center" style="font-family: 'Cairo', serif;">
                <h1 class="text-center" style=" font-size: 45px; text-decoration: #000; font-weight: 600 ">ASIGNAR CLIENTE</h1>
                <p style="color: #FFF; margin-bottom: 45px; font-size: 20px; color: #f56c40">Rellenar el formulario con los datos del Cliente </p>
            </div>



            <form name="formulario1" action="ventaNoRegistrados.php" method="POST" enctype="multipart/form-data" style="margin-top: 5%; font-family: 'Comfortaa', sans-serif; font-size: 14px">
                <div class="form-group col-sm-3">
                    <label for="exampleInputEmail1" style="font-size: 16px; font-family: 'Comfortaa', fantasy">Código del Vehiculo<a style="color: red">*</a></label>
                    <input type="text" class="form-control " id="codigo" name="codigo" required value="<?php echo $autos[0]['id'] ?>">
                </div>
                <br>
                <br>
                <br>
                <br>
                <br>

                <div class="form-group">
                    <label for="exampleInputEmail1" style="font-size: 14px; font-family: 'Comfortaa', fantasy">DNI<a style="color: red">*</a></label>
                    <input type="text" class="form-control" id="nombre" name="dni" required >
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1" style="font-size: 14px; font-family: 'Comfortaa', fantasy">Nombre<a style="color: red">*</a></label>
                    <input type="text" class="form-control" id="nombre" name="nombre" required >
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1" style="font-size: 14px; font-family: 'Comfortaa', fantasy">Primer apellido<a style="color: red">*</a></label>
                    <input type="text" class="form-control" id="kms" name="apellido1" minlength="0" required >
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1" style="font-size: 14px; font-family: 'Comfortaa', fantasy">Segundo apellido<a style="color: red">*</a></label>
                    <input type="text" class="form-control" id="caballos" name="apellido2" minlength="0" required >
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1" style="font-size: 14px; font-family: 'Comfortaa', fantasy">Correo electrónico principal</label>
                    <input type="email" class="form-control" id="emailPrincipal" name="personal" aria-describedby="emailHelp">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1" style="font-size: 14px; font-family: 'Comfortaa', fantasy">Otro correo electrónico</label>
                    <input type="email" class="form-control" id="emailSecundario" name="otro" aria-describedby="emailHelp">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1" style="font-size: 14px; font-family: 'Comfortaa', fantasy">Móvil<a style="color: red">*</a></label>
                    <input type="text" class="form-control" id="movil" name ="movil" aria-describedby="emailHelp" required maxlength="9" minlength="9" required>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1" style="font-size: 14px; font-family: 'Comfortaa', fantasy">Fijo</label>
                    <input type="text" class="form-control" id="fijo" name="fijo" aria-describedby="emailHelp" >
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1" style="font-size: 14px; font-family: 'Comfortaa', fantasy">Otro télefono</label>
                    <input type="text" class="form-control" id="otros" name="otros" aria-describedby="emailHelp">
                </div>
                <div class="form-group">
                    <label for="exampleSelect1" style="font-size: 14px; font-family: 'Comfortaa', fantasy">Tipo de via<a style="color: red">*</a></label>
                    <select style="padding: 1.5px 5px 1.5px 5px; margin-left: 5px" id="via" name="tipo_via"> 
                        <option value="0">Elige via</option> 

                        <?php
                        $pago = array("Autopista", "Autovía", "Avenida", "Bulevar", "Calle", "Calle peatonal", "Callejón", "Camino", "Cañada real", "Carretera", "Carretera de circunvalación", "Carril", "Ciclovía", "Corredera", "Costanilla", "Parque", "Pasadizo elevado", "Paseo marítimo", "Plaza", "Puente", "Sendero", "Túnel", "Vía pecuaria", "Vía rápida", "Vía verde", "Urbanización");

                        foreach ($pago as $c => $v) {

                            echo "<option value='$v'>$v</option>";
                        }
                        ?> 
                    </select> 
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1" style="font-size: 14px; font-family: 'Comfortaa', fantasy">Nombre de la via<a style="color: red">*</a></label>
                    <input type="text" class="form-control" id="calle" name="nombre_via" aria-describedby="emailHelp" required >
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1" style="font-size: 14px; font-family: 'Comfortaa', fantasy">Número<a style="color: red">*</a></label>
                    <input type="number" class="form-control" id="numero" name="numero" aria-describedby="emailHelp" required min="1">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1" style="font-size: 14px; font-family: 'Comfortaa', fantasy">Piso</label>
                    <input type="number" class="form-control" id="piso" name="piso" aria-describedby="emailHelp" min="1">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1" style="font-size: 14px; font-family: 'Comfortaa', fantasy">Letra</label>
                    <input type="text" class="form-control" id="letra" name="letra" aria-describedby="emailHelp" maxlength="2">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1" style="font-size: 14px; font-family: 'Comfortaa', fantasy">Escalera</label>
                    <input type="text" class="form-control" id="escalera" name="escalera" aria-describedby="emailHelp" maxlength="2">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1" style="font-size: 14px; font-family: 'Comfortaa', fantasy">Código postal<a style="color: red">*</a></label>
                    <input type="text" class="form-control" id="codPostal" name="codPostal" aria-describedby="emailHelp" required maxlength="5" minlength="5">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1" style="font-size: 14px; font-family: 'Comfortaa', fantasy">Población<a style="color: red">*</a></label>
                    <input type="text" class="form-control" id="poblacion" name="poblacion" aria-describedby="emailHelp" required >
                </div>
                <div class="form-group">
                    <label for="exampleSelect1" style="font-size: 14px; font-family: 'Comfortaa', fantasy">Provincia<a style="color: red">*</a></label>
                    <select style="padding: 1.5px 5px 1.5px 5px; margin-left: 5px" id="provincia" name="provincia"> 
                        <option value="0">Elige una provincia</option> 

                        <?php
                        $provincias = array("Álava", "Albacete", "Alicante", "Almería", "Asturias", "Ávila", "Badajoz", "Barcelona", "Burgos", "Cáceres", "Cádiz", "Cantabria", "Castellón", "Ciudad Real", "Córdoba", "Cuenca", "Gerona", "Granada", "Guadalajara", "Guipúzcoa", "Huelva", "Huesca", "Islas Baleares", "Jaén", "La Coruña", "La Rioja", "Las Palmas", "León", "Lérida", "Lugo", "Madrid", "Málaga", "Murcia", "Navarra", "Orense", "Palencia", "Pontevedra", "Salamanca", "Santa Cruz de Tenerife", "Segovia", "Sevilla", "Soria", "Tarragona", "Teruel", "Toledo", "Valencia", "Valladolid", "Vizcaya", "Zamora", "Zaragoza");

                        foreach ($provincias as $c => $v) {

                            echo "<option value='$v'>$v</option>";
                        }
                        ?> 
                    </select> 
                </div>
                <div class="form-group">
                    <label for="exampleSelect1" style="font-size: 14px; font-family: 'Comfortaa', fantasy">Método de pago<a style="color: red">*</a></label>
                    <select style="padding: 1.5px 5px 1.5px 5px; margin-left: 5px" id="provincia" name="metodo_pago"> 
                        <option value="0">Elige una provincia</option> 

                        <?php
                        $pago = array("Efectivo", "Tarjeta", "Transferencia", "Cheque");

                        foreach ($pago as $c => $v) {

                            echo "<option value='$v'>$v</option>";
                        }
                        ?> 
                    </select> 
                </div>
                <button class="btn-clases" type="submit" value="Registrar" name="submit" style="margin-top: 20px; padding-bottom: 7px; padding-top: 7px; border-radius: 4px;">Agregar</button>
            </form>
        </div>
<!--        <script type="text/javascript" src="../../../js/jquery.1.11.1.js"></script>
        <script type="text/javascript" src="../../../js/bootstrap.js"></script>
        <script type="text/javascript" src="../../../js/SmoothScroll.js"></script>
        <script type="text/javascript" src="../../../js/nivo-lightbox.js"></script>
        <script type="text/javascript" src="../../../js/jquery.isotope.js"></script>
        <script type="text/javascript" src="../../../js/jqBootstrapValidation.js"></script>
        <script type="text/javascript" src="../../../js/main.js"></script>-->
    </body>
</html>