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

?>