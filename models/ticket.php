<?php namespace models;

class Ticket
{
    private $id;
    private $id_user;
    private $id_calendar;
    private $id_eventSeat;
    private $seatType;
    private $quantity;
    private $price;
    private $total;

    public function __construct($id_user, $id_cal, $id_evS, $st, $q, $p, $t="", $id="")
    {
        $this->id=$id;
	    $this->id_user=$id_user;
        $this->id_calendar=$id_cal;
        $this->id_eventSeat=$id_evS;
        $this->seatType = $st;
        $this->quantity=$q;
        $this->price = $p;
        $this->total= $t;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getIdUser()
    {
        return $this->id_user;
    }

    public function getCalendar()
    {
        return $this->id_calendar;
    }

    public function setCalendar($calendar)
    {
        $this->id_calendar = $calendar;
    }

    public function getEventSeat()
    {
        return $this->id_eventSeat;
    }

    public function setEventSeat ($eventSeat)
    {
        $this->id_eventSeat = $eventSeat;
    }

    public function getSeatType()
    {
        return $this->seatType;
    }

    public function setSeatType ($seatType)
    {
        $this->seatType = $seatType;
    }

    public function getQuantity()
    {
        return $this->quantity;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function getTotal()
    {
        return $this->total;
    }
}

?>
