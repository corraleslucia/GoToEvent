<?php namespace controllers;

use daos\daodb\UserDb as Dao;

use controllers\EventController as C_Event;
use controllers\FileController as C_File;

use models\User;

class UserController
{
    private $dao;
    private $eventController;
    private $fileController;

    public function __construct()
    {
        $this->dao= Dao::getInstance();
        $this->eventController = new C_Event;
        $this->fileController= new C_File;

    }

    public function index()
    {
        $val="";
        if(isset($_SESSION['userLogged']))
        {
            if ($_SESSION['userLogged']->getType()==="1")
            {
                $this->_list();
            }
            else if ($_SESSION['userLogged']->getType()==="2")
            {
                $this->eventController->listForUser("byArtist");
            }
        }
        else
        {
            require(ROOT.'views/login.php');
        }

    }

    public function add ($val="")
    {
        if(isset($_SESSION['userLogged']))
        {
            require(ROOT.'views/createUserAdmin.php');
        }
        else
        {
            echo ('inicie sesion, no saltearas este paso');
            require(ROOT.'views/login.php');
        }
    }

    public function register ($val="")
    {
        if(isset($_SESSION['userLogged']))
        {
            if ($_SESSION['userLogged']->getType()==="1")
            {
                $this->eventController->_list();
            }
            else if ($_SESSION['userLogged']->getType()==="2")
            {
                $this->eventController->listForUser("byArtist");
            }
        }
        else
        {
            require(ROOT.'views/createUser.php');
        }
    }

    public function _list ()
    {
        if(isset($_SESSION['userLogged']))
        {
            $users = $this->dao->readAll();
            if(!$users)
            {
                $users['0'] = new User ("SIN USUARIOS", "", "-", "-", "", 0);
            }
            require(ROOT.'views/listUsers.php');
        }
        else
        {
            $val = "Inicie sesión para continuar";
            require(ROOT.'views/login.php');
        }
    }


    public function store($typeFrom, $mail, $pass, $name, $lastname, $type, $file)
    {
            $user = new User($mail, $pass, $name, $lastname, $type, $file);
            try
            {
                $this->fileController->upload($user->getAvatar(), 'avatar');
                try
                {
                    $this->dao->create($user);

                    $val = "Usuario Creado";

                    if ($typeFrom === "1")
                    {
                        $this->_list();
                    }
                    else if ($typeFrom === "2")
                    {
                        require(ROOT.'views/login.php');
                    }


                }
                catch (\PDOException $ex)
                {
                    $val = "Ya existe un usuario registrado con ese email.";
                    if ($type === "1")
                    {
                        require(ROOT.'views/createUserAdmin.php');
                    }
                    else if ($type === "2")
                    {
                        require(ROOT.'views/createUser.php');
                    }
                }

            } catch (\Exception $e)
            {
                $val = $e->getMessage();
                require(ROOT.'views/createUser.php');
            }

    }

    public function login($mail, $pass)
    {
        $user =$this->dao->read($mail);

        if ($user['0'])
        {
            if($user['0']->getPass() === $pass)
            {
                $_SESSION['userLogged'] = $user['0'];
                $_SESSION['cart'] = array();
                $_SESSION['discardTickets'] = array();
                if ($user['0']->getType()==="1")
                {
                    $this->eventController->_list();
                }
                else if ($user['0']->getType()==="2")
                {
                    $this->eventController->listForUser("byArtist");
                }
            } else
            {
                $val = "Los datos ingresados no son correctos.";
                require(ROOT.'views/login.php');
            }
        }
        else{
            $val = "Los datos ingresados no son correctos.";
            require(ROOT.'views/login.php');
        }

    }
    public function logOut()
    {
        session_destroy();
        $val = "Sesion finalizada.";
        require(ROOT.'views/login.php');
    }
}
?>
