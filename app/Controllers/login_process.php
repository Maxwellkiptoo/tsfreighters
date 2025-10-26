<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

header('Content-Type: application/json');

require_once __DIR__ . '/../../Core/Database.php';

$db = Database::getInstance()->getConnection();

// CSRF protection
if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
    echo json_encode(['status' => 'error', 'message' => 'Invalid CSRF token.']);
    exit;
}

$email = trim($_POST['email'] ?? '');
$password = trim($_POST['password'] ?? '');

if (empty($email) || empty($password)) {
    echo json_encode(['status' => 'error', 'message' => 'Please fill in all fields.']);
    exit;
}

try {
    // Check if user exists
    $stmt = $db->prepare("SELECT * FROM users WHERE email = :email LIMIT 1");
    $stmt->execute([':email' => $email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$user) {
        echo json_encode(['status' => 'error', 'message' => 'No account found with that email.']);
        exit;
    }

    if ((int)$user['is_active'] === 0) {
        echo json_encode(['status' => 'error', 'message' => 'Your account is inactive. Contact admin.']);
        exit;
    }

    // ✅ Allow login via tracking number or password
    $validLogin = false;

    // 1. Check password (for normal users)
    if (password_verify($password, $user['password'])) {
        $validLogin = true;
    }

    // 2. Or check if entered password is their shipment tracking number
    if (!$validLogin) {
        $trackStmt = $db->prepare("
            SELECT tracking_number FROM shipments 
            WHERE client_id = :cid AND tracking_number = :tracking
        ");
        $trackStmt->execute([
            ':cid' => $user['id'],
            ':tracking' => $password
        ]);
        if ($trackStmt->fetch()) $validLogin = true;
    }

    if (!$validLogin) {
        echo json_encode(['status' => 'error', 'message' => 'Incorrect password or tracking number.']);
        exit;
    }

    // ✅ Set session variables
    $_SESSION['user_id'] = $user['id'];
    $_SESSION['full_name'] = $user['full_name'];
    $_SESSION['role'] = $user['role'];

    // ✅ Redirect based on role
    $redirect = '/dashboard.php';
    if ($user['role'] === 'admin') $redirect = '/admin/dashboard.php';
    elseif ($user['role'] === 'driver') $redirect = '/driver/dashboard.php';
    elseif ($user['role'] === 'staff') $redirect = '/staff/dashboard.php';
    elseif ($user['role'] === 'customer') $redirect = '/app/Views/customers/customer_dashboard.php';

    echo json_encode([
        'status' => 'success',
        'message' => 'Welcome back, ' . htmlspecialchars($user['full_name']) . '!',
        'role' => $user['role'],
        'redirect' => $redirect
    ]);
} catch (Exception $e) {
    echo json_encode(['status' => 'error', 'message' => 'Server error: ' . $e->getMessage()]);
}
