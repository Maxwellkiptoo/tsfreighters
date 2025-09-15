<?php
// app/Core/Auth.php
class Auth
{
    public static function init()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        // ensure a CSRF token exists
        if (empty($_SESSION['csrf_token'])) {
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        }
    }

    public static function getCsrfToken()
    {
        self::init();
        return $_SESSION['csrf_token'];
    }

    public static function verifyCsrfToken($token)
    {
        self::init();
        return isset($_SESSION['csrf_token']) && hash_equals($_SESSION['csrf_token'], (string)$token);
    }

    public static function requireLogin()
    {
        self::init();
        if (empty($_SESSION['user_id'])) {
            header('Location: index.php?controller=auth&action=login');
            exit;
        }
    }

    public static function requireRole(array $roles = [])
    {
        self::init();
        if (!isset($_SESSION['role']) || !in_array($_SESSION['role'], $roles, true)) {
            // simple 403 page
            http_response_code(403);
            echo '<h1 style="font-family:Segoe UI,Roboto,Arial">403 Forbidden — insufficient role</h1>';
            exit;
        }
    }
}
?>