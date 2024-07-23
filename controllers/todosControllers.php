<?php

    require_once '../models/todosModels.php';
    require_once '../config/cors.php';
    require_once '../functions.php';

    class TodosControllers{

        public static function getAll(){
           
            try {
                $alltodos = TodosModel::getAll();
                if ($alltodos) {
        
                    echo json_encode($alltodos);
                   
                }else{
                   
                    header('HTTP 1.1 404 Not Found');

                }
            } catch (PDOException $e) {
                header('HHTP/1.1 500 Error de servidor');
                
            }
        }

        public static function getById($id){
            try {
                $id = secureData($id);
                $todo = TodosModel::getById($id);
                if ($todo) {
                    echo json_encode($todo);
                   
                }else{
                   
                    header('HTTP/1.1 404 Not Found');
                    echo json_encode(['message' => 'NotFound']);

                }
            } catch (PDOException $e) {
               
                header('HHTP/1.1 500 Error de servidor');
            }
        }

        public static function create($tarea) {
            try {
                if(!$tarea){
                    echo json_encode(['message' => 'Campo tarea requerido']);
                    return;
                }
                $tarea = secureData($tarea);

                $response = TodosModel::create($tarea);
                if($response){
                
                    echo json_encode(['message' =>'Tarea creada correctamente']);
                   

                }else{
                    echo json_encode(['message' =>'Error al crear Tarea']);
                    header('HTTP/1.1 404 Error al crear tarea');
                }
            } catch (PDOException $e) {
               
                header('HHTP/1.1 500 Error de servidor');
            }

        }

        public static function delete($id) {
            try {
                $id = secureData($id);
                $response = TodosModel::delete($id);
               
                if ($response) {
                   echo json_encode(['message' => 'Tarea borrada']);
                  
                }else{
                    echo json_encode(['message' =>'Error al borrar Tarea']);
                    header('HTTP/1.1 404 Not Found');
                }
            } catch (PDOException $e) {
                
                header('HHTP/1.1 500 Error de servidor');
            }

        }

        public static function update($tarea, $id) {
            try {
                $id = secureData($id);
                if(!$tarea){
                    echo json_encode(['message' => 'Campo tarea requerido']);
                    return;
                }
                $tarea = secureData($tarea);
                $response = TodosModel::update($tarea, $id);
                echo $response;
                if($response){
                    echo json_encode(['message' => 'Tarea actualizada correctamente']);
                }else{
                    header('HTTP/1.1 404 No found');
                    echo json_encode(['message'=>'Not Found']);
                }
            } catch (PDOExceptin $e) {
                header('HHTP/1.1 500 Error de servidor');
            }
        }
    }
?>