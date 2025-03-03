
<?php 

class UsersController{
    public function index(){
        $userModel = new UserModel();
        $users = $userModel->getUsers();
        require_once __DIR__ . '/../views/user/users.php';
        
    }

    public function addusr(){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $name = $_POST['addName'] ?? '';
            $email = $_POST['addEmail'] ?? '';
            $password = $_POST['addPassword'] ?? '';
            $adminkey = $_POST['adminkey'] ?? '';
            $role = $_POST['role'] ?? '';

            if(empty($name) || empty($adminkey) || empty($role)){
                echo $name . $adminkey . $role;
                die( "Please fill in all the fields marked");
                return;
            }

            $user = new UserModel();

            if($user->getUserByEmail($email)){
                echo "User already exists";
                return;
            }

            if($user->createUser($name, $email, $password, $role, $adminkey)){

                
                // Store user data in session for logged-in state
                // session_start();
                // $_SESSION['user_id'] = $user->getUserByEmail($email)['id'];
                // $_SESSION['user_name'] = $user->getUserByEmail($email)['name'];
                // $_SESSION['user_email'] = $user->getUserByEmail($email)['email'];
                // $_SESSION['user_role'] = $user->getUserByEmail($email)['role'];
                exit;
            }else{

                die("Failed to create user");
            }
            
        }
    }

    public function updateP(){
        require_once __DIR__ . '/../views/user/profile.php';
        echo "Welcome to the profile page";
    }
}

?>