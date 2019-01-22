<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Telefono
 *
 * @author maros
 */
class Telefono {

    private $id;
    private $movil;
    private $fijo;
    private $otro;
    
    function __construct($id, $movil, $fijo, $otro) {
        $this->id = $id;
        $this->movil = $movil;
        $this->fijo = $fijo;
        $this->otro = $otro;
    }

    function getId() {
        return $this->id;
    }

    function getMovil() {
        return $this->movil;
    }

    function getFijo() {
        return $this->fijo;
    }

    function getOtro() {
        return $this->otro;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setMovil($movil) {
        $this->movil = $movil;
    }

    function setFijo($fijo) {
        $this->fijo = $fijo;
    }

    function setOtro($otro) {
        $this->otro = $otro;
    }


}
