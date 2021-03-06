<?php namespace daos\daodb;
use daos\IDao as IDao;

use \models\Calendar as M_calendar;
use daos\daodb\Connection as Connection;


     /**
      *
      */
     class CalendarDb extends singleton implements IDao
     {
          private $connection;

          function __construct() {}

          /**
           *
           */
          public function create($_calendar) {

               // Guardo como string la consulta sql utilizando como values, marcadores de parámetros con nombre (:name) o signos de interrogación (?) por los cuales los valores reales serán sustituidos cuando la sentencia sea ejecutada
			$sql = "INSERT INTO calendars (calendar_date, calendar_time,  id_location,id_event) VALUES (:calendar_date, :calendar_time, :id_location, :id_event)";

               $parameters['calendar_date'] = $_calendar->getDate();
               $parameters['calendar_time'] = $_calendar->getTime();
               $parameters['id_location'] = $_calendar->getLocation();
               $parameters['id_event'] = $_calendar->getIdEvent();

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
           public function read($_readInfo) {

               $date = $_readInfo['date'];
               $time = $_readInfo['time'];

                $sql = "SELECT c.calendar_date as calendar_date, c.calendar_time as calendar_time, l.name as id_location, e.description as id_event, c.id_calendar as id_calendar FROM calendars c inner join locations l on c.id_location = l.id_location inner join events e on c.id_event = e.id_event where e.id_event = :id_event and c.calendar_date = '$date' and c.calendar_time = '$time'";


                $parameters['id_event'] = $_readInfo['id_event'];


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
            public function readFromEvent($id_event)
            {

                 $sql = "SELECT c.calendar_date as calendar_date, c.calendar_time as calendar_time, l.name as id_location, e.description as id_event, c.id_calendar as id_calendar FROM calendars c inner join locations l on c.id_location = l.id_location inner join events e on c.id_event = e.id_event where e.id_event = :id_event";


                 $parameters['id_event'] = $id_event;


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
               $sql = "SELECT c.calendar_date as calendar_date, c.calendar_time as calendar_time, l.name as id_location, e.description as id_event, c.id_calendar as id_calendar FROM calendars c inner join locations l on c.id_location = l.id_location inner join events e on c.id_event = e.id_event FROM calendars";

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

           public function readId($id) {

                $sql = "SELECT  c.calendar_date as calendar_date, c.calendar_time as calendar_time, l.name as id_location, e.description as id_event, c.id_calendar as id_calendar FROM calendars c inner join locations l on c.id_location = l.id_location inner join events e on c.id_event = e.id_event where c.id_calendar = :id_calendar";

                $parameters['id_calendar'] = $id;

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


           public function readAllMonthYearFromCalendars ()
           {
               $sql = "SELECT month(calendar_date) as month, monthname(calendar_date) as monthName, year(calendar_date) as year
                       from calendars cal inner join events e on cal.id_event = e.id_event
                       where cal.calendar_date >= now()
                       group by monthname(calendar_date)
                       order by calendar_date";

               try {
                    $this->connection = Connection::getInstance();
                    $resultSet = $this->connection->execute($sql);
               } catch(Exception $ex) {
                   throw $ex;
               }

               if(!empty($resultSet))
                    return $resultSet;
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
		* Transforma el listado de calendarios en
		* objetos de la clase Calendar
		*
		* @param  Array $calendars Listado de calendarios a transformar
		*/
		private function mapear($value) {

			$value = is_array($value) ? $value : [];

			$resp = array_map(function($p){
				return new M_Calendar($p['calendar_date'], $p['calendar_time'], $p['id_location'], null, $p['id_event'], $p['id_calendar']);
			}, $value);

               return count($resp) > 0 ? $resp : $resp['0'];

		}
     }


 ?>
