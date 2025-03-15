
<?php 

    
require_once __DIR__ .'/../models/UserModel.php';

class AuthController {

     public function index() {
        require_once __DIR__ . '/../views/register.php';
     }

    public function signup(){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $name = $_POST['name'] ?? '';
            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';
            $adminkey = $_POST['adminkey'] ?? '';

            if(empty($name) || empty($adminkey)){
                die( "Please fill in all the required fields");
                return;
            }

            $user = new UserModel();

            if($user->getUserByEmail($email) || $user->getUserByName($name)){
                echo "User already exists";
                return;
            }
            $existingkey = $user->getAdminkey($name);
            if($existingkey){
                if (!password_verify($adminkey, $existingkey['hashedKEY'])){
                    die("Ivalid adminkey");
                    return;
                }
                if(!$existingkey['email']){
                    if($user->signIn($name, $email, $password)){
                        // Store user data in session for logged-in state
                        session_start();
                        $_SESSION['user_id'] = $user->getUserByEmail($email)['id'];
                        $_SESSION['user_name'] = $user->getUserByEmail($email)['name'];
                        $_SESSION['user_email'] = $user->getUserByEmail($email)['email'];
                        $_SESSION['user_role'] = $user->getUserByEmail($email)['role'];
                        header("Location: ".BASE_URL."/dashboard");
                        exit;
                    }else{
                        die('not set email');
                        return;
                    }
                }elseif($email == $existingkey['email']){
                    if($user->signIn($name, $email, $password)){
                        // Store user data in session for logged-in state
                        session_start();
                        $_SESSION['user_id'] = $user->getUserByEmail($email)['id'];
                        $_SESSION['user_name'] = $user->getUserByEmail($email)['name'];
                        $_SESSION['user_email'] = $user->getUserByEmail($email)['email'];
                        $_SESSION['user_role'] = $user->getUserByEmail($email)['role'];
                        header("Location: ".BASE_URL."/dashboard");
                        exit;
                    }else{
                        die(' set email not correct');
                        return;
                    }
                }
                else{

                    die("something wong");
                    return;
                }
            }else{
                die("this key not right");
                return;
            }
            
        }
    }

    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';
    
            if (empty($email) || empty($password)) {
                die( "All fields are required!");
                return;
            }
    
            $user = new UserModel();
            $existingUser = $user->getUserByEmail($email);
    
            if (!$existingUser) {
                die("Invalid user");
                return;
            }
            elseif (!password_verify($password, $existingUser['password'])){
                die("Ivalid password");
                return;
            }
            else{
                // Store user data in session for logged-in state
                session_start();
                $_SESSION['user_id'] = $user->getUserByEmail($email)['id'];
                $_SESSION['user_name'] = $user->getUserByEmail($email)['name'];
                $_SESSION['user_email'] = $user->getUserByEmail($email)['email'];
                $_SESSION['user_role'] = $user->getUserByEmail($email)['role'];
                // Redirect to a dashboard    
                header("Location: ".BASE_URL."/dashboard");
                exit;
            }
            
            
            
        }
    }

    public function logout() {
        session_start();
        session_unset();
        session_destroy();
        echo "Logged out successfully!";
        // Redirect to homepage or login page
        header("Location: <?=BASE_URL?>/");
        exit;
    }
    
}

?>