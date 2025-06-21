<?php

    require_once __DIR__ . '/../core/Database.php';

    // Dynamically get the base URL
    $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? "https" : "http";
    $host = $_SERVER['HTTP_HOST'];
    $scriptName = dirname($_SERVER['SCRIPT_NAME']);
    $baseUrl = rtrim($protocol . '://' . $host . $scriptName, '/');

    define('BASE_URL', $baseUrl);
    define('BASE_DIR', $baseUrl = rtrim(dirname(dirname($_SERVER['SCRIPT_NAME'])), '/\\'));

?>