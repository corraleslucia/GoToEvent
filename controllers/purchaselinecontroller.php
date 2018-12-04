<?php namespace controllers;

use daos\daodb\PurchaseLineDb as Dao;
use models\PurchaseLine;

use daos\daodb\calendarDb as DaoCalendar;
use daos\daodb\eventSeatDb as DaoEventSeat;
use daos\daodb\seatTypeDb as DaoSeatType;
use daos\daodb\eventDb as DaoEvent;
use daos\daodb\artistsxCalendarsDb as DaoArtistsXCalendars;

use controllers\EventController as C_Event;



class PurchaseLineController
{
    private $dao;
    private $daoCalendar;
    private $daoEventSeat;
    private $daoSeatType;
    private $daoEvent;
    private $daoArtistsXCalendars;
    private $eventController;



    public function __construct()
    {
        $this->dao= Dao::getInstance();
        $this->daoCalendar= DaoCalendar::getInstance();
        $this->daoEventSeat= DaoEventSeat::getInstance();
        $this->daoSeatType= DaoSeatType::getInstance();
        $this->daoEvent= DaoEvent::getInstance();
        $this->daoArtistsXCalendars= DaoArtistsXCalendars::getInstance();
        $this->eventController = new C_Event;

    }

    public function index()
    {
        if(isset($_SESSION['userLogged']))
        {
            if ($_SESSION['userLogged']->getType()==="1")
            {
                $this->eventController->_list();
            }
            else if ($_SESSION['userLogged']->getType()==="2")
            {
                $this->listPurchaseLinesByUser();
            }

        }
        else
        {
            $val= "Inicie sesion, no saltearas este paso";
            require(ROOT.'views/login.php');
        }

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
            $val= "Inicie sesion, no saltearas este paso";
            require(ROOT.'views/login.php');
        }
    }

    public function addToCart($id_calendar, $id_eventSeat, $seatType, $price, $quantity)
    {
        if(isset($_SESSION['userLogged']))
        {
            $eventSeat = $this->daoEventSeat->readId($id_eventSeat);
            $calendar = $this->daoCalendar->readId($id_calendar);
            $calendar['0']->setArtists($this->daoArtistsXCalendars->readAllArtistsFromCalendar($calendar['0']->getId()));
            $eventSeat['0']->setSeatType($this->daoSeatType->read($seatType)['0']);
            $eventSeat['0']->setIdCalendar($calendar['0']);
            $_SESSION['cart'][] = new PurchaseLine ($eventSeat['0'], $quantity, $price);
            $val = "Agregado al carrito.";
            $this->eventController->listForUser("byArtist", $val);
        }
        else
        {
            $val= "Inicie sesion, no saltearas este paso";
            require(ROOT.'views/login.php');
        }

    }

    public function viewCart()
    {
        $val = null;

        if(isset($_SESSION['userLogged']))
        {
            require(ROOT.'views/viewCart.php');
        }
        else
        {
            $val= "Inicie sesion, no saltearas este paso";
            require(ROOT.'views/login.php');
        }
    }

    public function deleteFromCart($keyToDelete="")
    {
        if(isset($_SESSION['userLogged']))
        {
            if (!$keyToDelete)
            {
                $keyToDelete = '0';
            }
            unset($_SESSION['cart'][$keyToDelete]);
            $val = "Selección Eliminada";
            require(ROOT.'views/viewCart.php');
        }
        else
        {
            $val= "Inicie sesion, no saltearas este paso";
            require(ROOT.'views/login.php');
        }
    }



}

?>
