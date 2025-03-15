
<?php 

class UsersController{
    public function index(){
        $user = new UserModel();
        $users = $user->getUser();
        require_once __DIR__ . '/../views/deptPage.php';
        require_once __DIR__ . '/../views/user/profile.php';
        echo "Welcome to the profile page";
    }
}

?>