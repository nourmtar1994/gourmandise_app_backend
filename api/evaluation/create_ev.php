<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    include_once '../../config/database.php';
    include_once '../../class/evaluation.php';


    $database = new Database();
    $db = $database->getConnection();

    $item = new evaluation($db);

    $data = json_decode(file_get_contents("php://input"));

    $item->id_question = $data->id_question;
    $item->id_client = $data->id_client;
    $item->reponse = $data->reponse;
    $item->id_pt_de_vente = $data->id_pt_de_vente;
    $item->created = date('y-m-d h:i:s');
    
    if($item->createevaluation()){
        echo 'created successfully.';
    } else{
        echo ' could not be created.';
    }
?>