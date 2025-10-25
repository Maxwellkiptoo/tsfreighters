<?php
session_start();
include 'config.php';

// Ensure customer is logged in
if (!isset($_SESSION['customer_id'])) {
    header("Location: login.php");
    exit();
}

$customer_id = $_SESSION['customer_id'];

// Fetch customer data
$query = mysqli_query($conn, "SELECT * FROM customers WHERE id='$customer_id'");
$customer = mysqli_fetch_assoc($query);

// Handle profile update
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update_profile'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);

    $update = mysqli_query($conn, "UPDATE customers SET name='$name', email='$email', phone='$phone', address='$address' WHERE id='$customer_id'");
    if ($update) {
        $_SESSION['success_message'] = "Profile updated successfully.";
        header("Refresh:0");
        exit();
    } else {
        $error_message = "Failed to update profile.";
    }
}

// Handle password change
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['change_password'])) {
    $current = md5($_POST['current_password']);
    $new = md5($_POST['new_password']);
    $confirm = md5($_POST['confirm_password']);

    if ($new !== $confirm) {
        $error_message = "New passwords do not match.";
    } else {
        $check = mysqli_query($conn, "SELECT * FROM customers WHERE id='$customer_id' AND password='$current'");
        if (mysqli_num_rows($check) > 0) {
            mysqli_query($conn, "UPDATE customers SET password='$new' WHERE id='$customer_id'");
            $_SESSION['success_message'] = "Password changed successfully.";
            header("Refresh:0");
            exit();
        } else {
            $error_message = "Current password is incorrect.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Customer Settings | MyShip Logistics</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        body {font-family: 'Segoe UI', sans-serif; background:#f9fafb; margin:0; padding:0;}
        .container {max-width:1000px; margin:50px auto; background:#fff; padding:40px; border-radius:12px; box-shadow:0 2px 12px rgba(0,0,0,0.1);}
        h2 {color:#111827; margin-bottom:20px; border-bottom:2px solid #e5e7eb; padding-bottom:10px;}
        form {margin-bottom:40px;}
        label {display:block; font-weight:600; margin:10px 0 5px;}
        input, textarea, select {width:100%; padding:10px; border:1px solid #d1d5db; border-radius:8px; font-size:15px;}
        input:focus, textarea:focus {outline:none; border-color:#2563eb;}
        .btn {background:#2563eb; color:#fff; border:none; padding:10px 20px; border-radius:8px; cursor:pointer;}
        .btn:hover {background:#1e40af;}
        .section {margin-bottom:40px;}
        .success {background:#d1fae5; color:#065f46; padding:10px 15px; border-radius:8px; margin-bottom:20px;}
        .error {background:#fee2e2; color:#991b1b; padding:10px 15px; border-radius:8px; margin-bottom:20px;}
    </style>
</head>
<body>

<div class="container">
    <h2>Customer Settings</h2>

    <?php if(isset($_SESSION['success_message'])): ?>
        <div class="success"><?= $_SESSION['success_message']; unset($_SESSION['success_message']); ?></div>
    <?php endif; ?>

    <?php if(isset($error_message)): ?>
        <div class="error"><?= $error_message; ?></div>
    <?php endif; ?>

    <!-- Profile Section -->
    <div class="section">
        <h3>Update Profile</h3>
        <form method="POST">
            <label>Full Name</label>
            <input type="text" name="name" value="<?= htmlspecialchars($customer['name']); ?>" required>

            <label>Email Address</label>
            <input type="email" name="email" value="<?= htmlspecialchars($customer['email']); ?>" required>

            <label>Phone Number</label>
            <input type="text" name="phone" value="<?= htmlspecialchars($customer['phone']); ?>">

            <label>Address</label>
            <textarea name="address" rows="3"><?= htmlspecialchars($customer['address']); ?></textarea>

            <button type="submit" name="update_profile" class="btn">Save Changes</button>
        </form>
    </div>

    <!-- Password Section -->
    <div class="section">
        <h3>Change Password</h3>
        <form method="POST">
            <label>Current Password</label>
            <input type="password" name="current_password" required>

            <label>New Password</label>
            <input type="password" name="new_password" required>

            <label>Confirm New Password</label>
            <input type="password" name="confirm_password" required>

            <button type="submit" name="change_password" class="btn">Update Password</button>
        </form>
    </div>

    <!-- Notification Preferences -->
    <div class="section">
        <h3>Notification Preferences</h3>
        <form>
            <label><input type="checkbox" checked> Email Notifications</label>
            <label><input type="checkbox"> SMS Alerts</label>
            <label><input type="checkbox"> Push Notifications</label>
            <button type="button" class="btn">Save Preferences</button>
        </form>
    </div>
</div>

</body>
</html>
