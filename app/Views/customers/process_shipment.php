<?php
session_start();
include 'config.php'; // Make sure this contains your DB connection

// Ensure user is logged in (adjust session variable name if different)
if (!isset($_SESSION['customer_id'])) {
    header("Location: login.php");
    exit();
}

// Get customer details
$customer_id = $_SESSION['customer_id'];

// Collect form inputs safely
$origin = mysqli_real_escape_string($conn, $_POST['origin']);
$destination = mysqli_real_escape_string($conn, $_POST['destination']);
$package_details = mysqli_real_escape_string($conn, $_POST['package_details']);
$weight = floatval($_POST['weight']);
$delivery_type = mysqli_real_escape_string($conn, $_POST['delivery_type']);
$insurance = mysqli_real_escape_string($conn, $_POST['insurance']);
$estimated_cost = floatval(str_replace(',', '', $_POST['estimated_cost']));

// Generate tracking number
$tracking_number = 'TRK' . strtoupper(substr(md5(uniqid(mt_rand(), true)), 0, 8));

// Set initial status
$status = 'Pending Pickup';

// Expected delivery date logic
if ($delivery_type == 'express') {
    $expected_date = date('Y-m-d', strtotime('+1 day'));
} else {
    $expected_date = date('Y-m-d', strtotime('+3 days'));
}

// Insert into database
$query = "INSERT INTO shipments (customer_id, tracking_number, origin, destination, package_details, weight, delivery_type, insurance, estimated_cost, status, expected_delivery, created_at)
VALUES ('$customer_id', '$tracking_number', '$origin', '$destination', '$package_details', '$weight', '$delivery_type', '$insurance', '$estimated_cost', '$status', '$expected_date', NOW())";

if (mysqli_query($conn, $query)) {
    // Redirect to shipments page with success message
    $_SESSION['success_message'] = "Shipment created successfully! Your tracking number is $tracking_number.";
    header("Location: customer_shipments.php");
    exit();
} else {
    // On failure
    $_SESSION['error_message'] = "Error creating shipment. Please try again.";
    header("Location: customer_create_shipment.php");
    exit();
}
?>
