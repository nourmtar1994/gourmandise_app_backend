<?php
    class question{

        // Connection
        private $conn;

        // Table
        private $db_table = "question";

        // Columns
        public $id_question;
        public $label;
        public $type;
        public $type_reponse;
        public $reponse;
        public $created;

        // Db connection
        public function __construct($db){
            $this->conn = $db;
        }

        // GET ALL
        public function get_question(){
            $sqlQuery = "SELECT * FROM " . $this->db_table . "";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();
            return $stmt;
        }

        // CREATE
        public function create_question(){
            $sqlQuery = "insert into ".$this->db_table." (label,type,type_reponse,created,reponse) values (:label,:type,:type_reponse,:created,:reponse)";
            $stmt = $this->conn->prepare($sqlQuery);
        
            // sanitize
            $this->label=htmlspecialchars(strip_tags($this->label));
            $this->type=htmlspecialchars(strip_tags($this->type));
            $this->type_reponse=htmlspecialchars(strip_tags($this->type_reponse));
            $this->created=htmlspecialchars(strip_tags($this->created));
            $this->reponse=htmlspecialchars(strip_tags($this->reponse));
        
            // bind data
            
            $stmt->bindParam(":label", $this->label);
            $stmt->bindParam(":type", $this->type);
            $stmt->bindParam(":type_reponse", $this->type_reponse);
            $stmt->bindParam(":created", $this->created);
            $stmt->bindParam(":reponse", $this->reponse);
        
            if($stmt->execute()){
               return true;
            }
            return false;
        }

        // UPDATE
        public function getSingle_question(){
            $sqlQuery = "SELECT * FROM ". $this->db_table ." WHERE id_question = ? ";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->bindParam(1, $this->id_question);
            $stmt->execute();
            $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);
            if(!empty($dataRow)) { 
            $this->id_question = $dataRow['id_question'];
            $this->label = $dataRow['label'];
            $this->type = $dataRow['type'];
            $this->type_reponse = $dataRow['type_reponse'];
            $this->reponse = $dataRow['reponse'];
            $this->created = $dataRow['created'];
        }       
     }

        // UPDATE
        public function update_question(){
            $sqlQuery = "UPDATE
                        ". $this->db_table ."
                    SET
                        label = :label, 
                        type = :type, 
                        type_reponse = :type_reponse, 
                        reponse = :reponse,
                        created = :created
                    WHERE 
                        id_question = :id_question";
        
            $stmt = $this->conn->prepare($sqlQuery);
        
            $this->label=htmlspecialchars(strip_tags($this->label));
            $this->type=htmlspecialchars(strip_tags($this->type));
            $this->type_reponse=htmlspecialchars(strip_tags($this->type_reponse));
            $this->created=htmlspecialchars(strip_tags($this->created));
            $this->reponse=htmlspecialchars(strip_tags($this->reponse));
            $this->id_question=htmlspecialchars(strip_tags($this->id_question));
        
            // bind data
            $stmt->bindParam(":label", $this->label);
            $stmt->bindParam(":type", $this->type);
            $stmt->bindParam(":type_reponse", $this->type_reponse);
            $stmt->bindParam(":created", $this->created);
            $stmt->bindParam(":reponse", $this->reponse);
            $stmt->bindParam(":id_question", $this->id_question);
        
            if($stmt->execute()){
               return true;
            }
            return false;
        }

        // DELETE
        function delete_question(){
            $sqlQuery = "DELETE FROM " . $this->db_table . " WHERE id_question = ?";
            $stmt = $this->conn->prepare($sqlQuery);
        
            $this->id_question=htmlspecialchars(strip_tags($this->id_question));
        
            $stmt->bindParam(1, $this->id_question);
        
            if($stmt->execute()){
                return true;
            }
            return false;
        }

    }
