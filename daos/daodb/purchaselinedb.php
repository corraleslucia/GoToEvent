<?php namespace daos\daodb;
use daos\IDao as IDao;

use \models\PurchaseLine as M_PurchaseLine;
use daos\daodb\Connection as Connection;

     /**
      *
      */
     class PurchaseLineDb extends singleton implements IDao
     {
          private $connection;

          function __construct() {}

          /**
           *
           */
          public function create($_purchase_line) {

               // Guardo como string la consulta sql utilizando como values, marcadores de parámetros con nombre (:name) o signos de interrogación (?) por los cuales los valores reales serán sustituidos cuando la sentencia sea ejecutada
			$sql = "INSERT INTO purchase_lines (id_event_seat, quantity, price, id_purchase) VALUES (:id_event_seat, :quantity, :price, :id_purchase)";

               $parameters['id_event_seat'] = $_purchase_line->getEventSeat();
               $parameters['quantity'] = $_purchase_line->getQuantity();
               $parameters['price'] = $_purchase_line->getPrice();
               $parameters['id_purchase'] = $_purchase_line->getIdPurchase();

               try {
                    // creo la instancia connection
     			$this->connection = Connection::getInstance();
				// Ejecuto la sentencia.
				$this->connection->ExecuteNonQuery($sql, $parameters);
			} catch(\PDOException $ex) {
                   throw $ex;
              }

              $sql = "SELECT * FROM purchase_lines where id_purchase_line = last_insert_id()";

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
              $sql = "SELECT * FROM purchase_lines where id_purchase_line = :id_purchase_line";

              $parameters['id_purchase_line'] = $id;

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
               $sql = "SELECT * FROM purchase_lines";

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
          public function readAllFromPurchase($id_purchase) {
               $sql = "SELECT * FROM purchase_lines where id_purchase = :id_purchase";

               $parameters['id_purchase'] = $id_purchase;

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
          public function update($value, $newValue)
          {

          }


          /**
           *
           */
          public function delete($_description)
          {

          }


          /**
		* Transforma el listado de purchaseLines en
		* objetos de la clase Purchaseline
		*
		* @param  Array $purchaseLines Listado de purchaseLines a transformar
		*/
		private function mapear($value) {

			$value = is_array($value) ? $value : [];

			$resp = array_map(function($p){
				return new M_PurchaseLine($p['id_event_seat'], $p['quantity'], $p['price'], $p['id_purchase'], $p['id_purchase_line']);
			}, $value);

               return count($resp) > 0 ? $resp : $resp['0'];

		}
     }




 ?>
