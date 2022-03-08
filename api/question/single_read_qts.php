<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    include_once '../../config/database.php';
    include_once '../../class/question.php';


    $database = new Database();
    $db = $database->getConnection();

    $item = new question($db);

    
    $item->id = isset($_GET['id']) ? $_GET['id'] : die();
  
    $item->getSingle_question();

    if($item->label != null){
        // create array
        $emp_arr = array(
            "id" =>$item->id,
            "label" =>$item->label,
            "text" => $item->text,
            "type" => $item->type,
            "type_reponse" => $item->type_reponse,
            "reponse" => $item->reponse,
            "created" => $item->created
        );
      
        http_response_code(200);
        echo json_encode($emp_arr);
    }
      
    else{
        http_response_code(404);
        echo json_encode("data not found.");
    }
?>