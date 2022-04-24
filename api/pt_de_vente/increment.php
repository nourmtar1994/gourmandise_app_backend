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
    
  if(isset($_GET['local'])){
    $local = $_GET['local'] ; 
      $sqlQuery = "UPDATE  point_de_vente set nbr_visite = nbr_visite + 1 where id = '$local' ";
    $stmt = $db->prepare($sqlQuery);

    if($stmt->execute()){
        echo json_encode(true);
    } else{
        echo json_encode(false);
    }

}else {
    echo json_encode(false);
}
?>