<?php
    class point_de_vente{

        // Connection
        private $conn;

        // Table
        private $db_table = "point_de_vente";

        // Columns
        public $id;
        public $nom;
        public $region;
        public $type;
        public $nbr_visite;
        public $created;

        // Db connection
        public function __construct($db){
            $this->conn = $db;
        }

        // GET ALL
        public function getpoint_de_vente(){
            $sqlQuery = "SELECT id, nom, region, type, nbr_visite, created FROM " . $this->db_table . "";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();
            return $stmt;
        }

        // CREATE
        public function createpoint_de_vente(){
            $sqlQuery = "insert into ".$this->db_table." (nom,region,type,nbr_visite,created) values (:nom,:region,:type,:nbr_visite,:created)";
            $stmt = $this->conn->prepare($sqlQuery);
        
            // sanitize
            $this->nom=htmlspecialchars(strip_tags($this->nom));
            $this->region=htmlspecialchars(strip_tags($this->nbr_visite));
            $this->type=htmlspecialchars(strip_tags($this->type));
            $this->nbr_visite=htmlspecialchars(strip_tags($this->nbr_visite));
            $this->created=htmlspecialchars(strip_tags($this->created));
        
            // bind data
            $stmt->bindParam(":nom", $this->nom);
            $stmt->bindParam(":region", $this->region);
            $stmt->bindParam(":type", $this->type);
            $stmt->bindParam(":nbr_visite", $this->nbr_visite);
            $stmt->bindParam(":created", $this->created);
        
            if($stmt->execute()){
               return true;
            }
            return false;
        }

        // UPDATE
        public function getSinglepoint_de_vente(){
            $sqlQuery = "SELECT
                        id, 
                        nom, 
                        region, 
                        type, 
                        nbr_visite, 
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
            $this->nom = $dataRow['nom'];
            $this->region = $dataRow['region'];
            $this->type = $dataRow['type'];
            $this->nbr_visite = $dataRow['nbr_visite'];
            $this->created = $dataRow['created'];}
        }        

        // UPDATE
        public function updatepoint_de_vente(){
            $sqlQuery = "UPDATE
                        ". $this->db_table ."
                    SET
                        nom = :nom, 
                        region = :region, 
                        type = :type, 
                        nbr_visite = :nbr_visite, 
                        created = :created
                    WHERE 
                        id = :id";
        
            $stmt = $this->conn->prepare($sqlQuery);
        
            $this->nom=htmlspecialchars(strip_tags($this->nom));
            $this->region=htmlspecialchars(strip_tags($this->region));
            $this->type=htmlspecialchars(strip_tags($this->type));
            $this->nbr_visite=htmlspecialchars(strip_tags($this->nbr_visite));
            $this->created=htmlspecialchars(strip_tags($this->created));
            $this->id=htmlspecialchars(strip_tags($this->id));
        
            // bind data
            $stmt->bindParam(":nom", $this->nom);
            $stmt->bindParam(":region", $this->region);
            $stmt->bindParam(":type", $this->type);
            $stmt->bindParam(":nbr_visite", $this->nbr_visite);
            $stmt->bindParam(":created", $this->created);
            $stmt->bindParam(":id", $this->id);
        
            if($stmt->execute()){
               return true;
            }
            return false;
        }

        // DELETE
        function deletepoint_de_vente(){
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

