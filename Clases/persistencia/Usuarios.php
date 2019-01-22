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

class Usuarios {

    private static $instance;
    private $bd;

    function __construct() {
        $this->bd = Conexion::singleton_conexion();
    }

    public static function singletonUsuarios() {
        if (!isset(self::$instance)) {
            $miclass = __CLASS__;
            self::$instance = new $miclass;
        }

        return self::$instance;
    }

    public function getClienteLogin($login) {
        try {
            $consulta = "SELECT usuarios.*, clientes.* "
                    . "FROM usuarios "
                    . "INNER JOIN clientes "
                    . "ON usuarios.id_cliente = clientes.id "
                    . "WHERE usuarios.login = '$login'";
            $query = $this->bd->preparar($consulta);
            $query->execute();
            $tClientes = $query->fetchAll();
        } catch (Exception $ex) {
            //echo "Se ha producido un error en getUnPedido";
        }
        return $tClientes;
    }

    public function getIdUsuario($login) {
        try {
            $consulta = "SELECT * FROM usuarios WHERE "
                    . "login='" .
                    $login . "';";

            $query = $this->bd->preparar($consulta);

            $query->execute();
            $tUsuarios = $query->fetchAll();
        } catch (Exception $ex) {
            
        }
        return $tUsuarios;
    }
    
    public function getUsuario($id) {
        try {
            $consulta = "SELECT * FROM usuarios WHERE "
                    . "id_cliente='" .
                    $id . "';";

            $query = $this->bd->preparar($consulta);

            $query->execute();
            $tUsuarios = $query->fetchAll();
        } catch (Exception $ex) {
            
        }
        return $tUsuarios;
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

            $tUsuarios = new Usuario($tUsuarios[0][0], $tUsuarios[0][1], $tUsuarios[0][2], $tUsuarios[0][3], $tUsuarios[0][4], $tUsuarios[0][5], $tUsuarios[0][6]);
        }
        return $tUsuarios;
    }

    public function addUsuario(Usuario $u) {

        try {
            $consulta = "INSERT INTO usuarios "
                    . "(id, login, password, id_cliente, id_empleado, tipo, activo)"
                    . "values"
                    . "(null,?,?,?,?,?,?)";

            $query = $this->bd->preparar($consulta);

            @$query->bindParam(1, $u->getLogin());
            @$query->bindParam(2, $u->getPassword());
            @$query->bindParam(4, $u->getId_empleado());
            @$query->bindParam(3, $u->getId_cliente());
            @$query->bindParam(5, $u->getTipo());
            @$query->bindParam(6, $u->getActivo());

            $query->execute();
            $insertado = true;
        } catch (Exception $ex) {
            $insertado = false;
        }

        return $insertado;
    }

    public function updateUsuarios($login, $password) {

        try {
            $consulta = "UPDATE usuarios SET password='$password'"
                    . " WHERE login='$login';";
            var_dump($consulta);
            $query = $this->bd->preparar($consulta);
            $query->execute();
            $usuario = true;
        } catch (Exception $ex) {
            $usuario = false;
        }
        return $usuario;
    }
    
    public function getUserCliente($dni) {
        try {
            $consulta = "SELECT usuarios.*, clientes.* "
                    . "FROM usuarios "
                    . "INNER JOIN clientes "
                    . "ON usuarios.id_cliente = clientes.id "
                    . "WHERE usuarios.login = '$login'";
            $query = $this->bd->preparar($consulta);
            $query->execute();
            $tClientes = $query->fetchAll();
        } catch (Exception $ex) {
            //echo "Se ha producido un error en getUnPedido";
        }
        return $tClientes;
    }

}
