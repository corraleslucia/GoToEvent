<?php namespace models;

class SeatType
{
    private $id;
    private $name;

    public function __construct($n, $id=""){
        $this->id = $id;
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
