<?php namespace controllers;

use daos\daodb\CalendarDb as Dao;
use daos\daodb\ArtistsXCalendarsDb as DaoAC;
use \daos\daodb\LocationDb as DaoLocation;
use \daos\daodb\ArtistDb as DaoArtist;
use \daos\daodb\EventDb as DaoEvent;

use controllers\EventSeatController as C_EventSeat;

use models\Calendar;
use models\ArtistInCalendar;




class CalendarController
{
    private $dao;
    private $daoAC;
    private $daoArtist;
    private $daoLocation;
    private $eventSeatController;
    private $daoEvent;

    public function __construct()
    {
        $this->eventSeatController = new C_EventSeat;
        $this->dao= Dao::getInstance();
        $this->daoAC= DaoAC::getInstance();
        $this->daoLocation= DaoLocation::getInstance();
        $this->daoEvent= DaoEvent::getInstance();
        $this->daoArtist= DaoArtist::getInstance();
    }

    public function index()
    {


    }

    public function add ($event, $val="")
    {
        if(isset($_SESSION['userLogged']))
        {
            $artists = $this->daoArtist->readAll();
            $locations = $this->daoLocation->readAll();
            require(ROOT.'views/createCalendar.php');
        }
        else
        {
            echo ('inicie sesion, no saltearas este paso');
            require(ROOT.'views/login.php');
        }


    }

    public function addMoreCalendars ($id_event, $val="")
    {
        if(isset($_SESSION['userLogged']))
        {
            $event = $this->daoEvent->readId($id_event);
            $this->add ($event['0'], $val);
        }
        else
        {
            echo ('inicie sesion, no saltearas este paso');
            require(ROOT.'views/login.php');
        }
    }

    public function addMoreEventSeats ($id_event)
    {
        if(isset($_SESSION['userLogged']))
        {
            $event = $this->daoEvent->readId($id_event);
            $calendars = $this->dao->readFromEvent($id_event);
            require(ROOT.'views/selectCalendar.php');
        }
        else
        {
            echo ('inicie sesion, no saltearas este paso');
            require(ROOT.'views/login.php');
        }
    }


    public function store($date, $time, $id_event, $id_location, $_artists="")
    {
        if(isset($_SESSION['userLogged']))
        {
            $calendar = new Calendar($date, $time, $id_location, $_artists, $id_event);

            try
            {
                $this->dao->create($calendar);

                $readInfo['date'] = $date;
                $readInfo['time'] = $time;
                $readInfo['id_event'] = $id_event;
                $readInfo['id_location'] = $id_location;

                $_calendar= $this->dao->read($readInfo);

                foreach ($_artists as $key => $value)
                {
                    $_artistInCalendar = new ArtistInCalendar($value, $_calendar['0']->getId());
                    $this->daoAC->create($_artistInCalendar);
                }

                $_location = $this->daoLocation->readId($id_location);

                $this->eventSeatController->add($_calendar, $_location['0']->getCapacity());
            } catch (\PDOException $ex)
            {
                $val = "Ya existe un evento en esa fecha, esa hora y ese lugar.";
                $this->add($this->daoEvent->readId($id_event)['0'],$val);
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
