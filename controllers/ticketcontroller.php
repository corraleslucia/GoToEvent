<?php namespace controllers;



use daos\daodb\TicketDb as Dao;
use daos\daodb\PurchaseLineDb as DaoPurchaseLine;
use daos\daodb\eventSeatDb as DaoEventSeat;
use daos\daodb\CalendarDb as DaoCalendar;

use models\Ticket;


class TicketController
{
    private $dao;
    private $daoPurchaseLine;
    private $daoEventSeat;
    private $daoCalendar;

    public function __construct()
    {
        $this->dao= Dao::getInstance();
        $this->daoPurchaseLine = DaoPurchaseLine::getInstance();
        $this->daoCalendar = DaoCalendar::getInstance();
        $this->daoEventSeat = DaoEventSeat::getInstance();
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

    public function showTicketsByPurchaseLine($id_purchaseLine)
    {
        if(isset($_SESSION['userLogged']))
        {
            $tickets = $this->dao->readAllFromPurchaseLine($id_purchaseLine);
            $purchaseLine = $this->daoPurchaseLine->read($id_purchaseLine)['0'];
            $purchaseLine->setEventSeat($this->daoEventSeat->readId($purchaseLine->getEventSeat())['0']);
            $purchaseLine->getEventSeat()->setIdCalendar($this->daoCalendar->readId($purchaseLine->getEventSeat()->getIdCalendar())['0']);

            require(ROOT.'views/showTickets.php');
        }
        else
        {
            $val= "Inicie sesion, no saltearas este paso";
            require(ROOT.'views/login.php');
        }

    }





}

?>
