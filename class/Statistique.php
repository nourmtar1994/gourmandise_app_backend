<?php
    class Statistique{

        // Connection
        private $conn;

        // Table
        private $db_table = "";

        // Columns
        public $ptVente;
        public $question;
        // Db connection
        public function __construct($db){
            $this->conn = $db;
        }
        // UPDATE
        public function getStatistique(){
            $sqlQuery = "SELECT  reponse  , count(reponse) as nbr from wv_statistique 
                        where labelQues like  '%$this->question%' 
                        and  nom like'%$this->ptVente%'
                        group by reponse" ;


            if($this->question != 'undefined'  ) {

            $sqlQuestion= "SELECT * from question  where label like  '%$this->question%'  " ; 

            $stmt = $this->conn->prepare($sqlQuestion);
            $stmt->execute();
            $rows = $stmt->fetchAll();
            $itemCount = count($rows);
            $questionArr = array();
            $questionArr["body"] = array();
            $questionArr["itemCount"] = $itemCount;

            foreach ($rows as $row) {
                extract($row);
                $e = array(
                    "id_question" => $id_question,
                    "reponse" => explode("#", $reponse),
                );
                array_push($questionArr["body"] , $e);
            }

                $data=array();
                $responses =  $questionArr["body"][0]['reponse']; 
            }
            if ($this->question == 'undefined' && ($this->ptVente =='undefined' ) ) {
               $sqlQuery = "SELECT  nom as reponse , nbr_visite as nbr from point_de_vente " ;
            }


            if($this->question == 'undefined' &&  $this->ptVente !='undefined'){
                 $sqlQuery = "SELECT  nom as reponse , nbr_visite as nbr from point_de_vente 
                        where nom like  '%$this->ptVente%' " ;

            }

            if($this->question != 'undefined' &&  ($this->ptVente =='undefined'   )  ) {
                 $sqlQuery = "SELECT  reponse  , count(reponse) as nbr from wv_statistique 
                        where labelQues like'%$this->question%'
                        group by reponse" ;
            }

            // echo $sqlQuery ; 

// echo $sqlQuery ; 
             $stmt = $this->conn->prepare($sqlQuery);
             $stmt->execute() ; 
             $rows = $stmt->fetchAll();
             $itemCount = count($rows);
             // var_dump($rows) ;
            if($itemCount > 0){
                    $statistique = array();
                    $statistique["body"] = array();
                    $statistique["itemCount"] = $itemCount;

                        foreach ($rows as $row) {
                          extract($row);
                          $e = array(
                             "label" =>$reponse ,  
                             "nbr" => $nbr 
                         );
                if (isset($questionArr)) {
                    $found = array_search($reponse ,$questionArr["body"][0]['reponse'] ) ;
                    unset($questionArr["body"][0]['reponse'] [$found]) ; 
                  
                }
                  array_push($statistique["body"], $e);   
            }
             if (isset($questionArr)) {
                foreach ($questionArr["body"][0]['reponse']  as $key => $value) {
                     array_push($statistique["body"], array(
                             "label" =>$value ,  
                             "nbr" => 0 
                         ));
                }     
            }    


            $data['statistique'] =  $statistique ; 
            echo json_encode($statistique);
            
            return false;
            }
}
        public function getStatistiqueChart($type){
            if ($type == "sexe") {
                $sqlQuery = "SELECT sexe as label  , count(sexe)  as nbr from client group by sexe" ; 
            }elseif ($type =='age') {
                $sqlQuery = "SELECT age as label  , count(age)  as nbr from client group by age " ; 
            }elseif ($type =='region') {
                $sqlQuery = "SELECT region as label  , count(region)  as nbr from client group by region" ; 
            }elseif ($type =='visite') {
                $sqlQuery = "SELECT  nom as label , nbr_visite as nbr from point_de_vente " ; 

            }else {
                return false ; 
            }

             $stmt = $this->conn->prepare($sqlQuery);

            if($stmt->execute()){
               return ($stmt);
            }
            return false;
        }

        public function getStatistiqueData(){
            $sqlQuery = "SELECT  * from wv_statistique";

             $stmt = $this->conn->prepare($sqlQuery);

            if($stmt->execute()){
               return $stmt;
            }
            return false;
        }

    }


 
?>

