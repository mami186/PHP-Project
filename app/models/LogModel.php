<?php
require_once __DIR__ . '/../../core/Database.php';
class LogModel
{
    private $db;

    public function __construct()
    {

        $this->db = new Database();
        if (!$this->db->conn) {
            die("Error: Database connection failed!");
        }




    }
public function create_log($user_name,$bg_dep ,$bg_amount ,$bgcatagory ){

    $sql = "INSERT INTO logs (user_name,bg_dep,bg_amount,bgcatagory) VALUES (?,?,?,?)";
    $stmt = $this->db->conn->prepare($sql);

    return $stmt-> execute([$user_name,$bg_dep,$bg_amount,$bgcatagory]);


}
public function log_delete ($id){
    
    $sql = "DELETE FROM logs WHERE id = ?";
    $stmt = $this->db->conn->prepare($sql);

    return $stmt-> execute([$id]);
}

public function get_all_logs(){
    $sql = "SELECT * FROM logs";
    $stmt = $this->db->conn->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll();
}
public function update_log($log_id ,$bg_dep,$bg_amount,$bgcatagory){

    $sql = "UPDATE logs SET bg_dep = ?, bg_amount = ?, bgcatagory = ? WHERE log_id = ?";
    $stmt = $this->db->conn->prepare($sql);

    return $stmt-> execute([$bg_dep,$bg_amount,$bgcatagory,$log_id]);


}




}
