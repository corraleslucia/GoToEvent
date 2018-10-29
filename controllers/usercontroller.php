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

    public function store($mail, $pass, $name, $lastname)
    {
            $user = new User($mail, $pass, $name, $lastname);

        $this->dao->create($user);

        var_dump ($this->dao->readAll());

    }

}

?>
