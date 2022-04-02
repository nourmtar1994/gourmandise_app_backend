<?php
    include_once '../../config/database.php';
    include_once '../../class/Statistique.php';

    $database = new Database();
    $db = $database->getConnection();
    $items = new Statistique($db);
    $stmt = $items->getStatistiqueData();
    $rows = $stmt->fetchAll();
    $itemCount = count($rows);

    if($itemCount > 0){
        $employeeArr = array();
        $employeeArr["body"] = array();
        $employeeArr["itemCount"] = $itemCount;

         foreach ($rows as $row) {
            extract($row);
            $e = array(
                "idEv" => $idEv,
                "id_client" => $id_client,
                "id_pt_de_vente" => $id_pt_de_vente,
                "nom" => $nom,
                "region" => $region,
                "idQues" => $idQues , 
                "labelQues" => $labelQues , 
                "reponse" => $reponse 
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