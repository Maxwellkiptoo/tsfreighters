<?php
require_once(__DIR__ . '/../../../fpdf/fpdf.php'); // ✅ Make sure you have FPDF in your project

// Mock data (Replace later with real DB data)
$order = [
    'invoice_no' => 'INV-' . strtoupper(substr(md5(uniqid()), 0, 6)),
    'client_name' => 'John Doe',
    'client_email' => 'johndoe@example.com',
    'client_phone' => '+254712345678',
    'shipment_id' => 'TSF-2458',
    'destination' => 'Mombasa, Kenya',
    'date' => date('d M Y'),
    'total_amount' => 12500,
    'items' => [
        ['name' => 'Freight Service - Nairobi to Mombasa', 'quantity' => 1, 'price' => 12500],
    ]
];

// ✅ Create Invoice Folder if not exists
$invoiceDir = __DIR__ . '/../../invoices/';
if (!file_exists($invoiceDir)) {
    mkdir($invoiceDir, 0777, true);
}

// ✅ Initialize FPDF
$pdf = new FPDF('P', 'mm', 'A4');
$pdf->AddPage();

// --- HEADER ---
$pdf->SetFont('Arial', 'B', 16);
$pdf->SetTextColor(16, 185, 129);
$pdf->Cell(0, 10, 'TS Freighters Ltd', 0, 1, 'C');
$pdf->SetTextColor(0, 0, 0);
$pdf->SetFont('Arial', '', 11);
$pdf->Cell(0, 8, 'Official Invoice', 0, 1, 'C');
$pdf->Ln(8);

// --- INVOICE INFO ---
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(100, 6, 'Invoice No: ' . $order['invoice_no'], 0, 0);
$pdf->Cell(0, 6, 'Date: ' . $order['date'], 0, 1);
$pdf->Cell(100, 6, 'Client: ' . $order['client_name'], 0, 0);
$pdf->Cell(0, 6, 'Phone: ' . $order['client_phone'], 0, 1);
$pdf->Cell(100, 6, 'Email: ' . $order['client_email'], 0, 1);
$pdf->Cell(100, 6, 'Shipment ID: ' . $order['shipment_id'], 0, 1);
$pdf->Ln(10);

// --- ITEMS TABLE ---
$pdf->SetFont('Arial', 'B', 11);
$pdf->Cell(90, 8, 'Description', 1, 0, 'C');
$pdf->Cell(30, 8, 'Quantity', 1, 0, 'C');
$pdf->Cell(35, 8, 'Unit Price (KSh)', 1, 0, 'C');
$pdf->Cell(35, 8, 'Total (KSh)', 1, 1, 'C');

$pdf->SetFont('Arial', '', 10);
foreach ($order['items'] as $item) {
    $pdf->Cell(90, 8, $item['name'], 1, 0);
    $pdf->Cell(30, 8, $item['quantity'], 1, 0, 'C');
    $pdf->Cell(35, 8, number_format($item['price'], 2), 1, 0, 'R');
    $pdf->Cell(35, 8, number_format($item['price'] * $item['quantity'], 2), 1, 1, 'R');
}

$pdf->SetFont('Arial', 'B', 11);
$pdf->Cell(155, 8, 'Total Amount', 1, 0, 'R');
$pdf->Cell(35, 8, 'KSh ' . number_format($order['total_amount'], 2), 1, 1, 'R');
$pdf->Ln(10);

// --- FOOTER ---
$pdf->SetFont('Arial', '', 9);
$pdf->MultiCell(0, 6, "Thank you for choosing TS Freighters.\nAll payments should be made to TS Freighters Bank Account 123456789 - Equity Bank.\nFor queries, contact support@tsfreighters.com", 0, 'C');

// ✅ Save the invoice
$invoiceFile = $invoiceDir . $order['invoice_no'] . '.pdf';
$pdf->Output('F', $invoiceFile);

// ✅ Output to browser for download
$pdf->Output('I', $order['invoice_no'] . '.pdf');
exit;
?>
