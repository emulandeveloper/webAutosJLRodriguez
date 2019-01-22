<?php
session_start();
require_once '../../POJOs/Automovil.php';
require_once '../../persistencia/Automoviles.php';
require_once '../../POJOs/ImagenesCar.php';
require_once '../../persistencia/ImagenesCars.php';
require_once '../../POJOs/Extras_automovil.php';
require_once '../../persistencia/Extra_automoviles.php';

$submit = filter_input(INPUT_POST, 'submit');
if (isset($submit)) {
    $tCoche = Automoviles::singletonAutomoviles();
    $id = $tCoche->getUltimoId();
    $id_formateado = str_pad($id, 6, "0", STR_PAD_LEFT);
    $cod_automovil = "car" . $id_formateado;
    $marca = filter_input(INPUT_POST, 'marca');
    $modelo = filter_input(INPUT_POST, 'modelo');
    $ano = filter_input(INPUT_POST, 'ano');
    $kilometros = filter_input(INPUT_POST, 'kms');
    $caballos = filter_input(INPUT_POST, 'caballos');
    $precio = filter_input(INPUT_POST, 'precio');
    $image = $_FILES['foto']['name'];
    //$posPunto = strpos($image, ".") + 1;
    //$extensionOri = substr($image, $posPunto, 3);
    $carpeta_destino = $_SERVER['DOCUMENT_ROOT'] . '/WebConcesionario_V2.0/img/cars/';
    //var_dump($_SERVER['DOCUMENT_ROOT']);
    $archivostemp = $_FILES['foto']['tmp_name'];
    var_dump($archivostemp);
    var_dump($carpeta_destino . $image);
    move_uploaded_file($archivostemp, $carpeta_destino . $image);

    $tipo = $_FILES['foto']['type'];
    $tamanio = $_FILES['foto']['size'];

    $foto = "img/cars/" . $_FILES['foto']['name'];
    $activo = 1;

    $t = new Automovil(null, $cod_automovil, $marca, $modelo, $ano, $kilometros, $caballos, $precio, $foto, $activo);

    $insertado = $tCoche->addAutomovil($t);

    if (!empty($insertado)) {

        $tExtras = Extra_automoviles::singletonExtra_automoviles();
        $id = $tCoche->getUltimoId();
        $id_automovil = $id;
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

        $t = new Extras_automovil(null, $id, $cambio, $combustible, $num_marchas, $num_plazas, $num_puertas, $traccion, $c_urbano, $c_medio, $c_carretera, $deposito, $descripcion);

        $insertarExtras = $tExtras->addExtras($t);

        if (!empty($insertarExtras)) {

            $tImagenes = ImagenesCars::singletonImagenesCars();
            $i = new ImagenesCar(null, $id, $foto);
            $insert = $tImagenes->addImagenes($i);

            $array = array("foto1", "foto2", "foto3", "foto4", "foto5", "foto6", "foto7", "foto8", "foto9", "foto10", "foto11", "foto12", "foto13", "foto14");

            foreach ($array as $imagen) {
                $nameFoto = $_FILES[$imagen]['name'];
                var_dump($nameFoto);
                $imagenes = "img/cars/" . $nameFoto;
                if (!$nameFoto == "") {

                    $i = new ImagenesCar(null, $id, $imagenes);
                    $insert = $tImagenes->addImagenes($i);
                }
            }
        }
    }
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
                <h1 class="text-center" style=" font-size: 45px; text-decoration: #000; font-weight: 600 "> AGREGAR COCHE</h1>
                <p style="color: #FFF; margin-bottom: 45px; font-size: 20px; color: #f56c40">Rellenar el formulario con los datos del Coche a incluir </p>
            </div>

            <form name="formulario1" action="addCoche.php" method="POST" enctype="multipart/form-data" style="margin-top: 5%; font-family: 'Comfortaa', sans-serif;">


                <div class="form-group">
                    <label for="exampleInputEmail1" style="font-size: 14px; font-family: 'Comfortaa', fantasy">Marca<a style="color: red">*</a></label>
                    <input type="text" class="form-control" id="nombre" name="marca" required >
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1" style="font-size: 14px; font-family: 'Comfortaa', fantasy">Modelo<a style="color: red">*</a></label>
                    <input type="text" class="form-control" id="nombre" name="modelo" required >
                </div>
                <div class="form-group">
                    <label for="exampleSelect1" style="font-size: 14px; font-family: 'Comfortaa', fantasy;">Año de matriculación<a style="color: red">*</a></label><br>
                    <select  id="tipo" name="ano" style="padding: 5px"> 
                        <option value="0">Elegir año</option> 

                        <?php
                        $provincias = array("2018", "2017", "2016", "2015", "2014", "2013", "2012", "2011", "2010", "2009", "2008", "2007", "2006", "2005", "2004", "2003", "2002", "2001", "2000", "1999", "1998", "1997", "1996", "1995", "1994", "1993", "1992", "1991", "1990", "1989", "1988", "1987", "1986", "1985", "1984", "1983", "1982", "1981", "1980", "1979", "1978", "1977", "1976", "1975", "1974", "1973", "1972", "1971", "1970");

                        foreach ($provincias as $c => $v) {

                            echo "<option value='$v'>$v</option>";
                        }
                        ?> 
                    </select> 
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1" style="font-size: 14px; font-family: 'Comfortaa', fantasy">Kilometros<a style="color: red">*</a></label>
                    <input type="number" class="form-control" id="kms" name="kms" minlength="0" required >
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1" style="font-size: 14px; font-family: 'Comfortaa', fantasy">Potencia (cv)<a style="color: red">*</a></label>
                    <input type="number" class="form-control" id="caballos" name="caballos" minlength="0" required >
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1" style="font-size: 14px; font-family: 'Comfortaa', fantasy">Precio<a style="color: red">*</a></label>
                    <input type="number" class="form-control" id="precio" name="precio" minlength="0" required >
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1" style="font-size: 14px; font-family: 'Comfortaa', fantasy">Tip de cambio<a style="color: red">*</a></label>
                    <input type="text" class="form-control"  name="cambio" required >
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1" style="font-size: 14px; font-family: 'Comfortaa', fantasy">Tipo de combustible<a style="color: red">*</a></label>
                    <input type="text" class="form-control" name="combustible" required >
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1" style="font-size: 14px; font-family: 'Comfortaa', fantasy">Deposito<a style="color: red">*</a></label>
                    <input type="number" class="form-control" name="deposito" minlength="0" required step="any">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1" style="font-size: 14px; font-family: 'Comfortaa', fantasy">Número de marchas<a style="color: red">*</a></label>
                    <input type="number" class="form-control" name="num_marchas" minlength="0" required >
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1" style="font-size: 14px; font-family: 'Comfortaa', fantasy">Número de plazas<a style="color: red">*</a></label>
                    <input type="number" class="form-control" name="num_plazas" minlength="0" required >
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1" style="font-size: 14px; font-family: 'Comfortaa', fantasy">Número de puertas<a style="color: red">*</a></label>
                    <input type="number" class="form-control" name="num_puertas" minlength="0" required >
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1" style="font-size: 14px; font-family: 'Comfortaa', fantasy">Tracción<a style="color: red">*</a></label>
                    <input type="text" class="form-control" name="traccion" minlength="0" required >
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1" style="font-size: 14px; font-family: 'Comfortaa', fantasy">Consumo urbano<a style="color: red">*</a></label>
                    <input type="number" class="form-control" name="c_urbano" minlength="0" required step="any">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1" style="font-size: 14px; font-family: 'Comfortaa', fantasy">Consumo medio<a style="color: red">*</a></label>
                    <input type="number" class="form-control" name="c_medio" minlength="0" required step="any">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1" style="font-size: 14px; font-family: 'Comfortaa', fantasy">Consumo carretera<a style="color: red">*</a></label>
                    <input type="number" class="form-control" name="c_carretera" minlength="0" required step="any">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1" style="font-size: 14px; font-family: 'Comfortaa', fantasy">Descripción del vehiculo<a style="color: red">*</a></label>
                    <textarea class="form-control" name="descripcion"></textarea>
                </div>
                <div class="form-groups col-lg-4">
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
                </div>
                <button class="btn-clases" type="submit" value="Registrar" name="submit" style="margin-top: 20px; padding-bottom: 7px; padding-top: 7px; border-radius: 4px;">Agregar</button>
            </form>
        </div>
<!--    <script type="text/javascript" src="../../../js/jquery.1.11.1.js"></script>
        <script type="text/javascript" src="../../../js/bootstrap.js"></script>
        <script type="text/javascript" src="../../../js/SmoothScroll.js"></script>
        <script type="text/javascript" src="../../../js/nivo-lightbox.js"></script>
        <script type="text/javascript" src="../../../js/jquery.isotope.js"></script>
        <script type="text/javascript" src="../../../js/jqBootstrapValidation.js"></script>
        <script type="text/javascript" src="../../../js/main.js"></script>-->
    </body>
</html>