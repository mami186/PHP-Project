
<?php
    

    require_once __DIR__ . '/../models/BudgetModel.php';

    class BudgetController {
        
        public function index() {
            $budgetModel = new BudgetModel();
            $budgets = $budgetModel->getBudgets();

            require_once __DIR__ . '/../views/budget/view-budget.php';
        }

        public function create() {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $user_id = $_POST['user_id'] ?? '';
                $name = $_POST['name'] ?? '';
                $amount = $_POST['amount'] ?? '';
                $category = $_POST['category'] ?? '';
                $start_date = $_POST['start_date'] ?? '';
                $end_date = $_POST['end_date'] ?? '';
                

                if (empty($name) || empty($amount) || empty($category) || empty($user_id) || empty($start_date) || empty($end_date)) {
                    
                    echo $name . $user_id . $amount . $category . $start_date. $end_date;
                    die("All fields are required!");
                    return;
                }

                $budget = new BudgetModel();

                if ($budget->createBudget($name, $amount, $category, $user_id, $start_date, $end_date)) {
                    
                    header("Location: " . BASE_URL . "/budget");
                    exit;
                } else {
                    die("Failed to create budget");
                }     
            }
        }

        public function update() {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $id = $_POST['id'] ?? '';
                $name = $_POST['name'] ?? '';
                $amount = $_POST['amount'] ?? 0;
                $category = $_POST['category'] ?? '';
                $start_date = $_POST['start_date'] ?? '';
                $end_date = $_POST['end_date'] ?? '';

                echo $id . $name . $category; 
                if (empty($id)) {
                    die("id not set");
                    return;
                }

                $budget = new BudgetModel();

                if ($budget->updateBudget($id, $name, $amount, $category, $start_date, $end_date)) {
                    echo "update";
                    header("Location: " . BASE_URL . "/budget");
                    exit;
                } else {
                    die("Failed to update budget");
                }
            }
        }

        public function delete() {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $id = $_POST['id'] ?? '';

                if (empty($id)) {
                    die("ID is required!");
                    return;
                }

                $budget = new BudgetModel();

                if ($budget->deleteBudget($id)) {
                    header("Location: " . BASE_URL . "/budget");
                    exit;
                } else {
                    die("Failed to delete budget");
                }
            }
        }

        // public function view() {
            
        //     $budget = new BudgetModel();
        //     $name = $_POST['name']?? null; // Ensure user is logged in
        //     if ($name) {
        //         echo $budget->showBudgetTable($name);
        //     } else {
        //         echo "<p>Please log in to view your budgets.</p>";
        //     }
        // }
    }

?>