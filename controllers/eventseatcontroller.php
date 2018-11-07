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


    /**
     *
     */
    public function add ($_calendar, $locationCapacity)
    {
        $val = null;

        $seatsTypes = $this->daoSeatType->readAll();

        $availableCapacity = $this->getAvailableCapacity ($locationCapacity, $_calendar['0']->getId());

        require(ROOT.'views/createEventSeat.php');

    }

    /**
     *
     */
    public function _list ()
    {

    }


    /**
     *
     */
    public function getAvailableCapacity ($totalCapacity, $id_calendar)
    {
        $usedCapacity = $this->dao->usedCapacityFromCalendar ($id_calendar);

        $availableCapacity = $totalCapacity - $usedCapacity;

        return $availableCapacity;

    }


    /**
     *
     */
    public function store($locationCapacity,$calendar,$seatType,$totalQuantity,$price,$buttonAction)
    {
        $eventSeat = new EventSeat($seatType,$totalQuantity,$price,$calendar);

        $this->dao->create($eventSeat);

        $_calendar = $this->daoCalendar->readID($calendar);


        if ($buttonAction === "continue")
        {

            $this->add($_calendar, $locationCapacity );

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
