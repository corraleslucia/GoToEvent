<?php namespace models;

class Ticket
{   
    private $id;
    private $id_user;
    private $id_calendar;
    private $quantity;
    private $total;

    public function __construct($id="", $id_user, $id_cal, $q, $t){
        $this->id=$id;
	$this->id_user=$id_user;
        $this->id_calendar=$id_cal;
        $this->quantity=$q;
        $this->total=$t;
    }

    public function getId(){
        return $this->id;
    }
    public function getIdUser(){
        return $this->id_user;
    }
    public function getCalendar(){
        return $this->id_calendar;
    }

    public function getQuantity(){
        return $this->quantity;
    }
    public function getTotal(){
        return $this->total;
        
    }
}

?>
