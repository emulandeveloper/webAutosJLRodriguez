<?php

class Automovil {
    
    private $id;
    private $cod_automovil;
    private $marca;
    private $modelo;
    private $ano;
    private $kilometros;
    private $caballos;
    private $precio;
    private $foto;
    private $activo;
    
    
    function __construct($id, $cod_automovil, $marca, $modelo, $ano, $kilometros, $caballos, $precio, $foto, $activo) {
        $this->id = $id;
        $this->cod_automovil = $cod_automovil;
        $this->marca = $marca;
        $this->modelo = $modelo;
        $this->ano = $ano;
        $this->kilometros = $kilometros;
        $this->caballos = $caballos;
        $this->precio = $precio;
        $this->foto = $foto;
        $this->activo = $activo;
    }
    
    function getId() {
        return $this->id;
    }

    function getCod_automovil() {
        return $this->cod_automovil;
    }

    function getMarca() {
        return $this->marca;
    }

    function getModelo() {
        return $this->modelo;
    }

    function getAno() {
        return $this->ano;
    }

    function getKilometros() {
        return $this->kilometros;
    }

    function getFoto() {
        return $this->foto;
    }

    function getActivo() {
        return $this->activo;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setCod_automovil($cod_automovil) {
        $this->cod_automovil = $cod_automovil;
    }

    function setMarca($marca) {
        $this->marca = $marca;
    }

    function setModelo($modelo) {
        $this->modelo = $modelo;
    }

    function setAno($ano) {
        $this->ano = $ano;
    }

    function setKilometros($kilometros) {
        $this->kilometros = $kilometros;
    }

    function setFoto($foto) {
        $this->foto = $foto;
    }

    function setActivo($activo) {
        $this->activo = $activo;
    }

    function getPrecio() {
        return $this->precio;
    }

    function setPrecio($precio) {
        $this->precio = $precio;
    }

    function getCaballos() {
        return $this->caballos;
    }

    function setCaballos($caballos) {
        $this->caballos = $caballos;
    }




}

