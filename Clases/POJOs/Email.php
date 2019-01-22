<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Email
 *
 * @author maros
 */
class Email {

    private $id;
    private $personal;
    private $otro;
    
    function __construct($id, $personal, $otro) {
        $this->id = $id;
        $this->personal = $personal;
        $this->otro = $otro;
    }
    
    function getId() {
        return $this->id;
    }

    function getPersonal() {
        return $this->personal;
    }

    function getOtro() {
        return $this->otro;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setPersonal($personal) {
        $this->personal = $personal;
    }

    function setOtro($otro) {
        $this->otro = $otro;
    }



}
