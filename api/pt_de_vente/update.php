<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: PUT");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    
    include_once '../../config/database.php';
    include_once '../../class/pt_de_vente.php';
    
    $database = new Database();
    $db = $database->getConnection();
    
    $item = new point_de_vente($db);
    
    $data = json_decode(file_get_contents("php://input"));
    
    $item->id = $data->id;
    
    // employee values
    $item->nom = $data->nom;
    $item->region = $data->region;
    $item->type = $data->type;
    $item->nbr_visite = $data->nbr_visite;
    $item->created = date('Y-m-d H:i:s');
    
    if($item->updatepoint_de_vente()){
        echo json_encode(" data updated.");
    } else{
        echo json_encode("Data could not be updated");
    }
?>