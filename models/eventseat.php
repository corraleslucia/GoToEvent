<?php namespace models;

class EventSeat
{
    private $seatType;
    private $calendar;
    private $totalQuantity;
    private $price;
    private $remaningQuantity;

    public function __construct($st,$c,$tq,$p,$rq){
        $this->seatType=$st;
        $this->calendar=$c;
        $this->totalQuantity=$tq;
        $this->price=$p;
        $this->remaningQuantity=$rq;
    }

    public function getSeatType(){
        return $this->seatType;
    }

    public function setSeatType($newSeatType){
        $this->seatType = $newSeatType;
    }

    public function getCalendar(){
        return $this->calendar;
    }

    public function setCalendar($newCalendar){
        $this->calendar = $newCalendar;
    }

    public function getTotalQuantity(){
        return $this->totalQuantity;
    }

    public function setTotalQuantity($newTotalQuantity){
        $this->totalQuantity = $newTotalQuantity;
    }

    public function getPrice(){
        return $this->price;
    }

    public function setPrice($newPrice){
        $this->price = $newPrice;
    }

    public function getRemaningQuantity(){
        return $this->remaningQuantity;
    }

    public function setRemaningQuantity($newRemaningQuantity){
        $this->remaningQuantity = $newRemaningQuantity;
    }
}

?>
