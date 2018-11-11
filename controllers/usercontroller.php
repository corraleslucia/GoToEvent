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


    public function store($mail, $pass, $name, $lastname, $type)
    {
        $user = new User($mail, $pass, $name, $lastname, $type);

        try
        {
            $this->dao->create($user);

            $val = "Usuario Creado";

            require(ROOT.'views/createUserAdmin.php');
        }
        catch (\PDOException $ex)
        {
            $val = "Ya existe un usuario registrado con ese email.";
            require(ROOT.'views/createUserAdmin.php');

        }

    }

}

?>
