<?php namespace models;

class PurchaseLine
{
    private $id;
    private $id_eventSeat;
    private $quantity;
    private $price;
    private $id_purchase;
    private $tickets;

    public function __construct($id_evS, $q, $p, $id_p="", $id="")
    {
        $this->id=$id;
        $this->id_eventSeat=$id_evS;
        $this->quantity=$q;
        $this->price = $p;
        $this->id_purchase = $id_p;
        $this->tickets = array();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getEventSeat()
    {
        return $this->id_eventSeat;
    }

    public function setEventSeat ($eventSeat)
    {
        $this->id_eventSeat = $eventSeat;
    }

    public function getQuantity()
    {
        return $this->quantity;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function getIdPurchase()
    {
        return $this->id_purchase;
    }

    public function getTickets ()
    {
        return $this->tickets;
    }
    
    public function setTickets($tickets)
    {
        $this->tickets = $tickets;
    }

}

?>
