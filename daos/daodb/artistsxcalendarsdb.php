<?php namespace daos\daodb;
use daos\IDao as IDao;

use \models\ArtistInCalendar as M_ArtistInCalendar;
use daos\daodb\Connection as Connection;


     /**
      *
      */
     class ArtistsXCalendarsDb extends singleton implements IDao
     {
          private $connection;

          function __construct() {}

          /**
           *
           */
          public function create($_artistsxcalendars) {

               // Guardo como string la consulta sql utilizando como values, marcadores de parámetros con nombre (:name) o signos de interrogación (?) por los cuales los valores reales serán sustituidos cuando la sentencia sea ejecutada
			$sql = "INSERT INTO artists_in_calendars (id_artist,id_calendar) VALUES (:id_artist,:id_calendar)";

               $parameters['id_artist'] = $_artistsxcalendars->getIdArtist();
               $parameters['id_calendar'] = $_artistsxcalendars->getIdCalendar();

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
          public function readAllArtistsFromCalendar($id_calendar) {

              $sql = "SELECT id_calendar, a.name as id_artist FROM artists_in_calendars aic inner join artists a on aic.id_artist = a.id_artist  where id_calendar = :id_calendar";


              $parameters['id_calendar'] = $id_calendar;


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
          public function read($_info)
          {


          }


          /**
           *
           */
          public function readAll()
          {
               $sql = "SELECT * FROM artists_in_calendars";

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
		* Transforma el listado de id_artistas_id_calendarios en
		* objetos de la clase ArtistInCalendar
		*
		* @param  Array $_artistsxcalendars Listado a transformar
		*/
		private function mapear($value) {

			$value = is_array($value) ? $value : [];

			$resp = array_map(function($p){
				return new M_ArtistInCalendar($p['id_artist'], $p['id_calendar']);
			}, $value);

               return count($resp) > 0 ? $resp : $resp['0'];

		}
     }




 ?>
