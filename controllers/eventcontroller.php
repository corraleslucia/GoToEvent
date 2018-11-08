<?php namespace controllers;

use daos\daodb\EventDb as Dao;
use daos\daodb\CategoryDb as DaoCategory;
use daos\daodb\EventSeatDb as DaoEventSeat;
use daos\daodb\CalendarDb as DaoCalendar;
use daos\daodb\ArtistsXCalendarsDb as DaoArtistsXCalendars;

use models\Event;

use controllers\CalendarController as C_Calendar;

class EventController
{
    protected $dao;
    protected $daoCategory;
    protected $daoEventSeat;
    protected $daoCalendar;
    protected $daoArtistsXCalendars;

    protected $calendarController;


    public function __construct()
    {
        $this->calendarController = new C_Calendar;
        $this->dao= Dao::getInstance();
        $this->daoCategory = DaoCategory::getInstance();
        $this->daoEventSeat = DaoEventSeat::getInstance();
        $this->daoCalendar = DaoCalendar::getInstance();
        $this->daoArtistsXCalendars = DaoArtistsXCalendars::getInstance();

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

        require(ROOT.'views/listEvents.php');

    }

    public function selectEvent ($type)
    {
        $events = $this->dao->readAll();
        require(ROOT.'views/selectEvent.php');

    }

    public function showEventDetails ($id_event)
    {
        $event = $this->dao->readID($id_event);
        $calendars = $this->daoCalendar->readFromEvent($id_event);


        foreach ($calendars as $key => $value)
        {
            $value->setArtists($this->daoArtistsXCalendars->readAllArtistsFromCalendar($value->getId()));

            $value->setEventSeats($this->daoEventSeat->readAllFromCalendar($value->getId()));
        }

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
