<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    
    include_once '../../config/database.php';
    include_once '../../class/client.php';

    $database = new Database();
    $db = $database->getConnection();
    $items = new client($db);
    $stmt = $items->getClient();
	$rows = $stmt->fetchAll();
    $itemCount = count($rows);
	
    if($itemCount > 0){
        $clientArray = array();
        $clientArray["body"] = array();
        $clientArray["itemCount"] = $itemCount;

         foreach ($rows as $row) {
            extract($row);
            $e = array(
                "id" => $id,
                "age" => $age,
                "sexe" => $sexe,
                "region" => $region,
                "age" => $age,
                "created" => $created,
            );

            array_push($clientArray["body"], $e);
        }
        echo json_encode($clientArray);
    }

    else{
        http_response_code(404);
        echo json_encode(
            array("message" => "No record found.")
        );
    }
?>