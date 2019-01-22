<?php
session_start();
require_once '../../POJOs/Automovil.php';
require_once '../../persistencia/Automoviles.php';

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
        .elc-borrar{
            color: #f56c40;
            transition: all 0.5s;
            font-weight: 600;
        }
        .elc-borrar:hover {
            color: #0E76A8;
        }
    </style>
    <body style="background-color: transparent">
        <div class="allcontain container-fluid">
            <div class="feturedsection text-center">
                <h1 class="text-center" style="font-family: 'Bree Serif', serif; font-size: 40px; text-decoration: #000 ">LISTA DE VEHICULOS</h1>
                <p style="color: #FFF; margin-bottom: 45px; font-size: 20px; color: #f56c40">Lista de vehiculos del concesionario</p>
                <br>
                <hr>
                <br>
            </div>
            <div class="col-md-6">
                <table class="table">
                    <h2 class="text-center" style="font-family: 'Bree Serif', serif; font-size: 40px">Activos</h2>

                    <thead>
                        <tr class="text-center" style="background-color: #333; color: #FFF; border-radius: 5px 0px 5px 0px">
                            <th scope="col">Código</th>
                            <th scope="col">Marca</th>
                            <th scope="col">Modelo</th>
                            <th scope="col">Año de Matriculación</th>
                            <th scope="col">Kilometros</th>
                            <th scope="col">Precio</th>
                            <th scope="col"></th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody  >
                        <?php
                        $tCoche = Automoviles::singletonAutomoviles();
                        $listCoches = $tCoche->getAllAutos();

                        foreach ($listCoches as $fila) {
                            ?>
                            <tr>
                                <th scope="row" style="padding: 15px; font-weight: 800"><?php echo $fila['codigo'] ?></th>
                                <th scope="row" style="padding: 15px; color: #f56c40"><?php echo $fila['marca'] ?></th>
                                <td style="padding: 15px"><?php echo $fila['modelo'] ?></td>
                                <td style="padding: 15px"><?php echo $fila['ano_mat'] ?></td>
                                <td style="padding: 15px"><?php echo $fila['kilometros'] ?></td>
                                <td style="padding: 15px"><?php echo $fila['precio'] ?>&euro;</td>
                                <td style="padding: 15px">
                                    <a class="elc-editar" href="updateCoche.php?id=<?php echo $fila['id'] ?>">Editar</a>
                                </td>
                                <td style="padding: 15px">
                                    <a class="elc-borrar" href="deleteAutomovil.php?id=<?php echo $fila['id'] ?>">Borrar</a>
                                </td>
                            </tr>
                            <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            <div class="col-md-6">
                <table class="table">
                    <h2 class="text-center" style="font-family: 'Bree Serif', serif; font-size: 40px;">No activos</h2>
                    <thead>
                        <tr class="text-center" style="background-color: #333; color: #FFF; border-radius: 5px 0px 5px 0px">
                            <th scope="col">Código</th>
                            <th scope="col">Marca</th>
                            <th scope="col">Modelo</th>
                            <th scope="col">Año de Matriculación</th>
                            <th scope="col">Kilometros</th>
                            <th scope="col">Precio</th>
                            <th scope="col">Cliente</th>
                        </tr>
                    </thead>
                    <tbody  >
                        <?php
                        require_once '../../POJOs/Automovil.php';
                        require_once '../../persistencia/Automoviles.php';
                        require_once '../../POJOs/Cliente.php';
                        require_once '../../persistencia/Clientes.php';

                        $tCoche = Automoviles::singletonAutomoviles();
                        $listCoches = $tCoche->getAllAutosBaja();
                        $tCliente = Clientes::singletonClientes();

                        foreach ($listCoches as $fila) {
                            $codigoCliente = $tCliente->getCodigoCliente($fila['id']);
                            ?>
                            <tr>
                                <th scope="row" style="padding: 15px; font-weight: 800"><?php echo $fila['codigo'] ?></th>
                                <th scope="row" style="padding: 15px; color: #f56c40"><?php echo $fila['marca'] ?></th>
                                <td style="padding: 15px"><?php echo $fila['modelo'] ?></td>
                                <td style="padding: 15px"><?php echo $fila['ano_mat'] ?></td>
                                <td style="padding: 15px"><?php echo $fila['kilometros'] ?></td>
                                <td style="padding: 15px"><?php echo $fila['precio'] ?>&euro;</td>
                                <td style="padding: 15px"><?php echo $codigoCliente[0]['cod_cliente'] ?>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
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