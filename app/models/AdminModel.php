<?php

require_once __DIR__ . '/../../core/Database.php';

class AdminModel {

    private $db;

    public function __construct(){
        $this->db = new Database();
        if (!$this->db->conn) {
            die("Error: Database connection failed!");
        }
    }
    // Create a new department
    public function createDepartment($name, $description) {
        $stmt = $this->db->conn->prepare("INSERT INTO departments (department_name, description) VALUES (?, ?)");
        return $stmt->execute([$name, $description]);
    }

    // Allocate a budget to a department
    public function allocateBudget($department_id, $amount, $start_date, $end_date) {
        $stmt = $this->db->conn->prepare("INSERT INTO budgets (department_id, bg_amount, bg_start_date, bg_end_date) VALUES (?, ?, ?, ?)");
        return $stmt->execute([$department_id, $amount, $start_date, $end_date]);
    }

    // Assign a user to a department
    public function assignUser($name, $email, $password, $department_id) {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $this->db->conn->prepare("INSERT INTO users (name, email, password, department_id) VALUES (?, ?, ?, ?)");
        return $stmt->execute([$name, $email, $hashed_password, $department_id]);
    }

    // Fetch all departments with allocated budgets
    public function getDepartments() {
        $sql = "SELECT d.*, IFNULL(SUM(b.bg_amount), 0) AS allocated_budget
                FROM departments d
                LEFT JOIN budgets b ON d.id = b.department_id
                GROUP BY d.id";
        return $this->db->conn->query($sql);
    }

    // Fetch all users and their departments
    public function getUsers() {
        $sql = "SELECT u.*, d.department_name 
                FROM users u
                LEFT JOIN departments d ON u.department_id = d.id";
        return $this->db->conn->query($sql);
    }
}
?>
