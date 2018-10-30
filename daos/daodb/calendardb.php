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

                $sql = "SELECT * FROM calendars where id_event = :id_event and calendar_date = '$date' and calendar_time = '$time'";


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

         /* public function read($_readInfo) {

               $calendar_date = $_readInfo['date'];
               $id_event = $_readInfo['id_event'];

               $sql = "SELECT * FROM calendars where calendar_date = :calendar_date and id_event = :id_event";

               //$sql = "SELECT * FROM calendars where calendar_date = :calendar_date and id_event = :id_event";
               //$parameters['calendar_date'] = $_readInfo['date'];
               $parameters['id_event'] =  $id_event;
               $parameters['calendar_date'] =  $calendar_date;

               var_dump($parameters);

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
          }*/

          /**
           *
           */
          public function readAll() {
               $sql = "SELECT * FROM calendars";

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

                $sql = "SELECT * FROM calendars where id_calendar = :id_calendar";

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

          /**
           *
           */
          public function edit($_calendar) {
               $sql = "UPDATE calendars SET calendar_date = :calendar_date, id_location = :id_location, id_event = :id_event";

               $parameters['calendar_date'] = $_calendar->getDate();
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
				return new M_Calendar($p['calendar_date'], $p['calendar_time'], $p['id_location'], null, $p['id_event'], $p['id_calendar']);
			}, $value);

               return count($resp) > 1 ? $resp : $resp['0'];

		}
     }


 ?>
