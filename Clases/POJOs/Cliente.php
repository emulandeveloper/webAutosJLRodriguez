<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Cliente
 *
 * @author maros
 */
class Cliente {
    private $id;
    private $cod_cliente;
    private $nombre;
    private $apellido1;
    private $apellido2;
    private $dni;
    private $id_direccion;
    private $id_telefono;
    private $id_email;
    
    
    function __construct($id, $cod_cliente, $nombre, $apellido1, $apellido2, $dni, $id_direccion, $id_telefono, $id_email) {
        $this->id = $id;
        $this->cod_cliente = $cod_cliente;
        $this->nombre = $nombre;
        $this->apellido1 = $apellido1;
        $this->apellido2 = $apellido2;
        $this->dni = $dni;
        $this->id_direccion = $id_direccion;
        $this->id_telefono = $id_telefono;
        $this->id_email = $id_email;
    }
    
    function getId() {
        return $this->id;
    }

    function getCod_cliente() {
        return $this->cod_cliente;
    }

    function getNombre() {
        return $this->nombre;
    }

    function getApellido1() {
        return $this->apellido1;
    }

    function getApellido2() {
        return $this->apellido2;
    }

    function getDni() {
        return $this->dni;
    }

    function getId_direccion() {
        return $this->id_direccion;
    }

    function getId_telefono() {
        return $this->id_telefono;
    }

    function getId_email() {
        return $this->id_email;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setCod_cliente($cod_cliente) {
        $this->cod_cliente = $cod_cliente;
    }

    function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    function setApellido1($apellido1) {
        $this->apellido1 = $apellido1;
    }

    function setApellido2($apellido2) {
        $this->apellido2 = $apellido2;
    }

    function setDni($dni) {
        $this->dni = $dni;
    }

    function setId_direccion($id_direccion) {
        $this->id_direccion = $id_direccion;
    }

    function setId_telefono($id_telefono) {
        $this->id_telefono = $id_telefono;
    }

    function setId_email($id_email) {
        $this->id_email = $id_email;
    }


}
