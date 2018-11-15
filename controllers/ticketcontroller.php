<?php namespace controllers;

use daos\daodb\TicketDb as Dao;
use models\Ticket;

use daos\daodb\calendarDb as DaoCalendar;
use daos\daodb\eventSeatDb as DaoEventSeat;
use daos\daodb\seatTypeDb as DaoSeatType;
use daos\daodb\eventDb as DaoEvent;
use daos\daodb\artistsxCalendarsDb as DaoArtistsXCalendars;

use controllers\EventController as C_Event;

class TicketController
{
    protected $dao;
    protected $daoCalendar;
    protected $daoEventSeat;
    protected $daoSeatType;
    protected $daoEvent;
    protected $daoArtistsXCalendars;
    protected $eventController;

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

    public function addToCart($id_calendar, $id_eventSeat, $seatType, $price, $quantity)
    {
        if(isset($_SESSION['userLogged']))
        {
            $total = intval($price) * intval($quantity);
            $eventSeat = $this->daoEventSeat->readId($id_eventSeat);
            $calendar = $this->daoCalendar->readId($id_calendar);
            $calendar['0']->setArtists($this->daoArtistsXCalendars->readAllArtistsFromCalendar($calendar['0']->getId()));
            $_SESSION['cart'][] = new Ticket ($_SESSION['userLogged']->getId(), $calendar['0'], $eventSeat['0'], $seatType, $quantity, $price, $total);
            $val = "Agregado al carrito.";
            $this->eventController->listForUser("byArtist", $val);
        }
        else
        {
            echo ('inicie sesion, no saltearas este paso');
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
            echo ('inicie sesion, no saltearas este paso');
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
            $val = "Ticket Eliminado";
            require(ROOT.'views/viewCart.php');
        }
        else
        {
            echo ('inicie sesion, no saltearas este paso');
            require(ROOT.'views/login.php');
        }
    }

    public function buyTickets()
    {
        if(isset($_SESSION['userLogged']))
        {
            foreach ($_SESSION['cart'] as $key => $ticket)
            {
                $remaningQuantity = $this->daoEventSeat->checkRemaningQuantity($ticket->getEventSeat()->getId());
                if ($remaningQuantity != 0 && $ticket->getEventSeat()->getRemaningQuantity() >= $ticket->getQuantity() )
                {
                    $newRemaningQuantity = intval($ticket->getEventSeat()->getRemaningQuantity()) - intval($ticket->getQuantity());
                    $this->daoEventSeat->update($ticket->getEventSeat()->getId(), $newRemaningQuantity);
                    $seatType = $this->daoSeatType->read($ticket->getSeatType());
                    $_ticket = New Ticket ($_SESSION['userLogged']->getId(), $ticket->getCalendar()->getId(), $ticket->getEventSeat()->getId(), $seatType['0']->getId() , $ticket->getQuantity(), $ticket->getPrice(), $ticket->getTotal());
                    $this->dao->create($_ticket);
                    unset($_SESSION['cart'][$key]);
                }
                else
                {
                    $_SESSION['discardTickets'][] = $ticket;
                    unset($_SESSION['cart'][$key]);
                }
            }
            require(ROOT.'views/endShopping.php');

        }
        else
        {
            echo ('inicie sesion, no saltearas este paso');
            require(ROOT.'views/login.php');
        }
    }

    public function listTicketsByUser ()
    {
        if(isset($_SESSION['userLogged']))
        {
            $tickets = $this->dao->readAll();

            if ($tickets)
            {
                foreach ($tickets as $key => $value)
                {
                    $value->setCalendar($this->daoCalendar->readId($value->getCalendar())['0']);
                    $value->getCalendar()->setArtists($this->daoArtistsXCalendars->readAllArtistsFromCalendar($value->getCalendar()->getId()));
                    $value->setEventSeat($this->daoEventSeat->readId($value->getEventSeat())['0']);
                    $value->setSeatType($this->daoSeatType->readId($value->getSeatType())['0']);
                }
            }
            require(ROOT.'views/myTickets.php');

        }
        else
        {
            echo ('inicie sesion, no saltearas este paso');
            require(ROOT.'views/login.php');
        }
    }


}

?>
