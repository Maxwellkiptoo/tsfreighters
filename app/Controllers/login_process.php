<?php
header('Content-Type: application/json');
session_start();
require_once __DIR__ . '/../../private/config/db_connect.php'; // update path if needed

$email = trim($_POST['email'] ?? '');
$password = trim($_POST['password'] ?? '');

if (empty($email) || empty($password)) {
  echo json_encode(['status' => 'error', 'message' => 'Please fill in all fields.']);
  exit;
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
  echo json_encode(['status' => 'error', 'message' => 'Invalid email format.']);
  exit;
}

try {
  $stmt = $pdo->prepare("SELECT * FROM users WHERE email = :email");
  $stmt->execute(['email' => $email]);
  $user = $stmt->fetch(PDO::FETCH_ASSOC);

  if ($user && password_verify($password, $user['password'])) {
    $_SESSION['user_id'] = $user['id'];
    $_SESSION['user_email'] = $user['email'];
    $_SESSION['tracking_number'] = $password;
    echo json_encode(['status' => 'success', 'message' => 'Login successful! Redirecting...']);
  } else {
    echo json_encode(['status' => 'error', 'message' => 'Incorrect email or tracking number.']);
  }
} catch (Exception $e) {
  echo json_encode(['status' => 'error', 'message' => 'Server error. Please try again later.']);
}
