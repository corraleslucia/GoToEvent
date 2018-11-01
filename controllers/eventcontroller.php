<?php namespace controllers;

use daos\daodb\EventDb as Dao;
use \daos\daodb\CategoryDb as DaoCategory;
use daos\daodb\EventSeatDb as DaoEventSeat;
use daos\daodb\LocationDb as DaoLocation;
use daos\daodb\CalendarDb as DaoCalendar;
use daos\daodb\SeatTypeDb as DaoSeatType;
use daos\daodb\ArtistsXCalendarsDb as DaoArtistsXCalendars;
use daos\daodb\ArtistDb as DaoArtist;

use models\Event;
use models\Category;
use models\EventSeat;
use models\Location;
use models\Calendar;
use models\SeatType;


use controllers\CalendarController as C_Calendar;

class EventController
{
    protected $dao;
    protected $daoCategory;
    protected $daoEventSeat;
    protected $daoLocation;
    protected $daoCalendar;
    protected $daoSeatType;
    protected $daoArtistsXCalendars;
    protected $daoArtist;

    protected $calendarController;


    public function __construct()
    {
        $this->calendarController = new C_Calendar;
        $this->dao= Dao::getInstance();
        $this->daoCategory = DaoCategory::getInstance();
        $this->daoEventSeat = DaoEventSeat::getInstance();
        $this->daoLocation = DaoLocation::getInstance();
        $this->daoCalendar = DaoCalendar::getInstance();
        $this->daoSeatType = DaoSeatType::getInstance();
        $this->daoArtistsXCalendars = DaoArtistsXCalendars::getInstance();
        $this->daoArtist = DaoArtist::getInstance();


    }

    public function index()
    {

    }
    public function add ()
    {
        $val = null;

        $categories = $this->daoCategory->readAll();
        require(ROOT.'views/createEvent.php');
    }

    public function _list ()
    {
        $events = $this->dao->readAll();
        $categories = $this->daoCategory->readAll();
        require(ROOT.'views/listEvents.php');

    }

    public function selectEvent ()
    {
        $events = $this->dao->readAll();
        require(ROOT.'views/selectEvent.php');

    }

    public function showEventDetails ($id_event)
    {
        $event = $this->dao->readID($id_event);
        $category = $this->daoCategory->readId($event->getCategory());
        $calendars = $this->daoCalendar->readFromEvent($id_event);


        foreach ($calendars as $key => $value)
        {
            $artistsIds = $this->daoArtistsXCalendars->readAllArtistsFromCalendar($value->getId());

            $artists = array();

            foreach ($artistsIds as $_key => $_value)
            {
                array_push ($artists, $this->daoArtist->readId($_value->getIdArtist()));
            }
            $value->setArtists($artists);
            $location = $this->daoLocation->readID($value->getLocation());

            $value->setEventSeats($this->daoEventSeat->readAllFromCalendar($value->getId()));
        }

        $_seatsType = $this->daoSeatType->readAll();

        require(ROOT.'views/showEvent.php');

    }



    public function store($description,$category)
    {
        $event = new Event($description, $category);

        $this->dao->create($event);
        $_event = $this->dao->read($description);

        $this->calendarController->add($_event);



    }
}

?>
