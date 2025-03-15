<?php
require_once __DIR__ . '/../../core/Database.php';

class LogModel {
    private $db;

    public function __construct() {
        $this->db = new Database();
        if (!$this->db->conn) {
            die("Error: Database connection failed!");
        }
    }

    public function create_log($user_name, $bg_dep, $bg_amount, $bg_catagory) {
        $sql = "INSERT INTO logs (user_name, bg_dep, bg_amount, description) VALUES (?, ?, ?, ?)";
        $stmt = $this->db->conn->prepare($sql);
        return $stmt->execute([$user_name, $bg_dep, $bg_amount, $bg_catagory]);
    }

    public function log_delete($log_id) {
        $sql = "DELETE FROM logs WHERE log_id = ?";
        $stmt = $this->db->conn->prepare($sql);
        return $stmt->execute([$log_id]);
    }

    public function get_all_logs() {
        $sql = "SELECT * FROM logs";
        $stmt = $this->db->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function update_log($log_id, $bg_dep, $bg_amount, $bg_catagory) {
        $sql = "UPDATE logs SET bg_dep = ?, bg_amount = ?, description = ? WHERE log_id = ?";
        $stmt = $this->db->conn->prepare($sql);
        return $stmt->execute([$bg_dep, $bg_amount, $bg_catagory, $log_id]);
    }
}