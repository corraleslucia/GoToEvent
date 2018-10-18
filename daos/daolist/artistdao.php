<?php namespace daos\daolist;
use daos\IDao as IDao;


/**
 *
 */
class ArtistDao extends singleton implements IDao
{
    private $list;

    function __construct()
    {
        $this->list = array ();
    }

    public function getSessionArtist()
    {

        if (!isset($_SESSION['ArtistList'])) {
            $_SESSION['ArtistList'] = array();
        }
        return $_SESSION['ArtistList'];
    }

    public function setSessionArtist($value)
    {
        $_SESSION['ArtistList'] = $value;
    }


    public function create($artist)
    {
        $this->list=$this->getSessionArtist();
        array_push($this->list, $artist);
        $this->setSessionArtist($this->list);
        print_r($this->list);
    }


    public function readAll ()
    {
        $this->list=$this->getSessionArtist();
        return $this->list;

    }

    public function read ($artistName)
    {
        $this->list=$this->getSessionArtist();
        foreach ($this->list as $key => $value)
        {
            if ($value->getName() == $artistName)
            {
                return $value;
            }
        }
    }

    public function update ($artistName, $newArtistName)
    {
        $this->list=$this->getSessionArtist();
        foreach ($this->list as $key => $value)
        {
            if ($value->getName() == $artistName)
            {
                $value->setName($newArtistName);
                $this->setSessionArtist($this->list);
                return $value;
            }
        }
        return false;
    }

    public function delete ($artistName)
    {
        $this->list=$this->getSessionArtist();
        foreach ($this->list as $key => $value)
        {
            if ($value->getName() == $artistName)
            {
                unset($this->list[$key]);
                $this->setSessionArtist($this->list);
                return $true;
            }
        }
        return false;
    }


    /*public function read ($artist)
    {
        if (isset ($_SESSION['artist']))
        {
          $artistArray = $_SESSION['artist'];

            foreach ($artistArray as $key => $value)
            {
                if ($value->getName() == $v)
                {
                    return $value;
                }
            }
         }
    }*/

    /*public function readAll ()
    {
        if (isset ($_SESSION['artist']))
        {
          $artistArray = $_SESSION['artist'];

          return $artistArray;
        }

        return false;
    }*/


    /*public function update ($v,$newV)
    {
        if (isset ($_SESSION['artist']))
        {
          $artistArray = $_SESSION['artist'];

            foreach ($artistArray as $key => $value)
            {
                if ($value->getName() == $v)
                {
                    $value->setName($newV);
                }
            }
         }
    }*/


    /*public function delete ($v)
    {
        if (isset($_SESSION['artist']))
        {
          $artistArray = $_SESSION['artist'];

          foreach ($artistArray as $key => $value)
           {
              if ($value->getName() == $v)
              {
                unset ($artistArray[$key]);
              }
           }
        }
    }*/


}


 ?>
