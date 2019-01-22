<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Poblacion
 *
 * @author maros
 */
class Poblacion {

    private $id;
    private $nombre;
    private $provincia;
    
    function __construct($id, $nombre, $provincia) {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->provincia = $provincia;
    }
    
    function getId() {
        return $this->id;
    }

    function getNombre() {
        return $this->nombre;
    }

    function getProvincia() {
        return $this->provincia;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    function setProvincia($provincia) {
        $this->provincia = $provincia;
    }


}
