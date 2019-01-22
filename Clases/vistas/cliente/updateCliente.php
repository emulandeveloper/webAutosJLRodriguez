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

$login = $_SESSION['login'];
$usuario = $tUsuario->getClienteLogin($login);
$idCliente = $usuario[0]['id_cliente'];
$idDireccion = $usuario[0]['id_direccion'];
$idTelefono = $usuario[0]['id_telefono'];
$idEmail = $usuario[0]['id_email'];

$email = $tEmail->getEmails($idEmail);
$telefono = $tTelefono->getTelefono($idTelefono);
$direccion = $tDireccion->getDireccion($idDireccion);

$idPoblacion = $direccion[0]['id_poblacion'];
$poblacion = $tPoblacion->getPoblacion($idPoblacion);

$submit = filter_input(INPUT_POST, 'submit');
if (isset($submit)) {
    $usuario = $tUsuario->getClienteLogin($login);
    $idCliente = $usuario[0]['id_cliente'];
    $idDireccion = $usuario[0]['id_direccion'];
    $idTelefono = $usuario[0]['id_telefono'];
    $idEmail = $usuario[0]['id_email'];

    $usuarioId = $tUsuario->getIdUsuario($login);
    $idUsuario = $usuarioId[0]['id'];
    $password = filter_input(INPUT_POST, 'password');
    $tipo = 0;
    $activo = 1;

    $email = $tEmail->getEmails($idEmail);
    $telefono = $tTelefono->getTelefono($idTelefono);
    $direccion = $tDireccion->getDireccion($idDireccion);

    $idPoblacion = $direccion[0]['id_poblacion'];
    $poblacion = $tPoblacion->getPoblacion($idPoblacion);

    $personal = filter_input(INPUT_POST, 'personal');
    $otroEmail = filter_input(INPUT_POST, 'otro');
    $movil = filter_input(INPUT_POST, 'movil');
    $fijo = filter_input(INPUT_POST, 'fijo');
    $otroTel = filter_input(INPUT_POST, 'otros');
    $municipio = filter_input(INPUT_POST, 'poblacion');
    $provincia = filter_input(INPUT_POST, 'provincia');
    $tipoVia = filter_input(INPUT_POST, 'tipo_via');
    $nombreVia = filter_input(INPUT_POST, 'nombre_via');
    $numero = filter_input(INPUT_POST, 'numero');
    $piso = filter_input(INPUT_POST, 'piso');
    $letra = filter_input(INPUT_POST, 'letra');
    $escalera = filter_input(INPUT_POST, 'escalera');
    $codPostal = filter_input(INPUT_POST, 'codPostal');
    $codCliente = filter_input(INPUT_POST, 'codigo');
    $nombre = filter_input(INPUT_POST, 'nombre');
    $apellido1 = filter_input(INPUT_POST, 'apellido1');
    $apellido2 = filter_input(INPUT_POST, 'apellido2');
    $dni = filter_input(INPUT_POST, 'dni');

    $insert = $tEmail->updateEmails($idEmail, $personal, $otroEmail);
    $insertT = $tTelefono->updateTelefonos($idTelefono, $movil, $fijo, $otroTel);
    $insertP = $tPoblacion->updatePoblaciones($idPoblacion, $municipio, $provincia);
    $insertD = $tDireccion->updateDirecciones($idDireccion, $tipoVia, $nombreVia, $numero, $piso, $letra, $escalera, $codPostal, $idPoblacion);
    $insertC = $tCliente->updateClientes($idCliente, $codCliente, $nombre, $apellido1, $apellido2, $dni, $idDireccion, $idTelefono, $idEmail);
    $final = $tUsuario->updateUsuarios($idUsuario, $login, $password, $idCliente, $tipo, $activo);

    
}
                    if (!empty($final)){
                        header('Location:./clienteActualizado.php');
                    }
?>

<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>J&L Rodriguez </title>
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
        .btn-buscar {
            text-transform: uppercase;
            color: #FFF;
            background-color: #f56c40;
            border: 0;
            padding: 8px 15px;
            margin-left: 10%; 
            margin-top: 20px;
            font-size: 16px;
            border-radius: 5px;
            transition: all 0.3s;
        }
        .btn-buscar:hover, .btn-buscar:focus, .btn-buscar.focus, .btn-buscar:active, .btn-buscar.active {
            color: #f56c40;
            background-color: #101010;
        }
    </style>
    <body style="background-color: transparent">

        <div class="allcontain container">
            <div class="feturedsection">
                <h1 class="text-center" style="font-family: 'Bree Serif', serif; font-size: 40px; text-decoration: #000 "> MODIFICAR COCHE</h1>
                <br>
                <hr>
            </div>
            <form name="formulario1" action="updateCliente.php" method="POST" enctype="multipart/form-data" style="margin-top: 5%; font-family: 'Comfortaa', sans-serif; font-size: 14px">
<!--                <div class="form-group col-sm-3">
                    <label for="exampleInputEmail1" style="font-size: 16px; font-family: 'Comfortaa', fantasy">Código del Vehiculo<a style="color: red">*</a></label>
                    <input type="text" class="form-control " id="codigo" name="codigo" required readonly="readonly" value="<?php echo $usuario[0]['cod_cliente'] ?>">
                </div>
                <br>
                <br>
                <br>
                <br>
                <br>-->
                <div class="form-group">
                    <label for="exampleInputEmail1" style="font-size: 14px; font-family: 'Comfortaa', fantasy">Username<a style="color: red">*</a></label>
                    <input type="text" class="form-control" id="nombre" name="login" required value="<?php echo $usuario[0]['login'] ?>" readonly="readonly">
                </div>
                <a style="color: #DB4A39" href="updatePass.php?login=<?php echo $login; ?>">Actualizar contraseña</a><br><br>    
                <div class="form-group">
                    <label for="exampleInputEmail1" style="font-size: 14px; font-family: 'Comfortaa', fantasy">DNI<a style="color: red">*</a></label>
                    <input type="text" class="form-control" id="nombre" name="dni" required value="<?php echo $usuario[0]['dni'] ?>">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1" style="font-size: 14px; font-family: 'Comfortaa', fantasy">Nombre<a style="color: red">*</a></label>
                    <input type="text" class="form-control" id="nombre" name="nombre" required value="<?php echo $usuario[0]['nombre'] ?>">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1" style="font-size: 14px; font-family: 'Comfortaa', fantasy">Primer apellido<a style="color: red">*</a></label>
                    <input type="text" class="form-control" id="kms" name="apellido1" minlength="0" required value="<?php echo $usuario[0]['apellido1'] ?>">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1" style="font-size: 14px; font-family: 'Comfortaa', fantasy">Segundo apellido<a style="color: red">*</a></label>
                    <input type="text" class="form-control" id="caballos" name="apellido2" minlength="0" required value="<?php echo $usuario[0]['apellido2'] ?>">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1" style="font-size: 14px; font-family: 'Comfortaa', fantasy">Correo electrónico principal<a style="color: red">*</a></label>
                    <input type="email" class="form-control" id="emailPrincipal" name="personal" aria-describedby="emailHelp" required value="<?php echo $email[0]['personal'] ?>">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1" style="font-size: 14px; font-family: 'Comfortaa', fantasy">Otro correo electrónico</label>
                    <input type="email" class="form-control" id="emailSecundario" name="otro" aria-describedby="emailHelp" value="<?php echo $email[0]['otro'] ?>">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1" style="font-size: 14px; font-family: 'Comfortaa', fantasy">Móvil<a style="color: red">*</a></label>
                    <input type="text" class="form-control" id="movil" name ="movil"  required maxlength="9" minlength="9" value="<?php echo $telefono[0]['movil'] ?>">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1" style="font-size: 14px; font-family: 'Comfortaa', fantasy">Fijo</label>
                    <input type="text" class="form-control" id="fijo" name="fijo" required value="<?php echo $telefono[0]['fijo'] ?>">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1" style="font-size: 14px; font-family: 'Comfortaa', fantasy">Otro télefono</label>
                    <input type="text" class="form-control" id="otros" name="otros"  required value="<?php echo $telefono[0]['otro'] ?>">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1" style="font-size: 14px; font-family: 'Comfortaa', fantasy">Tipo de vía<a style="color: red">*</a></label>
                    <input type="text" class="form-control" id="via" name="tipo_via"  required value="<?php echo $direccion[0]['tipo_via'] ?>">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1" style="font-size: 14px; font-family: 'Comfortaa', fantasy">Nombre de la via<a style="color: red">*</a></label>
                    <input type="text" class="form-control" id="calle" name="nombre_via" aria-describedby="emailHelp" required value="<?php echo $direccion[0]['nombre_via'] ?>">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1" style="font-size: 14px; font-family: 'Comfortaa', fantasy">Número<a style="color: red">*</a></label>
                    <input type="number" class="form-control" id="numero" name="numero"  required min="1" value="<?php echo $direccion[0]['numero'] ?>">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1" style="font-size: 14px; font-family: 'Comfortaa', fantasy">Piso</label>
                    <input type="number" class="form-control" id="piso" name="piso"  min="1" value="<?php echo $direccion[0]['piso'] ?>">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1" style="font-size: 14px; font-family: 'Comfortaa', fantasy">Letra</label>
                    <input type="text" class="form-control" id="letra" name="letra"  maxlength="2" value="<?php echo $direccion[0]['letra'] ?>">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1" style="font-size: 14px; font-family: 'Comfortaa', fantasy">Escalera</label>
                    <input type="text" class="form-control" id="escalera" name="escalera"  maxlength="2" value="<?php echo $direccion[0]['escalera'] ?>">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1" style="font-size: 14px; font-family: 'Comfortaa', fantasy">Código postal<a style="color: red">*</a></label>
                    <input type="text" class="form-control" id="codPostal" name="codPostal"  required maxlength="5" minlength="5" value="0<?php echo $direccion[0]['cod_postal'] ?>">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1" style="font-size: 14px; font-family: 'Comfortaa', fantasy">Población<a style="color: red">*</a></label>
                    <input type="text" class="form-control" id="poblacion" name="poblacion"  required value="<?php echo $poblacion[0]['municipio'] ?>">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1" style="font-size: 14px; font-family: 'Comfortaa', fantasy">Población<a style="color: red">*</a></label>
                    <input type="text" class="form-control" id="poblacion" name="provincia" required value="<?php echo $poblacion[0]['provincia'] ?>">
                </div>
                <button class="btn-clases" type="submit" value="Registrar" name="submit" style="margin-top: 20px; padding-bottom: 7px; padding-top: 7px; border-radius: 4px;">Actualizar</button>
            </form>
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
