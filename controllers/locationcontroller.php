<?php namespace controllers;

use daos\daodb\LocationDb as Dao;
use models\Location;

class LocationController
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
            require(ROOT.'views/createLocation.php');
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
            $locations = $this->dao->readAll();
            if(!$locations)
            {
                $locations['0'] = new Location ("SIN UBICACIONES", "-","-","-", 0);
            }
            require(ROOT.'views/listLocations.php');
        }
        else
        {
            echo ('inicie sesion, no saltearas este paso');
            require(ROOT.'views/login.php');
        }

    }


    public function store($name, $capacity, $adress, $city)
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
            echo ('inicie sesion, no saltearas este paso');
            require(ROOT.'views/login.php');
        }
    }

}

?>
