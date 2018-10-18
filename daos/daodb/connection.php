<?php namespace daobd;
/**
*
*/
class Connection
{
	public function get_Connection()
	{
			try
			{
				$connection=new\PDO("mysql:host=".HOST.";dbname=".DB,USER,PASS);
			}
			catch(PDOException $e)
			{
				echo "ERROR:".$e->getMessage();
			}
			 return $connection;
	}
}
 ?>
