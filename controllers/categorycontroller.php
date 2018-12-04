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
            $val= "Inicie sesion, no saltearas este paso";
            require(ROOT.'views/login.php');
        }

    }


    public function add ($from="")
    {
        if(isset($_SESSION['userLogged']))
        {
            $val = null;
            require(ROOT.'views/createCategory.php');
        }
        else
        {
            $val= "Inicie sesion, no saltearas este paso";
            require(ROOT.'views/login.php');
        }
    }

    public function _list ($val = "")
    {
        if(isset($_SESSION['userLogged']))
        {
            $categories = $this->dao->readAll();

            require(ROOT.'views/listCategories.php');
        }
        else
        {
            $val= "Inicie sesion, no saltearas este paso";
            require(ROOT.'views/login.php');
        }
    }

    public function store($description, $from="")
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
            $val= "Inicie sesion, no saltearas este paso";
            require(ROOT.'views/login.php');
        }
    }

    public function inputUpdateData ($id_category)
    {
        if(isset($_SESSION['userLogged']))
        {
            $val = null;
            $category = $this->dao->readId($id_category)['0'];

            require(ROOT.'views/updateCategory.php');
        }
        else
        {
            $val= "Inicie sesion, no saltearas este paso";
            require(ROOT.'views/login.php');
        }
    }

    public function updateCategory ($id_category, $description)
    {
        if(isset($_SESSION['userLogged']))
        {
            $category = new Category($description);
            try
            {
                $this->dao->update($id_category, $category);
                $val = "Categoria Modificada";
                $this->_list($val);
            }
            catch (\PDOException $ex)
            {
                $val = "No se ha podido modificar la categoria.";
                require(ROOT.'views/updateCategory.php');
            }

        }
        else
        {
            $val= "Inicie sesion, no saltearas este paso";
            require(ROOT.'views/login.php');
        }
    }

    public function deleteCategory ($id_category)
    {
        if(isset($_SESSION['userLogged']))
        {
            try
            {
                $this->dao->delete($id_category);
                $val = "Categoria Eliminada";
                $this->_list($val);
            }
            catch (\PDOException $ex)
            {
                $val = "No se ha podido eliminar la categoria. Se encuentra asociada a un Evento.";
                $this->_list($val);
            }

        }
        else
        {
            $val= "Inicie sesion, no saltearas este paso";
            require(ROOT.'views/login.php');
        }
    }

}

?>
