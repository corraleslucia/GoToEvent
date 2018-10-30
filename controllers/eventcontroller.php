<?php namespace controllers;

use daos\daodb\EventDb as Dao;
use \daos\daodb\CategoryDb as DaoCategory;

use models\Event;
use controllers\CalendarController as C_Calendar;

class EventController
{
    protected $dao;
    protected $daoCategory;
    protected $calendarController;


    public function __construct()
    {
        $this->calendarController = new C_Calendar;
        $this->dao= Dao::getInstance();
        $this->daoCategory = DaoCategory::getInstance();

    }

    public function index()
    {

    }
    public function add ()
    {
        $val = null;

        $categories = $this->daoCategory->readAll();
        require(ROOT.'views/createEvent.php');
    }

    public function list ()
    {
        $events = $this->dao->readAll();
        require(ROOT.'views/listEvents.php');

    }



    public function store($description,$category)
    {
        $event = new Event($description, $category);

        $this->dao->create($event);
        $_event = $this->dao->read($description);

        $this->calendarController->add($_event);



    }
}

?>
