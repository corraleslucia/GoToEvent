<?php namespace models;

class Purchase
{
    private $id;
    private $id_user;
    private $date;
    private $total;
    private $purchaseLines;

    public function __construct($id_user, $date="", $total="", $id="")
    {
        $this->id=$id;
	    $this->id_user=$id_user;
        $this->date = $date;
        $this->total = $total;
        $this->purchaseLines = array();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getIdUser()
    {
        return $this->id_user;
    }

    public function getDate ()
    {
        return $this->date;
    }

    public function getTotal()
    {
        return $this->total;
    }

    public function getPurchaseLines()
    {
        return $this->purchaseLines;
    }

    public function setPurchaseLines($purchaseLines)
    {
        $this->purchaseLines = $purchaseLines;
    }
}

?>
