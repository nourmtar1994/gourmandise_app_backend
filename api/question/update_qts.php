<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: PUT");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    
    include_once '../../config/database.php';
    include_once '../../class/question.php';
    
    $database = new Database();
    $db = $database->getConnection();
    
    $item = new question($db);
    
    $data = json_decode(file_get_contents("php://input"));
    
    $item->id = $data->id;
    
    // employee values
    $item->label = $data->label;
    $item->text = $data->text;
    $item->type = $data->type;
    $item->type_reponse = $data->type_reponse;
    $item->reponse = $data->reponse;
    $item->created = date('Y-m-d H:i:s');
    
    if($item->update_question()){
        echo json_encode(" data updated.");
    } else{
        echo json_encode("Data could not be updated");
    }
?>