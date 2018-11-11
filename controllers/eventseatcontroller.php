<?php namespace controllers;

use daos\daodb\EventSeatDb as Dao;
use daos\daodb\CalendarDb as DaoCalendar;
use daos\daodb\SeatTypeDb as DaoSeatType;
use daos\daodb\LocationDb as DaoLocation;

use models\EventSeat;



class EventSeatController
{
    protected $dao;
    protected $daoCalendar;
    protected $daoSeatType;
    protected $daoLocation;



    public function __construct()
    {
        $this->dao= Dao::getInstance();
        $this->daoCalendar= DaoCalendar::getInstance();
        $this->daoSeatType= DaoSeatType::getInstance();
        $this->daoLocation= DaoLocation::getInstance();

    }

    public function index()
    {
    }


    /**
     *
     */
    public function add ($_calendar, $locationCapacity, $val="")
    {

        $seatsTypes = $this->daoSeatType->readAll();

        $availableCapacity = $this->getAvailableCapacity ($locationCapacity, $_calendar['0']->getId());

        require(ROOT.'views/createEventSeat.php');

    }

    public function addMoreEventSeats ($id_calendar)
    {
        $calendar = $this->daoCalendar->readId($id_calendar);

        $location = $this->daoLocation->read($calendar['0']->getLocation());

        $this->add ($calendar, $location->getCapacity());
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

        $_calendar = $this->daoCalendar->readID($calendar);

        try
        {
            $this->dao->create($eventSeat);



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

        } catch (\PDOException $ex)
        {
            $val = "Ya existe esa plaza para esa fecha.";

            $this->add($_calendar, $locationCapacity, $val );

        }

    }
}

?>
