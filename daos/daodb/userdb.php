<?php namespace daos\daodb;
use daos\IDao as IDao;

use \models\User as M_User;
use daos\daodb\Connection as Connection;

     /**
      *
      */
     class UserDb extends singleton implements IDao
     {
          private $connection;

          function __construct() {}

          /**
           *
           */
          public function create($_user) {

               // Guardo como string la consulta sql utilizando como values, marcadores de parámetros con nombre (:name) o signos de interrogación (?) por los cuales los valores reales serán sustituidos cuando la sentencia sea ejecutada
			$sql = "INSERT INTO users (mail, pass, name, last_name, user_type, img) VALUES (:mail, :pass, :name, :last_name, :user_type, :img)";

               $parameters['mail'] = $_user->getMail();
               $parameters['pass'] = $_user->getPass();
               $parameters['name'] = $_user->getName();
               $parameters['last_name'] = $_user->getLastName();
               $parameters['user_type'] = $_user->getType();
               $parameters['img'] = $_user->getAvatar()['avatar']['name'];

               try {
                    // creo la instancia connection
     			$this->connection = Connection::getInstance();
				// Ejecuto la sentencia.
				return $this->connection->ExecuteNonQuery($sql, $parameters);
			} catch(\PDOException $ex) {
                   throw $ex;
              }
          }


          /**
           *
           */
          public function read($_mail) {

               $sql = "SELECT * FROM users where mail = :mail";

               $parameters['mail'] = $_mail;

               try {
                    $this->connection = Connection::getInstance();
                    $resultSet = $this->connection->execute($sql, $parameters);
               } catch(Exception $ex) {
                   throw $ex;
               }


               if(!empty($resultSet))
                    return $this->mapear($resultSet);
               else
                    return false;
          }

          /**
           *
           */
          public function readAll() {
               $sql = "SELECT * FROM users";

               try {
                    $this->connection = Connection::getInstance();
                    $resultSet = $this->connection->execute($sql);
               } catch(Exception $ex) {
                   throw $ex;
               }

               if(!empty($resultSet))
                    return $this->mapear($resultSet);
               else
                    return false;
          }


          /**
           *
           */
          public function update($value, $newValue)
          {

          }


          /**
           *
           */
          public function delete($_mail)
          {

          }

          /**
		* Transforma el listado de usuarios en
		* objetos de la clase User
		*
		* @param  Array $gente Listado de usuarios a transformar
		*/
		private function mapear($value) {

			$value = is_array($value) ? $value : [];

			$resp = array_map(function($p){
				return new M_User($p['mail'], $p['pass'], $p['name'], $p['last_name'], $p['user_type'], $p['img'], $p['id_user']);
			}, $value);

               return count($resp) > 0 ? $resp : $resp['0'];

		}
     }




 ?>
