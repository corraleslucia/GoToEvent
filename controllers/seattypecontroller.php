<?php namespace controllers;


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

        try
        {
            $this->dao->create($seatType);

            $val = "Tipo de plaza Creada.";

            require(ROOT.'views/createSeatType.php');
        }
        catch (\PDOException $ex)
        {
            $val = "Ya existe un tipo de plaza con ese nombre.";
            require(ROOT.'views/createSeatType.php');
        }


    }

}

?>
