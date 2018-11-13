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
        if(isset($_SESSION['userLogged'])){
            $artists = $this->dao->readAll();
            require(ROOT.'views/listArtists.php');
        }
        else{
            echo ('inicie sesion, no saltearas este paso');
            require(ROOT.'views/login.php');
        }
        

    }


    public function store($name)
    {
        $artist = new Artist($name);

        try
        {
            $this->dao->create($artist);
            $val = "Artista Creado";
            require(ROOT.'views/createArtist.php');
        }
        catch (\PDOException $ex)
        {
            $val = "El artista ya existe en la base de datos.";
            require(ROOT.'views/createArtist.php');
        }

    }

}

?>
