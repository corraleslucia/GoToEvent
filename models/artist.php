<?php namespace models;

class Artist
{
    private $name;

    public function __construct($n){
        $this->name=$n;
    }

    public function getName(){
        return $this->name;
    }

    public function setName($newName){
        $this->name = $newName;
    }
}

?>
