<?php namespace controllers;

use daos\daodb\EventDb as Dao;
use daos\daodb\CategoryDb as DaoCategory;
use daos\daodb\EventSeatDb as DaoEventSeat;
use daos\daodb\CalendarDb as DaoCalendar;
use daos\daodb\ArtistsXCalendarsDb as DaoArtistsXCalendars;
use daos\daodb\ArtistDb as DaoArtist;
use daos\daodb\LocationDb as DaoLocation;


use models\Event;

use controllers\CalendarController as C_Calendar;

class EventController
{
    protected $dao;
    protected $daoCategory;
    protected $daoEventSeat;
    protected $daoCalendar;
    protected $daoArtistsXCalendars;
    protected $daoArtist;
    protected $daoLocation;

    protected $calendarController;


    public function __construct()
    {
        $this->calendarController = new C_Calendar;
        $this->dao= Dao::getInstance();
        $this->daoCategory = DaoCategory::getInstance();
        $this->daoEventSeat = DaoEventSeat::getInstance();
        $this->daoCalendar = DaoCalendar::getInstance();
        $this->daoArtistsXCalendars = DaoArtistsXCalendars::getInstance();
        $this->daoArtist = DaoArtist::getInstance();
        $this->daoLocation = DaoLocation::getInstance();

    }

    public function index()
    {

    }
    public function add ($val="")
    {

        $categories = $this->daoCategory->readAll();
        require(ROOT.'views/createEvent.php');
    }

    public function _list ($showType ="")
    {

        if ($showType === "all")
        {
            $events = $this->dao->readAllAtoZ();
            if(!$events)
            {
                $events['0'] = new Event ("SIN EVENTOS", "-");
            }
            require(ROOT.'views/listEvents.php');
        }
        else if ($showType === "valid")
        {
            $events = $this->dao->readAllValid();
            if(!$events)
            {
                $events['0'] = new Event ("SIN EVENTOS", "-");
            }
            require(ROOT.'views/listEvents.php');
        }
        else if (!$showType)
        {
            $events = $this->dao->readAll();
            if(!$events)
            {
                $events['0'] = new Event ("SIN EVENTOS", "-");
            }
            require(ROOT.'views/listEvents.php');
        }

    }

    public function listForUser($listType="")
    {
        if ($listType === "byArtist" || !$listType )
        {
            $artists = $this->daoArtist->readAll();
            if ($artists)
            {
                $eventsByArtists = array();

                foreach ($artists as $key => $value)
                {
                    $eventsByArtists [$value->getName()] = $this->dao->readEventsFromArtist($value->getId());
                }
            }
        }
        else if ($listType === "byCategory")
        {
            $categories = $this->daoCategory->readAll();
            if ($categories)
            {
                $eventsByCategory = array();
                foreach ($categories as $key => $value)
                {
                    $eventsByCategory [$value->getDescription()] = $this->dao->readEventsFromCategory($value->getId());
                }
            }

        }
        else if ($listType === "byDate")
        {
            $dates = $this->daoCalendar->readAllMonthYearFromCalendars();
            if ($dates)
            {
                $eventsByDate = array();
                foreach ($dates as $key => $value)
                {
                    $eventsByDate [$value['monthName'].'-'.$value['year']] = $this->dao->readEventsFromDate($value['month'], $value['year']);
                }
            }


        }
        else if ($listType === "byLocation")
        {
            $locations = $this->daoLocation->readAll();
            if ($locations)
            {
                $eventsByLocation = array ();
                foreach ($locations as $key => $value)
                {
                    $eventsByLocation [$value->getCity()] = $this->dao->readEventsFromLocation($value->getCity());
                }
            }

        }

        require(ROOT.'views/listEventsByForUsers.php');
    }

    public function selectEvent ($type)
    {
        $events = $this->dao->readAll();
        if(!$events)
        {
            $events['0'] = new Event ("SIN EVENTOS", 0);
        }
        require(ROOT.'views/selectEvent.php');

    }

    public function showEventDetails ($id_event = "")
    {
        $calendars = null;
        if ($id_event)
        {
            $event = $this->dao->readID($id_event);
            $calendars = $this->daoCalendar->readFromEvent($id_event);
            if ($calendars)
            {
                foreach ($calendars as $key => $value)
                {
                    $value->setArtists($this->daoArtistsXCalendars->readAllArtistsFromCalendar($value->getId()));

                    $value->setEventSeats($this->daoEventSeat->readAllFromCalendar($value->getId()));
                }
            }
        }
        else
        {
            $event['0'] = new Event ("SIN EVENTOS", "-");
        }
        require(ROOT.'views/showEvent.php');

    }

    public function showEventDetailsForUser ($id_event)
    {
        $event = $this->dao->readID($id_event);
        $calendars = $this->daoCalendar->readFromEvent($id_event);

        if ($calendars)
        {
            foreach ($calendars as $key => $value)
            {
                $value->setArtists($this->daoArtistsXCalendars->readAllArtistsFromCalendar($value->getId()));

                $value->setEventSeats($this->daoEventSeat->readAllFromCalendar($value->getId()));
            }

        }

        require(ROOT.'views/pickEventSeatUser.php');
    }



    public function store($description,$category)
    {
        $event = new Event($description, $category);

        try
        {
            $this->dao->create($event);

            $_event = $this->dao->read($description);

            $this->calendarController->add($_event['0']);

        } catch (\PDOException $ex)
        {
            $val = "El evento ya existe en la base de datos.";

            $this->add($val);
        }




    }
}

?>
