<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ImagenesCars
 *
 * @author maros
 */
class ImagenesCar {
    
    private $id;
    private $id_car;
    private $foto_car;
    
    function __construct($id, $id_car, $foto_car) {
        $this->id = $id;
        $this->id_car = $id_car;
        $this->foto_car = $foto_car;
    }
    
    function getId() {
        return $this->id;
    }

    function getId_car() {
        return $this->id_car;
    }

    function getFoto_car() {
        return $this->foto_car;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setId_car($id_car) {
        $this->id_car = $id_car;
    }

    function setFoto_car($foto_car) {
        $this->foto = $foto;
    }



}
