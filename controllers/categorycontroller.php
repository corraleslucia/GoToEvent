<?php namespace controllers;

use daos\daodb\CategoryDb as Dao;
use models\Category;

class CategoryController
{
    protected $dao;

    public function __construct()
    {
        $this->dao= Dao::getInstance();
    }

    public function index()
    {

    }

    public function store($description)
    {
        $category = new Category($description);

        $this->dao->create($category);

        var_dump ($this->dao->readAll());

    }

}

?>
