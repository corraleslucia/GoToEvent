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

    public function store($name)
    {
        $seatType = new SeatType($name);

        $this->dao->create($seatType);

        var_dump ($this->dao->readAll());

    }

}

?>
