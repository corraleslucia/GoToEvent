<?php
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    require_once "config/constants.php";
	require_once "config/autoload.php";

	require_once "config/request.php";
	require_once "config/router.php";
    require_once "daos/daolist/singleton.php";

    use config\autoload as Autoload;
	use config\router 	as Router;
	use config\request 	as Request;
	use daos\daoList\singleton as Singleton;

	Autoload::start();
	session_start();
    Router::go(new Request());
?>
