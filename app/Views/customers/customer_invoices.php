<?php
session_start();
require_once __DIR__ . '/../../Core/Database.php';
if (!isset($_SESSION['customer_id'])) {
    header("Location: /tsfreighters/app/Views/auth/login.php");
    exit();
}
include __DIR__ . '/layout/client_sidebar.php';

$customer_id = $_SESSION['customer_id'];

$sql = "SELECT i.id, i.invoice_number, i.total_amount, i.created_at, s.tracking_number 
        FROM invoices i 
        JOIN shipments s ON i.shipment_id = s.id 
        WHERE s.customer_id = '$customer_id' 
        ORDER BY i.created_at DESC";
$result = mysqli_query($conn, $sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Invoices</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        body {
            font-family: "Poppins", sans-serif;
            background-color: #f8fafc;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 95%;
            max-width: 1100px;
            margin: 30px auto;
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            padding: 25px;
        }
        h2 {
            text-align: center;
            color: #222;
            margin-bottom: 25px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            border-radius: 10px;
            overflow: hidden;
        }
        th, td {
            padding: 14px;
            border-bottom: 1px solid #ddd;
            text-align: center;
        }
        th {
            background: #1e293b;
            color: white;
        }
        tr:hover {
            background: #f1f5f9;
        }
        .btn-view {
            background: #2563eb;
            color: white;
            padding: 8px 14px;
            border-radius: 6px;
            text-decoration: none;
            transition: 0.2s;
        }
        .btn-view:hover {
            background: #1d4ed8;
        }
        .no-data {
            text-align: center;
            padding: 30px;
            color: #555;
        }
        .back-btn {
            display: inline-block;
            background: #0f172a;
            color: white;
            padding: 8px 14px;
            text-decoration: none;
            border-radius: 6px;
            margin-bottom: 20px;
        }
        .back-btn:hover {
            background: #1e293b;
        }
    </style>
</head>
<body>
    <div class="container">
        <a href="customer_dashboard.php" class="back-btn">← Back to Dashboard</a>
        <h2>My Invoices</h2>

        <?php
        if (mysqli_num_rows($result) > 0) {
            echo '<table>
                    <thead>
                        <tr>
                            <th>Invoice #</th>
                            <th>Tracking #</th>
                            <th>Total Amount</th>
                            <th>Date Issued</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>';
            while ($row = mysqli_fetch_assoc($result)) {
                echo '<tr>
                        <td>'.$row['invoice_number'].'</td>
                        <td>'.$row['tracking_number'].'</td>
                        <td>$'.number_format($row['total_amount'], 2).'</td>
                        <td>'.date("M d, Y", strtotime($row['created_at'])).'</td>
                        <td><a class="btn-view" href="view_invoice.php?invoice='.$row['invoice_number'].'">View</a></td>
                      </tr>';
            }
            echo '</tbody></table>';
        } else {
            echo '<div class="no-data">No invoices found.</div>';
        }
        ?>
    </div>
      <?php include 'layout/cfooter.php'; ?>
</body>
</html>
