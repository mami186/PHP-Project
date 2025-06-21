
<?php

    require_once __DIR__ . '/../../core/Database.php';

    class BudgetModel {

        private $db;

        public function __construct(){
            $this->db = new Database();
            if (!$this->db->conn) {
                die("Error: Database connection failed!");
            }
        }

        public function createBudget($name, $amount, $category, $user_id, $start_date, $end_date){
            $sql = "INSERT INTO budgets (name, amount, category, user_id, start_date, end_date) VALUES (?, ?, ?, ?, ?, ?)";
            $stmt = $this->db->conn->prepare($sql);
            return $stmt->execute([$name, $amount, $category, $user_id, $start_date, $end_date]);
        }

        public function getBudgets(){
            $sql = "SELECT * FROM budgets";
            $stmt = $this->db->conn->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        public function getBudgetsByUserId($user_id){
            try {
                $sql = "SELECT * FROM budgets WHERE user_id = ?";
                $stmt = $this->db->conn->prepare($sql);
                if (!$stmt) {
                    die("Error: Failed to prepare statement.");
                }
                $stmt->execute([$user_id]);
                return $stmt->fetchAll(PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                die("SQL Error: " . $e->getMessage()); // Print exact SQL error
            }
        }

        public function getBudgetByName($name){
            try {
                $stmt = $this->db->conn->prepare("SELECT * FROM budgets WHERE name = ?");
                if (!$stmt) {
                    die("Error: Failed to prepare statement.");
                }
                $stmt->execute([$name]);
                return $stmt->fetch(PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                die("SQL Error: " . $e->getMessage()); // Print exact SQL error
            }
        }

        public function getBudgetById($id){
            $stmt = $this->db->conn->prepare("SELECT * FROM budgets WHERE id =?");
            $stmt->execute([$id]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }

        public function updateBudget($id, $name, $amount, $category, $start_date, $end_date){
            $stmt = $this->db->conn->prepare("UPDATE budgets SET name= ?, amount = ?, category = ?, start_date = ?, end_date = ? WHERE id = ?");
            return $stmt->execute([ $name, $amount, $category, $start_date, $end_date, $id]);
        }

        public function deleteBudget($id){
            $stmt = $this->db->conn->prepare("DELETE FROM budgets WHERE id = ?");
            return $stmt->execute([$id]);
        }
        
        public function lastInsertId() {
            return $this->db->lastInsertId();
        }
       
    }

?>