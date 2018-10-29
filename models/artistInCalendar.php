<?php namespace models;

class ArtistInCalendar
{
    private $id_artist;
    private $id_calendar;

    public function __construct($id_artist, $id_calendar){
        $this->id_artist=$id_artist;
        $this->id_calendar=$id_calendar;
    }

    public function getIdArtist(){
        return $this->id_artist;
    }

    public function setIdArtist($newIdArtist){
        $this->id_artist = $newIdArtist;
    }

    public function getIdCalendar(){
        return $this->id_calendar;
    }

    public function setIdCalendar($newIdCalendar){
        $this->id_calendar = $newIdCalendar;
    }

}

?>
