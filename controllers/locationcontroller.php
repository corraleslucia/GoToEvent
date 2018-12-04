<?php namespace controllers;

use daos\daodb\LocationDb as Dao;
use models\Location;

class LocationController
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
            $val= "Inicie sesion, no saltearas este paso";;
            require(ROOT.'views/login.php');
        }


    }

    public function add ($fromEvent="")
    {
        if(isset($_SESSION['userLogged']))
        {
            $val = null;
            require(ROOT.'views/createLocation.php');
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
            $locations = $this->dao->readAll();

            require(ROOT.'views/listLocations.php');
        }
        else
        {
            $val= "Inicie sesion, no saltearas este paso";
            require(ROOT.'views/login.php');
        }

    }


    public function store($fromEvent, $name, $capacity, $adress, $city)
    {
        if(isset($_SESSION['userLogged']))
        {
            $location = new Location($name, $capacity, $adress, $city);
            try
            {
                $this->dao->create($location);

                $val = "Lugar Creado";

                require(ROOT.'views/createLocation.php');
            }
            catch (\PDOException $ex)
            {
                $val = "Esa ubicacion ya existe en la base de datos.";

                require(ROOT.'views/createLocation.php');
            }
        }
        else
        {
            $val= "Inicie sesion, no saltearas este paso";
            require(ROOT.'views/login.php');
        }
    }

    public function inputUpdateData ($id_location)
    {
        if(isset($_SESSION['userLogged']))
        {
            $val = null;
            $location = $this->dao->readId($id_location)['0'];

            require(ROOT.'views/updateLocation.php');
        }
        else
        {
            $val= "Inicie sesion, no saltearas este paso";
            require(ROOT.'views/login.php');
        }
    }

    public function updateLocation ($id_location, $name, $capacity, $adress, $city)
    {
        if(isset($_SESSION['userLogged']))
        {
            $location = new Location($name, $capacity, $adress, $city);
            try
            {
                $this->dao->update($id_location, $location);
                $val = "Lugar Modificado";
                $this->_list($val);
            }
            catch (\PDOException $ex)
            {
                $val = "No se ha podido modificar el lugar.";
                require(ROOT.'views/updateLocation.php');
            }

        }
        else
        {
            $val= "Inicie sesion, no saltearas este paso";
            require(ROOT.'views/login.php');
        }
    }

    public function deleteLocation ($id_location)
    {
        if(isset($_SESSION['userLogged']))
        {
            try
            {
                $this->dao->delete($id_location);
                $val = "Lugar Eliminado";
                $this->_list($val);
            }
            catch (\PDOException $ex)
            {
                $val = "No se ha podido eliminar el lugar. Se encuentra asociado a un Evento.";
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
