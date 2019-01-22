<?php

class Usuario {
    
    private $id;
    private $login;
    private $password;
    private $id_empleado;
    private $id_cliente;
    private $tipo;
    private $activo;
    
    function __construct($id, $login, $password, $id_cliente, $id_empleado, $tipo, $activo) {
        $this->id = $id;
        $this->login = $login;
        $this->password = $password;
        $this->id_cliente = $id_cliente;
        $this->id_empleado = $id_empleado;
        $this->tipo = $tipo;
        $this->activo = $activo;
    }
    
    function getId() {
        return $this->id;
    }

    function getTipo() {
        return $this->tipo;
    }

    function getLogin() {
        return $this->login;
    }

    function getPassword() {
        return $this->password;
    }


    function getActivo() {
        return $this->activo;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setTipo($tipo) {
        $this->tipo = $tipo;
    }

    function setLogin($login) {
        $this->login = $login;
    }

    function setPassword($password) {
        $this->password = $password;
    }

    function setActivo($activo) {
        $this->activo = $activo;
    }
    
    function getId_empleado() {
        return $this->id_empleado;
    }

    function getId_cliente() {
        return $this->id_cliente;
    }

    function setId_empleado($id_empleado) {
        $this->id_empleado = $id_empleado;
    }

    function setId_cliente($id_cliente) {
        $this->id_cliente = $id_cliente;
    }





}