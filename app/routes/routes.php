<?php

require_once __DIR__ . '/../controllers/HomeController.php';
require_once __DIR__ . '/../controllers/AuthController.php';
require_once __DIR__ . '/../controllers/DashboardController.php';
require_once __DIR__ . '/../controllers/UserController.php';
require_once __DIR__ . '/../controllers/BudgetController.php';

// Define all routes
$routes = [
    '/' => ['HomeController', 'index'],
    '/register' => ['AuthController', 'index'],
    '/login' => ['AuthController', 'login'],
    '/signup' => ['AuthController', 'signup'],
    '/usrpage' => ['UserController','index'],
    '/dashboard' => ['DashboardController', 'index'],
    '/logout' => ['AuthController', 'logout'],
    '/user' => ['UserController', 'index'],
    '/profile' => ['UserController', 'profile'],
    '/profile/update' => ['UserController', 'updateP'],
    '/budget' => ['BudgetController', 'index'],
    '/budget/create' => ['BudgetController', 'create'],
    '/budget/update' => ['BudgetController', 'update'],
    '/budget/delete' => ['BudgetController', 'delete'],
    '/create-user' => ['UserController', 'createUsr'],
    '/api/user' => ['DashboardController', 'userInfo'],
    '/apiIndex' => ['DashboardController', 'apiIndex'],
    '/api/budgets' => ['DashboardController', 'apiBUdgets'],
];
// Dynamically extract and normalize path
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$baseFolder = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\');

// Strip the base folder from the request URI
$path = preg_replace('#^' . preg_quote($baseFolder) . '#', '', $uri);
$path = '/' . trim($path, '/');


// Special case: root
if ($path === '/' || $path === '') {
    $path = '/';
}

// Match route
if (array_key_exists($path, $routes)) {
    [$controller, $method] = $routes[$path];
    $instance = new $controller();
    $instance->$method();
} else {
    http_response_code(404);
    echo "404 Very Not Found";
}
