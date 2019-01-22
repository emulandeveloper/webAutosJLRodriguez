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

class Ventas {

    private static $instance;
    private $bd;

    function __construct() {
        $this->bd = Conexion::singleton_conexion();
    }

    public static function singletonVentas() {
        if (!isset(self::$instance)) {
            $miclass = __CLASS__;
            self::$instance = new $miclass;
        }

        return self::$instance;
    }
    
        public function getAllVentas() {
        try {
            $consulta = "SELECT * FROM ventas";

            $query = $this->bd->preparar($consulta);

            $query->execute();
            $tAutos = $query->fetchAll();
        } catch (Exception $exc) {
            
        }

        return $tAutos;
    }
    
            public function getIdVentas($idCliente) {
        try {
            $consulta = "SELECT * FROM ventas WHERE id_cliente = $idCliente;";

            $query = $this->bd->preparar($consulta);

            $query->execute();
            $tAutos = $query->fetchAll();
        } catch (Exception $exc) {
            
        }

        return $tAutos;
    }

    public function addVenta(Venta $v) {

        try {
            $consulta = "INSERT INTO ventas "
                    . "(id, id_automovil, id_cliente, metodo_pago, fecha_venta)"
                    . "values"
                    . "(null,?,?,?,?)";

            $query = $this->bd->preparar($consulta);

            @$query->bindParam(1, $v->getId_automovil());
            @$query->bindParam(2, $v->getId_cliente());
            @$query->bindParam(3, $v->getMetodo_pago());
            @$query->bindParam(4, $v->getFecha_venta());

            $query->execute();
            var_dump($query);
            $insertado = true;
        } catch (Exception $ex) {
            $insertado = false;
        }

        return $insertado;
    }
    
    public function datosVentaAuto($idCliente){
        try {
            $consulta = "SELECT automoviles.*, ventas.* "
                    . "FROM automoviles "
                    . "INNER JOIN ventas "
                    . "ON automoviles.id = ventas.id_automovil "
                    . "WHERE ventas.id_cliente = $idCliente;";

            $query = $this->bd->preparar($consulta);

            $query->execute();
            $tDatos = $query->fetchAll();
        } catch (Exception $exc) {
            
        }

        return $tDatos;
    }
    
    public function confirmacionVenta($idAuto){
        try{
            $consulta = "SELECT * FROM automoviles "
                    . "INNER JOIN ventas "
                    . "ON automoviles.id = ventas.id_automovil "
                    . "WHERE ventas.id_automovil = $idAuto;";
            
            $query = $this->bd->preparar($consulta);
            $query->execute();
            $tAutomo = $query->fetchAll();
        } catch (Exception $ex) {

        }
        return $tAutomo;
    }

}
