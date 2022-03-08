<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    
    include_once '../../config/database.php';
    include_once '../../class/question.php';

    $database = new Database();
    $db = $database->getConnection();
    $items = new question($db);
    $stmt = $items->get_question();
	$rows = $stmt->fetchAll();
    $itemCount = count($rows);
	
    if($itemCount > 0){
        $question = array();
        $question["body"] = array();
        $question["itemCount"] = $itemCount;

         foreach ($rows as $row) {
            extract($row);
            $e = array(
                "id" => $id,
                "label" => $label,
                "text" => $text,
                "type" => $type,
                "type_reponse" => $type_reponse,
                "reponse" => $reponse,
                "created" => $created
            );

            array_push($question["body"], $e);
        }
        echo json_encode($question);
    }

    else{
        http_response_code(404);
        echo json_encode(
            array("message" => "No record found.")
        );
    }
?>