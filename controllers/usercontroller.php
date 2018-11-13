<?php namespace controllers;

use daos\daodb\UserDb as Dao;

use controllers\EventController as C_Event;

use models\User;

class UserController
{
    protected $dao;
    protected $eventController;

    public function __construct()
    {
        $this->dao= Dao::getInstance();
        $this->eventController = new C_Event;

    }

    public function index()
    {

    }

    public function add ($val="")
    {
        require(ROOT.'views/createUserAdmin.php');
    }

    public function register ($val="")
    {
        require(ROOT.'views/createUser.php');
    }

    public function _list ()
    {
        $users = $this->dao->readAll();
        if(!$users)
        {
            $users['0'] = new User ("SIN USUARIOS", "", "-", "-", "", 0);
        }
        require(ROOT.'views/listUsers.php');

    }


    public function store($mail, $pass, $name, $lastname, $type)
    {
        $user = new User($mail, $pass, $name, $lastname, $type);

        try
        {
            $this->dao->create($user);

            $val = "Usuario Creado";

            require(ROOT.'views/login.php');
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

    }

    public function login($mail, $pass){

        $user =$this->dao->read($mail);

        if ($user['0'])
        {
            if($user[0]->getPass() === $pass)
            {
                $_SESSION['userLogged'] = $user['0'];
                if ($user['0']->getType()==="1")
                {
                    $this->eventController->_list();
                }
                else if ($user['0']->getType()==="2")
                {
                    $this->eventController->listForUser();
                }
            } else
            {
                echo 'Los datos ingresados no son correctos.';
                require(ROOT.'views/login.php');
            }
        }
        else{
            echo 'Los datos ingresados no son correctos.';
            require(ROOT.'views/login.php');
        }

    }


    public function logOut(){
        unset($_SESSION['userLogged']);
        require(ROOT.'views/login.php');
    }
}
?>
