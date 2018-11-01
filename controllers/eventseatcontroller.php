<?php namespace controllers;

use daos\daodb\EventSeatDb as Dao;
use daos\daodb\EventDb as DaoEvent;
use daos\daodb\LocationDb as DaoLocation;
use daos\daodb\CalendarDb as DaoCalendar;
use daos\daodb\SeatTypeDb as DaoSeatType;

use models\EventSeat;
use models\Event;
use models\Location;
use models\Calendar;
use models\SeatType;


class EventSeatController
{
    protected $dao;
    protected $daoEvent;
    protected $daoLocation;
    protected $daoCalendar;
    protected $daoSeatType;


    public function __construct()
    {
        $this->dao= Dao::getInstance();
        $this->daoEvent= DaoEvent::getInstance();
        $this->daoLocation= DaoLocation::getInstance();
        $this->daoCalendar= DaoCalendar::getInstance();
        $this->daoSeatType= DaoSeatType::getInstance();

    }

    public function index()
    {
    }

    public function add ($_calendar)
    {
        $val = null;

        $location = $this->daoLocation->readID($_calendar['0']->getLocation());
        $event = $this->daoEvent->readID($_calendar['0']->getIdEvent());
        $seatsTypes = $this->daoSeatType->readAll();

        require(ROOT.'views/createEventSeat.php');

    }

    public function list ()
    {

    }

    public function store($calendar,$seatType,$totalQuantity,$price,$buttonAction)
    {
        $eventSeat = new EventSeat($seatType,$totalQuantity,$price,$calendar);

        $this->dao->create($eventSeat);

        $_calendar = $this->daoCalendar->readID($calendar);


        if ($buttonAction === "continue")
        {

            $this->add($_calendar);

        }
        else if ($buttonAction === "end")
        {
            $val = "Plaza Creada.";

            $location = $this->daoLocation->readID($_calendar['0']->getLocation());

            $event = $this->daoEvent->readID($_calendar['0']->getIdEvent());

            $_seatsType = $this->daoSeatType->readAll();


            $eventSeats = $this->dao->readAllFromCalendar($_calendar['0']->getId());


            require(ROOT.'views/listEventSeatsForCalendar.php');
        }
    }
}

?>
