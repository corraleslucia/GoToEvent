<?php namespace daos\daodb;
use daos\IDao as IDao;

use \models\Purchase as M_Purchase;
use daos\daodb\Connection as Connection;

     /**
      *
      */
     class PurchaseDb extends singleton implements IDao
     {
          private $connection;

          function __construct() {}

          /**
           *
           */
          public function create($_purchase) {

               // Guardo como string la consulta sql utilizando como values, marcadores de parámetros con nombre (:name) o signos de interrogación (?) por los cuales los valores reales serán sustituidos cuando la sentencia sea ejecutada
			$sql = "INSERT INTO purchases (purchase_date, id_user, total) VALUES (curdate(), :id_user, :total)";

               $parameters['id_user'] = $_purchase->getIdUser();
               $parameters['total'] = intval($_purchase->getTotal());


               try {
                    // creo la instancia connection
     			$this->connection = Connection::getInstance();
				// Ejecuto la sentencia.
				$this->connection->ExecuteNonQuery($sql, $parameters);
			} catch(\PDOException $ex) {
                   throw $ex;
              }

              $sql = "SELECT * FROM purchases where id_purchase = last_insert_id()";

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
          public function read($id)
          {
              $sql = "SELECT * FROM purchases where id_purchase = :id_purchase";

              $parameters['id_purchase'] = $id;

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
               $sql = "SELECT * FROM purchases";

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
          public function readAllFromUser($id_user) {
               $sql = "SELECT * FROM purchases where id_user = :id_user";

               $parameters['id_user'] = $id_user;

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
          public function update($id_purchase, $newTotal)
          {
              $sql = "UPDATE purchases SET total = :total where id_purchase = :id_purchase";

              $parameters['total'] = $newTotal;
              $parameters['id_purchase'] = $id_purchase;


              try
              {
                   // creo la instancia connection
               $this->connection = Connection::getInstance();
               // Ejecuto la sentencia.
               return $this->connection->ExecuteNonQuery($sql, $parameters);
              } catch(\PDOException $ex)
              {
                  throw $ex;
             }


          }


          /**
           *
           */
          public function delete($_description)
          {

          }


          /**
		* Transforma el listado de purchases en
		* objetos de la clase Purchase
		*
		* @param  Array $purchases Listado de purchases a transformar
		*/
		private function mapear($value) {

			$value = is_array($value) ? $value : [];

			$resp = array_map(function($p){
				return new M_Purchase($p['id_user'], $p['purchase_date'], $p['total'], $p['id_purchase']);
			}, $value);

               return count($resp) > 0 ? $resp : $resp['0'];

		}
     }




 ?>
