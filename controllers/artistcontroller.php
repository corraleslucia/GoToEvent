<?php namespace controllers;

//use daos\daoList\ArtistDao as Dao;
use daos\daodb\ArtistDb as Dao;
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

    public function add ()
    {
        $val = null;
        require(ROOT.'views/createArtist.php');
    }

    public function _list()
    {
        $artists = $this->dao->readAll();
        require(ROOT.'views/listArtists.php');

    }


    public function store($name)
    {
        $artist = new Artist($name);

        $this->dao->create($artist);

        $val = "Artista Creado";

        require(ROOT.'views/createArtist.php');

    }

}

?>
