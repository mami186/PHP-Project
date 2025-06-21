
<?php 
require_once __DIR__ . '/../models/UserModel.php';
class UserController{
    public function index(){
        if (!isset($_SESSION['user_id'])) {
            header('Location: /register');
            exit;
        }
        $userModel = new UserModel();
        $users = $userModel->getUsers();
        require_once __DIR__ . '/../../public/admin/user.html';
        
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

            $key = new UserModel();

            if ($key->createUser($name,$email, $adminKey, $role)) {
                exit;
            } else {
                die("Failed to create key");
            }     
        }
    }

    public function profile(){
        if (!isset($_SESSION['user_id'])) {
            header('Location: register');
            exit;
        }
        $userModel = new UserModel();
        $user = $userModel->getUserById($_SESSION['user_id']);
        require_once __DIR__ . '/../../public/profile.html';
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