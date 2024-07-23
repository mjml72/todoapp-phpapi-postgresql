<?php

    require_once '../config/Database.php';
    require_once '../config/cors.php';


    

    class TodosModel{



        public static function getAll() {
            try {
               
                $database = new Database();
                $connection = $database->getConnection();
                
                    
                $query = $connection->prepare('SELECT * FROM todo');
                $query->execute();
               
                
                $listTodos = $query->fetchAll();
                
               return $listTodos;
    
            } catch (PDOException $e) {
                $e->getMessage();
                return;
            }
        }



        public static function getById($id){
            try {
                $database = new Database();
                $connection = $database->getConnection();

                $query = $connection->prepare("SELECT * FROM todo WHERE todoid = :id;");
                $query->bindParam(':id', $id);

                $query->execute();
                $todo = $query->fetch();
                return $todo;

            } catch (PDOException $e) {
                $e->getMessage();
                return;
            }

        }
        


        public static function create($tarea) {
            try {
                $database = new Database();
                $connection = $database->getConnection();
    
                $query = $connection->prepare('INSERT INTO todo (tarea) 
                VALUES (:tarea)');
                $query->bindParam(':tarea', $tarea);
                 
                return $query->execute();
               
            } catch (PDOException $e) {
                $e->getMessage();
                return;
            }



        }


        public static function delete($id) {
            try {
                $database = new Database();
                $connection = $database->getConnection();
                
                $query = $connection->prepare("DELETE FROM todo WHERE todoid = :id;");
                $query->bindParam(':id', $id);
                return $query->execute();
            } catch (PDOException $e) {
                $e->getMessage();
                return;
            }

        }

        
        public static function update($tarea, $id) {
            try {
                $database = new Database();
                $connection = $database->getConnection();

                $query = $connection->prepare('UPDATE todo SET tarea=:tarea WHERE todoid=:id');
                $query->bindParam(':tarea', $tarea);
                $query->bindParam(':id', $id);
                return $query->execute();
            } catch (PDOException $e) {
                $e->getMessage();
                return;
            }
        }
    }

?>