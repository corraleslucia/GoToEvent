<?php namespace controllers;

//use daos\daoList\ArtistDao as Dao;
use daos\daodb\SeatTypeDb as Dao;
use models\SeatType;

class SeatTypeController
{
    protected $dao;

    public function __construct()
    {
        $this->dao= Dao::getInstance();
    }

    public function index()
    {

    }

    public function add ()
    {
        $val = null;
        require(ROOT.'views/createSeatType.php');
    }

    public function _list ()
    {
        $seatTypes = $this->dao->readAll();
        require(ROOT.'views/listSeatTypes.php');

    }


    public function store($name)
    {
        $seatType = new SeatType($name);

        $this->dao->create($seatType);

        $val = "Tipo de plaza Creada.";

        require(ROOT.'views/createSeatType.php');

    }

}

?>
