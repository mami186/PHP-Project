<?php
    session_start();
    
    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    // Load config
    require_once __DIR__ . '/config/config.php';

    // Load all core/logic
    require_once __DIR__ . '/core/Database.php';
    require_once __DIR__ . '/app/routes/routes.php';

?>