<?php
session_start();
require('fpdf/fpdf.php');
include 'config.php';

// Check login
if (!isset($_SESSION['customer_id'])) {
    header("Location: login.php");
    exit();
}

$customer_id = $_SESSION['customer_id'];

if (!isset($_GET['invoice'])) {
    die("Invoice not specified.");
}

$invoice_number = mysqli_real_escape_string($conn, $_GET['invoice']);

// Fetch invoice and shipment details
$sql = "SELECT i.*, s.tracking_number, s.origin, s.destination, s.package_details, s.weight, 
               s.delivery_type, s.status, s.estimated_cost, s.expected_delivery, 
               c.name, c.email 
        FROM invoices i 
        JOIN shipments s ON i.shipment_id = s.id 
        JOIN customers c ON s.customer_id = c.id 
        WHERE i.invoice_number = '$invoice_number' AND s.customer_id = '$customer_id'
        LIMIT 1";

$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) == 0) {
    die("Invoice not found or unauthorized access.");
}

$row = mysqli_fetch_assoc($result);

// Create PDF
class PDF extends FPDF {
    function Header() {
        // Company Logo and Title
        $this->Image('assets/logo.png', 10, 10, 25); // Adjust path to your logo
        $this->SetFont('Arial', 'B', 16);
        $this->Cell(80);
        $this->Cell(30, 10, 'Logistics Company Ltd', 0, 0, 'C');
        $this->Ln(12);
        $this->SetFont('Arial', '', 12);
        $this->Cell(0, 10, 'Official Invoice', 0, 1, 'C');
        $this->Ln(5);
    }

    function Footer() {
        // Footer Text
        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 9);
        $this->Cell(0, 10, 'Thank you for shipping with us - Logistics Company Ltd', 0, 0, 'C');
    }
}

$pdf = new PDF();
$pdf->AddPage();
$pdf->SetFont('Arial', '', 12);

// Invoice Header
$pdf->Cell(100, 10, "Invoice No: " . $row['invoice_number'], 0, 0);
$pdf->Cell(0, 10, "Date: " . date("M d, Y", strtotime($row['created_at'])), 0, 1);
$pdf->Cell(100, 10, "Tracking No: " . $row['tracking_number'], 0, 1);
$pdf->Ln(5);

// Customer Info
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(0, 10, 'Bill To:', 0, 1);
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(0, 8, $row['name'], 0, 1);
$pdf->Cell(0, 8, $row['email'], 0, 1);
$pdf->Ln(5);

// Shipment Info
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(0, 10, 'Shipment Details:', 0, 1);
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(0, 8, "Origin: " . $row['origin'], 0, 1);
$pdf->Cell(0, 8, "Destination: " . $row['destination'], 0, 1);
$pdf->Cell(0, 8, "Delivery Type: " . ucfirst($row['delivery_type']), 0, 1);
$pdf->Cell(0, 8, "Package Details: " . $row['package_details'], 0, 1);
$pdf->Cell(0, 8, "Status: " . $row['status'], 0, 1);
$pdf->Ln(10);

// Table
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(120, 10, 'Description', 1);
$pdf->Cell(0, 10, 'Amount (Ksh)', 1, 1, 'R');

$pdf->SetFont('Arial', '', 12);
$pdf->Cell(120, 10, $row['package_details'], 1);
$pdf->Cell(0, 10, number_format($row['total_amount'], 2), 1, 1, 'R');

$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(120, 10, 'Total', 1);
$pdf->Cell(0, 10, number_format($row['total_amount'], 2), 1, 1, 'R');

$pdf->Ln(15);

// Note
$pdf->SetFont('Arial', '', 11);
$pdf->MultiCell(0, 8, "Expected Delivery: " . $row['expected_delivery'] . "\n\nWe appreciate your business and hope to serve you again soon.");

// Output PDF
$filename = "Invoice_" . $row['invoice_number'] . ".pdf";
$pdf->Output('D', $filename); // Force download
exit;
?>
