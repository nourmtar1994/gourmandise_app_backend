<?php
    class question{

        // Connection
        private $conn;

        // Table
        private $db_table = "question";

        // Columns
        public $id;
        public $label;
        public $text;
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
            $sqlQuery = "SELECT id, label, text, type, type_reponse, created,reponse FROM " . $this->db_table . "";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();
            return $stmt;
        }

        // CREATE
        public function create_question(){
            $sqlQuery = "insert into ".$this->db_table." (label,text,type,type_reponse,created,reponse) values (:label,:text,:type,:type_reponse,:created,:reponse)";
            $stmt = $this->conn->prepare($sqlQuery);
        
            // sanitize
            $this->label=htmlspecialchars(strip_tags($this->label));
            $this->text=htmlspecialchars(strip_tags($this->type_reponse));
            $this->type=htmlspecialchars(strip_tags($this->type));
            $this->type_reponse=htmlspecialchars(strip_tags($this->type_reponse));
            $this->created=htmlspecialchars(strip_tags($this->created));
            $this->reponse=htmlspecialchars(strip_tags($this->reponse));
        
            // bind data
            $stmt->bindParam(":label", $this->label);
            $stmt->bindParam(":text", $this->text);
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
            $sqlQuery = "SELECT
                        id, 
                        label, 
                        text, 
                        type, 
                        type_reponse, 
						reponse,
                        created
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
            $this->id = $dataRow['id'];
            $this->label = $dataRow['label'];
            $this->text = $dataRow['text'];
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
                        text = :text, 
                        type = :type, 
                        type_reponse = :type_reponse, 
                        reponse = :reponse,
                        created = :created
                    WHERE 
                        id = :id";
        
            $stmt = $this->conn->prepare($sqlQuery);
        
            $this->label=htmlspecialchars(strip_tags($this->label));
            $this->text=htmlspecialchars(strip_tags($this->text));
            $this->type=htmlspecialchars(strip_tags($this->type));
            $this->type_reponse=htmlspecialchars(strip_tags($this->type_reponse));
            $this->created=htmlspecialchars(strip_tags($this->created));
            $this->reponse=htmlspecialchars(strip_tags($this->reponse));
            $this->id=htmlspecialchars(strip_tags($this->id));
        
            // bind data
            $stmt->bindParam(":label", $this->label);
            $stmt->bindParam(":text", $this->text);
            $stmt->bindParam(":type", $this->type);
            $stmt->bindParam(":type_reponse", $this->type_reponse);
            $stmt->bindParam(":created", $this->created);
            $stmt->bindParam(":reponse", $this->reponse);
            $stmt->bindParam(":id", $this->id);
        
            if($stmt->execute()){
               return true;
            }
            return false;
        }

        // DELETE
        function delete_question(){
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
