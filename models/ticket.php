<?php namespace models;

class Ticket
{
    private $id;
    private $id_user;
    private $id_calendar;
    private $seatType;
    private $quantity;
    private $price;
    private $total;

    public function __construct($id_user, $id_cal, $st, $q, $p, $t="", $id="")
    {
        $this->id=$id;
	    $this->id_user=$id_user;
        $this->id_calendar=$id_cal;
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
    public function getSeatType()
    {
        return $this->seatType;
    }

<<<<<<< HEAD
    public function getQuantity(){
=======
    public function getQuantity()
    {
>>>>>>> f684931bafa6e65711090be51e00dd5ec547ad5d
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
