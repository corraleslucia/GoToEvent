<?php namespace controllers;

//use daos\daoList\LocationDao as Dao;
//use daos\daodb\LocationDao as Dao;

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

    public function store($name,$adress,$city)
    {
        $location = new Location($name,$adress,$city);

        $this->dao->create($location);
    }
}

?>
