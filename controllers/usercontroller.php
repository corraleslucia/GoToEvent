<?php namespace controllers;

use daos\daodb\UserDb as Dao;
use models\User;

class UserController
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
        require(ROOT.'views/createUserAdmin.php');
    }

    public function register ()
    {
        $val = null;
        require(ROOT.'views/createUser.php');
    }

    public function _list ()
    {
        $users = $this->dao->readAll();
        require(ROOT.'views/listUsers.php');

    }


    public function store($mail, $pass, $name, $lastname)
    {
        $user = new User($mail, $pass, $name, $lastname);

        $this->dao->create($user);

        $val = "Usuario Creado";

        require(ROOT.'views/createUser.php');

    }

    public function login($mail, $pass){
        $user =$this->dao->read($mail);
        
        if ($user){
            if($user[0]->getPass() === $pass){
                $_SESSION['userLogged'] = $user[0];
                require(ROOT.'views/homeUser.php');
            } else{      
                echo 'Los datos ingresados no son correctos.';
                require(ROOT.'views/login.php');
            }          
        }
        else{      
            echo 'Los datos ingresados no son correctos.';
            require(ROOT.'views/login.php');
        } 
       
    }
}



?>
