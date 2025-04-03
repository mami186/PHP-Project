
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

        public function createUser($name, $email, $adminKey, $role){
            $hashedAdminKey = password_hash($adminKey, PASSWORD_BCRYPT);
            $sql = "INSERT INTO adminkeys (name, hashedKEY, email, role) VALUES (?, ?, ?, ?)";
            $stmt = $this->db->conn->prepare($sql);
            return $stmt->execute([$name, $hashedAdminKey, $email, $role]);
        }

        public function signIn($name, $email, $password){
            try {
                // Get admin key info first
                $adminKeyInfo = $this->getAdminKey($name);
                if (!$adminKeyInfo) {
                    return false; // No matching admin key found
                }
                
                $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
                $role = $adminKeyInfo['role'];
                
                // Check if email already exists
                if ($this->getUserByEmail($email)) {
                    return false; // Email already registered
                }
                
                $stmt = $this->db->conn->prepare("INSERT INTO users (role, name, email, password) VALUES (?, ?, ?, ?)");
                return $stmt->execute([$role, $name, $email, $hashedPassword]);
            } catch (PDOException $e) {
                // Log error and return false
                error_log("Error in signIn: " . $e->getMessage());
                return false;
            }
        }

        public function getAdminKey($name){
            $stmt = $this->db->conn->prepare("SELECT * FROM adminkeys WHERE name = ?");
            $stmt->execute([$name]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }

        public function getUsers(){
            $sql = "SELECT * FROM users";
            $stmt = $this->db->conn->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        public function getUserById($id){
            try {
                $stmt = $this->db->conn->prepare("SELECT * FROM users WHERE id = ?");
                if (!$stmt) {
                    die("Error: Failed to prepare statement.");
                }
                $stmt->execute([$id]);
                return $stmt->fetch(PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                die("SQL Error: " . $e->getMessage()); // Print exact SQL error
            }
        }

        public function getUserByName($name){
            $stmt = $this->db->conn->prepare("SELECT * FROM users WHERE name = ?");
            $stmt->execute([$name]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
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

        public function updateUser($id, $name, $email, ){
            $stmt = $this->db->conn->prepare("UPDATE users SET name = ?, email = ? WHERE id = ?");
            return $stmt->execute([$name, $email, $id]);
        }
        public function updateUserPassword($id, $name, $email, $password){
            $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
            $stmt = $this->db->conn->prepare("UPDATE users SET name = ?, email = ?, password = ? WHERE id = ?");    
            return $stmt->execute([$name, $email, $hashedPassword, $id]);
            
        }
    }

?>