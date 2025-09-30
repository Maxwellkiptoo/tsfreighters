<?php
// app/controllers/login_process.php
header('Content-Type: application/json');
session_start();

// basic rate limit per session (adjust thresholds for production)
if (!isset($_SESSION['login_attempts'])) $_SESSION['login_attempts'] = 0;
if (!isset($_SESSION['last_attempt_time'])) $_SESSION['last_attempt_time'] = 0;
$now = time();
if ($_SESSION['login_attempts'] >= 8 && ($now - $_SESSION['last_attempt_time']) < 300) {
    echo json_encode(['status'=>'error','message'=>'Too many attempts. Try again later.']);
    exit;
}

// adjust path to your DB bootstrap (use PDO)
require_once __DIR__ . '/../../private/config/db_connect.php'; // must set $pdo = new PDO(...)

// helper: send error
function jsonError($msg) {
    echo json_encode(['status'=>'error','message'=>$msg]); exit;
}

try {
    // only allow POST
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        jsonError('Invalid request method.');
    }

    // CSRF check
    $csrfPosted = $_POST['csrf_token'] ?? '';
    if (empty($csrfPosted) || !hash_equals($_SESSION['csrf_token'] ?? '', $csrfPosted)) {
        jsonError('Invalid CSRF token.');
    }

    // sanitize
    $email = filter_var(trim($_POST['email'] ?? ''), FILTER_VALIDATE_EMAIL);
    $password = trim($_POST['password'] ?? '');
    $remember = isset($_POST['remember']) ? true : false;

    if (!$email || !$password) {
        $_SESSION['login_attempts']++;
        $_SESSION['last_attempt_time'] = $now;
        jsonError('Please provide both email and password.');
    }

    // fetch user by email
    $stmt = $pdo->prepare("SELECT id, email, password_hash, role, is_active FROM users WHERE email = :email LIMIT 1");
    $stmt->execute(['email' => $email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$user) {
        $_SESSION['login_attempts']++;
        $_SESSION['last_attempt_time'] = $now;
        jsonError('Incorrect email or password.');
    }

    if (!$user['is_active']) {
        jsonError('Account not active. Contact support.');
    }

    // verify password (password_hash should be created with password_hash())
    if (!password_verify($password, $user['password_hash'])) {
        $_SESSION['login_attempts']++;
        $_SESSION['last_attempt_time'] = $now;
        jsonError('Incorrect email or password.');
    }

    // reset attempt counter on successful login
    $_SESSION['login_attempts'] = 0;
    $_SESSION['last_attempt_time'] = $now;

    // OPTIONAL: check if 2FA/mfa is required for role
    $role = $user['role'] ?? 'customer'; // e.g. admin, ops, warehouse, customer, supplier

    // create session payload & minimal session hardening
    session_regenerate_id(true);
    $_SESSION['user_id'] = $user['id'];
    $_SESSION['user_email'] = $user['email'];
    $_SESSION['user_role'] = $role;
    // set 'remember' as cookie if requested (implement secure token in DB)
    if ($remember) {
        // Warning: implement persistent login tokens with DB-stored hashed tokens (not plain password)
        setcookie('remember', base64_encode($user['id'] . '|' . bin2hex(random_bytes(16))), time() + (86400 * 30), "/", "", true, true);
    }

    // AUDIT: log login time/IP (implement in DB or file)
    // $auditStmt = $pdo->prepare("INSERT INTO user_audit (user_id, event, ip) VALUES (:uid, 'login', :ip)");
    // $auditStmt->execute(['uid'=>$user['id'], 'ip'=>$_SERVER['REMOTE_ADDR']]);

    // Determine redirect by role
    $redirect = '/dashboard.php';
    if ($role === 'admin') $redirect = '/admin/dashboard.php';
    if ($role === 'warehouse') $redirect = '/warehouse/dashboard.php';
    if ($role === 'ops') $redirect = '/ops/dashboard.php';
    if ($role === 'supplier') $redirect = '/supplier/dashboard.php';
    if ($role === 'customer') $redirect = '/customer/orders.php';

    echo json_encode([
        'status' => 'success',
        'message' => 'Login successful. Welcome back!',
        'role' => $role,
        'redirect' => $redirect
    ]);
    exit;

} catch (PDOException $ex) {
    // Do NOT reveal DB details in production — keep safe logging in server logs
    error_log("Login DB error: " . $ex->getMessage());
    jsonError('Server error. Please try again later.');
} catch (Exception $e) {
    error_log("Login error: " . $e->getMessage());
    jsonError('Server error. Please try again later.');
}
