<?php namespace daos\daodb;
use daos\IDao as IDao;

use \models\Location as M_Location;
use daos\daodb\Connection as Connection;

     /**
      *
      */
     class LocationDb extends singleton implements IDao
     {
          private $connection;

          function __construct() {}

          /**
           *
           */
          public function create($_location) {

               // Guardo como string la consulta sql utilizando como values, marcadores de parámetros con nombre (:name) o signos de interrogación (?) por los cuales los valores reales serán sustituidos cuando la sentencia sea ejecutada
			$sql = "INSERT INTO locations (name,capacity,adress,city) VALUES (:name, :capacity, :adress, :city)";

               $parameters['name'] = $_location->getName();
               $parameters['capacity'] = $_location->getCapacity();
               $parameters['adress'] = $_location->getAdress();
               $parameters['city'] = $_location->getCity();

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
          public function read($_name) {

               $sql = "SELECT * FROM locations where name = :name";

               $parameters['name'] = $_name;

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
          public function readId($id) {

               $sql = "SELECT * FROM locations where id_location = :id_location";

               $parameters['id_location'] = $id;

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
               $sql = "SELECT * FROM locations order by city asc";

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
          public function update($id_location, $location)
          {
              $sql = "UPDATE locations SET name = :name, capacity = :capacity, adress = :adress , city = :city  where id_location = :id_location";

              $parameters['name'] = $location->getName();
              $parameters['capacity'] = $location->getCapacity();
              $parameters['adress'] = $location->getAdress();
              $parameters['city'] = $location->getCity();
              $parameters['id_location'] = $id_location;


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
          public function delete($id_location)
          {
              $sql = "DELETE from categories where id_location = :id_location";

              $parameters['id_category'] = $id_location;

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
		* Transforma el listado de locations en
		* objetos de la clase Location
		*
		* @param  Array $gente Listado de locations a transformar
		*/
		private function mapear($value) {

			$value = is_array($value) ? $value : [];

			$resp = array_map(function($p){
				return new M_Location($p['name'],$p['capacity'], $p['adress'], $p['city'], $p['id_location']);
			}, $value);

               return count($resp) > 0 ? $resp : $resp['0'];

		}
     }




 ?>
