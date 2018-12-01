<?php

namespace models;

class Event
{
    private $id;
    private $description;
    private $category;
    private $poster;
    private $calendars;

    function __construct($d, $cat, $files, $id="", $cal=""){
        $this->id = $id;
        $this->description = $d;
        $this->category = $cat;
        $this->poster = $files;
        $this->calendars = $cal;
    }

    public function getDescription(){
        return $this->description;
    }

    public function getCategory(){
        return $this->category;
    }

    public function getPoster() {
         return $this->poster;
    }

    public function getCalendar(){
        return $this->calendars;
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
        $this->calendars = $newCalendar;
    }

    public function setId($newId){
        $this->id = $newId;
    }





}
?>
