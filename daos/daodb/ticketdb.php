<?php namespace daos\daodb;
use daos\IDao as IDao;

use \models\Ticket as M_Ticket;
use daos\daodb\Connection as Connection;

     /**
      *
      */
     class TicketDb extends singleton implements IDao
     {
          private $connection;

          function __construct() {}

          /**
           *
           */
          public function create($_ticket) {

               // Guardo como string la consulta sql utilizando como values, marcadores de parámetros con nombre (:name) o signos de interrogación (?) por los cuales los valores reales serán sustituidos cuando la sentencia sea ejecutada
			$sql = "INSERT INTO tickets (ticket_number, id_purchase_line, qr) VALUES (:ticket_number, :id_purchase_line, :qr)";
               $parameters['ticket_number'] = intval($_ticket->getNumber());
               $parameters['id_purchase_line'] = $_ticket->getIdPurchaseLine();
               $parameters['qr'] = $_ticket->getQr();

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
          public function read($id)
          {
              $sql = "SELECT * FROM tickets where id_ticket = :id_ticket";

              $parameters['id_ticket'] = $id;

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
               $sql = "SELECT * FROM tickets";

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
          public function readAllFromPurchaseLine($id_purchase_line) {
               $sql = "SELECT * FROM tickets where id_purchase_line = :id_purchase_line";

               $parameters['id_purchase_line'] = $id_purchase_line;

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
		* Transforma el listado de tickets en
		* objetos de la clase Ticket
		*
		* @param  Array $tickets Listado de tickets a transformar
		*/
		private function mapear($value) {

			$value = is_array($value) ? $value : [];

			$resp = array_map(function($p){
				return new M_Ticket($p['ticket_number'], $p['id_purchase_line'], $p['qr'], $p['id_ticket']);
			}, $value);

               return count($resp) > 0 ? $resp : $resp['0'];

		}
     }




 ?>
