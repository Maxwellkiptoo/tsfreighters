<?php
session_start();
include 'config.php'; // database connection

// Check if customer is logged in
if (!isset($_SESSION['customer_id'])) {
    header("Location: login.php");
    exit();
}

$customer_id = $_SESSION['customer_id'];

// Check for invoice parameter
if (!isset($_GET['invoice'])) {
    header("Location: customer_invoices.php");
    exit();
}

$invoice_number = mysqli_real_escape_string($conn, $_GET['invoice']);

// Fetch invoice and related shipment
$sql = "SELECT i.*, s.tracking_number, s.origin, s.destination, s.package_details, s.weight, 
               s.delivery_type, s.status, s.estimated_cost, s.expected_delivery, c.name, c.email 
        FROM invoices i 
        JOIN shipments s ON i.shipment_id = s.id 
        JOIN customers c ON s.customer_id = c.id 
        WHERE i.invoice_number = '$invoice_number' AND s.customer_id = '$customer_id' 
        LIMIT 1";

$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) == 0) {
    echo "<p style='color:red;text-align:center;'>Invoice not found or unauthorized access.</p>";
    exit();
}

$row = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Invoice #<?= htmlspecialchars($row['invoice_number']); ?></title>
    <style>
        body {
            font-family: "Poppins", sans-serif;
            background: #f8fafc;
            margin: 0;
            padding: 0;
        }
        .invoice-container {
            background: white;
            max-width: 900px;
            margin: 40px auto;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        }
        .header {
            display: flex;
            justify-content: space-between;
            border-bottom: 2px solid #e5e7eb;
            padding-bottom: 15px;
        }
        .header h2 {
            margin: 0;
            color: #111827;
        }
        .company {
            text-align: right;
        }
        .info {
            margin-top: 25px;
            display: flex;
            justify-content: space-between;
        }
        .info div {
            width: 48%;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 25px;
        }
        th, td {
            border-bottom: 1px solid #e5e7eb;
            padding: 12px;
            text-align: left;
        }
        th {
            background: #f1f5f9;
            color: #111827;
        }
        .total {
            text-align: right;
            font-size: 1.2em;
            margin-top: 20px;
            color: #111827;
        }
        .btns {
            text-align: center;
            margin-top: 25px;
        }
        .btn {
            display: inline-block;
            background: #2563eb;
            color: white;
            padding: 10px 18px;
            border-radius: 6px;
            text-decoration: none;
            transition: 0.2s;
        }
        .btn:hover {
            background: #1d4ed8;
        }
        .back {
            background: #334155;
        }
        .back:hover {
            background: #1e293b;
        }
    </style>
</head>
<body>
    <div class="invoice-container">
        <div class="header">
            <div>
                <h2>Invoice #<?= htmlspecialchars($row['invoice_number']); ?></h2>
                <p><strong>Date Issued:</strong> <?= date("M d, Y", strtotime($row['created_at'])); ?></p>
                <p><strong>Tracking #:</strong> <?= htmlspecialchars($row['tracking_number']); ?></p>
            </div>
            <div class="company">
                <h3>Logistics Company Ltd</h3>
                <p>Nairobi, Kenya</p>
                <p>support@logisticsco.com</p>
            </div>
        </div>

        <div class="info">
            <div>
                <h4>Bill To:</h4>
                <p><?= htmlspecialchars($row['name']); ?><br>
                   <?= htmlspecialchars($row['email']); ?></p>
            </div>
            <div>
                <h4>Shipment Details:</h4>
                <p><strong>From:</strong> <?= htmlspecialchars($row['origin']); ?><br>
                   <strong>To:</strong> <?= htmlspecialchars($row['destination']); ?><br>
                   <strong>Weight:</strong> <?= htmlspecialchars($row['weight']); ?> kg<br>
                   <strong>Delivery Type:</strong> <?= htmlspecialchars(ucfirst($row['delivery_type'])); ?><br>
                   <strong>Status:</strong> <?= htmlspecialchars($row['status']); ?></p>
            </div>
        </div>

        <table>
            <tr>
                <th>Description</th>
                <th>Amount</th>
            </tr>
            <tr>
                <td><?= htmlspecialchars($row['package_details']); ?></td>
                <td>$<?= number_format($row['total_amount'], 2); ?></td>
            </tr>
        </table>

        <div class="total">
            <strong>Total: $<?= number_format($row['total_amount'], 2); ?></strong>
        </div>

        <div class="btns">
            <a href="customer_invoices.php" class="btn back">← Back</a>
            <a href="download_invoice.php?invoice=<?= urlencode($row['invoice_number']); ?>" class="btn">Download PDF</a>
        </div>
    </div>
</body>
</html>
