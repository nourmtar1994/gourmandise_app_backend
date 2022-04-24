<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    include_once '../../config/database.php';
    include_once '../../class/client.php';

    $database = new Database();
    $db = $database->getConnection();

    $item = new client($db);


    $item->email = isset($_GET['email']) ? $_GET['email'] : '';
    $item->getSingleclient();

    if($item->age != null){
        // create array
        $emp_arr = array(
            "id" =>  $item->id,
            "age" => $item->age,
            "sexe" => $item->sexe,
            "region" => $item->region,
            "email" => $item->email,
            "created" => $item->created
        );
      
        http_response_code(200);
        echo json_encode($emp_arr);
    }
      
    else{
        http_response_code(200);
        echo json_encode(false);
    }
?>