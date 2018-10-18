<?php

namespace models;

class Calendar
{
    private $date;
    private $event;
    private $location;
    private $artist;

    function __construct($d, $e, $l, $a){
        $this->date = $d;
        $this->event = $e;
        $this->location = $l;
        $this->artist = $a;
    }

    public function getDate(){
        return $this->date;
    }

    public function getEvent(){
        return $this->event;
    }

    public function getLocation(){
        return $this->location;
    }

    public function getArtist(){
        return $this->artist;
    }

    public function setDate($newDate){
        $this->date = $newDate;
    }

    public function setEvent($newEvent){
        $this->event = $newEvent;
    }

    public function setLocation($newLocation){
        $this->location = $location;
    }

    public function setArtist($newArtist){
        $this->artist = $newArtist;
    }
}
?>
