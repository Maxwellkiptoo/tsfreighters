<?php
include 'layout/client_sidebar.php';
include 'config.php';
session_start();

// Check if customer is logged in
if (!isset($_SESSION['customer_id'])) {
    header("Location: login.php");
    exit();
}

$customer_id = $_SESSION['customer_id'];

// Fetch invoices for the logged-in customer
$query = "SELECT * FROM invoices WHERE customer_id = '$customer_id' ORDER BY created_at DESC";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>My Invoices | Customer Dashboard</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

<style>
body {
  margin: 0;
  font-family: 'Poppins', sans-serif;
  background: #f9fafb;
  color: #333;
  overflow-x: hidden;
}
.main-content {
  margin-left: 250px;
  padding: 30px;
}

.page-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
}
.page-header h1 {
  font-size: 22px;
  font-weight: 600;
  color: #111827;
}
.page-header .btn {
  background: #10b981;
  color: #fff;
  padding: 10px 15px;
  border-radius: 10px;
  text-decoration: none;
  transition: background 0.3s;
}
.page-header .btn:hover {
  background: #059669;
}

/* Table Styling */
.table-section {
  background: white;
  margin-top: 30px;
  border-radius: 16px;
  box-shadow: 0 4px 10px rgba(0,0,0,0.08);
  padding: 25px;
}
.table-section h2 {
  margin-bottom: 15px;
  color: #111827;
}
table {
  width: 100%;
  border-collapse: collapse;
  font-size: 15px;
}
table th, table td {
  text-align: left;
  padding: 12px 15px;
}
table th {
  background: #10b981;
  color: white;
  font-weight: 600;
}
table tr:nth-child(even){background:#f9fafb;}
.action-btn {
  background: #10b981;
  color: #fff;
  border: none;
  border-radius: 8px;
  padding: 6px 10px;
  font-size: 13px;
  text-decoration: none;
  transition: background 0.3s;
}
.action-btn:hover { background: #059669; }
.status {
  padding: 5px 10px;
  border-radius: 8px;
  font-weight: 500;
  font-size: 13px;
  display: inline-block;
}
.status.paid{background:#d1fae5;color:#047857;}
.status.unpaid{background:#fee2e2;color:#b91c1c;}
.status.pending{background:#fef3c7;color:#b45309;}
footer {
  margin-top: 40px;
  text-align: center;
  font-size: 14px;
  color: #6b7280;
}
</style>
</head>
<body>

<div class="main-content">
  <div class="page-header">
    <h1><i class="fa fa-file-invoice"></i> My Invoices</h1>
    <a href="customer_dashboard.php" class="btn"><i class="fa fa-arrow-left"></i> Back to Dashboard</a>
  </div>

  <!-- Success or Error Messages -->
  <?php
  if (isset($_SESSION['success_message'])) {
      echo '<div style="background:#d1fae5;color:#047857;padding:10px;border-radius:8px;margin-top:15px;">'.$_SESSION['success_message'].'</div>';
      unset($_SESSION['success_message']);
  }
  if (isset($_SESSION['error_message'])) {
      echo '<div style="background:#fee2e2;color:#b91c1c;padding:10px;border-radius:8px;margin-top:15px;">'.$_SESSION['error_message'].'</div>';
      unset($_SESSION['error_message']);
  }
  ?>

  <div class="table-section">
    <h2>Invoice Summary</h2>
    <table>
      <thead>
        <tr>
          <th>Invoice #</th>
          <th>Tracking ID</th>
          <th>Amount (Ksh)</th>
          <th>Status</th>
          <th>Date</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        <?php if (mysqli_num_rows($result) > 0): ?>
          <?php while ($row = mysqli_fetch_assoc($result)): ?>
          <tr>
            <td>#<?php echo $row['invoice_number']; ?></td>
            <td><?php echo $row['tracking_number']; ?></td>
            <td><?php echo number_format($row['amount'], 2); ?></td>
            <td>
              <span class="status <?php echo strtolower($row['status']); ?>">
                <?php echo ucfirst($row['status']); ?>
              </span>
            </td>
            <td><?php echo date('d M Y', strtotime($row['created_at'])); ?></td>
            <td>
              <a href="view_invoice.php?id=<?php echo $row['id']; ?>" class="action-btn"><i class="fa fa-eye"></i> View</a>
              <a href="invoices/<?php echo $row['invoice_file']; ?>" class="action-btn" download><i class="fa fa-download"></i> Download</a>
            </td>
          </tr>
          <?php endwhile; ?>
        <?php else: ?>
          <tr><td colspan="6" style="text-align:center;color:#6b7280;">No invoices found.</td></tr>
        <?php endif; ?>
      </tbody>
    </table>
  </div>

  <footer>© 2025 Nexbridge Logistics | Customer Invoices</footer>
</div>

</body>
</html>
