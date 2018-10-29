<?php namespace controllers;

use daos\daodb\EventDb as Dao;

use models\Event;

class EventController
{
    protected $dao;
    protected $daoCategory;


    public function __construct()
    {
        $this->dao= Dao::getInstance();
    }

    public function index()
    {

    }

    public function store($description,$category)
    {
        $event = new Event($description, $category);

        $this->dao->create($event);

        var_dump ($this->dao->readAll());
    }
}

?>
