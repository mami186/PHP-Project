
<?php 
require_once __DIR__ . '/../models/UserModel.php';
class UserController{
    public function index(){
        $userModel = new UserModel();
        $users = $userModel->getUsers();
        require_once __DIR__ . '/../views/user/user.php';
        
    }  

    public function createUsr(){
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['Name'] ?? '';
            $email = $_POST['Email'] ?? '';
            $adminKey = $_POST['adminKey'] ?? '';
            $role = $_POST['role'] ?? 'user';

            if (empty($name) || empty($adminKey)) {
                die("The Name and Adminkey field must be filled ");
                return;
            }

            $budget = new UserModel();

            if ($budget->createUser($name,$email, $adminKey, $role)) {
                exit;
            } else {
                die("Failed to create budget");
            }     
        }
    }

    public function updateP(){
        require_once __DIR__ . '/../views/user/profile.php';
        echo "Welcome to the profile page";
    }

    
}

?>