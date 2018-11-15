<?php namespace controllers;

use daos\daodb\CategoryDb as Dao;
use models\Category;

class CategoryController
{
    private $dao;

    public function __construct()
    {
        $this->dao= Dao::getInstance();
    }

    public function index()
    {
        if(isset($_SESSION['userLogged']))
        {
            if ($_SESSION['userLogged']->getType()==="1")
            {
                $this->_list();
            }
            else if ($_SESSION['userLogged']->getType()==="2")
            {
                require(ROOT.'views/login.php');
            }
        }
        else
        {
            echo ('inicie sesion, no saltearas este paso');
            require(ROOT.'views/login.php');
        }

    }


    public function add ()
    {
        if(isset($_SESSION['userLogged']))
        {
            $val = null;
            require(ROOT.'views/createCategory.php');
        }
        else
        {
            echo ('inicie sesion, no saltearas este paso');
            require(ROOT.'views/login.php');
        }
    }

    public function _list ()
    {
        if(isset($_SESSION['userLogged']))
        {
            $categories = $this->dao->readAll();
            if(!$categories)
            {
                $categories['0'] = new Category ("SIN CATEGORIAS", 0);
            }
            require(ROOT.'views/listCategories.php');
        }
        else
        {
            echo ('inicie sesion, no saltearas este paso');
            require(ROOT.'views/login.php');
        }
    }

    public function store($description)
    {
        if(isset($_SESSION['userLogged']))
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
        else
        {
            echo ('inicie sesion, no saltearas este paso');
            require(ROOT.'views/login.php');
        }
    }

}

?>
