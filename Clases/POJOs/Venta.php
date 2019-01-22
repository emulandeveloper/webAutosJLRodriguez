<?php

class Venta {
    
    private $id;
    private $id_automovil;
    private $id_cliente;
    private $metodo_pago;
    private $fecha_venta;
    
    function __construct($id, $id_automovil, $id_cliente, $metodo_pago, $fecha_venta) {
        $this->id = $id;
        $this->id_automovil = $id_automovil;
        $this->id_cliente = $id_cliente;
        $this->metodo_pago = $metodo_pago;
        $this->fecha_venta = $fecha_venta;
    }
    
    function getId() {
        return $this->id;
    }

    function getId_automovil() {
        return $this->id_automovil;
    }

    function getId_cliente() {
        return $this->id_cliente;
    }

    function getId_empleado() {
        return $this->id_empleado;
    }

    function getMetodo_pago() {
        return $this->metodo_pago;
    }

    function getFecha_venta() {
        return $this->fecha_venta;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setId_automovil($id_automovil) {
        $this->id_automovil = $id_automovil;
    }

    function setId_cliente($id_cliente) {
        $this->id_cliente = $id_cliente;
    }

    function setId_empleado($id_empleado) {
        $this->id_empleado = $id_empleado;
    }

    function setMetodo_pago($metodo_pago) {
        $this->metodo_pago = $metodo_pago;
    }

    function setFecha_venta($fecha_venta) {
        $this->fecha_venta = $fecha_venta;
    }



            
}

