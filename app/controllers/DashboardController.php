
<?php 

class DashboardController{
    public function index(){
        require_once __DIR__ . '/../views/dashboard.php';
        echo "Welcome to the dashboard";
    }
}

?>
