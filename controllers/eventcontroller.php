<?php namespace controllers;

use daos\daodb\EventDb as Dao;
use daos\daodb\CategoryDb as DaoCategory;
use daos\daodb\EventSeatDb as DaoEventSeat;
use daos\daodb\CalendarDb as DaoCalendar;
use daos\daodb\ArtistsXCalendarsDb as DaoArtistsXCalendars;
use daos\daodb\ArtistDb as DaoArtist;
use daos\daodb\LocationDb as DaoLocation;


use models\Event;

use controllers\CalendarController as C_Calendar;

class EventController
{
    private $dao;
    private $daoCategory;
    private $daoEventSeat;
    private $daoCalendar;
    private $daoArtistsXCalendars;
    private $daoArtist;
    private $daoLocation;

    private $calendarController;


    public function __construct()
    {
        $this->calendarController = new C_Calendar;
        $this->dao= Dao::getInstance();
        $this->daoCategory = DaoCategory::getInstance();
        $this->daoEventSeat = DaoEventSeat::getInstance();
        $this->daoCalendar = DaoCalendar::getInstance();
        $this->daoArtistsXCalendars = DaoArtistsXCalendars::getInstance();
        $this->daoArtist = DaoArtist::getInstance();
        $this->daoLocation = DaoLocation::getInstance();

    }

    public function index()
    {
        if(isset($_SESSION['userLogged']))
        {
            if ($_SESSION['userLogged']->getType()==="1")
            {
                $this->_list();
            }
            else if ($_SESSION['userLogged']->getType()==="2")
            {
                $this->listForUser("byArtist");
            }
        }
        else
        {
            require(ROOT.'views/login.php');
        }

    }


    public function add ($val="")
    {
        if(isset($_SESSION['userLogged']))
        {
            $categories = $this->daoCategory->readAll();
            require(ROOT.'views/createEvent.php');
        }
        else
        {
            echo ('inicie sesion, no saltearas este paso');
            require(ROOT.'views/login.php');
        }
    }

    public function _list ($showType ="")
    {
        if(isset($_SESSION['userLogged']))
        {
            if ($showType === "all")
            {
                $events = $this->dao->readAllAtoZ();
            }
            else if ($showType === "valid")
            {
                $events = $this->dao->readAllValid();
            }
            else if (!$showType)
            {
                $events = $this->dao->readAll();
            }
            require(ROOT.'views/listEvents.php');
        }
        else
        {
            echo ('inicie sesion, no saltearas este paso');
            require(ROOT.'views/login.php');
        }
    }


    public function listForUser($listType="", $val="")
    {
        if(isset($_SESSION['userLogged']))
        {
            if ($listType === "byArtist" || !$listType )
            {
                $artists = $this->daoArtist->readAll();
                if ($artists)
                {
                    $eventsByArtists = array();

                    foreach ($artists as $key => $value)
                    {
                        $eventsByArtists [$value->getName()] = $this->dao->readEventsFromArtist($value->getId());
                    }
                }
            }
            else if ($listType === "byCategory")
            {
                $categories = $this->daoCategory->readAll();
                if ($categories)
                {
                    $eventsByCategory = array();
                    foreach ($categories as $key => $value)
                    {
                        $eventsByCategory [$value->getDescription()] = $this->dao->readEventsFromCategory($value->getId());
                    }
                }

            }
            else if ($listType === "byDate")
            {
                $dates = $this->daoCalendar->readAllMonthYearFromCalendars();
                if ($dates)
                {
                    $eventsByDate = array();
                    foreach ($dates as $key => $value)
                    {
                        $eventsByDate [$value['monthName'].'-'.$value['year']] = $this->dao->readEventsFromDate($value['month'], $value['year']);
                    }
                }


            }
            else if ($listType === "byLocation")
            {
                $locations = $this->daoLocation->readAll();
                if ($locations)
                {
                    $eventsByLocation = array ();
                    foreach ($locations as $key => $value)
                    {
                        $eventsByLocation [$value->getCity()] = $this->dao->readEventsFromLocation($value->getCity());
                    }
                }

            }

            require(ROOT.'views/listEventsByForUsers.php');
        }
        else
        {
            echo ('inicie sesion, no saltearas este paso');
            require(ROOT.'views/login.php');
        }
    }

    public function selectEvent ($type="")
    {
        if(isset($_SESSION['userLogged']))
        {
            $events = $this->dao->readAll();
            if(!$events)
            {
                $events['0'] = new Event ("SIN EVENTOS", 0);
            }
            require(ROOT.'views/selectEvent.php');
        }
        else
        {
            echo ('inicie sesion, no saltearas este paso');
            require(ROOT.'views/login.php');
        }

    }

    public function showEventDetails ($id_event = "")
    {
        if(isset($_SESSION['userLogged']))
        {
            $calendars = null;
            if ($id_event)
            {
                $event = $this->dao->readID($id_event);
                $calendars = $this->daoCalendar->readFromEvent($id_event);
                if ($calendars)
                {
                    foreach ($calendars as $key => $value)
                    {
                        $value->setArtists($this->daoArtistsXCalendars->readAllArtistsFromCalendar($value->getId()));

                        $value->setEventSeats($this->daoEventSeat->readAllFromCalendar($value->getId()));
                    }
                }
            }
            else
            {
                $event['0'] = new Event ("SIN EVENTOS", "-");
            }
            require(ROOT.'views/showEvent.php');
        }
        else
        {
            echo ('inicie sesion, no saltearas este paso');
            require(ROOT.'views/login.php');
        }

    }

    public function showEventDetailsForUser ($id_event="")
    {
        if(isset($_SESSION['userLogged']))
        {
            $event = $this->dao->readID($id_event);
            $calendars = $this->daoCalendar->readFromEvent($id_event);

            if ($calendars)
            {
                foreach ($calendars as $key => $value)
                {
                    $value->setArtists($this->daoArtistsXCalendars->readAllArtistsFromCalendar($value->getId()));

                    $value->setEventSeats($this->daoEventSeat->readAllFromCalendar($value->getId()));
                }

            }

            require(ROOT.'views/pickEventSeatUser.php');
        }
        else
        {
            echo ('inicie sesion, no saltearas este paso');
            require(ROOT.'views/login.php');
        }
    }



    public function store($description="",$category="")
    {
        if(isset($_SESSION['userLogged']))
        {
            $event = new Event($description, $category);

            try
            {
                $this->dao->create($event);

                $_event = $this->dao->read($description);

                $this->calendarController->add($_event['0']);

            } catch (\PDOException $ex)
            {
                $val = "El evento ya existe en la base de datos.";

                $this->add($val);
            }
        }
        else
        {
            echo ('inicie sesion, no saltearas este paso');
            require(ROOT.'views/login.php');
        }
    }

    public function eventSoldQuantity ()
    {
        if(isset($_SESSION['userLogged']))
        {
            $totalsSoldQuantity = array();

            $events = $this->dao->readAll();
            if ($events)
            {
                foreach ($events as $key => $event)
                {
                    $soldQuantity = 0;
                    $event->setCalendar($this->daoCalendar->readFromEvent($event->getId()));
                    if($event->getCalendar())
                    {
                        foreach ($event->getCalendar() as $key => $calendar)
                        {
                            $calendar->setEventSeats($this->daoEventSeat->readAllFromCalendar($calendar->getId()));
                            if ($calendar->getEventSeats())
                            {
                                foreach ($calendar->getEventSeats() as $key => $eventSeat)
                                {
                                    $soldQuantity = $soldQuantity + (intval($eventSeat->getTotalQuantity()) - intval($eventSeat->getRemaningQuantity()));
                                }
                            }
                        }

                    }
                    $totalsSoldQuantity[$event->getId()] = $soldQuantity;
                }
            }


            require(ROOT.'views/eventSoldQuantityReport.php');
        }
        else
        {
            echo ('inicie sesion, no saltearas este paso');
            require(ROOT.'views/login.php');
        }
    }

    public function eventSoldMoney ()
    {
        if(isset($_SESSION['userLogged']))
        {
            $totalsSoldMoney = array();

            $events = $this->dao->readAll();
            if ($events)
            {
                foreach ($events as $key => $event)
                {
                    $soldMoney = 0;
                    $event->setCalendar($this->daoCalendar->readFromEvent($event->getId()));
                    if($event->getCalendar())
                    {
                        foreach ($event->getCalendar() as $key => $calendar)
                        {
                            $calendar->setEventSeats($this->daoEventSeat->readAllFromCalendar($calendar->getId()));
                            if ($calendar->getEventSeats())
                            {
                                foreach ($calendar->getEventSeats() as $key => $eventSeat)
                                {
                                    $soldMoney = $soldMoney + ( (intval($eventSeat->getTotalQuantity()) - intval($eventSeat->getRemaningQuantity())) * intval($eventSeat->getPrice()));
                                }
                            }
                        }

                    }
                    $totalsSoldMoney[$event->getId()] = $soldMoney;
                }
            }

            require(ROOT.'views/eventSoldMoneyReport.php');
        }
        else
        {
            echo ('inicie sesion, no saltearas este paso');
            require(ROOT.'views/login.php');
        }
    }

    public function categorySoldMoney ()
    {
        if(isset($_SESSION['userLogged']))
        {
            $totalsSoldMoney = array();

            $categories = $this->daoCategory->readAll();
            if ($categories)
            {
                foreach ($categories as $key => $category)
                {
                    $soldMoney = 0;
                    $events = $this->dao->readEventsFromCategory($category->getId());
                    if ($events)
                    {
                        foreach ($events as $key => $event)
                        {
                            $event->setCalendar($this->daoCalendar->readFromEvent($event->getId()));
                            if($event->getCalendar())
                            {
                                foreach ($event->getCalendar() as $key => $calendar)
                                {
                                    $calendar->setEventSeats($this->daoEventSeat->readAllFromCalendar($calendar->getId()));
                                    if ($calendar->getEventSeats())
                                    {
                                        foreach ($calendar->getEventSeats() as $key => $eventSeat)
                                        {
                                            $soldMoney = $soldMoney + ( (intval($eventSeat->getTotalQuantity()) - intval($eventSeat->getRemaningQuantity())) * intval($eventSeat->getPrice()));
                                        }
                                    }
                                 }
                             }
                         }
                     }
                     $totalsSoldMoney[$category->getId()] = $soldMoney;
                }

            }



            require(ROOT.'views/categorySoldMoneyReport.php');
        }
        else
        {
            echo ('inicie sesion, no saltearas este paso');
            require(ROOT.'views/login.php');
        }
    }

    public function searchByEvent ($eventName = "")
    {
        $val = "";
        $events = "";

        if ($eventName)
        {
            $events = $this->dao->searchEventsByEvent($eventName);
            if (!$events)
            {
                $val = "No se encontraron eventos con ese nombre.";
            }
        }
        require(ROOT.'views/searchByEvent.php');
    }



}

?>
