<?php namespace models;

class Category
{
    private $description;

    function __construct($d){
        $this->description = $d;
    }

    public function getDescription(){
        return $this->description;
    }

    public function setDescription($newDescription){
        $this->description = $newDescription;
    }
}

?>
