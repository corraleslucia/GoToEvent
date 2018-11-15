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
			$sql = "INSERT INTO tickets (id_user, id_calendar, id_event_seat, id_seats_type, quantity, price, total) VALUES (:id_user, :id_calendar, :id_event_seat, :id_seatType, :quantity, :price, :total)";

               $parameters['id_user'] = $_ticket->getIdUser();
               $parameters['id_calendar'] = $_ticket->getCalendar();
               $parameters['id_event_seat'] = $_ticket->getEventSeat();
               $parameters['id_seatType'] = $_ticket->getSeatType();
               $parameters['quantity'] = $_ticket->getQuantity();
               $parameters['price'] = $_ticket->getPrice();
               $parameters['total'] = $_ticket->getTotal();

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
		protected function mapear($value) {

			$value = is_array($value) ? $value : [];

			$resp = array_map(function($p){
				return new M_Ticket($p['id_user'], $p['id_calendar'], $p['id_event_seat'], $p['id_seats_type'], $p['quantity'], $p['price'], $p['total'], $p['id_ticket']);
			}, $value);

               return count($resp) > 0 ? $resp : $resp['0'];

		}
     }




 ?>
