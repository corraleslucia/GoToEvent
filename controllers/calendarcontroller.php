<?php namespace controllers;

//use daos\daoList\CalendarDao as Dao;
//use daos\daodb\CalendarDao as DaoCalendar;
//use daos\daodb\EventDao as DaoEvent;
//use daos\daodb\LocationDao as DaoLocation;
//use daos\daodb\ArtistDao as DaoArtist;

use models\Calendar;

class CalendarController
{
    protected $daoCalendar;
    protected $daoEvent;
    protected $daoLocation;
    protected $daoArtist;

    public function __construct()
    {
        $this->daoCalendar= DaoCalendar::getInstance();
        $this->DaoEvent= DaoEvent::getInstance();
        $this->DaoLocation= DaoLocation::getInstance();
        $this->DaoArtist= DaoArtist::getInstance();
    }

    public function index()
    {
    }

    public function store($date, $event, $location, $artists)
    {
        $calendar = new Calendar($date, $event, $location, $artists);

        $this->dao->create($calendar);
    }
}

?>
