<?php
    class users{

        // Connection
        private $conn;

        // Table
        private $db_table = "users";

        // Columns
        public $id;
        public $username;
        public $login;
        public $password;
        public $created;
        public $updated;

        // Db connection
        public function __construct($db){
            $this->conn = $db;
        }

        // GET ALL
        public function getAll(){
            $sqlQuery = "SELECT * FROM " . $this->db_table . "";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();
            return $stmt;
        }

        // CREATE
        public function create(){
            $sqlQuery = "insert into ".$this->db_table." (username,login,password,created,updated) values (:username,:login,:password,:created,:updated)";
            $stmt = $this->conn->prepare($sqlQuery);
        
            // sanitize
            $this->username=htmlspecialchars(strip_tags($this->username));
            $this->login=htmlspecialchars(strip_tags($this->login));
            $this->password=htmlspecialchars(strip_tags($this->password));
            $this->updated=htmlspecialchars(strip_tags($this->updated));
            $this->created=htmlspecialchars(strip_tags($this->created));
        
            // bind data
            $stmt->bindParam(":username", $this->username);
            $stmt->bindParam(":login", $this->login);
            $stmt->bindParam(":password", $this->password);
            $stmt->bindParam(":updated", $this->updated);
            $stmt->bindParam(":created", $this->created);
        
            if($stmt->execute()){
               return true;
            }
            return false;
        }

        // GetByid
        public function getById(){
            $sqlQuery = "SELECT
                        id, 
                        username, 
                        login, 
                        password, 
                        updated, 
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
            $this->username = $dataRow['username'];
            $this->login = $dataRow['login'];
            $this->password = $dataRow['password'];
            $this->updated = $dataRow['updated'];
            $this->created = $dataRow['created'];}
        }        

        // UPDATE
        public function update(){
            $sqlQuery = "UPDATE
                        ". $this->db_table ."
                    SET
                        username = :username, 
                        login = :login, 
                        password = :password, 
                        updated = :updated, 
                        created = :created
                    WHERE 
                        id = :id";
        
            $stmt = $this->conn->prepare($sqlQuery);
        
            $this->username=htmlspecialchars(strip_tags($this->username));
            $this->login=htmlspecialchars(strip_tags($this->login));
            $this->password=htmlspecialchars(strip_tags($this->password));
            $this->updated=htmlspecialchars(strip_tags($this->updated));
            $this->created=htmlspecialchars(strip_tags($this->created));
            $this->id=htmlspecialchars(strip_tags($this->id));
        
            // bind data
            $stmt->bindParam(":username", $this->username);
            $stmt->bindParam(":login", $this->login);
            $stmt->bindParam(":password", $this->password);
            $stmt->bindParam(":updated", $this->updated);
            $stmt->bindParam(":created", $this->created);
            $stmt->bindParam(":id", $this->id);
        
            if($stmt->execute()){
               return true;
            }
            return false;
        }

        // DELETE
        function delete(){
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

