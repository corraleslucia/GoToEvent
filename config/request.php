<?php namespace config;

class Request
{
    /*atributos para almacenar todos los valores que vengan por url*/
    private $controller;
    private $method;
    private $parameters;

    public function __construct()
    {
        /*  En el archivo htaccess se define una regla de reescritura para poder tomar la url tanto para todo metodo de petición.*/
        $url = filter_input(INPUT_GET, 'url', FILTER_SANITIZE_URL);

        /*
        Convierto la url en un array tomando como separador la "/".
         */
        $urlToArray = explode("/", $url);
        /*
        Filtro el arreglo para eliminar datos vacios en caso de haberlos.
         */
        $ArregloUrl = array_filter($urlToArray);
        /*
        Defino un controlador por defecto en el caso de que el arreglo llegue vacío
        Si el arreglo tiene datos, tomo como controlador el primer elemento.
         */
        if (empty($ArregloUrl)) {
            $this->controller = 'Home';
        } else {
            $this->controller = array_shift($ArregloUrl);
        }

        /*
        Defino un método por defecto en el caso de que el arreglo llegue vacío
        Si el arreglo tiene datos, tomo como método el primero elemento.
         */
        if (empty($ArregloUrl)) {
            $this->method = 'index';
        } else {
            $this->method = array_shift($ArregloUrl);
        }
        /**
         * Capturo el metodo de petición y lo guardo en una variable
         */
        $methodRequest = $this->getMethodRequest();
        /**
         * Si el método es GET, en caso de que el arreglo llegue con datos,
         * lo guardo entero en el campo "parametros" de la  clase.
         *
         * Si el método es POST, guardo todos los datos que llegaron por POST
         * en el campo "parametros"
         */

        if ($methodRequest == 'GET') {
            if (!empty($ArregloUrl)) {
                $this->parameters = $ArregloUrl;
            }
        } else {
            $this->parameters = $_POST;
        }
         /*echo '<pre>';
    var_dump($this);
    echo '</pre>';
    exit();*/
    }

    /**
     *
     */
    public static function getInstance()
    {
        static $inst = null;
        if ($inst === null) {
            $inst = new Request();
        }

        return $inst;
    }
    /**
     * Devuelve el método HTTP
     * con el que se hizo el
     * Request
     * @return String
     */
    public static function getMethodRequest()
    {
        return $_SERVER['REQUEST_METHOD'];
    }
    /**
     * Devuelve el controlador
     * @return String
     */
    public function getController()
    {
        return $this->controller;
    }
    /**
     * Devuelve el método
     * @return String
     */
    public function getMethod()
    {
        return $this->method;
    }
    /**
     * Devuelve los atributos
     * @return Array
     */
    public function getParameters()
    {
        return $this->parameters;
    }

}
