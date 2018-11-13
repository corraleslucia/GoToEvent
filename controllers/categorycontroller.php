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
        if(!$categories)
        {
            $categories['0'] = new Category ("SIN CATEGORIAS", 0);
        }
        require(ROOT.'views/listCategories.php');

    }

    public function store($description)
    {
        $category = new Category($description);

        try
        {
            $this->dao->create($category);

            $val = "Categoria Creada";

            require(ROOT.'views/createCategory.php');

        }
        catch (\PDOException $ex)
        {
            $val = "La categoria ya existe en la base de datos";

            require(ROOT.'views/createCategory.php');
        }


    }

}

?>
