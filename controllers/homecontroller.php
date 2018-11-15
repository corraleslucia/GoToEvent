<?php namespace controllers;

use controllers\EventController as C_Event;

class HomeController
{
    private $eventController;

    public function __construct()
    {
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
                $this->eventController->listForUser("byArtist");
            }
        }
        else
        {
            require(ROOT.'views/login.php');
        }

    }

    public function inProgress ()
    {
        if(isset($_SESSION['userLogged']))
        {
            if ($_SESSION['userLogged']->getType() === "1")
            {
                include(ROOT.'views/headerAdmin.php');
                include(ROOT.'views/navAdmin.php');
            }
            else if ($_SESSION['userLogged']->getType() === "2")
            {
                include(ROOT.'views/headerUser.php');
                include(ROOT.'views/navUser.php');
            }
            require(ROOT.'views/workInProgress.php');
        }
        else
        {
            echo ('inicie sesion, no saltearas este paso');
            require(ROOT.'views/login.php');
        }
    }

}
?>
