<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Usuarios
 *
 * @author maros
 */
require_once 'Conexion.php';

class Telefonos {

    private static $instance;
    private $bd;

    function __construct() {
        $this->bd = Conexion::singleton_conexion();
    }

    public static function singletonTelefonos() {
        if (!isset(self::$instance)) {
            $miclass = __CLASS__;
            self::$instance = new $miclass;
        }

        return self::$instance;
    }

    public function getLogins($login, $password) {
        try {
            $consulta = "SELECT * FROM usuarios WHERE "
                    . "login='" .
                    $login . "' and password='" .
                    $password . "'";

            $query = $this->bd->preparar($consulta);

            $query->execute();
            $tUsuarios = $query->fetchAll();
        } catch (Exception $ex) {
            echo "Se ha producido un error en getLoginPassword";
        }
        if (empty($tUsuarios)) { //Si no existe ese idUsuario
            $tUsuarios = null;
        } else {

            $tUsuarios = new Usuario($tUsuarios[0][0], $tUsuarios[0][1], $tUsuarios[0][2], $tUsuarios[0][3], $tUsuarios[0][4], $tUsuarios[0][5]);
        }
        return $tUsuarios;
    }

    public function getUltimoIdTel() {
        try {
            $consulta = "SELECT MAX(id) as ultimo FROM telefonos";

            $query = $this->bd->preparar($consulta);

            $query->execute();
            $tTelefonos = $query->fetchAll();
        } catch (Exception $ex) {
            
        }
        return $tTelefonos[0]['ultimo'];
    }

    public function getTelefono($id) {
        try {
            $consulta = "SELECT * FROM telefonos WHERE id=" . $id . ";";
            $query = $this->bd->preparar($consulta);
            $query->execute();
            $tTelefono = $query->fetchAll();
        } catch (Exception $ex) {
            //echo "Se ha producido un error en getUnPedido";
        }
        return $tTelefono;
    }

    public function addTelefono(Telefono $t) {

        try {
            $consulta = "INSERT INTO telefonos "
                    . "(id, movil, fijo, otro)"
                    . "values"
                    . "(null,?,?,?)";

            $query = $this->bd->preparar($consulta);

            @$query->bindParam(1, $t->getMovil());
            @$query->bindParam(2, $t->getFijo());
            @$query->bindParam(3, $t->getOtro());

            $query->execute();
            $insertado = true;
        } catch (Exception $ex) {
            $insertado = false;
        }

        return $insertado;
    }

    public function updateTelefonos($id, $movil, $fijo, $otro) {

        try {
            $consulta = "UPDATE telefonos SET movil=$movil, fijo=$fijo, otro=$otro"
                    . " WHERE id = $id;";

            $query = $this->bd->preparar($consulta);

            $query->execute();
            $modificado = true;
        } catch (Exception $ex) {
            $modificado = false;
        }
        return $modificado;
    }

}
