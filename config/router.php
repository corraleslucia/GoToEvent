<?php
namespace config;

class Router
{

    /**
     * Se encarga de direccionar a la pagina solicitada
     * @param Request
     */
    public function __construct()
    {

    }
    public static function go(Request $request)
    {

        $controller = $request->getController()."Controller";
        $method = $request->getMethod();
        $parameters = $request->getParameters();
        $object = "controllers\\" . $controller;
        $controller = new $object();

        if($_FILES)
        {
             $parameters[] = $_FILES;
        }

        if (!isset($parameters))
        {
            call_user_func(array($controller, $method));
        } else
        {
            call_user_func_array(array($controller, $method), $parameters);
        }
    }
}
