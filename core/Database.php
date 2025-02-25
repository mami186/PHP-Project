
<?php

    class Database {

        private $host = "localhost";
        private $db_name = "budgetman";
        private $username = "root";
        private $password = "killpill";
        public $conn;

        public function __construct(){
            try{
                $this->conn = new PDO("mysql:host=$this->host;dbname=$this->db_name;charset=utf8mb4", $this->username, $this->password);
                $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            }catch(PDOException $e){
                die("Failed to connect to the database: " . $e->getMessage());
            }
            
        }
    }

?>