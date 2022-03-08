<?php
  

    include_once '../../config/database.php';
    include_once '../../class/pt_de_vente.php';

    $database = new Database();
    $db = $database->getConnection();
    $items = new point_de_vente($db);
    $stmt = $items->getpoint_de_vente();
	$rows = $stmt->fetchAll();
    $itemCount = count($rows);
	
    if($itemCount > 0){
        $employeeArr = array();
        $employeeArr["body"] = array();
        $employeeArr["itemCount"] = $itemCount;

         foreach ($rows as $row) {
            extract($row);
            $e = array(
                "id" => $id,
                "nom" => $nom,
                "region" => $region,
                "type" => $type,
                "nbr_visite" => $nbr_visite,
                "created" => $created
            );

            array_push($employeeArr["body"], $e);
        }
        echo json_encode($employeeArr);
    }

    else{
        http_response_code(404);
        echo json_encode(
            array("message" => "No record found.")
        );
    }
?>