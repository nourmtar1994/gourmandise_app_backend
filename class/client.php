<?php
class client
{

    // Connection
    private $conn;

    // Table
    private $db_table = "client";

    // Columns
    public $id;
    public $age;
    public $sexe;
    public $region;
    public $email;
    public $created;

    // Db connection
    public function __construct($db)
    {
        $this->conn = $db;
    }

    // GET ALL
    public function getClient()
    {
        $sqlQuery = "SELECT id, age, sexe, region, email, created FROM " . $this->db_table . "";
        $stmt = $this->conn->prepare($sqlQuery);
        $stmt->execute();
        return $stmt;
    }

    // CREATE
    public function createclient()
    {
        $sqlQuery = "insert into " . $this->db_table . " (age,sexe,region,email,created) values (:age,:sexe,:region,:email,:created)";
        $stmt = $this->conn->prepare($sqlQuery);

        // sanitize
        $this->age = htmlspecialchars(strip_tags($this->age));
        $this->sexe = htmlspecialchars(strip_tags($this->email));
        $this->region = htmlspecialchars(strip_tags($this->region));
        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->created = htmlspecialchars(strip_tags($this->created));

        // bind data
        $stmt->bindParam(":age", $this->age);
        $stmt->bindParam(":sexe", $this->sexe);
        $stmt->bindParam(":region", $this->region);
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":created", $this->created);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    // UPDATE
    public function getSingleclient()
    {
        $sqlQuery = "SELECT
                        id, 
                        age, 
                        sexe, 
                        region, 
                        email, 
                        created
                      FROM
                        " . $this->db_table . "
                    WHERE 
                       email = ?
                   ";

        $stmt = $this->conn->prepare($sqlQuery);

        $stmt->bindParam(1, $this->id);

        $stmt->execute();

        $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!empty($dataRow)) {
            $this->age = $dataRow['age'];
            $this->sexe = $dataRow['sexe'];
            $this->region = $dataRow['region'];
            $this->email = $dataRow['email'];
            $this->created = $dataRow['created'];
        }
    }

    // UPDATE
    public function updateclient()
    {
        $sqlQuery = "UPDATE
                        " . $this->db_table . "
                    SET
                        age = :age, 
                        sexe = :sexe, 
                        region = :region, 
                        email = :email, 
                        created = :created
                    WHERE 
                        id = :id";

        $stmt = $this->conn->prepare($sqlQuery);

        $this->age = htmlspecialchars(strip_tags($this->age));
        $this->sexe = htmlspecialchars(strip_tags($this->sexe));
        $this->region = htmlspecialchars(strip_tags($this->region));
        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->created = htmlspecialchars(strip_tags($this->created));
        $this->id = htmlspecialchars(strip_tags($this->id));

        // bind data
        $stmt->bindParam(":age", $this->age);
        $stmt->bindParam(":sexe", $this->sexe);
        $stmt->bindParam(":region", $this->region);
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":created", $this->created);
        $stmt->bindParam(":id", $this->id);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    // DELETE
    function deleteclient()
    {
        $sqlQuery = "DELETE FROM " . $this->db_table . " WHERE id = ?";
        $stmt = $this->conn->prepare($sqlQuery);

        $this->id = htmlspecialchars(strip_tags($this->id));

        $stmt->bindParam(1, $this->id);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
}
