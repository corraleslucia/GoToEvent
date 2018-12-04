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
            $val= "Inicie sesion, no saltearas este paso";
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
            $val= "Inicie sesion, no saltearas este paso";
            require(ROOT.'views/login.php');
        }
    }

    public function _list ($val = "")
    {
        if(isset($_SESSION['userLogged']))
        {
            $seatTypes = $this->dao->readAll();

            require(ROOT.'views/listSeatTypes.php');
        }
        else
        {
            $val= "Inicie sesion, no saltearas este paso";
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
            $val= "Inicie sesion, no saltearas este paso";
            require(ROOT.'views/login.php');
        }
    }

    public function inputUpdateData ($id_seatType)
    {
        if(isset($_SESSION['userLogged']))
        {
            $val = null;
            $seatType = $this->dao->readId($id_seatType)['0'];

            require(ROOT.'views/updateSeatType.php');
        }
        else
        {
            $val= "Inicie sesion, no saltearas este paso";
            require(ROOT.'views/login.php');
        }
    }

    public function updateSeatType ($id_seatType, $name)
    {
        if(isset($_SESSION['userLogged']))
        {
            $seatType = new SeatType($name);
            try
            {
                $this->dao->update($id_seatType, $seatType);
                $val = "Tipo de Plaza Modificada";
                $this->_list($val);
            }
            catch (\PDOException $ex)
            {
                $val = "No se ha podido modificar el tipo de plaza.";
                require(ROOT.'views/updateSeatType.php');
            }

        }
        else
        {
            $val= "Inicie sesion, no saltearas este paso";
            require(ROOT.'views/login.php');
        }
    }

    public function deleteSeatType ($id_seatType)
    {
        if(isset($_SESSION['userLogged']))
        {
            try
            {
                $this->dao->delete($id_seatType);
                $val = "Tipo de plaza Eliminada";
                $this->_list($val);
            }
            catch (\PDOException $ex)
            {
                $val = "No se ha podido eliminar el tipo de plaza. Se encuentra asociado a un Evento.";
                $this->_list($val);
            }

        }
        else
        {
            $val= "Inicie sesion, no saltearas este paso";
            require(ROOT.'views/login.php');
        }
    }

}

?>
