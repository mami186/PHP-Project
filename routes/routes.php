<?php

require_once __DIR__ . '/../config/config.php';

require_once __DIR__ . '/../app/controllers/HomeController.php';
require_once __DIR__ . '/../app/controllers/AuthController.php';
require_once __DIR__ . '/../app/controllers/DashboardController.php';
require_once __DIR__ . '/../app/controllers/UserController.php';
require_once __DIR__ . '/../app/controllers/BudgetController.php';
require_once __DIR__ . '/../app/controllers/LogController.php';
$routes = [
    '/' => ['HomeController', 'index'], //page => controller@method
    '/register' => ['AuthController', 'index'],
    '/login' => ['AuthController', 'login'],
    '/signup' => ['AuthController', 'signup'],
    '/usrpage' => ['UserController','index'],
    '/dashboard' => ['DashboardController', 'index'],
    '/logout' => ['AuthController', 'logout'],
    '/profile' => ['UserController', 'profile'],
    '/profile/update' => ['UserController', 'updateP'],
    '/budget' => ['BudgetController', 'index'],
    '/budget/create' => ['BudgetController', 'create'],
    '/budget/update' => ['BudgetController', 'update'],
    '/budget/delete' => ['BudgetController', 'delete'],
    '/budget/view' => ['BudgetController', 'view'],
    '/logs' => ['LogController', 'create_log'],
    '/logpage' => ['LogController', 'index'],
    '/create-user' => ['UserController', 'createUsr']
];

$request = $_SERVER['REQUEST_URI'] ?? '/';
$path = parse_url($request, PHP_URL_PATH);



$baseUri = BASE_URL;
$path = str_replace($baseUri, '', $path);
$path = '/' . trim($path, '/');
if (empty(trim($path, '/'))) {
    $path = '/';
}

if (array_key_exists($path, $routes)) {
    [$controller, $method] = $routes[$path];
    $instance = new $controller();
    $instance->$method();
} else {
    http_response_code(404);
    echo "404 Not Found" . "<br>";
    
}

?>
