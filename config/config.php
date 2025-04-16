
<?php


    require_once __DIR__ . '/../core/Database.php';

    $db = new Database();
    define('BASE_URL', rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\'));?>
