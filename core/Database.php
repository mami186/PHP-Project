
<?php

    class Database {

        private $host = "localhost";
        // private $db_name = "budgetman";
        private $username = "root";
        private $password = "";
        public $conn;

        public function __construct(){

            try {
                $this->conn = new PDO("mysql:host=$this->host", $this->username, $this->password);
                $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                echo "Connected successfully";

                $sqlFile = __DIR__ . '/../database/budgetman.sql';
                $sql = file_get_contents($sqlFile);
                $this->conn->exec($sql);
            } catch (PDOException $e) {
                die("Connection failed: " . $e->getMessage());
            }
    
            
        }

        public function __destruct(){
            $this->conn = null;
        }
    }

?>