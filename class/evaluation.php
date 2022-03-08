<?php
    class evaluation{

        // Connection
        private $conn;

        // Table
        private $db_table = "evaluation";

        // Columns
        public $id;
        public $id_question;
        public $id_client;
        public $reponse;
        public $id_pt_de_vente;
        public $created;

        // Db connection
        public function __construct($db){
            $this->conn = $db;
        }

        // GET ALL
        public function getevaluation(){
            $sqlQuery = "SELECT id, id_question, id_client, reponse,id_pt_de_vente, created FROM " . $this->db_table . "";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();
            return $stmt;
        }

        // CREATE
        public function createevaluation(){
            $sqlQuery = "insert into ".$this->db_table." (id_question,id_client,reponse,created,id_pt_de_vente) values (:id_question,:id_client,:reponse,:created,:id_pt_de_vente)";
            $stmt = $this->conn->prepare($sqlQuery);
        
            // sanitize
            $this->id_question=htmlspecialchars(strip_tags($this->id_question));
            $this->id_client=htmlspecialchars(strip_tags($this->id_client));
            if( is_array($this->reponse)) {
                $reponses = '' ; 
                foreach ($this->reponse as  $value) {
                   $reponses = $reponses . $value .'|' ; 
                }
                $this->reponse= $reponses ; 
                var_dump($reponses);
            }else {
                $this->reponse=htmlspecialchars(strip_tags($this->reponse));
            }
            
            $this->created=htmlspecialchars(strip_tags($this->created));
            $this->id_pt_de_vente=htmlspecialchars(strip_tags($this->id_pt_de_vente));
        
            // bind data
            $stmt->bindParam(":id_question", $this->id_question);
            $stmt->bindParam(":id_client", $this->id_client);
            $stmt->bindParam(":reponse", $this->reponse);
            $stmt->bindParam(":created", $this->created);
            $stmt->bindParam(":id_pt_de_vente", $this->id_pt_de_vente);
        
            if($stmt->execute()){
               return true;
            }
            return false;
        }

        // UPDATE
        public function getSingleevaluation(){
            $sqlQuery = "SELECT
                        id, 
                        id_question, 
                        id_client, 
                        reponse, 
                        created,
                        id_pt_de_vente
                      FROM
                        ". $this->db_table ."
                    WHERE 
                       id = ?
                    ";

            $stmt = $this->conn->prepare($sqlQuery);

            $stmt->bindParam(1, $this->id);

            $stmt->execute();

            $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);
            if(!empty($dataRow)) { 
            $this->id_question = $dataRow['id_question'];
            $this->id_client = $dataRow['id_client'];
            $this->reponse = $dataRow['reponse'];
            $this->created = $dataRow['created'];
            $this->id_pt_de_vente = $dataRow['id_pt_de_vente'];
        
        }
        }        

        // UPDATE
        public function updateevaluation(){
            $sqlQuery = "UPDATE
                        ". $this->db_table ."
                    SET
                        id_question = :id_question, 
                        id_client = :id_client, 
                        reponse = :reponse, 
                        created = :created,
                        id_pt_de_vente = :id_pt_de_vente
                    WHERE 
                        id = :id";
        
            $stmt = $this->conn->prepare($sqlQuery);
        
            $this->id_question=htmlspecialchars(strip_tags($this->id_question));
            $this->id_client=htmlspecialchars(strip_tags($this->id_client));
            $this->reponse=htmlspecialchars(strip_tags($this->reponse));
            $this->created=htmlspecialchars(strip_tags($this->created));
            $this->id_pt_de_vente=htmlspecialchars(strip_tags($this->id_pt_de_vente));
            $this->id=htmlspecialchars(strip_tags($this->id));
        
            // bind data
            $stmt->bindParam(":id_question", $this->id_question);
            $stmt->bindParam(":id_client", $this->id_client);
            $stmt->bindParam(":reponse", $this->reponse);
            $stmt->bindParam(":created", $this->created);
            $stmt->bindParam(":id_pt_de_vente", $this->id_pt_de_vente);
            $stmt->bindParam(":id", $this->id);
        
            if($stmt->execute()){
               return true;
            }
            return false;
        }

        // DELETE
        function deleteevaluation(){
            $sqlQuery = "DELETE FROM " . $this->db_table . " WHERE id = ?";
            $stmt = $this->conn->prepare($sqlQuery);
        
            $this->id=htmlspecialchars(strip_tags($this->id));
        
            $stmt->bindParam(1, $this->id);
        
            if($stmt->execute()){
                return true;
            }
            return false;
        }

    }
?>

