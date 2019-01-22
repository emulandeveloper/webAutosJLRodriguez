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

class Emails {

    private static $instance;
    private $bd;

    function __construct() {
        $this->bd = Conexion::singleton_conexion();
    }

    public static function singletonEmails() {
        if (!isset(self::$instance)) {
            $miclass = __CLASS__;
            self::$instance = new $miclass;
        }

        return self::$instance;
    }

    public function getUltimoIdEm() {
        try {
            $consulta = "SELECT MAX(id) as ultimo FROM emails";

            $query = $this->bd->preparar($consulta);

            $query->execute();
            $tEmails = $query->fetchAll();
        } catch (Exception $ex) {
            
        }
        return $tEmails[0]['ultimo'];
    }

    public function getEmails($id) {
        try {
            $consulta = "SELECT * FROM emails WHERE id=" . $id . ";";
            $query = $this->bd->preparar($consulta);
            $query->execute();
            $tEmails = $query->fetchAll();
        } catch (Exception $ex) {
            //echo "Se ha producido un error en getUnPedido";
        }
        return $tEmails;
    }

    public function addEmails(Email $e) {

        try {
            $consulta = "INSERT INTO emails "
                    . "(id, personal, otro)"
                    . "values"
                    . "(null,?,?)";

            $query = $this->bd->preparar($consulta);

            @$query->bindParam(1, $e->getPersonal());
            @$query->bindParam(2, $e->getOtro());


            $query->execute();
            $insertado = true;
        } catch (Exception $ex) {
            $insertado = false;
        }

        return $insertado;
    }

    public function updateEmails($id, $personal, $otro) {

        try {
            $consulta = "UPDATE emails SET personal='$personal', otro='$otro'"
                    . "WHERE id = $id;";

            $query = $this->bd->preparar($consulta);

            $query->execute();
            $modificado = true;
        } catch (Exception $ex) {
            $modificado = false;
        }
        return $modificado;
    }

}
