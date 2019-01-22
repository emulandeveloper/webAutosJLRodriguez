<?php
session_start();
require_once './POJOs/Usuario.php';
require_once './persistencia/Usuarios.php';

$submit = filter_input(INPUT_POST, 'submit');

if (isset($submit)){
    $login = $_POST['login'];
    $password = hash('sha256', $_POST['password']);
    if (isset($login) & isset($password)) {

        $tUsuario = Usuarios::singletonUsuarios();
        $u = $tUsuario->getLogins($login, $password);
        if (!is_null($u)) {
            $_SESSION['login'] = $u->getLogin();
            $_SESSION['id_empleado'] = $u->getId_empleado();
            $_SESSION['id_cliente'] = $u->getId_cliente();
            $_SESSION['tipo'] = $u->getTipo();

            header('Location:viewAdministracion.php');
            }
        } else {
            header('Location:administracion.php? identificado = 1');
        }
}
?>

<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Autos J&L Rodriguez </title>
        <meta name="description" content="">
        <meta name="author" content="">


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
        <script type="text/javascript" src="../js/modernizr.custom.js"></script>
        <script src="http://code.jquery.com/jquery-1.10.1.min.js"></script>

    </head>
    <body style="background-color: #31b0d5">
        <div class="card container" style="width: 38rem; margin-top: 100px; ">
            <img class="card-img-top center" src="../img/LOGO_J&LAdmin.png" alt="Card image cap" style="padding: 10px 10px 20px 10px; margin-left: 50px">

            <?php
            /* @var $_GET type */
            if (isset($_GET['identificado'])) {
                if ($_GET['identificado'] == 1) {
                    ?> 
                    <div class="invalid-tooltip" style="color: #ff4b4b">
                        Usuario o Contraseña incorrectas.
                    </div><br>
                    <?php
                }
            }
            ?>
                    <form method="post" action="administracion.php" name="formularioIndex">
                <div class="modal-header" style="color: #414a52; margin-bottom: 5px; margin-top: -15px">
                    <h5 class="modal-title" id="exampleModalLabel" style="font-size: 18px">Acceso Administrador</h5>
                </div>
                <div class="form-group" style="margin-top: 20px">
                    <label for="email" class="col-form-label" style="font-size: 20px">Usuario:</label>
                    <input type="text" name="login" class="form-control" id="email" style="background-color: #E7E7E7" placeholder="Introducir nombre de usuario">
                </div>
                <div class="form-group">
                    <label for="password" class="col-form-label" style="font-size: 20px">Contraseña:</label>
                    <input class="form-control" id="password" style="background-color: #E7E7E7" type="password" name="password" placeholder="Introducir contraseña">
                </div>
                <div class="modal-footer" style="margin-bottom: -20px">
                    <input type="submit" id="submit" name="submit" value="Acceder" class="btn btn-custom" style="padding: 5px 20px; margin-bottom: -5px">
                </div>
            </form>
        </div>

        <script type="text/javascript" src="../js/jquery.1.11.1.js"></script> 
        <script type="text/javascript" src="../js/bootstrap.js"></script> 
        <script type="text/javascript" src="../js/SmoothScroll.js"></script> 
        <script type="text/javascript" src="../js/nivo-lightbox.js"></script> 
        <script type="text/javascript" src="../js/jquery.isotope.js"></script> 
        <script type="text/javascript" src="../js/jqBootstrapValidation.js"></script> 
        <script type="text/javascript" src="../js/main.js"></script>    
    </body>
</html>