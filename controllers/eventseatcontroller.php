<?php namespace controllers;

use daos\daodb\EventSeatDb as Dao;
use daos\daodb\CalendarDb as DaoCalendar;
use daos\daodb\SeatTypeDb as DaoSeatType;
use daos\daodb\LocationDb as DaoLocation;

use models\EventSeat;



class EventSeatController
{
    private $dao;
    private $daoCalendar;
    private $daoSeatType;
    private $daoLocation;



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
        if(isset($_SESSION['userLogged']))
        {
            $seatsTypes = $this->daoSeatType->readAll();

            $availableCapacity = $this->getAvailableCapacity ($locationCapacity, $_calendar['0']->getId());

            require(ROOT.'views/createEventSeat.php');
        }
        else
        {
            echo ('inicie sesion, no saltearas este paso');
            require(ROOT.'views/login.php');
        }

    }

    public function addMoreEventSeats ($id_calendar)
    {
        if(isset($_SESSION['userLogged']))
        {
            $calendar = $this->daoCalendar->readId($id_calendar);

            $location = $this->daoLocation->read($calendar['0']->getLocation());

            $this->add ($calendar, $location['0']->getCapacity());
        }
        else
        {
            echo ('inicie sesion, no saltearas este paso');
            require(ROOT.'views/login.php');
        }
    }



    /**
     *
     */
    public function getAvailableCapacity ($totalCapacity, $id_calendar)
    {
        if(isset($_SESSION['userLogged']))
        {
            $usedCapacity = $this->dao->usedCapacityFromCalendar ($id_calendar);

            $availableCapacity = $totalCapacity - $usedCapacity;

            return $availableCapacity;
        }
        else
        {
            echo ('inicie sesion, no saltearas este paso');
            require(ROOT.'views/login.php');
        }

    }


    /**
     *
     */
    public function store($locationCapacity,$calendar,$seatType,$totalQuantity,$price,$buttonAction)
    {
        if(isset($_SESSION['userLogged']))
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
        else
        {
            echo ('inicie sesion, no saltearas este paso');
            require(ROOT.'views/login.php');
        }
    }
}

?>
