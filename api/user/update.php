<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: PUT");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    
    include_once '../../config/database.php';
    include_once '../../class/users.php';
    
    $database = new Database();
    $db = $database->getConnection();
    
    $item = new users($db);
    
    $data = json_decode(file_get_contents("php://input"));
    
    
    // users values
    $item->username = $data->username;
    $item->login = $data->login;
    $item->password = $data->password;

    $item->updated = date('y-m-d h:i:s');
    $item->created = date('y-m-d h:i:s');
    
    if($item->update()){
        echo json_encode(" data updated.");
    } else{
        echo json_encode("Data could not be updated");
    }
?>