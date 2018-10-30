<?php namespace controllers;

use daos\daodb\CalendarDb as Dao;
use daos\daodb\ArtistsXCalendarsDb as DaoAC;
use \daos\daodb\LocationDb as DaoLocation;
use \daos\daodb\ArtistDb as DaoArtist;

use controllers\EventSeatController as C_EventSeat;

use models\Calendar;
use models\ArtistInCalendar;
use models\Artist;
use models\Location;



class CalendarController
{
    protected $dao;
    protected $daoAC;
    protected $daoArtist;
    protected $daoLocation;
    protected $eventSeatController;

    public function __construct()
    {
        $this->eventSeatController = new C_EventSeat;
        $this->dao= Dao::getInstance();
        $this->daoAC= DaoAC::getInstance();
        $this->daoLocation= DaoLocation::getInstance();
        $this->daoArtist= DaoArtist::getInstance();
    }

    public function index()
    {

    }

    public function add ($event)
    {
        $val = null;
        $artists = $this->daoArtist->readAll();
        $locations = $this->daoLocation->readAll();
        require(ROOT.'views/createCalendar.php');

    }

    public function list ()
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

        $this->eventSeatController->add($_calendar);

    }

}

?>
