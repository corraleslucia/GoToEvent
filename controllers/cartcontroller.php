<?php namespace controllers;

//use daos\daodb\TicketDb as Dao;
//use models\Ticket;

use daos\daodb\calendarDb as DaoCalendar;
use daos\daodb\eventSeatDb as DaoEventSeat;
use daos\daodb\eventDb as DaoEvent;
use daos\daodb\artistsxCalendarsDb as DaoArtistsXCalendars;

class CartController
{
    //protected $dao;
    protected $daoCalendar;
    protected $daoEventSeat;
    protected $daoEvent;
    protected $daoArtistsXCalendars;

    public function __construct()
    {
        //$this->dao= Dao::getInstance();
        $this->daoCalendar= DaoCalendar::getInstance();
        $this->daoEventSeat= DaoEventSeat::getInstance();
        $this->daoEvent= DaoEvent::getInstance();
        $this->daoArtistsXCalendars= DaoArtistsXCalendars::getInstance();
    }

    public function index()
    {

    }



    public function selectTicketOptions ($id_calendar, $id_eventSeat, $id_event)
    {
        $event = $this->daoEvent->readId($id_event);
        $calendar = $this->daoCalendar->readId($id_calendar);
        $eventSeat = $this->daoEventSeat->readId($id_eventSeat);
        $calendar['0']->setArtists($this->daoArtistsXCalendars->readAllArtistsFromCalendar($calendar['0']->getId()));

        
        require(ROOT.'views/addToCart.php');

    }

}

?>