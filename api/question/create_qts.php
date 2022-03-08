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

    $data = json_decode(file_get_contents("php://input"));

    $item->label = $data->label;
    $item->text = $data->text;
    $item->type = $data->type;
    $item->type_reponse = $data->type_reponse;
    $item->reponse = $data->reponse;
    $item->created = date('y-m-d h:i:s');
    
    if($item->create_question()){
        echo 'created successfully.';
    } else{
        echo ' could not be created.';
    }
?>