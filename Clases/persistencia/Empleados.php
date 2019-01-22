<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Usuarios
 *
 * @author maros
 */

require_once 'Conexion.php';

class Empleados {
    
    private static $instance;
    private $bd;
    
    function __construct() {
        $this->bd = Conexion::singleton_conexion();
    }
    
    public static function singletonEmpleados() {
        if(!isset(self::$instance)) {
            $miclass = __CLASS__;
            self::$instance = new $miclass;
        }
        
        return self::$instance;
    }
    
    public function addEmpleado(Empleado $p) {

        try {
            $consulta = "INSERT INTO empleados "
                    . "(id, cod_empleado, nombre, apellido1, apellido2, dni, id_direccion, id_telefono, id_email, rango, activo)"
                    . "values"
                    . "(null, ?,?,?,?,?,?,?,?,?,?)";

            $query = $this->bd->preparar($consulta);

            @$query->bindParam(1, $p->getCod_empleado());
            @$query->bindParam(2, $p->getNombre());
            @$query->bindParam(3, $p->getApellido1());
            @$query->bindParam(4, $p->getApellido2());
            @$query->bindParam(5, $p->getDni());
            @$query->bindParam(6, $p->getId_direccion());
            @$query->bindParam(7, $p->getId_telefono());
            @$query->bindParam(8, $p->getId_email());
            @$query->bindParam(9, $p->getRango());
            @$query->bindParam(10, $p->getActivo());

            $query->execute();
            $insertado = true;
        } catch (Exception $ex) {
            $insertado = false;
        }

        return $insertado;
    }
    
            public function getAllEmpleados() {
        try {
            $consulta = "SELECT * FROM empleados";

            $query = $this->bd->preparar($consulta);

            $query->execute();
            $tEmpleados = $query->fetchAll();
        } catch (Exception $exc) {
            
        }

        return $tEmpleados;
    }
    
    public function getUltimoEmpleado() {
        try {
            $consulta = "SELECT MAX(id) as ultimo FROM empleados";

            $query = $this->bd->preparar($consulta);

            $query->execute();
            $tEmpleados = $query->fetchAll();
        } catch (Exception $ex) {
            
        }
        return $tEmpleados[0]['ultimo'];
    }
    
    

    

}
