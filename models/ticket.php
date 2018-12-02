<?php namespace models;

class Ticket
{
    private $id;
    private $number;
    private $qr;
    private $id_purchase_line;


    public function __construct($n, $id_pl, $qr="", $id="")
    {
        $this->id=$id;
	    $this->number=$n;
        $this->qr=$qr;
        $this->id_purchase_line=$id_pl;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getNumber()
    {
        return $this->number;
    }

    public function getQr()
    {
        return $this->qr;
    }

    public function setQr($newQr)
    {
        $this->qr = $newQr;
    }

    public function getIdPurchaseLine()
    {
        return $this->id_purchase_line;
    }


}

?>
