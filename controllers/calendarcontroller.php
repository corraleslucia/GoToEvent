<?php namespace controllers;

use daos\daodb\CalendarDb as Dao;
use daos\daodb\ArtistsXCalendarsDb as DaoAC;
use models\Calendar;
use models\ArtistInCalendar;


class CalendarController
{
    protected $dao;
    protected $daoAC;

    public function __construct()
    {
        $this->dao= Dao::getInstance();
        $this->daoAC= DaoAC::getInstance();
    }

    public function index()
    {

    }

    public function store($date, $time, $id_event, $id_location, $_artists)
    {
        $calendar = new Calendar($date, $time, $id_location, $_artists, $id_event);

        $this->dao->create($calendar);

        $readInfo['date'] = $date;
        $readInfo['time'] = $time;
        $readInfo['id_event'] = $id_event;
        $readInfo['id_location'] = $id_location;

        $_calendar = $this->dao->read($readInfo);

        foreach ($_artists as $key => $value)
        {
            $_artistInCalendar = new ArtistInCalendar($value, $_calendar->getId());
            $this->daoAC->create($_artistInCalendar);
        }


    }

}

?>
