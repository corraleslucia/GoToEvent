<?php

namespace models;

class Calendar
{
    private $date;
    private $time;
    private $id;
    private $location;
    private $artists;
    private $eventSeats;
    private $id_event;

    function __construct($d, $t, $l, $a, $id_event, $id="", $es=""){
        $this->id = $id;
        $this->date = $d;
        $this->time = $t;
        $this->location = $l;
        $this->artists = $a;
        $this->eventSeats = $es;
        $this->id_event = $id_event;
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

    public function getArtists(){
        return $this->artists;
    }

    public function getEventSeats(){
        return $this->eventSeats;
    }

    public function getTime ()
    {
        return $this->time;
    }

    public function setTime ($newTime)
    {
        $this->time = $newTime;
    }

    public function setEventSeats($newEventSeat){
        $this->eventSeats = $newEventSeat;
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

    public function setArtists($newArtist){
        $this->artists = $newArtist;
    }

    public function getIdEvent ()
    {
        return $this->id_event;
    }

    public function setIdEvent ($newIdEvent)
    {
        $this_id_event = $newIdEvent;
    }
}
?>
