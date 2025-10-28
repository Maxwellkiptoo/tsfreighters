<?php
// ===============================
// ✅ Global Configuration
// ===============================

// Database connection settings
$config = [
    'host' => 'localhost',
    'dbname' => 'tsfreighters',
    'user' => 'root',
    'pass' => '',
    'charset' => 'utf8mb4',
];

// Define base path (for filesystem references)
if (!defined('BASE_PATH')) {
    define('BASE_PATH', dirname(__DIR__, 1) . '/');
}

// Define dynamic BASE_URL (auto works on localhost & live)
if (!defined('BASE_URL')) {
    $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443)
        ? "https://" : "http://";
    $host = $_SERVER['HTTP_HOST'];
    $folder = trim(str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME'])), '/');
    $baseUrl = $protocol . $host . ($folder ? '/' . $folder : '') . '/';
    define('BASE_URL', $baseUrl);
}

// Return config for database use
return $config;
