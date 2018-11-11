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
        $val = null;
        require(ROOT.'views/createLocation.php');
    }

    public function _list ()
    {
        $locations = $this->dao->readAll();
        require(ROOT.'views/listLocations.php');

    }


    public function store($name, $capacity, $adress, $city)
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

}

?>
