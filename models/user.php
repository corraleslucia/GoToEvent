<?php

namespace models;

class User
{
    private $id;
    private $mail;
    private $pass;
    private $name;
    private $lastName;
    private $type;

    function __construct($m, $p, $n, $ln, $t){
        $this->mail = $m;
        $this->pass = $p;
        $this->name = $n;
        $this->lastName = $ln;
        $this->type = $t;
    }

    public function getMail(){
        return $this->mail;
    }

    public function getPass(){
        return $this->pass;
    }

    public function getName(){
        return $this->name;
    }

    public function getLastName(){
        return $this->lastName;
    }

    public function getType(){
        return $this->type;
    }

    public function getId(){
        return $this->id;
    }

    public function setId($newId){
        $this->id = $newId;
    }

    public function setMail($newMail){
        $this->mail = $newMail;
    }

    public function setPass($newPass){
        $this->pass = $newPass;
    }

    public function setName($newName){
        $this->name = $newName;
    }

    public function setLastName($newLastName){
        $this->lastName = $newLastName;
    }

    public function setType($newType){
        $this->type = $newType;
    }

}

?>