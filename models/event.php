<?php

namespace models;

class Event
{
    private $description;
    private $category;

    function __construct($d,$c){
        $this->description = $d;
        $this->category = $c;
    }

    public function getDescription(){
        return $this->description;
    }

    public function setDescription($newDescription){
        $this->description = $newDescription;
    }

    public function getCategory(){
        return $this->category;
    }

    public function setCategory($newCategory){
        $this->category = $newCategory;
    }


}
?>
