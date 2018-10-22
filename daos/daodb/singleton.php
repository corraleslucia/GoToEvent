<?php namespace daos\daodb;

class Singleton
{
    private static $instance=array();
	public static function getInstance()
	{

		$myclass=get_called_class();
		if(!isset(self::$instance[$myclass]))
			{
				self::$instance[$myclass]=new $myclass;
			}


		return self::$instance[$myclass];
	}
}
?>
