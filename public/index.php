<?php
// public/index.php

require_once __DIR__ . '/../app/Core/Database.php';
require_once __DIR__ . '/../app/Core/Auth.php';

// Load controllers
require_once __DIR__ . '/../app/Controllers/HomeController.php';
require_once __DIR__ . '/../app/Controllers/CustomerController.php';

// Start session/auth
Auth::init();

// Default to home controller
$controller = $_GET['controller'] ?? 'home';
$action = $_GET['action'] ?? 'index';

// Simple router
switch ($controller) {
    case 'home':
        $ctrl = new HomeController();
        if (method_exists($ctrl, $action)) {
            $ctrl->$action();
        } else {
            echo 'Unknown action';
        }
        break;

    case 'customer':
        $ctrl = new CustomerController();
        if (method_exists($ctrl, $action)) {
            $ctrl->$action();
        } else {
            echo 'Unknown action';
        }
        break;

    default:
        echo 'Unknown controller';
}
?>