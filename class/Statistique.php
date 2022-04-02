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


            if ($this->question == 'undefined' && $this->ptVente == 'undefined') {
               $sqlQuery = "SELECT  nom as reponse , count(nom) as nbr from wv_statistique group by nom" ;
            }


            if($this->question == 'undefined' &&  $this->ptVente !='undefined'){
                 $sqlQuery = "SELECT  reponse  , count(reponse) as nbr from wv_statistique 
                        where nom like  '%$this->ptVente%' 
                        group by reponse" ;
            }

            if($this->question != 'undefined' &&  $this->ptVente =='undefined'){
                 $sqlQuery = "SELECT  reponse  , count(reponse) as nbr from wv_statistique 
                        where labelQues like'%$this->question%'
                        group by reponse" ;
            }

// echo $sqlQuery ; 
             $stmt = $this->conn->prepare($sqlQuery);

            if($stmt->execute()){
               return $stmt;
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

