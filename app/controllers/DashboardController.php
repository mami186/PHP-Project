
<?php 

class DashboardController{
    public function index(){
        if($_SESSION['user_role'] == 'admin'){
            require_once __DIR__ . '/../views/admin/dashboardAd.php';
            exit();
        }
        require_once __DIR__ . '/../views/dashboard.php';
        
        
    }
}

?>
