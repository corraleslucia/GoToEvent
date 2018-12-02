<?php namespace controllers;


use daos\daodb\SeatTypeDb as Dao;
use models\SeatType;

class SeatTypeController
{
    private $dao;

    public function __construct()
    {
        $this->dao= Dao::getInstance();
    }

    public function index()
    {
        if(isset($_SESSION['userLogged']))
        {
            if ($_SESSION['userLogged']->getType()==="1")
            {
                $this->_list();
            }
            else if ($_SESSION['userLogged']->getType()==="2")
            {
                require(ROOT.'views/login.php');
            }
        }
        else
        {
            echo ('inicie sesion, no saltearas este paso');
            require(ROOT.'views/login.php');
        }

    }

    public function add ($fromEventSeat="")
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

            require(ROOT.'views/listSeatTypes.php');
        }
        else
        {
            echo ('inicie sesion, no saltearas este paso');
            require(ROOT.'views/login.php');
        }

    }


    public function store($fromEventSeat, $name)
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
