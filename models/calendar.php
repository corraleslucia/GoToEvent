<?php

namespace models;

class Calendar
{
    private $date;
    private $id;
    private $location;
    private $artists;
    private $eventSeats;

    function __construct($d, $l, $a, $es){
        $this->date = $d;
        $this->location = $l;
        $this->artist = $a;
        $this->eventSeats = $es;
    }

    public function getDate(){
        return $this->date;
    }

    public function getId(){
        return $this->id;
    }

    public function getLocation(){
        return $this->location;
    }

    public function getArtist(){
        return $this->artist;
    }

    public function getEventSeat(){
        return $this->eventSeat;
    }

    public function setEventSeat($newEventSeat){
        $this->eventSeat = $newEventSeat;
    }

    public function setDate($newDate){
        $this->date = $newDate;
    }

    public function setId($newId){
        $this->id = $newId;
    }

    public function setLocation($newLocation){
        $this->location = $location;
    }

    public function setArtist($newArtist){
        $this->artist = $newArtist;
    }
}
?>
