
<?php
    

    require_once __DIR__ . '/../models/BudgetModel.php';

    class BudgetController {
        
        public function index() {
            $budgetModel = new BudgetModel();
            $budgets = $budgetModel->getBudgets();

            require_once __DIR__ . '/../../public/admin/view-budget.html';
        }

        public function create() {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                
                $user_id = $_SESSION['user_id'] ?? '';
                $name = $_POST['name'] ?? '';
                $amount = $_POST['amount'] ?? null;
                $category = $_POST['category'] ?? '';
                $start_date = $_POST['start_date'] ?? '';
                $end_date = $_POST['end_date'] ?? '';
                
                if (empty($name) || empty($amount) || empty($category) || empty($user_id) || empty($start_date) || empty($end_date)) {
                    header("Location: " . BASE_URL . "/budget");
                    http_response_code(400);
                    echo json_encode(['status' => 'error', 'message' => 'All fields are required']);
                    exit;
                }

                $budget = new BudgetModel();

                if ($budget->createBudget($name, $amount, $category, $user_id, $start_date, $end_date)) {
                    header("Location: " . BASE_URL . "/budget");
                } else {
                    http_response_code(500);
                    echo json_encode(['status' => 'error', 'message' => 'Failed to create budget']);
                }
            } else {
                http_response_code(405);
                echo json_encode(['status' => 'error', 'message' => 'Method Not Allowed']);
            }
        }


        public function update() {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {

                $id = $_POST['id'] ?? '';
                $name = $_POST['name'] ?? '';
                $amount = $_POST['amount'] ?? null;
                $category = $_POST['category'] ?? '';
                $start_date = $_POST['start_date'] ?? '';
                $end_date = $_POST['end_date'] ?? '';

                $budget = new BudgetModel();

                if ($budget->updateBudget($id, $name, $amount, $category, $start_date, $end_date)) {
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
    }

?>