<?php

namespace models;

class Event
{
    private $id;
    private $description;
    private $category;
    private $caldendars;

    function __construct($d, $cat, $cal){
        $this->description = $d;
        $this->category = $cat;
        $this->calendar = $cal;
    }

    public function getDescription(){
        return $this->description;
    }
    
    public function getCategory(){
        return $this->category;
    }

    public function getCalendar(){
        return $this->caldendar;
    }

    public function getId(){
        return $this->id;
    }

    public function setDescription($newDescription){
        $this->description = $newDescription;
    }

    public function setCategory($newCategory){
        $this->category = $newCategory;
    }

    public function setCalendar($newCalendar){
        $this->calendar = $newCalendar;
    }

    public function setId($newId){
        $this->id = $newId;
    }

    



}
?>
