<?php
session_start();
require_once '../../POJOs/Automovil.php';
require_once '../../persistencia/Automoviles.php';
require_once '../../POJOs/ImagenesCar.php';
require_once '../../POJOs/Extras_automovil.php';
require_once '../../persistencia/Extra_automoviles.php';

$id = $_GET['id'];
$tAutos = Automoviles::singletonAutomoviles();
$info = $tAutos->getCodAutomovil($id);
$tExtras = Extra_automoviles::singletonExtra_automoviles();
$id_extras = $tExtras->getExtrasId($id);

$submit = filter_input(INPUT_POST, 'submit');

if (isset($submit)) {

    $idOficial = filter_input(INPUT_POST, 'id');
    $codigo = filter_input(INPUT_POST, 'codigo');
    $marca = filter_input(INPUT_POST, 'marca');
    $modelo = filter_input(INPUT_POST, 'modelo');
    $ano = filter_input(INPUT_POST, 'ano');
    $kilometros = filter_input(INPUT_POST, 'kms');
    $caballos = filter_input(INPUT_POST, 'caballos');
    $precio = filter_input(INPUT_POST, 'precio');
//  $image = $_FILES['foto']['name'];
    //$foto = "img/cars/" . $_FILES['foto']['name'];
    $foto = filter_input(INPUT_POST, 'foto');
    $activo = 1;

    $insertado = $tAutos->updateAutomoviles($idOficial, $codigo, $marca, $modelo, $ano, $kilometros, $caballos, $precio, $foto, $activo);

    if (!empty($insertado)) {
        
        $idExtras = filter_input(INPUT_POST, 'id_extras');
        $cambio = filter_input(INPUT_POST, 'cambio');
        $combustible = filter_input(INPUT_POST, 'combustible');
        $num_marchas = filter_input(INPUT_POST, 'num_marchas');
        $num_plazas = filter_input(INPUT_POST, 'num_plazas');
        $num_puertas = filter_input(INPUT_POST, 'num_puertas');
        $traccion = filter_input(INPUT_POST, 'traccion');
        $c_urbano = filter_input(INPUT_POST, 'c_urbano');
        $c_medio = filter_input(INPUT_POST, 'c_medio');
        $c_carretera = filter_input(INPUT_POST, 'c_carretera');
        $deposito = filter_input(INPUT_POST, 'deposito');
        $descripcion = filter_input(INPUT_POST, 'descripcion');


        $insertarExtras = $tExtras->updateExtras($idExtras, $idOficial, $cambio, $combustible, $num_marchas, $num_plazas, $num_puertas, $traccion, $c_urbano, $c_medio, $c_carretera, $deposito, $descripcion);
    }if (!empty($insertarExtras)) {
        $modal = true;
        header('Location:listCoche.php');
    }
} else {
//    $id = $_GET['id'];
//    $info = $tAutos->getCodAutomovil($id);
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
            <form name="formulario1" action="updateCoche.php" method="POST" enctype="multipart/form-data" style="margin-top: 5%; font-family: 'Comfortaa', sans-serif;">
                <div class="form-group">
                    <label for="exampleInputEmail1" style="font-size: 14px; font-family: 'Comfortaa', fantasy">Identificador<a style="color: red">*</a></label>
                    <input type="text" class="form-control" id="id" name="id" readonly="readonly" value="<?php echo $info[0]['id'] ?>">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1" style="font-size: 14px; font-family: 'Comfortaa', fantasy">Código vehiculo<a style="color: red">*</a></label>
                    <input type="text" class="form-control" id="codigo" name="codigo" readonly="readonly" value="<?php echo $info[0]['codigo'] ?>">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1" style="font-size: 14px; font-family: 'Comfortaa', fantasy">Marca<a style="color: red">*</a></label>
                    <input type="text" class="form-control" id="nombre" name="marca" required value="<?php echo $info[0]['marca'] ?>">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1" style="font-size: 14px; font-family: 'Comfortaa', fantasy">Modelo<a style="color: red">*</a></label>
                    <input type="text" class="form-control" id="nombre" name="modelo" required value="<?php echo $info[0]['modelo'] ?>">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1" style="font-size: 14px; font-family: 'Comfortaa', fantasy">Año de matriculación<a style="color: red">*</a></label>
                    <input type="text" class="form-control" id="ano" name="ano" required value="<?php echo $info[0]['ano_mat'] ?>">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1" style="font-size: 14px; font-family: 'Comfortaa', fantasy">Kilometros<a style="color: red">*</a></label>
                    <input type="number" class="form-control" id="kms" name="kms" minlength="0" required value="<?php echo $info[0]['kilometros'] ?>">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1" style="font-size: 14px; font-family: 'Comfortaa', fantasy">Potencia (cv)<a style="color: red">*</a></label>
                    <input type="number" class="form-control" id="caballos" name="caballos" minlength="0" required value="<?php echo $info[0]['potencia_cv'] ?>">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1" style="font-size: 14px; font-family: 'Comfortaa', fantasy">Precio<a style="color: red">*</a></label>
                    <input type="number" class="form-control" id="precio" name="precio" minlength="0" required value="<?php echo $info[0]['precio'] ?>">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1" style="font-size: 14px; font-family: 'Comfortaa', fantasy">Tipo de cambio<a style="color: red">*</a></label>
                    <input type="text" class="form-control"  name="id_extras" required readonly="readonly" value="<?php echo $id_extras[0]['id'] ?>">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1" style="font-size: 14px; font-family: 'Comfortaa', fantasy">Tipo de cambio<a style="color: red">*</a></label>
                    <input type="text" class="form-control"  name="cambio" required value="<?php echo $id_extras[0]['cambio'] ?>">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1" style="font-size: 14px; font-family: 'Comfortaa', fantasy">Tipo de combustible<a style="color: red">*</a></label>
                    <input type="text" class="form-control" name="combustible" required value="<?php echo $id_extras[0]['combustible'] ?>">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1" style="font-size: 14px; font-family: 'Comfortaa', fantasy">Deposito<a style="color: red">*</a></label>
                    <input type="number" class="form-control" name="deposito" minlength="0" required step="any" value="<?php echo $id_extras[0]['deposito'] ?>">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1" style="font-size: 14px; font-family: 'Comfortaa', fantasy">Número de marchas<a style="color: red">*</a></label>
                    <input type="number" class="form-control" name="num_marchas" minlength="0" required value="<?php echo $id_extras[0]['num_marchas'] ?>">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1" style="font-size: 14px; font-family: 'Comfortaa', fantasy">Número de plazas<a style="color: red">*</a></label>
                    <input type="number" class="form-control" name="num_plazas" minlength="0" required value="<?php echo $id_extras[0]['num_plazas'] ?>">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1" style="font-size: 14px; font-family: 'Comfortaa', fantasy">Número de puertas<a style="color: red">*</a></label>
                    <input type="number" class="form-control" name="num_puertas" minlength="0" required value="<?php echo $id_extras[0]['num_puertas'] ?>">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1" style="font-size: 14px; font-family: 'Comfortaa', fantasy">Tracción<a style="color: red">*</a></label>
                    <input type="text" class="form-control" name="traccion" minlength="0" required value="<?php echo $id_extras[0]['traccion'] ?>">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1" style="font-size: 14px; font-family: 'Comfortaa', fantasy">Consumo urbano<a style="color: red">*</a></label>
                    <input type="number" class="form-control" name="c_urbano" minlength="0" required step="any" value="<?php echo $id_extras[0]['c_urbano'] ?>">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1" style="font-size: 14px; font-family: 'Comfortaa', fantasy">Consumo medio<a style="color: red">*</a></label>
                    <input type="number" class="form-control" name="c_medio" minlength="0" required step="any" value="<?php echo $id_extras[0]['c_medio'] ?>">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1" style="font-size: 14px; font-family: 'Comfortaa', fantasy">Consumo carretera<a style="color: red">*</a></label>
                    <input type="number" class="form-control" name="c_carretera" minlength="0" required step="any" value="<?php echo $id_extras[0]['c_carretera'] ?>">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1" style="font-size: 14px; font-family: 'Comfortaa', fantasy">Foto de Cabecera<a style="color: red">*</a></label>
                    <input type="text" class="form-control" name="foto" minlength="0" required step="any" value="<?php echo $info[0]['foto'] ?>">
                </div>
<!--                <div class="form-groups col-lg-4">
                    <label for="exampleFormControlFile1" style="font-size: 14px; font-family: 'Comfortaa', fantasy;">Imagen del Coche<a style="color: red">* </a></label>
                    <input type="file" class="form-control-file" id="foto" name="foto" style="padding-bottom: 10px; padding-left: 10px; margin-top: 22.5px">
                </div>
                <div class="form-groups col-lg-4">
                    <label for="exampleFormControlFile1" style="font-size: 14px; font-family: 'Comfortaa', fantasy;">Imagen del Coche<a style="color: red">* </a></label>
                    <input type="file" class="form-control-file" id="foto1" name="foto1" style="padding-bottom: 10px; padding-left: 10px; margin-top: 22.5px">
                </div>
                <div class="form-groups col-lg-4">
                    <label for="exampleFormControlFile1" style="font-size: 14px; font-family: 'Comfortaa', fantasy;">Imagen del Coche<a style="color: red">* </a></label>
                    <input type="file" class="form-control-file" id="foto2" name="foto2" style="padding-bottom: 10px; padding-left: 10px; margin-top: 22.5px">
                </div>
                <div class="form-groups col-lg-4">
                    <label for="exampleFormControlFile1" style="font-size: 14px; font-family: 'Comfortaa', fantasy;">Imagen del Coche<a style="color: red">* </a></label>
                    <input type="file" class="form-control-file" id="foto3" name="foto3" style="padding-bottom: 10px; padding-left: 10px; margin-top: 22.5px">
                </div>
                <div class="form-groups col-lg-4">
                    <label for="exampleFormControlFile1" style="font-size: 14px; font-family: 'Comfortaa', fantasy;">Imagen del Coche<a style="color: red">* </a></label>
                    <input type="file" class="form-control-file" id="foto3" name="foto4" style="padding-bottom: 10px; padding-left: 10px; margin-top: 22.5px">
                </div>
                <div class="form-groups col-lg-4">
                    <label for="exampleFormControlFile1" style="font-size: 14px; font-family: 'Comfortaa', fantasy;">Imagen del Coche<a style="color: red">* </a></label>
                    <input type="file" class="form-control-file" id="foto3" name="foto5" style="padding-bottom: 10px; padding-left: 10px; margin-top: 22.5px">
                </div>
                <div class="form-groups col-lg-4">
                    <label for="exampleFormControlFile1" style="font-size: 14px; font-family: 'Comfortaa', fantasy;">Imagen del Coche<a style="color: red">* </a></label>
                    <input type="file" class="form-control-file" id="foto3" name="foto6" style="padding-bottom: 10px; padding-left: 10px; margin-top: 22.5px">
                </div>
                <div class="form-groups col-lg-4">
                    <label for="exampleFormControlFile1" style="font-size: 14px; font-family: 'Comfortaa', fantasy;">Imagen del Coche<a style="color: red">* </a></label>
                    <input type="file" class="form-control-file" id="foto3" name="foto7" style="padding-bottom: 10px; padding-left: 10px; margin-top: 22.5px">
                </div>
                <div class="form-groups col-lg-4">
                    <label for="exampleFormControlFile1" style="font-size: 14px; font-family: 'Comfortaa', fantasy;">Imagen del Coche<a style="color: red">* </a></label>
                    <input type="file" class="form-control-file" id="foto3" name="foto8" style="padding-bottom: 10px; padding-left: 10px; margin-top: 22.5px">
                </div>
                <div class="form-groups col-lg-4">
                    <label for="exampleFormControlFile1" style="font-size: 14px; font-family: 'Comfortaa', fantasy;">Imagen del Coche<a style="color: red">* </a></label>
                    <input type="file" class="form-control-file" id="foto3" name="foto9" style="padding-bottom: 10px; padding-left: 10px; margin-top: 22.5px">
                </div>
                <div class="form-groups col-lg-4">
                    <label for="exampleFormControlFile1" style="font-size: 14px; font-family: 'Comfortaa', fantasy;">Imagen del Coche<a style="color: red">* </a></label>
                    <input type="file" class="form-control-file" id="foto3" name="foto10" style="padding-bottom: 10px; padding-left: 10px; margin-top: 22.5px">
                </div>
                <div class="form-groups col-lg-4">
                    <label for="exampleFormControlFile1" style="font-size: 14px; font-family: 'Comfortaa', fantasy;">Imagen del Coche<a style="color: red">* </a></label>
                    <input type="file" class="form-control-file" id="foto3" name="foto11" style="padding-bottom: 10px; padding-left: 10px; margin-top: 22.5px">
                </div>
                <div class="form-groups col-lg-4">
                    <label for="exampleFormControlFile1" style="font-size: 14px; font-family: 'Comfortaa', fantasy;">Imagen del Coche<a style="color: red">* </a></label>
                    <input type="file" class="form-control-file" id="foto3" name="foto12" style="padding-bottom: 10px; padding-left: 10px; margin-top: 22.5px">
                </div>
                <div class="form-groups col-lg-4">
                    <label for="exampleFormControlFile1" style="font-size: 14px; font-family: 'Comfortaa', fantasy;">Imagen del Coche<a style="color: red">* </a></label>
                    <input type="file" class="form-control-file" id="foto3" name="foto13" style="padding-bottom: 10px; padding-left: 10px; margin-top: 22.5px">
                </div>
                <div class="form-groups col-lg-4">
                    <label for="exampleFormControlFile1" style="font-size: 14px; font-family: 'Comfortaa', fantasy;">Imagen del Coche<a style="color: red">* </a></label>
                    <input type="file" class="form-control-file" id="foto3" name="foto14" style="padding-bottom: 10px; padding-left: 10px; margin-top: 22.5px">
                </div>-->
                <button class="btn-clases" type="submit" value="Registrar" name="submit" style="margin-top: 20px; padding-bottom: 7px; padding-top: 7px; border-radius: 4px;">Actualizar</button>
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