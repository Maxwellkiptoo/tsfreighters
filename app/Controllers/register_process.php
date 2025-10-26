<?php
if (session_status() === PHP_SESSION_NONE) session_start();
header('Content-Type: application/json');

require_once __DIR__ . '/../../Core/Database.php';
$db = Database::getInstance()->getConnection();

// Validate CSRF
if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== ($_SESSION['csrf_token'] ?? '')) {
    echo json_encode(['status' => 'error', 'message' => 'Invalid CSRF token.']);
    exit;
}

// Validate math captcha
$captcha = intval($_POST['captcha'] ?? 0);
if (!isset($_SESSION['math_answer']) || $captcha !== $_SESSION['math_answer']) {
    echo json_encode(['status' => 'error', 'message' => 'Incorrect math answer.']);
    exit;
}

$full_name = trim($_POST['full_name'] ?? '');
$email     = trim($_POST['email'] ?? '');
$phone     = trim($_POST['phone'] ?? '');
$password  = trim($_POST['password'] ?? '');
$confirm   = trim($_POST['confirm'] ?? '');

if (!$full_name || !$email || !$password || !$confirm) {
    echo json_encode(['status' => 'error', 'message' => 'All required fields must be filled.']);
    exit;
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo json_encode(['status' => 'error', 'message' => 'Invalid email format.']);
    exit;
}

if ($password !== $confirm) {
    echo json_encode(['status' => 'error', 'message' => 'Passwords do not match.']);
    exit;
}

if (strlen($password) < 8) {
    echo json_encode(['status' => 'error', 'message' => 'Password must be at least 8 characters long.']);
    exit;
}

try {
    $stmt = $db->prepare("SELECT id FROM users WHERE email = ?");
    $stmt->execute([$email]);
    if ($stmt->fetch()) {
        echo json_encode(['status' => 'error', 'message' => 'This email is already registered.']);
        exit;
    }

    $hashed = password_hash($password, PASSWORD_DEFAULT);
    $insert = $db->prepare("INSERT INTO users (full_name, email, phone, password, role, is_active, created_at) VALUES (?, ?, ?, ?, 'customer', 1, NOW())");
    $insert->execute([$full_name, $email, $phone, $hashed]);

    echo json_encode(['status' => 'success', 'message' => 'Account created successfully!']);
} catch (Exception $e) {
    echo json_encode(['status' => 'error', 'message' => 'Server error: ' . $e->getMessage()]);
}
