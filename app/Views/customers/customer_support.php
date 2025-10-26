<?php
session_start();
require_once 'tsfreighters/app/Core/Database.php';
include 'layout/client_sidebar.php';

// Check login
if (!isset($_SESSION['customer_id'])) {
    header("Location: tsfreighters/app/Views/auth/login.php");
    exit();
}

$db = Database::getInstance()->getConnection();
$customer_id = $_SESSION['customer_id'];

// Handle support form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $subject = trim($_POST['subject']);
    $message = trim($_POST['message']);
    $attachment = "";

    // Handle file upload
    if (!empty($_FILES['attachment']['name'])) {
        $targetDir = "uploads/support/";
        if (!file_exists($targetDir)) mkdir($targetDir, 0777, true);
        $fileName = time() . "_" . basename($_FILES["attachment"]["name"]);
        $targetFile = $targetDir . $fileName;
        if (move_uploaded_file($_FILES["attachment"]["tmp_name"], $targetFile)) {
            $attachment = $fileName;
        }
    }

    // Insert support ticket
    $stmt = $db->prepare("
        INSERT INTO support_tickets (customer_id, subject, message, attachment, status, created_at)
        VALUES (:customer_id, :subject, :message, :attachment, 'Open', NOW())
    ");
    $stmt->execute([
        ':customer_id' => $customer_id,
        ':subject' => $subject,
        ':message' => $message,
        ':attachment' => $attachment
    ]);

    $success_msg = "✅ Your support request has been submitted successfully!";
}

// Fetch past tickets
$stmt = $db->prepare("SELECT * FROM support_tickets WHERE customer_id = :cid ORDER BY created_at DESC");
$stmt->execute([':cid' => $customer_id]);
$tickets = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Customer Support | Client Portal</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
<style>
body {
  font-family: 'Poppins', sans-serif;
  margin: 0;
  background: #f8fafc;
  color: #333;
}
.main-content {
  margin-left: 250px;
  padding: 30px;
}
/* Header */
.header {
  display: flex;
  justify-content: space-between;
  align-items: center;
}
.header h1 {
  font-size: 22px;
  color: #111827;
}
/* Support Form */
.support-form {
  background: #fff;
  padding: 25px;
  border-radius: 16px;
  box-shadow: 0 4px 10px rgba(0,0,0,0.08);
  margin-bottom: 40px;
}
.support-form h2 {
  font-size: 20px;
  margin-bottom: 20px;
  color: #111827;
}
.support-form input, .support-form textarea {
  width: 100%;
  padding: 12px;
  border: 1px solid #d1d5db;
  border-radius: 10px;
  font-size: 14px;
  margin-bottom: 15px;
  outline: none;
}
.support-form textarea {
  resize: none;
  height: 120px;
}
.support-form input[type="file"] {
  padding: 8px;
}
.support-form button {
  background: #10b981;
  color: white;
  padding: 12px 18px;
  border: none;
  border-radius: 10px;
  font-size: 15px;
  cursor: pointer;
  transition: background 0.3s;
}
.support-form button:hover {
  background: #059669;
}
/* Ticket List */
.ticket-section {
  background: white;
  border-radius: 16px;
  box-shadow: 0 4px 10px rgba(0,0,0,0.08);
  padding: 25px;
}
.ticket-section h2 {
  font-size: 20px;
  margin-bottom: 20px;
}
table {
  width: 100%;
  border-collapse: collapse;
}
table th, table td {
  padding: 12px;
  text-align: left;
  font-size: 14px;
}
table th {
  background: #10b981;
  color: white;
}
table tr:nth-child(even) {
  background: #f1f5f9;
}
.status {
  padding: 6px 10px;
  border-radius: 8px;
  font-weight: 500;
  text-align: center;
  font-size: 13px;
}
.status.Open { background: #fef3c7; color: #b45309; }
.status.Closed { background: #d1fae5; color: #047857; }
.success-message {
  background: #ecfdf5;
  color: #065f46;
  padding: 10px 15px;
  border-radius: 8px;
  margin-bottom: 15px;
  font-size: 14px;
  border-left: 4px solid #10b981;
}
</style>
</head>
<body>

<div class="main-content">
  <div class="header">
    <h1><i class="fa fa-headset"></i> Customer Support</h1>
  </div>

  <?php if (isset($success_msg)) echo "<div class='success-message'>$success_msg</div>"; ?>

  <!-- Support Form -->
  <div class="support-form">
    <h2>Submit a Support Request</h2>
    <form action="" method="POST" enctype="multipart/form-data">
      <input type="text" name="subject" placeholder="Subject" required>
      <textarea name="message" placeholder="Describe your issue or question..." required></textarea>
      <label for="attachment">Attach File (optional):</label>
      <input type="file" name="attachment" accept=".jpg,.png,.pdf,.docx">
      <button type="submit"><i class="fa fa-paper-plane"></i> Submit Ticket</button>
    </form>
  </div>

  <!-- Ticket History -->
  <div class="ticket-section">
    <h2>My Support Tickets</h2>
    <table>
      <thead>
        <tr>
          <th>Ticket ID</th>
          <th>Subject</th>
          <th>Status</th>
          <th>Date</th>
          <th>Attachment</th>
        </tr>
      </thead>
      <tbody>
        <?php if (count($tickets) > 0): ?>
          <?php foreach ($tickets as $row): ?>
            <tr>
              <td>#<?= htmlspecialchars($row['id']) ?></td>
              <td><?= htmlspecialchars($row['subject']) ?></td>
              <td><span class="status <?= htmlspecialchars($row['status']) ?>"><?= htmlspecialchars($row['status']) ?></span></td>
              <td><?= date("M d, Y", strtotime($row['created_at'])) ?></td>
              <td>
                <?php if ($row['attachment']): ?>
                  <a href="uploads/support/<?= htmlspecialchars($row['attachment']) ?>" target="_blank"><i class="fa fa-paperclip"></i> View</a>
                <?php else: ?>
                  —
                <?php endif; ?>
              </td>
            </tr>
          <?php endforeach; ?>
        <?php else: ?>
          <tr><td colspan="5" style="text-align:center;">No support tickets found.</td></tr>
        <?php endif; ?>
      </tbody>
    </table>
  </div>

  <footer style="margin-top:40px;text-align:center;font-size:14px;color:#6b7280;">
    © 2025 tsfreighters Logistics Customer Support
  </footer>
</div>

</body>
</html>
