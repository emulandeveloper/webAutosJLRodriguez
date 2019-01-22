<?php 

class Extras_automovil{
    private $id;
    private $id_automovil;
    private $cambio;
    private $combustible;
    private $num_marchas;
    private $num_plazas;
    private $num_puertas;
    private $traccion;
    private $c_urbano;
    private $c_medio;
    private $c_carretera;
    private $deposito;
    private $descripcion;
    
    function __construct($id, $id_automovil, $cambio, $combustible, $num_marchas, $num_plazas, $num_puertas, $traccion, $c_urbano, $c_medio, $c_carretera, $deposito, $descripcion) {
        $this->id = $id;
        $this->id_automovil = $id_automovil;
        $this->cambio = $cambio;
        $this->combustible = $combustible;
        $this->num_marchas = $num_marchas;
        $this->num_plazas = $num_plazas;
        $this->num_puertas = $num_puertas;
        $this->traccion = $traccion;
        $this->c_urbano = $c_urbano;
        $this->c_medio = $c_medio;
        $this->c_carretera = $c_carretera;
        $this->deposito = $deposito;
        $this->descripcion = $descripcion;
    }
    
    function getId() {
        return $this->id;
    }

    function getId_automovil() {
        return $this->id_automovil;
    }

    function getCambio() {
        return $this->cambio;
    }

    function getCombustible() {
        return $this->combustible;
    }

    function getNum_marchas() {
        return $this->num_marchas;
    }

    function getNum_plazas() {
        return $this->num_plazas;
    }

    function getNum_puertas() {
        return $this->num_puertas;
    }

    function getTraccion() {
        return $this->traccion;
    }

    function getC_urbano() {
        return $this->c_urbano;
    }

    function getC_medio() {
        return $this->c_medio;
    }

    function getC_carretera() {
        return $this->c_carretera;
    }

    function getDeposito() {
        return $this->deposito;
    }

    function getDescripcion() {
        return $this->descripcion;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setId_automovil($id_automovil) {
        $this->id_automovil = $id_automovil;
    }

    function setCambio($cambio) {
        $this->cambio = $cambio;
    }

    function setCombustible($combustible) {
        $this->combustible = $combustible;
    }

    function setNum_marchas($num_marchas) {
        $this->num_marchas = $num_marchas;
    }

    function setNum_plazas($num_plazas) {
        $this->num_plazas = $num_plazas;
    }

    function setNum_puertas($num_puertas) {
        $this->num_puertas = $num_puertas;
    }

    function setTraccion($traccion) {
        $this->traccion = $traccion;
    }

    function setC_urbano($c_urbano) {
        $this->c_urbano = $c_urbano;
    }

    function setC_medio($c_medio) {
        $this->c_medio = $c_medio;
    }

    function setC_carretera($c_carretera) {
        $this->c_carretera = $c_carretera;
    }

    function setDeposito($deposito) {
        $this->deposito = $deposito;
    }

    function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;
    }



}

