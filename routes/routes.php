<?php

require_once __DIR__ . '/../config/config.php';

require_once __DIR__ . '/../app/controllers/HomeController.php';
require_once __DIR__ . '/../app/controllers/AuthController.php';
require_once __DIR__ . '/../app/controllers/DashboardController.php';
require_once __DIR__ . '/../app/controllers/UsersController.php';
require_once __DIR__ . '/../app/controllers/BudgetController.php';
require_once __DIR__ . '/../app/controllers/LogController.php';
require_once __DIR__ . '/../app/controllers/AdminController.php';
$routes = [
    '/' => ['HomeController', 'index'], //page => controller@method
    '/register' => ['AuthController', 'index'],
    '/login' => ['AuthController', 'login'],
    '/signup' => ['AuthController', 'signup'],
    '/dashboard' => ['DashboardController', 'index'],
    '/logout' => ['AuthController', 'logout'],
    '/profile' => ['UsersController', 'index'],
    '/budget' => ['BudgetController', 'index'],
    '/budget/create' => ['BudgetController', 'create'],
    '/budget/update' => ['BudgetController', 'update'],
    '/budget/delete' => ['BudgetController', 'delete'],
    '/budget/view' => ['BudgetController', 'view'],
    '/logs' => ['LogController', 'create_log'],
    '/logpage' => ['LogController', 'index'],
'/adminpg' => ['AdminController', 'showAdminPage'],
'/createdept' => ['DeptController', 'create_dept'],
'/logs/delete' => ['LogController', 'delete_log'],
];

$request = $_SERVER['REQUEST_URI'] ?? '/';
$path = parse_url($request, PHP_URL_PATH);



$baseUri = '/PHP-Project/public';
$path = str_replace($baseUri, '', $path);
$path = '/' . trim($path, '/');
if (empty(trim($path, '/'))) {
    $path = '/';
}

echo $path . "<br>" . $request;

if (array_key_exists($path, $routes)) {
    [$controller, $method] = $routes[$path];
    $instance = new $controller();
    $instance->$method();
    [$controller, $method] = $routes[$path];
    $instance = new $controller;
    echo "404 Not Found";
}
?> 