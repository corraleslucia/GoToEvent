<?php namespace daos\daodb;
use daos\IDao as IDao;

use models\Event as M_Event;
use daos\daodb\Connection as Connection;

/**
 *
 */
class EventDb extends singleton implements IDao
{
     private $connection;

     function __construct() {}

     /**
      *
      */
     public function create($_event) {

          // Guardo como string la consulta sql utilizando como values, marcadores de parámetros con nombre (:name) o signos de interrogación (?) por los cuales los valores reales serán sustituidos cuando la sentencia sea ejecutada
       $sql = "INSERT INTO events (description,id_category, img) VALUES (:description,:id_category, :img)";

          $parameters['description'] = $_event->getDescription();

          $parameters['id_category'] = $_event->getCategory();

          $parameters['img'] = $_event->getPoster()['event']['name'];

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
     public function read($_description) {

          $sql = "SELECT * FROM events where description = :description";

          $parameters['description'] = $_description;

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

           $sql = "SELECT e.description as description, c.description as id_category, e.img as img, e.id_event as id_event FROM events e inner join categories c on e.id_category = c.id_category where e.id_event = :id_event";

           $parameters['id_event'] = $id;

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
          $sql = "SELECT e.description as description, c.description as id_category, e.img as img, e.id_event as id_event FROM events e inner join categories c on e.id_category = c.id_category order by e.id_event";

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
     public function readAllAtoZ()
     {
         $sql = "SELECT e.description as description, c.description as id_category, e.img as img, e.id_event as id_event FROM events e inner join categories c on e.id_category = c.id_category order by e.description asc";

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
     public function readAllValid()
     {
         $sql = "SELECT e.description as description, c.description as id_category, e.img as img, e.id_event as id_event
                 FROM events e inner join categories c on e.id_category = c.id_category
                 inner join (select cal.id_event from calendars cal where calendar_date >= now()
                 group by cal.id_event order by calendar_date asc) cal on cal.id_event = e.id_event";

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

     public function readEventsFromArtist ($id_artist)
     {
         $sql = "SELECT ifnull(e.id_event,'0') as id_event, ifnull(e.description,'SIN EVENTOS') as description, ifnull(e.id_category, '0') as id_category,
                ifnull(e.img, '0') as img

                FROM artists a left outer join artists_in_calendars ac on a.id_artist = ac.id_artist

                left outer join calendars cal on cal.id_calendar = ac.id_calendar

                left outer join events e on cal.id_event = e.id_event

                left outer join locations l on cal.id_location = l.id_location

                where a.id_artist = :id_artist and cal.calendar_date >= now()

                group by e.description";

                $parameters['id_artist'] = $id_artist;

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

     public function readEventsFromCategory ($id_category)
     {
         $sql = " SELECT  ifnull(e.description, 'SIN EVENTOS') as description, ifnull(e.id_event, '0') as id_event,
                    ifnull(e.id_category,'0') as id_category, ifnull(e.img,'0') as img
                  FROM categories c left outer join events e on c.id_category = e.id_category
                  left outer join calendars cal on e.id_event = cal.id_event
                  WHERE c.id_category = :id_category and cal.calendar_date >= now()";

                $parameters['id_category'] = $id_category;

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

     public function readEventsFromLocation ($city)
     {
         $sql = " SELECT ifnull(e1.id_event, '0') as id_event, ifnull(e1.description,'SIN EVENTOS') as description,
                    ifnull(e1.id_category,'0') as id_category, ifnull(e1.img,'0') as img
                    FROM
                        (SELECT l.id_location as id_location, l.city as city, e.id_event as id_event,
                        e.description as description, e.id_category as id_category,
                        e.img as img
                        FROM locations l left outer join calendars cal on l.id_location = cal.id_location
                        left outer join events e on cal.id_event = e.id_event
                        where l.city = :city and cal.calendar_date >= now()
                        group by e.description) e1
                        where e1.id_event>0";

                $parameters['city'] = $city;

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

     public function readEventsFromDate ($month,$year)
     {
         $sql = " SELECT e1.id_event, e1.description, e1.id_category, e1.img
         from (SELECT e.id_event as id_event, e.description as description, e.id_category as id_category,
              e.img as img, monthname(calendar_date), month(calendar_date) as month, year(calendar_date) as year
              from calendars cal inner join events e on cal.id_event = e.id_event
              where year(calendar_date) = $year and month(calendar_date) = $month and cal.calendar_date >= now()
              group by e.id_event, monthname(calendar_date)
              order by calendar_date) e1";


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

     public function searchEventsByEvent ($event)
     {
         $sql = " SELECT e.id_event as id_event, e.description as description, c.description as id_category, e.img as img
                    from events e inner join categories c on e.id_category = c.id_category
                    where e.description like :eventname
                    group by e.description";

                $parameters['eventname'] = "%".$event."%";

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
     public function update($id_event, $event)
     {
         $sql = "UPDATE events SET description = :description, id_category = :id_category, img = :img  where id_event = :id_event";

         $parameters['description'] = $event->getDescription();
         $parameters['id_category'] = $event->getCategory();
         $parameters['img'] = $event->getPoster()['event']['name'];
         $parameters['id_event'] = $id_event;


         try {
              // creo la instancia connection
          $this->connection = Connection::getInstance();
          // Ejecuto la sentencia.
          return $this->connection->ExecuteNonQuery($sql, $parameters);
      } catch(\PDOException $ex) {
             throw $ex;
        }
     }

     public function checkSoldTicketsFromEvent ($id_event)
     {
         $sql = "SELECT *
                 FROM purchase_lines pl inner join event_seats evs on pl.id_event_seat = evs.id_event_seat
                    inner join calendars cal on evs.id_calendar = cal.id_calendar
                    inner join events e on cal.id_event = e.id_event
                 WHERE e.id_event = :id_event";

         $parameters['id_event'] = $id_event;

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
     public function delete($id_event)
     {
         $sql = "DELETE from events where id_event = :id_event";

         $parameters['id_event'] = $id_event;

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
   * Transforma el listado de eventos en
   * objetos de la clase Event
   *
   * @param  Array $events Listado de eventos a transformar
   */
   private function mapear($value) {

       $value = is_array($value) ? $value : [];

       $resp = array_map(function($p){
           return new M_Event($p['description'], $p['id_category'], $p['img'], $p['id_event']);
       }, $value);

          return count($resp) > 0 ? $resp : $resp['0'];

   }
}



?>
