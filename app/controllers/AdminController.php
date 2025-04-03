<?php
require_once __DIR__ . '/../models/AdminModel.php';

class AdminController {
    private $adminModel;

    public function __construct() {
        $this->adminModel = new AdminModel();
    }

    // Handle form submissions
    public function handleRequest() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (isset($_POST['create_department'])) {
                if (isset($_POST['department_name']) && isset($_POST['description'])) {
                    $this->adminModel->createDepartment($_POST['department_name'], $_POST['description']);
                    echo "Department created successfully!";
                } else {
                    echo "Error: Missing department name or description.";
                }
            
                if (isset($_POST['department_id']) && isset($_POST['allocated_budget']) && isset($_POST['start_date']) && isset($_POST['end_date'])) {
                    $this->adminModel->allocateBudget($_POST['department_id'], $_POST['allocated_budget'], $_POST['start_date'], $_POST['end_date']);
                    echo "Budget allocated successfully!";
                } else {
                    echo "Error: Missing budget allocation details.";
                }
            
                if (isset($_POST['user_name']) && isset($_POST['user_email']) && isset($_POST['user_password']) && isset($_POST['department_id'])) {
                    $this->adminModel->assignUser($_POST['user_name'], $_POST['user_email'], $_POST['user_password'], $_POST['department_id']);
                    echo "User assigned successfully!";
                } else {
                    echo "Error: Missing user assignment details.";
                }
            }
            }
        } // Closing brace for handleRequest method
    
            if (isset($_POST['allocate_budget'])) {
            $this->adminModel->allocateBudget($_POST['department_id'], $_POST['allocated_budget'], $_POST['start_date'], $_POST['end_date']);
            echo "Budget allocated successfully!";
        }

        if (isset($_POST['assign_user'])) {
            $this->adminModel->assignUser($_POST['user_name'], $_POST['user_email'], $_POST['user_password'], $_POST['department_id']);
            echo "User assigned successfully!";
        }
    }

    // Display Admin Management Page
    public function showAdminPage() {
        $departments = $this->adminModel->getDepartments();
        $users = $this->adminModel->getUsers();
        require_once __DIR__ . '/../views/user/Admin.php';
    }
?>
