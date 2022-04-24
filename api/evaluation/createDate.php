<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    include_once '../../config/database.php';
    include_once '../../class/evaluation.php';


    $database = new Database();
    $db = $database->getConnection();

    $date_evaluation = date('Y-m-d') ; 
    $day = date('d') ; 
    $month = date('m') ; 
    $year = date('Y') ; 
    $weekDay = date('w') + 1; 
    $yearQuarter = ceil($month / 3);
    $monthYear = date('Y-m') ; 
    $weekYear = date("W") ; 

    $sqlQuery = "INSERT into  date (date_evaluation , day  ,  month , year ,  weekDay ,quarter ,monthYear ,weekYear ) 
                 values('$date_evaluation','$day','$month','$year','$weekDay' ,'$yearQuarter' ,'$monthYear' , '$weekYear')";

            $stmt = $db->prepare($sqlQuery);        
            if($stmt->execute()){
               return true;
            }
            return false;
   
?>