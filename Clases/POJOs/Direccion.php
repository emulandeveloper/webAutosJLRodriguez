<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Direccion
 *
 * @author maros
 */
class Direccion {

    private $id;
    private $tipo_via;
    private $nombre_via;
    private $numero;
    private $piso;
    private $letra;
    private $escalera;
    private $cod_postal;
    private $id_poblacion;
    
    
    function __construct($id, $tipo_via, $nombre_via, $numero, $piso, $letra, $escalera, $cod_postal, $id_poblacion) {
        $this->id = $id;
        $this->tipo_via = $tipo_via;
        $this->nombre_via = $nombre_via;
        $this->numero = $numero;
        $this->piso = $piso;
        $this->letra = $letra;
        $this->escalera = $escalera;
        $this->cod_postal = $cod_postal;
        $this->id_poblacion = $id_poblacion;
    }
    
    function getId() {
        return $this->id;
    }

    function getTipo_via() {
        return $this->tipo_via;
    }

    function getNombre_via() {
        return $this->nombre_via;
    }

    function getNumero() {
        return $this->numero;
    }

    function getPiso() {
        return $this->piso;
    }

    function getLetra() {
        return $this->letra;
    }

    function getEscalera() {
        return $this->escalera;
    }

    function getCod_postal() {
        return $this->cod_postal;
    }

    function getId_poblacion() {
        return $this->id_poblacion;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setTipo_via($tipo_via) {
        $this->tipo_via = $tipo_via;
    }

    function setNombre_via($nombre_via) {
        $this->nombre_via = $nombre_via;
    }

    function setNumero($numero) {
        $this->numero = $numero;
    }

    function setPiso($piso) {
        $this->piso = $piso;
    }

    function setLetra($letra) {
        $this->letra = $letra;
    }

    function setEscalera($escalera) {
        $this->escalera = $escalera;
    }

    function setCod_postal($cod_postal) {
        $this->cod_postal = $cod_postal;
    }

    function setId_poblacion($id_poblacion) {
        $this->id_poblacion = $id_poblacion;
    }



}
