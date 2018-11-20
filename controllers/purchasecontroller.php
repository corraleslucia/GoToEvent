<?php namespace controllers;

use daos\daodb\PurchaseDb as Dao;
use daos\daodb\PurchaseLineDb as DaoPurchaseLine;
use daos\daodb\TicketDb as DaoTicket;

use models\Purchase;
use models\PurchaseLine;
use models\Ticket;

use daos\daodb\calendarDb as DaoCalendar;
use daos\daodb\eventSeatDb as DaoEventSeat;
use daos\daodb\seatTypeDb as DaoSeatType;
use daos\daodb\eventDb as DaoEvent;
use daos\daodb\artistsxCalendarsDb as DaoArtistsXCalendars;

use controllers\EventController as C_Event;

class PurchaseController
{
    private $dao;
    private $daoPurchaseLine;
    private $daoTicket;
    private $daoCalendar;
    private $daoEventSeat;
    private $daoSeatType;
    private $daoEvent;
    private $daoArtistsXCalendars;
    private $eventController;

    public function __construct()
    {
        $this->dao= Dao::getInstance();
        $this->daoPurchaseLine= DaoPurchaseLine::getInstance();
        $this->daoTicket= DaoTicket::getInstance();
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
            echo ('inicie sesion, no saltearas este paso');
            require(ROOT.'views/login.php');
        }

    }

    public function buyTickets()
    {
        if(isset($_SESSION['userLogged']))
        {
            $total = 0;

            $_purchase = New Purchase ($_SESSION['userLogged']->getId());
            $lastPurchase= $this->dao->create($_purchase);

            foreach ($_SESSION['cart'] as $key => $purchaseLine)
            {
                $remaningQuantity = $this->daoEventSeat->checkRemaningQuantity($purchaseLine->getEventSeat()->getId());
                if ($remaningQuantity != 0 && $remaningQuantity >= $purchaseLine->getQuantity() )
                {
                    $newRemaningQuantity = intval($remaningQuantity) - intval($purchaseLine->getQuantity());
                    $this->daoEventSeat->update($purchaseLine->getEventSeat()->getId(), $newRemaningQuantity);

                    $_purchaseLine = New PurchaseLine ($purchaseLine->getEventSeat()->getId(), $purchaseLine->getQuantity(),$purchaseLine->getPrice(), $lastPurchase['0']->getId());
                    $lastPurchaseLine = $this->daoPurchaseLine->create($_purchaseLine);

                    for ($i=0; $i < $purchaseLine->getQuantity() ; $i++)
                    {
                        $_ticket = New Ticket (intval(rand(1000, 9999)), $lastPurchaseLine['0']->getId());
                        $this->daoTicket->create($_ticket);
                    }

                    $total = $total + (intval($purchaseLine->getQuantity()) * intval($purchaseLine->getPrice()));
                    unset($_SESSION['cart'][$key]);
                }
                else
                {
                    $_SESSION['discardTickets'][] = $purchaseLine;
                    unset($_SESSION['cart'][$key]);
                }
                $this->dao->update($lastPurchase['0']->getId(), $total);
            }
            require(ROOT.'views/endShopping.php');

        }
        else
        {
            echo ('inicie sesion, no saltearas este paso');
            require(ROOT.'views/login.php');
        }
    }

    public function listPurchasesByUser ()
    {
        if(isset($_SESSION['userLogged']))
        {
            $purchases = $this->dao->readAllFromUser($_SESSION['userLogged']->getId());

            if ($purchases)
            {
                foreach ($purchases as $key => $purchase)
                {
                    $purchaseLines = $this->daoPurchaseLine->readAllFromPurchase($purchase->getId());

                    foreach ($purchaseLines as $key => $purchaseLine)
                    {
                        $purchaseLine->setEventSeat($this->daoEventSeat->readId($purchaseLine->getEventSeat())['0']);
                        $purchaseLine->getEventSeat()->setIdCalendar($this->daoCalendar->readId($purchaseLine->getEventSeat()->getIdCalendar())['0']);

                        $purchaseLine->setTickets($this->daoTicket->readAllFromPurchaseLine($purchaseLine->getId()));
                    }
                    $purchase->setPurchaseLines($purchaseLines);
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
