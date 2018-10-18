<?php namespace controllers;

use daos\daoList\ArtistDao as Dao;
//use daos\daodb\ArtistDao as Dao;
use models\Artist;

class ArtistController
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
        $artist = new Artist($name);

        $this->dao->create($artist);

    }
}

?>
