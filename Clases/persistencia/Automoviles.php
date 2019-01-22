<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Automoviles
 *
 * @author maros
 */
require_once 'Conexion.php';

class Automoviles {

    private static $instance;
    private $bd;

    public function __construct() {
        $this->bd = Conexion::singleton_conexion();
    }

    public static function singletonAutomoviles() {
        if (!isset(self::$instance)) {
            $miclass = __CLASS__;
            self::$instance = new $miclass;
        }

        return self::$instance;
    }

    public function getAllAutos() {
        try {
            $consulta = "SELECT * FROM automoviles WHERE activo=1;";

            $query = $this->bd->preparar($consulta);

            $query->execute();
            $tAutos = $query->fetchAll();
        } catch (Exception $exc) {
            
        }

        return $tAutos;
    }

    public function getAllAutosBaja() {
        try {
            $consulta = "SELECT * FROM automoviles WHERE activo=0;";

            $query = $this->bd->preparar($consulta);

            $query->execute();
            $tAutos = $query->fetchAll();
        } catch (Exception $exc) {
            
        }

        return $tAutos;
    }

    public function addAutomovil(Automovil $a) {

        try {
            $consulta = "INSERT INTO automoviles "
                    . "(id, codigo, marca, modelo, ano_mat, kilometros, potencia_cv, precio, foto, activo)"
                    . "values"
                    . "(null, ?,?,?,?,?,?,?,?,?)";

            $query = $this->bd->preparar($consulta);

            @$query->bindParam(1, $a->getCod_automovil());
            @$query->bindParam(2, $a->getMarca());
            @$query->bindParam(3, $a->getModelo());
            @$query->bindParam(4, $a->getAno());
            @$query->bindParam(5, $a->getKilometros());
            @$query->bindParam(6, $a->getCaballos());
            @$query->bindParam(7, $a->getPrecio());
            @$query->bindParam(8, $a->getFoto());
            @$query->bindParam(9, $a->getActivo());

            $query->execute();
            $insertado = true;
        } catch (Exception $ex) {
            $insertado = false;
        }

        return $insertado;
    }

    public function getUltimoId() {
        try {
            $consulta = "SELECT MAX(id) as ultimo FROM automoviles";

            $query = $this->bd->preparar($consulta);

            $query->execute();
            $tAutomovil = $query->fetchAll();
        } catch (Exception $ex) {
            
        }
        return $tAutomovil[0]['ultimo'];
    }

    public function getCodAutomovil($id) {

        try {
            $consulta = "SELECT * FROM automoviles WHERE id=" . $id;
            $query = $this->bd->preparar($consulta);
            $query->execute();
            $a = $query->fetchAll();
        } catch (Exception $ex) {
            
        }
        return $a;
    }

    public function getAutomoviles($cod_automovil) {
        try {
            $consulta = "SELECT * FROM automoviles WHERE codigo ='" . $cod_automovil . "';";
            $query = $this->bd->preparar($consulta);
            $query->execute();
            $tAutos = $query->fetchAll();
        } catch (Exception $exc) {
            
        }
        return $tAutos;
    }

    public function getAutomovilList($codigo) {
        try {
            $consulta = "SELECT * FROM automoviles WHERE codigo= '$codigo' ;";
            $query = $this->bd->preparar($consulta);
            $query->execute();
            $tAutomoviles = $query->fetchAll();
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
        if (empty($tAutomoviles)) {
            $vol = NULL;
        } else {
            $vol = new Automovil($tAutomoviles[0][0], $tAutomoviles[0][1], $tAutomoviles[0][2], $tAutomoviles[0][3], $tAutomoviles[0][4], $tAutomoviles[0][5], $tAutomoviles[0][6], $tAutomoviles[0][7], $tAutomoviles[0][8], $tAutomoviles[0][9]);
        }
        return $vol;
    }

    public function updateAutomoviles($id, $codigo, $marca, $modelo, $ano, $kilometros, $caballos, $precio, $foto, $activo) {

        try {
            $consulta = "UPDATE automoviles SET codigo='$codigo', marca='$marca', modelo='$modelo', "
                    . "ano_mat=$ano, kilometros=$kilometros, potencia_cv=$caballos, precio=$precio, "
                    . "foto='$foto', activo=$activo WHERE"
                    . " id=$id;";

            $query = $this->bd->preparar($consulta);

            $query->execute();
            $modificado = true;
        } catch (Exception $ex) {
            $modificado = false;
        }
        return $modificado;
    }

    public function bajaAutomovil($codAuto) {

        try {
            $consulta = "UPDATE automoviles SET activo=0"
                    . " WHERE codigo= '$codAuto';";
            $query = $this->bd->preparar($consulta);

            $query->execute();
            $baja = true;
        } catch (Exception $ex) {
            $baja = false;
        }
        return $baja;
    }
    
    public function bajaAutomoviles($id) {

        try {
            $consulta = "UPDATE automoviles SET activo=2"
                    . " WHERE id= $id;";
            $query = $this->bd->preparar($consulta);

            $query->execute();
            $baja = true;
        } catch (Exception $ex) {
            $baja = false;
        }
        return $baja;
    }


    /* --------------------------------------------------------------------------- Persistencia de cada coche ---------------------------------------------------------------------------------------- */

    public function viewCar($id) {

        try {
            $consulta = "SELECT img_automoviles.* "
                    . "FROM img_automoviles "
                    . "INNER JOIN automoviles on img_automoviles.id_automovil = automoviles.id "
                    . "WHERE automoviles.id =" . $id;
            $query = $this->bd->preparar($consulta);
            $query->execute();
            $tAutomoviles = $query->fetchAll();
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }

        return $tAutomoviles;
    }

}
