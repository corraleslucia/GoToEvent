<?php namespace controllers;

//use daos\daodb\TicketDb as Dao;
use models\Ticket;

use daos\daodb\calendarDb as DaoCalendar;
use daos\daodb\eventSeatDb as DaoEventSeat;
use daos\daodb\eventDb as DaoEvent;
use daos\daodb\artistsxCalendarsDb as DaoArtistsXCalendars;

use controllers\EventController as C_Event;

class CartController
{
    //protected $dao;
    protected $daoCalendar;
    protected $daoEventSeat;
    protected $daoEvent;
    protected $daoArtistsXCalendars;
    protected $eventController;

    public function __construct()
    {
        //$this->dao= Dao::getInstance();
        $this->daoCalendar= DaoCalendar::getInstance();
        $this->daoEventSeat= DaoEventSeat::getInstance();
        $this->daoEvent= DaoEvent::getInstance();
        $this->daoArtistsXCalendars= DaoArtistsXCalendars::getInstance();
        $this->eventController = new C_Event;
    }

    public function index()
    {

    }



    public function selectTicketOptions ($id_calendar, $id_eventSeat, $id_event)
    {
        if(isset($_SESSION['userLogged']))
        {
            $event = $this->daoEvent->readId($id_event);
            $calendar = $this->daoCalendar->readId($id_calendar);
            $eventSeat = $this->daoEventSeat->readId($id_eventSeat);
            $calendar['0']->setArtists($this->daoArtistsXCalendars->readAllArtistsFromCalendar($calendar['0']->getId()));


            require(ROOT.'views/addToCart.php');
        }
        else
        {
            echo ('inicie sesion, no saltearas este paso');
            require(ROOT.'views/login.php');
        }
    }

    public function addToCart($id_calendar, $seatType, $price, $quantity)
    {
        if(isset($_SESSION['userLogged']))
        {
            $total = intval($price) * intval($quantity);
            $_SESSION['cart'][] = new Ticket ($_SESSION['userLogged']->getId(), $id_calendar, $seatType, $quantity, $price, $total);
            $val = "Agregado al carrito.";
            $this->eventController->listForUser("byArtist", $val);
        }
        else
        {
            echo ('inicie sesion, no saltearas este paso');
            require(ROOT.'views/login.php');
        }

    }

}

?>
