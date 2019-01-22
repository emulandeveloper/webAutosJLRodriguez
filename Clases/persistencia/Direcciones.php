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

class Direcciones {

    private static $instance;
    private $bd;

    function __construct() {
        $this->bd = Conexion::singleton_conexion();
    }

    public static function singletonDirecciones() {
        if (!isset(self::$instance)) {
            $miclass = __CLASS__;
            self::$instance = new $miclass;
        }

        return self::$instance;
    }

    public function getUltimoIdDir() {
        try {
            $consulta = "SELECT MAX(id) as ultimo FROM direcciones";

            $query = $this->bd->preparar($consulta);

            $query->execute();
            $tDireccion = $query->fetchAll();
        } catch (Exception $ex) {
            
        }
        return $tDireccion[0]['ultimo'];
    }

    public function getDireccion($id) {
        try {
            $consulta = "SELECT * FROM direcciones WHERE id=" . $id . ";";
            $query = $this->bd->preparar($consulta);
            $query->execute();
            $tDireccion = $query->fetchAll();
        } catch (Exception $ex) {
            //echo "Se ha producido un error en getUnPedido";
        }
        return $tDireccion;
    }

    public function addDirecciones(Direccion $d) {

        try {
            $consulta = "INSERT INTO direcciones "
                    . "(id, tipo_via, nombre_via, numero, piso, letra, escalera, cod_postal, id_poblacion)"
                    . "values"
                    . "(null,?,?,?,?,?,?,?,?)";

            $query = $this->bd->preparar($consulta);

            @$query->bindParam(1, $d->getTipo_via());
            @$query->bindParam(2, $d->getNombre_via());
            @$query->bindParam(3, $d->getNumero());
            @$query->bindParam(4, $d->getPiso());
            @$query->bindParam(5, $d->getLetra());
            @$query->bindParam(6, $d->getEscalera());
            @$query->bindParam(7, $d->getCod_postal());
            @$query->bindParam(8, $d->getId_poblacion());


            $query->execute();
            $insertado = true;
        } catch (Exception $ex) {
            $insertado = false;
        }

        return $insertado;
    }

    public function updateDirecciones($id, $tipoVia, $nombreVia, $numero, $piso, $letra, $escalera, $codPostal, $idPoblacion) {

        try {
            $consulta = "UPDATE direcciones SET tipo_via='$tipoVia', nombre_via='$nombreVia', "
                    . " numero=$numero, piso=$piso, letra='$letra', escalera='$escalera',"
                    . " cod_postal=$codPostal, id_poblacion=$idPoblacion"
                    . " WHERE id=$id;";
            $query = $this->bd->preparar($consulta);

            $query->execute();
            $modificados = true;
        } catch (Exception $ex) {
            $modificados = false;
        }
        return $modificados;
    }

}
