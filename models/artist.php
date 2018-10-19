<?php namespace models;

class Artist
{
    private $id;
    private $name;

    public function __construct($n){
        $this->name=$n;
    }

    public function getName(){
        return $this->name;
    }

    public function getId(){
        return $this->id;
    }

    public function setId($newId){
        $this->id = $newId;
    }

    public function setName($newName){
        $this->name = $newName;
    }
}

?>
