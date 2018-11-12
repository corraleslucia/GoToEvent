<?php namespace config;

class Autoload
{
	
    public static function autoload(){
        require __DIR__ . '/fb-sdk/src/Facebook/autoload.php';
    }

    public static function Start()
    {
        spl_autoload_register(function ($instancia) {

            $ruta = ROOT . str_replace("\\", "/", $instancia) . ".php";
            include_once ($ruta);

        });
    }
}


?>
