<?php

    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    include_once '../../config/database.php';
    include_once '../../class/users.php';

    $database = new Database();
    $db = $database->getConnection();


if(isset($_GET['login'])  && isset($_GET['password']) ){

    $login = $_GET['login']   ; 
    $password  = md5($_GET['password']) ;  

    $sqlQuery = "SELECT * FROM users where login  = '$login'  and password = '$password' 
     ";
    $stmt = $db->prepare($sqlQuery);
    $stmt->execute();
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
}else {
    http_response_code(404);
        echo json_encode(
            array("message" => "No record found.")
        );
}


?>