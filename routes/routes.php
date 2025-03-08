
<?php

require_once __DIR__ . '/../app/controllers/HomeController.php';
require_once __DIR__ . '/../app/controllers/DashboardController.php';
require_once __DIR__ . '/../app/controllers/AuthController.php';
require_once __DIR__ . '/../app/controllers/UsersController.php';
require_once __DIR__ . '/../app/controllers/BudgetController.php';
require_once __DIR__ . '/../app/controllers/LogControler.php';
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
    '/log.php' => ['LogController', 'index'],
];

//get the requested page if not homepage by default
$request = $_SERVER['REQUEST_URI'] ?? '/';

//extracting the path from the request(it has some other bullshit)
$path = parse_url($request, PHP_URL_PATH);

//check if the requested page is in the routes array
if (array_key_exists($path, $routes)) {
    [$controller, $method] = $routes[$path];
    $instance = new $controller();
    $instance->$method();
} else {
    http_response_code(404);
    echo "40444";
}

?>