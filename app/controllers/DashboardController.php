<?php

class DashboardController {
    public function index() {

        if (!isset($_SESSION['user_role'])) {
            header('Location: ' . BASE_URL . '/register');
            exit;
        }

        if ($_SESSION['user_role'] === 'admin') {
            require_once __DIR__ . '/../../public/admin/dashboardAd.html';
            exit;
        }

        require_once __DIR__ . '/../../public/dashboard.html';
        exit;
    }

    public function userInfo() {
        require_once __DIR__ .'/../models/UserModel.php';
        if (!isset($_SESSION['user_id'])) {
            http_response_code(401);
            echo json_encode(['error' => 'Unauthorized']);
            exit;
        }

        $userModel = new UserModel();
        $user = $userModel->getUserById($_SESSION['user_id']);

        header('Content-Type: application/json');
        echo json_encode($user);
        exit;
    }
    public function apiIndex() {
        require_once __DIR__ .'/../models/UserModel.php';

        header('Content-Type: application/json');
        $userModel = new UserModel();
        $users =$userModel->getUsers(); // should be a plain array
        echo json_encode($users); // ✅ CORRECT
        exit;
    }
    public function apiBUdgets() {
        require_once __DIR__ .'/../models/BudgetModel.php';

        header('Content-Type: application/json');
        $budgetModel = new BudgetModel();
        $budgets = $budgetModel->getBudgets(); // should be a plain array
        echo json_encode($budgets); // ✅ CORRECT
        exit;
    }

}
