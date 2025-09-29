<?php
// public/index.php

require_once __DIR__ . '/../app/Core/Database.php';
require_once __DIR__ . '/../app/Core/Auth.php';

// Autoload Controllers (instead of manually requiring each one)
spl_autoload_register(function ($class) {
    $controllerPath = __DIR__ . '/../app/Controllers/' . $class . '.php';
    if (file_exists($controllerPath)) {
        require_once $controllerPath;
    }
});

// Start session/auth
Auth::init();

// Default routing values
$controllerName = ucfirst(strtolower($_GET['controller'] ?? 'home')) . 'Controller';
$action = $_GET['action'] ?? 'index';

// Check if controller exists
if (class_exists($controllerName)) {
    $controller = new $controllerName();

    // Check if action exists
    if (method_exists($controller, $action)) {
        $controller->$action();
    } else {
        http_response_code(404);
        echo "404 - Unknown action: <b>{$action}</b> in {$controllerName}";
    }
} else {
    http_response_code(404);
    echo "404 - Unknown controller: <b>{$controllerName}</b>";
}
