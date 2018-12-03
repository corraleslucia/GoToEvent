<?php namespace controllers;

//use daos\daoList\ArtistDao as Dao;
use daos\daodb\ArtistDb as Dao;
use models\Artist;

use controllers\FileController as C_File;

class ArtistController
{
    private $dao;
    private $fileController;

    public function __construct()
    {
        $this->dao= Dao::getInstance();
        $this->fileController= new C_File;
    }

    public function index()
    {
        if(isset($_SESSION['userLogged']))
        {
            $this->_list();
        }
        else
        {
            echo ('inicie sesion, no saltearas este paso');
            require(ROOT.'views/login.php');
        }



    }

    public function add ($fromEvent="")
    {
        if(isset($_SESSION['userLogged']))
        {
            $val = null;
            require(ROOT.'views/createArtist.php');
        }
        else
        {
            echo ('inicie sesion, no saltearas este paso');
            require(ROOT.'views/login.php');
        }

    }

    public function _list($val = "")
    {

        if(isset($_SESSION['userLogged']))
        {
            $artists = $this->dao->readAll();

            if ($_SESSION['userLogged']->getType() === "1")
            {
                include(ROOT.'views/headerAdmin.php');
                include(ROOT.'views/navAdmin.php');
            }
            else if ($_SESSION['userLogged']->getType() === "2")
            {
                include(ROOT.'views/headerUser.php');
                include(ROOT.'views/navUser.php');
            }
            require(ROOT.'views/listArtists.php');
        }
        else
        {
            echo ('inicie sesion, no saltearas este paso');
            require(ROOT.'views/login.php');
        }

    }


    public function store($fromEvent, $name, $file )
    {
        if(isset($_SESSION['userLogged']))
        {
            $artist = new Artist($name, $file);
            try
            {
                $this->fileController->upload($artist->getAvatar(), 'artist');
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

            } catch (\Exception $e)
            {
                $val = $e->getMessage();
                require(ROOT.'views/createArtist.php');

            }
        }
        else
        {
            echo ('inicie sesion, no saltearas este paso');
            require(ROOT.'views/login.php');
        }
    }


    public function inputUpdateData ($id_artist)
    {
        if(isset($_SESSION['userLogged']))
        {
            $val = null;
            $artist = $this->dao->readId($id_artist)['0'];

            require(ROOT.'views/updateArtist.php');
        }
        else
        {
            echo ('inicie sesion, no saltearas este paso');
            require(ROOT.'views/login.php');
        }
    }

    public function updateArtist ($id_artist, $name, $file)
    {
        if(isset($_SESSION['userLogged']))
        {
            $artist = new Artist($name, $file);
            try
            {
                $this->fileController->upload($artist->getAvatar(), 'artist');
                try
                {
                    $this->dao->update($id_artist, $artist);
                    $val = "Artista Modificado";
                    $this->_list();
                }
                catch (\PDOException $ex)
                {
                    $val = "No se ha podido modificar el artista.";
                    require(ROOT.'views/updateArtist.php');
                }

            } catch (\Exception $e)
            {
                $val = $e->getMessage();
                require(ROOT.'views/updateArtist.php');

            }
        }
        else
        {
            echo ('inicie sesion, no saltearas este paso');
            require(ROOT.'views/login.php');
        }
    }

    public function deleteArtist ($id_artist)
    {
        if(isset($_SESSION['userLogged']))
        {
            try
            {
                $this->dao->delete($id_artist);
                $val = "Artista Eliminado";
                $this->_list($val);
            }
            catch (\PDOException $ex)
            {
                $val = "No se ha podido eliminar el artista. Se encuentra asociado a un Evento.";
                $this->_list($val);
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
