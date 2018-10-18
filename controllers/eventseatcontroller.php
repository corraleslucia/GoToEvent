<?php namespace controllers;

//use daos\daoList\EventSeatDao as Dao;
//use daos\daodb\EventSeatDao as DaoEventSeat;
//use daos\daodb\CalendarDao as DaoCalendar;


use models\EventSeat;

class EventSeatController
{
    protected $daoEventSeat;
    protected $daoCalendar;

    public function __construct()
    {
        $this->daoEventSeat= DaoEventSeat::getInstance();
        $this->daoCalendar= DaoCalendar::getInstance();

    }

    public function index()
    {
    }

    public function store($seatType,$calendar,$totalQuantity,$price,$remaningQuantity)
    {
        $eventSeat = new EventSeat($seatType,$calendar,$totalQuantity,$price,$remaningQuantity);

        $this->dao->create($eventSeat);
    }
}

?>
