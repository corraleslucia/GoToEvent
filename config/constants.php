<?php
namespace config;

define('ROOT', str_replace('\\','/',dirname(__DIR__) . "/"));


$base=explode($_SERVER['DOCUMENT_ROOT'],ROOT);
  define("BASE",$base[1]);


  define('HOST',"localhost");
  define('USER',"root");
  define('PASS',"");
  define('DB',"gotoevent");



define('IMG_UPLOADS_PATH', ROOT . '/media/uploads/img');

define('IMG_UPLOADS', BASE . '/media/uploads/img');


?>
