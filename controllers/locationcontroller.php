<?php namespace controllers;

//use daos\daoList\ArtistDao as Dao;
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


    public function store($name, $adress, $city)
    {
        $location = new Location($name, $adress, $city);

        $this->dao->create($location);

        $val = "Lugar Creado";

        require(ROOT.'views/createLocation.php');


    }

}

?>
