<?php namespace daos\daodb;
use daos\IDao as IDao;

use models\EventSeat as M_EventSeat;
use daos\daodb\Connection as Connection;

/**
 *
 */
class EventSeatDb extends singleton implements IDao
{
     private $connection;

     function __construct() {}

     /**
      *
      */

     public function create($_eventSeat) {

          // Guardo como string la consulta sql utilizando como values, marcadores de parámetros con nombre (:name) o signos de interrogación (?) por los cuales los valores reales serán sustituidos cuando la sentencia sea ejecutada
       $sql = "INSERT INTO event_seats (id_seat_type,total_quantity,price,remaning_quantity,id_calendar) VALUES (:id_seat_type,:total_quantity,:price,:remaning_quantity,:id_calendar)";

          $parameters['id_seat_type'] = $_eventSeat->getSeatType();
          $parameters['total_quantity'] = $_eventSeat->getTotalQuantity();
          $parameters['price'] = $_eventSeat->getPrice();
          $parameters['remaning_quantity'] = $_eventSeat->getRemaningQuantity();
          $parameters['id_calendar'] = $_eventSeat->getIdCalendar();

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

          $sql = "SELECT * FROM artists where name = :name";

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
     public function readAll() {
          $sql = "SELECT * FROM event_seats";

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

     public function readAllFromCalendar ($calendarId)
     {
         $sql = "SELECT se_t.name as id_seat_type, ev_s.total_quantity as total_quantity, ev_s.price as price, ev_s.id_calendar as id_calendar, ev_s.remaning_quantity as remaning_quantity, ev_s.id_event_seat as id_event_seat FROM event_seats ev_s inner join seats_type se_t on ev_s.id_seat_Type = se_t.id_seats_type where ev_s.id_calendar = :id_calendar";

         $parameters['id_calendar'] = $calendarId;

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
     public function edit($_artist) {
          $sql = "UPDATE artists SET name = :name";

          $parameters['name'] = $_artist->getName();


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
     public function update($value, $newValue) {

     }
     /**
      *
      */
     public function delete($_name) {
          /*$sql = "DELETE FROM usuarios WHERE email = :email";

          $obj_pdo = new Conexion();

          try {
               $conexion = $obj_pdo->conectar();

           // Creo una sentencia llamando a prepare. Esto devuelve un objeto statement
           $sentencia = $conexion->prepare($sql);

               $sentencia->bindParam(":email", $email);

               $sentencia->execute();


          } catch(PDOException $Exception) {

           throw new MyDatabaseException( $Exception->getMessage( ) , $Exception->getCode( ) );

       }*/
     }

     /**
   * Transforma el listado de artistas en
   * objetos de la clase Artista
   *
   * @param  Array $gente Listado de artistas a transformar
   */
   protected function mapear($value) {

       $value = is_array($value) ? $value : [];

       $resp = array_map(function($p){
           return new M_EventSeat($p['id_seat_type'], $p['total_quantity'], $p['price'], $p['id_calendar'], $p['remaning_quantity'], $p['id_event_seat']);
       }, $value);

          return count($resp) > 0 ? $resp : $resp['0'];

   }

}




?>
