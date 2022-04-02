<?php
    include_once '../../config/database.php';
    include_once '../../class/Statistique.php';

    $database = new Database();
    $db = $database->getConnection();
    $items = new Statistique($db);
 
	
    $data = json_decode(file_get_contents("php://input"));
    $items->ptVente = $_GET['ptVente'];
    $items->question = $_GET['question'];


    $stmt = $items->getStatistique();
    $rows = $stmt->fetchAll();
    $itemCount = count($rows);

    if($itemCount > 0){
        $employeeArr = array();
        $employeeArr["body"] = array();
        $employeeArr["itemCount"] = $itemCount;

         foreach ($rows as $row) {
            extract($row);
            $e = array(
                // "idEv" => $idEv,
                // "id_client" => $id_client,
                // "id_pt_de_vente" => $id_pt_de_vente,
                // "nom" => $nom,
                // "region" => $region,
                // "idQues" => $idQues , 
                // "labelQues" => $labelQues , 
                // "reponse" => $reponse 

                "reponse" =>$reponse ,  
                "nbr" => $nbr 

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