<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: PUT");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    
    include_once '../../config/database.php';
    include_once '../../class/client.php';
    
    $database = new Database();
    $db = $database->getConnection();
    
    $item = new client($db);
    
    $data = json_decode(file_get_contents("php://input"));
    
    $item->id = $data->id;
    
    // employee values
    $item->age = $data->age;
    $item->sexe = $data->sexe;
    $item->region = $data->region;
    $item->email = $data->email;
    $item->created = date('Y-m-d H:i:s');
    
    if($item->updateclient()){
        echo json_encode("client data updated.");
    } else{
        echo json_encode("Data could not be updated");
    }
?>