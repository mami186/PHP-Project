
<?php

    require_once __DIR__ . '/../models/BudgetModel.php';

    class BudgetController {
        
        public function index() {
            require_once __DIR__ . '/../views/budget/budget.php';
        }

        public function create() {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $name = $_POST['name'] ?? '';
                $amount = $_POST['amount'] ?? '';
                $category = $_POST['category'] ?? '';
                $user_id = $_POST['user_id'] ?? '';
                $start_date = $_POST['start_date'] ?? '';
                $end_date = $_POST['end_date'] ?? '';
                

                if (empty($name) || empty($amount) || empty($category) || empty($user_id) || empty($start_date) || empty($end_date)) {
                    die("All fields are required!");
                    return;
                }

                $budget = new BudgetModel();

                if ($budget->createBudget($name, $amount, $category, $user_id, $start_date, $end_date)) {
                    
                    var_dump($budget->getBudgetsByUserId($user_id));
                    
                    exit;
                } else {
                    die("Failed to create budget");
                }
            }
        }

        public function update($id, $name, $amount, $category, $start_date, $end_date) {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $id = $_POST['id'] ?? '';
                $name = $_POST['name'] ?? '';
                $amount = $_POST['amount'] ?? '';
                $category = $_POST['category'] ?? '';
                $start_date = $_POST['start_date'] ?? '';
                $end_date = $_POST['end_date'] ?? '';


                if (empty($id)) {
                    die("All fields are required!");
                    return;
                }

                $budget = new BudgetModel();

                if ($budget->updateBudget($id, $name, $amount, $category)) {
                    header("Location: /budgets");
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
                    header("Location: /budgets");
                    exit;
                } else {
                    die("Failed to delete budget");
                }
            }
        }

        public function view() {
            
            $budget = new BudgetModel();
            $name = $_POST['name']?? null; // Ensure user is logged in
            if ($name) {
                echo $budget->showBudgetTable($name);
            } else {
                echo "<p>Please log in to view your budgets.</p>";
            }
        }
    }

?>