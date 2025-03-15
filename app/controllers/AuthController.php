
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

                if(empty($name) || empty($email) || empty($password)){
                    die( "Please fill in all the fields");
                    return;
                }

                echo htmlspecialchars($email) . "<br>";

                $user = new UserModel();

                if($user->getUserByEmail($email)){
                    echo "User already exists";
                    return;
                }

                if($user->createUser($name, $email, $password)){
                    // Store user data in session for logged-in state
                   
                    $_SESSION['user_id'] = $user->getUserByEmail($email)['id'];
                    $_SESSION['user_name'] = $user->getUserByEmail($email)['name'];
                    $_SESSION['user_email'] = $user->getUserByEmail($email)['email'];
                    // Redirect to a dashboard    
                    require_once __DIR__ . '/../views/dashboard.php';
                    exit;
                }else{

                    die("Failed to create user");
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
                  
                    $_SESSION['user_id'] = $existingUser['id'];
                    $_SESSION['user_name'] = $existingUser['name'];
                    $_SESSION['user_email'] = $existingUser['email'];
                    // Redirect to a dashboard    
                    require_once __DIR__ . '/../views/dashboard.php';
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
            header("Location: /");
            exit;
        }
        
    }

?>