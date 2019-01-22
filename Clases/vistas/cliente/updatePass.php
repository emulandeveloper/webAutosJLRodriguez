<?php
session_start();
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

$tCliente = Clientes::singletonClientes();
$tUsuario = Usuarios::singletonUsuarios();

$username = $_SESSION['login'];
$submit = filter_input(INPUT_POST, 'submit');
if ($submit) {

    $pass = hash('sha256', $_POST['pass']);
    $pass2 = hash('sha256', $_POST['pass2']);
    if ($pass == $pass2) {
        
        $final = $tUsuario->updateUsuarios($username, $pass);
        header('Location:clienteActualizado.php');
    }
} else {
    
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
                <h1 class="text-center" style="font-family: 'Bree Serif', serif; font-size: 40px; text-decoration: #000 ">ACTUALIZAR CONTRASEÑA</h1>
                <br>
                <hr>
            </div>

            <form name="formulario1" action="updatePass.php" method="POST" enctype="multipart/form-data" style="margin-top: 5%; font-family: 'Comfortaa', sans-serif; font-size: 14px">
                <div class="modal fade" id="suModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="suModal">Contraseña actualizada</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                Su contraseña ha sido actualizada correctamente.
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Confirmar</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1" style="font-size: 14px; font-family: 'Comfortaa', fantasy">Nombre de Usuario</label>
                    <input type="text" class="form-control" id="nombre" name="username" required readonly="readonly" value="<?php echo $username ?>">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1" style="font-size: 14px; font-family: 'Comfortaa', fantasy">Nueva Contraseña</label>
                    <input type="text" class="form-control" id="nombre" name="pass" required>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1" style="font-size: 14px; font-family: 'Comfortaa', fantasy">Repetir Contraseña</label>
                    <input type="text" class="form-control" id="nombre" name="pass2" required>
                </div>
                <button class="btn-clases" href="#suModal" data-toggle="modal" type="submit" value="Registrar" name="submit" style="margin-top: 20px; padding-bottom: 7px; padding-top: 7px; border-radius: 4px;">Confirmar</button>
            </form>
        </div>
        <?php
//        if ($modal === true) {
//            ?>
            <script>
                $(document).ready(function () {
                    $("#suModal").modal();
                });
            </script>
            <?php
//        }
//
//        ?>
<!--        <script type="text/javascript" src="../../../js/jquery.1.11.1.js"></script>
        <script type="text/javascript" src="../../../js/bootstrap.js"></script>
        <script type="text/javascript" src="../../../js/SmoothScroll.js"></script>
        <script type="text/javascript" src="../../../js/nivo-lightbox.js"></script>
        <script type="text/javascript" src="../../../js/jquery.isotope.js"></script>
        <script type="text/javascript" src="../../../js/jqBootstrapValidation.js"></script>
        <script type="text/javascript" src="../../../js/main.js"></script>-->
    </body>
</html>
