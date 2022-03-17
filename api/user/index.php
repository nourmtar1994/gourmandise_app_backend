<?php
    include_once '../../config/database.php';
    include_once '../../class/users.php';

    $database = new Database();
    $db = $database->getConnection();
    $items = new users($db);
    $stmt = $items->getAll();
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
                "username" => $username,
                "login" => $login,
                "password" => $password,
                "updated" => $updated,
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