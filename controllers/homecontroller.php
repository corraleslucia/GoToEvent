<?php namespace controllers;

use controllers\EventController as C_Event;

class HomeController
{
    protected $eventController;

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
                require(ROOT.'views/listEvents.php');
            }
            else if ($_SESSION['userLogged']->getType()==="2")
            {
                $this->eventController->listForUser();
            }
        }
        else
        {
            require(ROOT.'views/login.php');
        }

    }

}
?>
