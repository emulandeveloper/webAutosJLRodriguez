<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once 'Conexion.php';

class Extra_automoviles {

    private static $instance;
    private $bd;

    public function __construct() {
        $this->bd = Conexion::singleton_conexion();
    }

    public static function singletonExtra_automoviles() {
        if (!isset(self::$instance)) {
            $miclass = __CLASS__;
            self::$instance = new $miclass;
        }

        return self::$instance;
    }

    public function getAllExtras() {
        try {
            $consulta = "SELECT * FROM extras_automoviles";
            $query = $this->bd->preparar($consulta);
            $query->execute();
            $tExtras = $query->fetchAll();
        } catch (Exception $ex) {
            
        }
        return $tExtras;
    }

    public function getExtrasId($id) {
        $consulta = "SELECT * FROM extra_automoviles WHERE id_automovil =" . $id;
        $query = $this->bd->preparar($consulta);
        $query->execute();
        $e = $query->fetchAll();

        return $e;
    }
    
    public function addExtras(Extras_automovil $a){
        
        try {
            $consulta = "INSERT INTO extra_automoviles"
                    . "(id, id_automovil, cambio, combustible, num_marchas, num_plazas, num_puertas, traccion, c_urbano, c_medio, c_carretera, deposito, descripcion)"
                    . "values"
                    . "(null,?,?,?,?,?,?,?,?,?,?,?,?);";
            
            $query = $this->bd->preparar($consulta);
            
            @$query->bindParam(1, $a->getId_automovil());
            @$query->bindParam(2, $a->getCambio());
            @$query->bindParam(3, $a->getCombustible());
            @$query->bindParam(4, $a->getNum_marchas());
            @$query->bindParam(5, $a->getNum_plazas());
            @$query->bindParam(6, $a->getNum_puertas());
            @$query->bindParam(7, $a->getTraccion());
            @$query->bindParam(8, $a->getC_urbano());
            @$query->bindParam(9, $a->getC_medio());
            @$query->bindParam(10, $a->getC_carretera());
            @$query->bindParam(11, $a->getDeposito());
            @$query->bindParam(12, $a->getDescripcion());
            
            $query->execute();
            $insertado = true;
            
        } catch (Exception $ex) {
            $insertado = false;
        }
        
        return $insertado;
    }
    
    public function updateExtras ($idExtra, $id, $cambio, $combustible, $num_marchas, $num_plazas, $num_puertas, $traccion, $c_urbano, $c_medio, $c_carretera, $deposito, $descripcion){
        
        try {
            $consulta = "UPDATE extra_automoviles SET id_automovil=$id, cambio='$cambio', combustible='$combustible', "
                    . "num_marchas=$num_marchas, num_plazas=$num_plazas, num_puertas=$num_puertas, traccion='$traccion', "
                    . "c_urbano=$c_urbano, c_medio=$c_medio, c_carretera=$c_carretera, deposito=$deposito, descripcion='$descripcion' "
                    . "WHERE id=$idExtra;";
            $query = $this->bd->preparar($consulta);
            $query->execute();
            $update = TRUE;
            
        } catch (Exception $ex) {
            $update = false;
        }
        return $update;
    }
    
    public function deleteAutomovil($id) {
        try {
            $consulta = "DELETE FROM automoviles WHERE"
                    . " id=$id";

            $query = $this->bd->preparar($consulta);
            $query->execute();
            $delete = true;
        } catch (Exception $delete) {
            $delete = false;
        }

        return $delete;
    }

}
