
<?php 

class UsersController{
    public function index(){
        require_once __DIR__ . '/../views/user/profile.php';
        echo "Welcome to the profile page";
    }
}

?>