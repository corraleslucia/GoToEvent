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


    public function add ()
    {
        $val = null;
        require(ROOT.'views/createCategory.php');
    }

    public function _list ()
    {
        $categories = $this->dao->readAll();
        require(ROOT.'views/listCategories.php');

    }

    public function store($description)
    {
        $category = new Category($description);

        $this->dao->create($category);

        $val = "Categoria Creada";

        require(ROOT.'views/createCategory.php');

    }

}

?>
