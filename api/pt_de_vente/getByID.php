<?php

    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    include_once '../../config/database.php';
    include_once '../../class/pt_de_vente.php';


    $database = new Database();
    $db = $database->getConnection();

    $item = new point_de_vente($db);

    $item->id = isset($_GET['id']) ? $_GET['id'] : die();
  
    $item->getSinglepoint_de_vente();
    
    if($item->nom != null){
        // create array
        
        $emp_arr = array(
            "id" =>  $item->id,
            "nom" => $item->nom,
            "region" => $item->region,
            "type" => $item->type,
            "nbr_visite" => $item->nbr_visite,
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