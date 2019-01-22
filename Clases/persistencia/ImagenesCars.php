<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once 'Conexion.php';

class ImagenesCars {

    private static $instance;
    private $bd;

    public function __construct() {
        $this->bd = Conexion::singleton_conexion();
    }

    public static function singletonImagenesCars() {
        if (!isset(self::$instance)) {
            $miclass = __CLASS__;
            self::$instance = new $miclass;
        }

        return self::$instance;
    }
    
    public function addImagenes(ImagenesCar $a) {

        try {
            $consulta = "INSERT INTO img_automoviles "
                    . "(id, id_automovil, foto)"
                    . "values"
                    . "(null, ?,?)";

            $query = $this->bd->preparar($consulta);

            @$query->bindParam(1, $a->getId_car());
            @$query->bindParam(2, $a->getFoto_car());

            $query->execute();
            $insert = true;
        } catch (Exception $ex) {
            $insert = false;
        }
        var_dump($insert);
        return $insert;
    }
    
    public function deleteImagenes($id) {
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