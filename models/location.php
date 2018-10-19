<?php namespace models;

class Location
{
    private $id;
    private $name;
    private $adress;
    private $city;

    public function __construct($n,$a,$c){
        $this->name=$n;
        $this->adress=$a;
        $this->city=$city;
    }

    public function getName(){
        return $this->name;
    }

    public function setName($newName){
        $this->name = $newName;
    }

    public function getAdress(){
        return $this->adress;
    }

    public function setAdress($newAdress){
        $this->adress = $newAdress;
    }

    public function getCity(){
        return $this->city;
    }

    public function setCity($newCity){
        $this->city = $newCity;
    }

    public function getId(){
        return $this->id;
    }

    public function setId($newId){
        $this->id = $newId;
    }
}

?>
