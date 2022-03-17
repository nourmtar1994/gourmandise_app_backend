<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    include_once '../../config/database.php';
    include_once '../../class/users.php';
    
    $options = [
        'cost' => 12,
    ];

    $database = new Database();
    $db = $database->getConnection();
    $item = new users($db);
    $data = json_decode(file_get_contents("php://input"));

    $item->username = $data->username;
    $item->login = $data->login;
    $item->password = md5($data->password); 
    // $item->password = password_hash($data->password, PASSWORD_BCRYPT); 
    $item->updated = date('y-m-d h:i:s');
    $item->created = date('y-m-d h:i:s');
    
    if($item->create()){
        echo 'created successfully.';
    } else{
        echo ' could not be created.';
    }
?>