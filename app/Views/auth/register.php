<?php
require_once(__DIR__ . '/../../Core/Database.php');
session_start();

$db = new Database();
$conn = $db->getConnection();

// Generate CSRF token
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

$success = '';
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // CSRF protection
    if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
        $error = "Invalid request. Please refresh and try again.";
    } else {
        $full_name = trim($_POST['full_name']);
        $email     = trim($_POST['email']);
        $phone     = trim($_POST['phone']);
        $password  = trim($_POST['password']);
        $confirm   = trim($_POST['confirm']);

        // Server-side validation
        if (empty($full_name) || empty($email) || empty($password) || empty($confirm)) {
            $error = "All required fields must be filled.";
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error = "Invalid email format.";
        } elseif ($password !== $confirm) {
            $error = "Passwords do not match.";
        } elseif (strlen($password) < 8) {
            $error = "Password must be at least 8 characters long.";
        } else {
            try {
                // Check if email exists
                $stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
                $stmt->execute([$email]);
                if ($stmt->rowCount() > 0) {
                    $error = "This email is already registered.";
                } else {
                    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

                    $insert = $conn->prepare("
                        INSERT INTO users (full_name, email, phone, password, role, is_active, created_at)
                        VALUES (?, ?, ?, ?, 'customer', 1, NOW())
                    ");
                    $insert->execute([$full_name, $email, $phone, $hashedPassword]);

                    if ($insert->rowCount() > 0) {
                        $success = "Account created successfully! You can now log in.";
                        // Optionally: redirect after a delay
                        header("refresh:3;url=login.php");
                    } else {
                        $error = "Registration failed. Please try again later.";
                    }
                }
            } catch (PDOException $e) {
                $error = "Database error: " . htmlspecialchars($e->getMessage());
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register | TSFreighters</title>
    <link rel="stylesheet" href="/tsfreighters/public/css/style.css">
    <style>
        body {
            font-family: "Segoe UI", sans-serif;
            background: #f7f8fa;
        }
        .register-box {
            width: 420px;
            margin: 60px auto;
            background: #fff;
            border-radius: 10px;
            padding: 30px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        h2 { text-align: center; color: #333; margin-bottom: 20px; }
        label { font-weight: 600; display: block; margin-top: 10px; }
        input {
            width: 100%; padding: 10px;
            border: 1px solid #ccc; border-radius: 5px;
            margin-top: 5px;
        }
        button {
            width: 100%; padding: 12px;
            margin-top: 15px;
            background: #007bff; color: #fff;
            border: none; border-radius: 5px;
            cursor: pointer; font-size: 16px;
        }
        button:hover { background: #0056b3; }
        .msg {
            padding: 10px; border-radius: 5px; text-align: center;
            margin-bottom: 15px; font-weight: bold;
        }
        .success { background: #d4edda; color: #155724; border: 1px solid #c3e6cb; }
        .error { background: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; }
    </style>
</head>
<body>

<div class="register-box">
    <h2>Create Your Account</h2>

    <?php if ($success): ?>
        <div class="msg success"><?= htmlspecialchars($success) ?></div>
    <?php elseif ($error): ?>
        <div class="msg error"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <form method="POST">
        <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($_SESSION['csrf_token']); ?>">

        <label>Full Name *</label>
        <input type="text" name="full_name" placeholder="John Doe" required>

        <label>Email Address *</label>
        <input type="email" name="email" placeholder="example@email.com" required>

        <label>Phone Number</label>
        <input type="text" name="phone" placeholder="+2547XXXXXXXX">

        <label>Password *</label>
        <input type="password" name="password" placeholder="********" minlength="8" required>

        <label>Confirm Password *</label>
        <input type="password" name="confirm" placeholder="********" required>

        <button type="submit">Register</button>

        <p style="text-align:center; margin-top:10px;">
            Already have an account? <a href="login.php">Login here</a>
        </p>
    </form>
</div>

</body>
</html>
