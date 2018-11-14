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
        if(isset($_SESSION['userLogged']))
        {
            $val = null;
            require(ROOT.'views/createSeatType.php');
        }
        else
        {
            echo ('inicie sesion, no saltearas este paso');
            require(ROOT.'views/login.php');
        }
    }

    public function _list ()
    {
        if(isset($_SESSION['userLogged']))
        {
            $seatTypes = $this->dao->readAll();
            if(!$seatTypes)
            {
                $seatTypes['0'] = new SeatType ("SIN TIPOS DE PLAZAS", 0);
            }
            require(ROOT.'views/listSeatTypes.php');
        }
        else
        {
            echo ('inicie sesion, no saltearas este paso');
            require(ROOT.'views/login.php');
        }

    }


    public function store($name)
    {
        if(isset($_SESSION['userLogged']))
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
        else
        {
            echo ('inicie sesion, no saltearas este paso');
            require(ROOT.'views/login.php');
        }
    }

}

?>
