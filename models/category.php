<?php namespace models;

class Category
{
    private $id;
    private $description;

    function __construct($d){
        $this->description = $d;
    }

    public function getDescription(){
        return $this->description;
    }

    public function getId(){
        return $this->id;
    }

    public function setId($newId){
        $this->id = $newId;
    }

    public function setDescription($newDescription){
        $this->description = $newDescription;
    }
}

?>
