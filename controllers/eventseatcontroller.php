<?php namespace controllers;

use daos\daodb\EventSeatDb as Dao;
use models\EventSeat;


class EventSeatController
{
    protected $dao;


    public function __construct()
    {
        $this->dao= Dao::getInstance();

    }

    public function index()
    {
    }

    public function store($calendar,$seatType,$totalQuantity,$price)
    {
        $eventSeat = new EventSeat($seatType,$totalQuantity,$price,$calendar);

        $this->dao->create($eventSeat);

        var_dump ($this->dao->readAll());
    }
}

?>
