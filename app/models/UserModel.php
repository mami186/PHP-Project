
<?php

    require_once __DIR__ . '/../../core/Database.php';

    class UserModel {

        private $db;

        public function __construct(){
            $this->db = new Database();
            if (!$this->db->conn) {
                die("Error: Database connection failed!");
            }
        }

        public function createUser($name, $email, $password){
            $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
            $stmt = $this->db->conn->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
            return $stmt->execute([$name, $email, $hashedPassword]);
        }

        public function getUserByEmail($email){
            try {
                $stmt = $this->db->conn->prepare("SELECT * FROM users WHERE email = ?");
                if (!$stmt) {
                    die("Error: Failed to prepare statement.");
                }
                $stmt->execute([$email]);
                return $stmt->fetch(PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                die("SQL Error: " . $e->getMessage()); // Print exact SQL error
            }
        }
        
        public function getUser(){
            
            return $stmt = $this->db->conn->query("SELECT * FROM users");
        }
        
    }

?>