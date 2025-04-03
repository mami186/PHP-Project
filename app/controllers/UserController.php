
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

    public function profile(){
        $userModel = new UserModel();
        $user = $userModel->getUserById($_SESSION['user_id']);
        require_once __DIR__ . '/../views/user/profile.php';
        echo "Welcome to the profile page";
    }

    public function updateP(){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $id = $_POST['id'] ?? '';
            $name = $_POST['name'] ?? '';
            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';

            $userModel = new UserModel();
            if(empty($password)){
                
                $userModel->updateUser($id, $name,$email,);
                header("Location: " . BASE_URL . "/profile");
                exit;
            }
            
            $userModel->updateUserPassword($id, $name,$email,$password);
            header("Location: " . BASE_URL . "/profile");
            exit;
            
        }
    }

    
}

?>