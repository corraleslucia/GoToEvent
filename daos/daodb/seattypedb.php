<?php namespace daos\daodb;
use daos\IDao as IDao;

use \models\SeatType as M_SeatType;
use daos\daodb\Connection as Connection;

     /**
      *
      */
     class SeatTypeDb extends singleton implements IDao
     {
          private $connection;

          function __construct() {}

          /**
           *
           */
          public function create($_seatType) {

               // Guardo como string la consulta sql utilizando como values, marcadores de parámetros con nombre (:name) o signos de interrogación (?) por los cuales los valores reales serán sustituidos cuando la sentencia sea ejecutada
			$sql = "INSERT INTO seats_type (name) VALUES (:name)";

               $parameters['name'] = $_seatType->getName();

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

               $sql = "SELECT * FROM seats_type where name = :name";

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
               $sql = "SELECT * FROM seats_type";

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

                $sql = "SELECT * FROM seats_type where id_event = :id_event";

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
          public function edit($_seatType) {
               $sql = "UPDATE seats_type SET name = :name";

               $parameters['name'] = $_seatType->getName();


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
		* Transforma el listado de seats_type en
		* objetos de la clase SeatType
		*
		* @param  Array  Listado de seats_Type a transformar
		*/
		protected function mapear($value) {

			$value = is_array($value) ? $value : [];

			$resp = array_map(function($p){
				return new M_SeatType($p['name'], $p['id_seats_type']);
			}, $value);

               return count($resp) > 0 ? $resp : $resp['0'];

		}
     }




 ?>
