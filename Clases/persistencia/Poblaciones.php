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

class Poblaciones {

    private static $instance;
    private $bd;

    function __construct() {
        $this->bd = Conexion::singleton_conexion();
    }

    public static function singletonPoblaciones() {
        if (!isset(self::$instance)) {
            $miclass = __CLASS__;
            self::$instance = new $miclass;
        }

        return self::$instance;
    }

    public function getUltimoIdPob() {
        try {
            $consulta = "SELECT MAX(id) as ultimo FROM poblaciones";

            $query = $this->bd->preparar($consulta);

            $query->execute();
            $tPoblacion = $query->fetchAll();
        } catch (Exception $ex) {
            
        }
        return $tPoblacion[0]['ultimo'];
    }

    public function getPoblacion($id) {
        try {
            $consulta = "SELECT * FROM poblaciones WHERE id=" . $id . ";";
            $query = $this->bd->preparar($consulta);
            $query->execute();
            $tPoblacion = $query->fetchAll();
        } catch (Exception $ex) {
            //echo "Se ha producido un error en getUnPedido";
        }
        return $tPoblacion;
    }

    public function addPoblacion(Poblacion $p) {

        try {
            $consulta = "INSERT INTO poblaciones "
                    . "(id, municipio, provincia)"
                    . "values"
                    . "(null,?,?)";

            $query = $this->bd->preparar($consulta);

            @$query->bindParam(1, $p->getNombre());
            @$query->bindParam(2, $p->getProvincia());


            $query->execute();
            $insertado = true;
        } catch (Exception $ex) {
            $insertado = false;
        }

        return $insertado;
    }

    public function updatePoblaciones($id, $municipio, $provincia) {

        try {
            $consulta = "UPDATE poblaciones SET municipio='$municipio', provincia='$provincia'"
                    . "WHERE id=$id;";

            $query = $this->bd->preparar($consulta);

            $query->execute();
            $modificado = true;
        } catch (Exception $ex) {
            $modificado = false;
        }
        return $modificado;
    }

}
