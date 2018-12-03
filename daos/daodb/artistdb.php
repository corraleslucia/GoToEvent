<?php namespace daos\daodb;
use daos\IDao as IDao;

use \models\Artist as M_Artist;
use daos\daodb\Connection as Connection;

     /**
      *
      */
     class ArtistDb extends singleton implements IDao
     {
          private $connection;

          function __construct() {}

          /**
           *
           */
          public function create($_artist) {

               // Guardo como string la consulta sql utilizando como values, marcadores de parámetros con nombre (:name) o signos de interrogación (?) por los cuales los valores reales serán sustituidos cuando la sentencia sea ejecutada
			$sql = "INSERT INTO artists (name, img) VALUES (:name, :img)";

               $parameters['name'] = $_artist->getName();
               $parameters['img'] = $_artist->getAvatar()['artist']['name'];

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
          public function readId($id) {

               $sql = "SELECT * FROM artists where id_artist = :id_artist";

               $parameters['id_artist'] = $id;

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
               $sql = "SELECT * FROM artists order by name asc";

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
          public function edit($_artist) {

          }

          /**
           *
           */
          public function update($id_artist, $artist)
          {
              $sql = "UPDATE artists SET name = :name, img = :img  where id_artist = :id_artist";

              $parameters['name'] = $artist->getName();
              $parameters['img'] = $artist->getAvatar()['artist']['name'];
              $parameters['id_artist'] = $id_artist;


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
          public function delete($id_artist)
          {
              $sql = "DELETE from artists where id_artist = :id_artist";

              $parameters['id_artist'] = $id_artist;
              
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
		* Transforma el listado de artistas en
		* objetos de la clase Artista
		*
		* @param  Array $gente Listado de artistas a transformar
		*/
		private function mapear($value) {

			$value = is_array($value) ? $value : [];

			$resp = array_map(function($p){
				return new M_Artist($p['name'], $p['img'], $p['id_artist']);
			}, $value);

               return count($resp) > 0 ? $resp : $resp['0'];

		}
     }

 ?>
