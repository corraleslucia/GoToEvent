<?php namespace daos\daodb;
use daos\IDao as IDao;

use \models\Category as M_Category;
use daos\daodb\Connection as Connection;

     /**
      *
      */
     class CategoryDb extends singleton implements IDao
     {
          private $connection;

          function __construct() {}

          /**
           *
           */
          public function create($_category) {

               // Guardo como string la consulta sql utilizando como values, marcadores de parámetros con nombre (:name) o signos de interrogación (?) por los cuales los valores reales serán sustituidos cuando la sentencia sea ejecutada
			$sql = "INSERT INTO categories (description) VALUES (:description)";

               $parameters['description'] = $_category->getDescription();

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

               $sql = "SELECT * FROM categories where description = :description";

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
          public function readAll() {
               $sql = "SELECT * FROM categories";

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

               $sql = "SELECT * FROM categories where id_category = :id_category";

               $parameters['id_category'] = $id;

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
          public function update($id_category, $category)
          {
              $sql = "UPDATE categories SET description = :description  where id_category = :id_category";

              $parameters['description'] = $category->getDescription();
              $parameters['id_category'] = $id_category;


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
          public function delete($id_category)
          {
              $sql = "DELETE from categories where id_category = :id_category";

              $parameters['id_category'] = $id_category;

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
		* Transforma el listado de categorias en
		* objetos de la clase Categoria
		*
		* @param  Array $categorias Listado de categorias a transformar
		*/
		private function mapear($value) {

			$value = is_array($value) ? $value : [];

			$resp = array_map(function($p){
				return new M_Category($p['description'], $p['id_category']);
			}, $value);

               return count($resp) > 0 ? $resp : $resp['0'];

		}
     }




 ?>
