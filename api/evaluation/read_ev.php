<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    
    include_once '../../config/database.php';
    include_once '../../class/evaluation.php';

    $database = new Database();
    $db = $database->getConnection();
    $items = new evaluation($db);
    $stmt = $items->getevaluation();
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
                "id_question" => $id_question,
                "id_client" => $id_client,
                "reponse" => $reponse,
                "created" => $created,
                "id_pt_de_vente" => $id_pt_de_vente
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