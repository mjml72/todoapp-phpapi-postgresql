<?php
    require_once '../controllers/todosControllers.php';
    require_once '../config/Database.php';
    require_once '../config/cors.php';
    

    $requestMethod = $_SERVER['REQUEST_METHOD'];
    
    if ($requestMethod === 'POST') {
        $data = json_decode(file_get_contents("php://input"), true);
        $tarea = $data['tarea'];
        
        TodosControllers::create($tarea);
    }
    
    if ($requestMethod === 'GET') {
        $url = explode('/', $_SERVER['REQUEST_URI']);
        if($url[2]){
            TodosControllers::getById($url[2]);
        }else{
            TodosControllers::getAll();
        }
        
    }
    

    if ($requestMethod === 'DELETE') {
        $url = explode('/', $_SERVER['REQUEST_URI']);
        if($url[2]){
            TodosControllers::delete($url[2]);
        }else{
            echo ('No recibe numero id en url');
        }

    }

    if ($requestMethod === 'PUT') {
        $url = explode('/', $_SERVER['REQUEST_URI']);
        if($url[2]){
            $data = json_decode(file_get_contents("php://input"), true);

            $tarea = $data['tarea'];
    
            TodosControllers::update($tarea, $url[2]);
        }else{
            echo ('Error al actualizar');
        }
        

    }

?>





