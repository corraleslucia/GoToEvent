<?php namespace controllers;

//use daos\daoList\EventDao as Dao;
//use daos\daodb\EventDao as DaoEvent;
//use daos\daodb\CategoryDao as DaoCategory;

use models\Event;

class EventController
{
    protected $daoEvent;
    protected $daoCategory;

    public function __construct()
    {
        $this->daoEvent= DaoEvent::getInstance();
        $this->daoCategory= DaoCategory::getInstance();
    }

    public function index()
    {
    }

    public function store($description,$category)
    {
        $event = new Event($description, $category);

        $this->dao->create($event);
    }
}

?>
