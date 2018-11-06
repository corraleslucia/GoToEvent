<?php namespace controllers;

use daos\daodb\EventSeatDb as Dao;
use daos\daodb\CalendarDb as DaoCalendar;
use daos\daodb\SeatTypeDb as DaoSeatType;

use models\EventSeat;



class EventSeatController
{
    protected $dao;
    protected $daoCalendar;
    protected $daoSeatType;


    public function __construct()
    {
        $this->dao= Dao::getInstance();
        $this->daoCalendar= DaoCalendar::getInstance();
        $this->daoSeatType= DaoSeatType::getInstance();

    }

    public function index()
    {
    }

    public function add ($_calendar)
    {
        $val = null;

        $seatsTypes = $this->daoSeatType->readAll();

        require(ROOT.'views/createEventSeat.php');

    }

    public function _list ()
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

            $eventSeats = $this->dao->readAllFromCalendar($_calendar['0']->getId());


            require(ROOT.'views/listEventSeatsForCalendar.php');
        }
    }
}

?>
