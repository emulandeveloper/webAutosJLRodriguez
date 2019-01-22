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

class Clientes {

    private static $instance;
    private $bd;

    function __construct() {
        $this->bd = Conexion::singleton_conexion();
    }

    public static function singletonClientes() {
        if (!isset(self::$instance)) {
            $miclass = __CLASS__;
            self::$instance = new $miclass;
        }

        return self::$instance;
    }

    public function getAllClientes() {
        try {
            $consulta = "SELECT * FROM clientes";

            $query = $this->bd->preparar($consulta);

            $query->execute();
            $tAutos = $query->fetchAll();
        } catch (Exception $exc) {
            
        }

        return $tAutos;
    }

    public function getUnCliente($codigo) {
        try {
            $consulta = "SELECT * FROM clientes WHERE dni='" . $codigo . "';";
            $query = $this->bd->preparar($consulta);
            $query->execute();
            $tClientes = $query->fetchAll();
        } catch (Exception $ex) {
            //echo "Se ha producido un error en getUnPedido";
        }
        if (empty($tClientes)) {
            $c = NULL;
        } else {
            $c = new Cliente($tClientes[0][0], $tClientes[0][1], $tClientes[0][2], $tClientes[0][3], $tClientes[0][4], $tClientes[0][5], $tClientes[0][6], $tClientes[0][7], $tClientes[0][8]);
        }
        return $c;
    }
    
    public function getClienteLogin ($login){
        try {
            $consulta = "SELECT usuarios.*, clientes.*"
                    . " FROM usuarios INNER JOIN clientes"
                    . " ON usuarios.id_cliente = clientes.id"
                    . " WHERE usuarios.login = '$login';";
            $query = $this->bd->preparar($consulta);
            $query->execute();
            $cLogin = $query->fetchAll();
            
        } catch (Exception $ex) {
            
        }
        return $cLogin;
    }

    public function getClienteDni($dni) {
        try {
            $consulta = "SELECT id FROM clientes WHERE dni='" . $dni . "';";
            $query = $this->bd->preparar($consulta);
            $query->execute();
            $tClientes = $query->fetchAll();
        } catch (Exception $ex) {
            //echo "Se ha producido un error en getUnPedido";
        }
        return $tClientes;
    }
    public function getClienteId($id) {
        try {
            $consulta = "SELECT * FROM clientes WHERE id=" . $id . ";";
            $query = $this->bd->preparar($consulta);
            $query->execute();
            $tClientes = $query->fetchAll();
        } catch (Exception $ex) {
            //echo "Se ha producido un error en getUnPedido";
        }
        return $tClientes;
    }
    
    public function getCodigoCliente ($idAutomovil){
        try {
            $consulta = "SELECT ventas.*, clientes.* "
                    . "FROM ventas INNER JOIN clientes "
                    . "ON ventas.id_cliente = clientes.id "
                    . "WHERE ventas.id_automovil = $idAutomovil;";
            $query = $this->bd->preparar($consulta);
            $query->execute();
            $codigo = $query->fetchAll();
        } catch (Exception $ex) {
            
        }
        return $codigo;
    }

    public function addCliente(Cliente $c) {

        try {
            $consulta = "INSERT INTO clientes "
                    . "(id, cod_cliente, nombre, apellido1, apellido2, dni, id_direccion, id_telefono, id_email)"
                    . "values"
                    . "(null, ?,?,?,?,?,?,?,?)";

            $query = $this->bd->preparar($consulta);

            @$query->bindParam(1, $c->getCod_cliente());
            @$query->bindParam(2, $c->getNombre());
            @$query->bindParam(3, $c->getApellido1());
            @$query->bindParam(4, $c->getApellido2());
            @$query->bindParam(5, $c->getDni());
            @$query->bindParam(6, $c->getId_direccion());
            @$query->bindParam(7, $c->getId_telefono());
            @$query->bindParam(8, $c->getId_email());

            $query->execute();
            $insertado = true;
        } catch (Exception $ex) {
            $insertado = false;
        }

        return $insertado;
    }

    public function getUltimoIdClient() {
        try {
            $consulta = "SELECT MAX(id) as ultimo FROM clientes";

            $query = $this->bd->preparar($consulta);

            $query->execute();
            $tCliente = $query->fetchAll();
        } catch (Exception $ex) {
            
        }
        return $tCliente[0]['ultimo'];
    }

    public function updateClientes($id, $codCliente, $nombre, $apellido1, $apellido2, $dni, $idDireccion, $idTelefono, $idEmail) {
        try {
            $consulta = "UPDATE clientes SET cod_cliente='$codCliente', nombre='$nombre', apellido1='$apellido1', apellido2='$apellido2', "
                    . "dni='$dni', id_direccion=$idDireccion, id_telefono=$idTelefono, id_email=$idEmail"
                    . " WHERE id=$id;";
            $query = $this->bd->preparar($consulta);
            $query->execute();
            $modificado = true;
        } catch (Exception $ex) {
            $modificado = false;
        }
        return $modificado;
    }

}
