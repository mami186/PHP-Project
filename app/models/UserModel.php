
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

        public function createUser($name, $email, $password, $role, $adminkey){
            $hashedadminkey = password_hash($adminkey, PASSWORD_BCRYPT);
            $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
            $stmt = $this->db->conn->prepare("INSERT INTO adminkeys (name, hashedKEY, email, password, role) VALUES (?, ?, ?, ?, ?)");
            return $stmt->execute([$name, $hashedadminkey, $email, $hashedPassword, $role]);
        }

        public function getUsers(){
            $sql = "SELECT * FROM users";
            $stmt = $this->db->conn->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
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

        public function getUserByName($name){
            try {
                $stmt = $this->db->conn->prepare("SELECT * FROM users WHERE name = ?");
                if (!$stmt) {
                    die("Error: Failed to prepare statement.");
                }
                $stmt->execute([$name]);
                return $stmt->fetch(PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                die("SQL Error: " . $e->getMessage()); // Print exact SQL error
            }
        }

        public function getAdminkeyByName($name){
            try {
                $stmt = $this->db->conn->prepare("SELECT * FROM adminkeys WHERE name = ?");
                if (!$stmt) {
                    die("Error: Failed to prepare statement.");
                }
                $stmt->execute([$name]);
                return $stmt->fetch(PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                die("SQL Error: " . $e->getMessage()); // Print exact SQL error
            }
        }

        public function signusr($name, $email, $password){
            $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
            $role = $this->getAdminkeyByName($name)['role'];
            $stmt = $this->db->conn->prepare("INSERT INTO users (role, name, email, password) VALUES (?, ?, ?, ?)");
            return $stmt->execute([$role, $name, $email, $hashedPassword]);
        }
        
    }

?>