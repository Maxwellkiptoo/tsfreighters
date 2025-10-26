
<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

header('Content-Type: application/json');
error_reporting(E_ALL);
ini_set('display_errors', 0); // hide warnings from browser
ini_set('log_errors', 1);
ini_set('error_log', __DIR__ . '/../../error_log.txt');

// ✅ Check if Database file exists
$databasePath = __DIR__ . '/../Core/Database.php';
if (!file_exists($databasePath)) {
    echo json_encode(['status' => 'error', 'message' => "❌ Database connection file missing at $databasePath"]);
    exit;
}

require_once $databasePath;

// ✅ Connect to DB safely
try {
    $db = Database::getInstance()->getConnection();
} catch (Throwable $e) {
    error_log("DB Connection Failed: " . $e->getMessage());
    echo json_encode(['status' => 'error', 'message' => '⚠️ Failed to connect to the database.']);
    exit;
}

// ✅ CSRF token
if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== ($_SESSION['csrf_token'] ?? '')) {
    echo json_encode(['status' => 'error', 'message' => '⚠️ Invalid CSRF token. Refresh and try again.']);
    exit;
}

// ✅ Math captcha
$captcha = intval($_POST['captcha'] ?? 0);
if (!isset($_SESSION['math_answer']) || $captcha !== $_SESSION['math_answer']) {
    echo json_encode(['status' => 'error', 'message' => '❌ Incorrect math answer.']);
    exit;
}

// ✅ Sanitize inputs
$email = trim($_POST['email'] ?? '');
$password = trim($_POST['password'] ?? '');

if ($email === '' || $password === '') {
    echo json_encode(['status' => 'error', 'message' => '⚠️ Please fill in all required fields.']);
    exit;
}

try {
    // ✅ Check user
    $stmt = $db->prepare("SELECT * FROM users WHERE email = :email LIMIT 1");
    $stmt->execute([':email' => $email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$user) {
        echo json_encode(['status' => 'error', 'message' => '❌ No account found with that email.']);
        exit;
    }

    if ((int)$user['is_active'] === 0) {
        echo json_encode(['status' => 'error', 'message' => '⚠️ Account inactive. Contact support.']);
        exit;
    }

    $validLogin = false;

    // Password check
    if (password_verify($password, $user['password'])) {
        $validLogin = true;
    }

    // Tracking number check
    if (!$validLogin) {
        $trackStmt = $db->prepare("
            SELECT tracking_number 
            FROM shipments 
            WHERE client_id = :cid AND tracking_number = :tracking LIMIT 1
        ");
        $trackStmt->execute([
            ':cid' => $user['id'],
            ':tracking' => $password
        ]);
        if ($trackStmt->fetch()) $validLogin = true;
    }

    if (!$validLogin) {
        echo json_encode(['status' => 'error', 'message' => '❌ Incorrect password or tracking number.']);
        exit;
    }

    // ✅ Set session
    $_SESSION['user_id'] = $user['id'];
    $_SESSION['full_name'] = $user['full_name'];
    $_SESSION['email'] = $user['email'];
    $_SESSION['role'] = $user['role'];

    // ✅ Redirect page
    $redirect = match ($user['role']) {
        'admin' => '/admin/dashboard.php',
        'driver' => '/driver/dashboard.php',
        'staff' => '/staff/dashboard.php',
        'customer' => '/app/Views/customers/customer_dashboard.php',
        default => '/dashboard.php'
    };

    echo json_encode([
        'status' => 'success',
        'message' => '✅ Welcome back, ' . htmlspecialchars($user['full_name']) . '!',
        'role' => $user['role'],
        'redirect' => $redirect
    ]);

} catch (Throwable $e) {
    // ✅ Log error safely
    error_log("Login Error: " . $e->getMessage());
    echo json_encode(['status' => 'error', 'message' => '⚠️ Internal server error. Please try again later.']);
    exit;
}
