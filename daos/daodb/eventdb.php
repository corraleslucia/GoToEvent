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
       $sql = "INSERT INTO events (description,id_category) VALUES (:description,:id_category)";

          $parameters['description'] = $_event->getDescription();

          $parameters['id_category'] = $_event->getCategory();

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

           $sql = "SELECT e.description as description, c.description as id_category, e.id_event as id_event FROM events e inner join categories c on e.id_category = c.id_category where e.id_event = :id_event";

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
          $sql = "SELECT e.description as description, c.description as id_category, e.id_event as id_event FROM events e inner join categories c on e.id_category = c.id_category order by e.id_event";

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
         $sql = "SELECT e.description as description, c.description as id_category, e.id_event as id_event FROM events e inner join categories c on e.id_category = c.id_category order by e.description asc";

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
         $sql = "SELECT e.description as description, c.description as id_category, e.id_event as id_event
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
         $sql = "SELECT ifnull(e.id_event,'0') as id_event, ifnull(e.description,'SIN EVENTOS') as description, ifnull(e.id_category, '0') as id_category

                FROM artists a left outer join artists_in_calendars ac on a.id_artist = ac.id_artist

                left outer join calendars cal on cal.id_calendar = ac.id_calendar

                left outer join events e on cal.id_event = e.id_event

                left outer join locations l on cal.id_location = l.id_location

                where a.id_artist = :id_artist

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
         ifnull(e.id_category,'0') as id_category FROM categories c left outer join events e on c.id_category = e.id_category
         WHERE c.id_category = :id_category";

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
                    ifnull(e1.id_category,'0') as id_category
                    FROM
                        (SELECT l.id_location as id_location, l.city as city, ifnull(e.id_event, '0') as id_event,
                        ifnull(e.description, 'SIN EVENTOS') as description, ifnull(e.id_category,'0') as id_category
                        FROM locations l left outer join calendars cal on l.id_location = cal.id_location
                        left outer join events e on cal.id_event = e.id_event
                        where l.city = :city
                        group by ifnull(e.description, 'SIN EVENTOS')) e1";

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
         $sql = " SELECT e1.id_event, e1.description, e1.id_category
         from (SELECT e.id_event as id_event, e.description as description, e.id_category as id_category,
              monthname(calendar_date), month(calendar_date) as month, year(calendar_date) as year
              from calendars cal inner join events e on cal.id_event = e.id_event
              where year(calendar_date) = $year and month(calendar_date) = $month
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


     /**
      *
      */
     public function update($value, $newValue)
     {

     }
     /**
      *
      */
     public function delete($_name)
     {

     }

     /**
   * Transforma el listado de eventos en
   * objetos de la clase Event
   *
   * @param  Array $events Listado de eventos a transformar
   */
   protected function mapear($value) {

       $value = is_array($value) ? $value : [];

       $resp = array_map(function($p){
           return new M_Event($p['description'], $p['id_category'], $p['id_event']);
       }, $value);

          return count($resp) > 0 ? $resp : $resp['0'];

   }
}




?>
