<?php namespace models;

class EventSeat
{
    private $id;
    private $seatType;
    private $totalQuantity;
    private $price;
    private $remaningQuantity;

    public function __construct($st, $tq, $p, $rq){
        $this->seatType=$st;
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


    public function getId(){
        return $this->id;
    }

    public function setId($newId){
        $this->id = $newId;
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
