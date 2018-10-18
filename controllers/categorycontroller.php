<?php namespace controllers;

//use daos\daoList\CategoryDao as Dao;
//use daos\daodb\CategoryDao as Dao;

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
    }
}

?>
