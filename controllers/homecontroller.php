<?php namespace controllers;
class HomeController
{

    public function __construct()
    {
    }

    public function index()
    {
        //require(ROOT.'views/home.php');
        require(ROOT.'views/createartist.php');
    }

}
?>
