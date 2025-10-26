<?php
session_start();
require_once __DIR__ . '/../../Core/Database.php';
include 'layout/client_sidebar.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Customer Dashboard | tsfreighters</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <style>
    body {font-family:'Poppins',sans-serif; background:#f9fafb; margin:0; padding:0;}
    .container {max-width:fit-content ; margin:200px auto;
       background:#fff; padding:40px; border-radius:12px; box-shadow:0 2px 12px rgba(0,0,0,0.1);}
    h2 {text-align:center; color:#111827; margin-bottom:25px;}
    form {display:flex; justify-content:center; gap:10px; margin-bottom:30px;}
    input[type="text"] {width:60%; padding:10px; border:1px solid #d1d5db; border-radius:8px; font-size:16px;}
    button {background:#2563eb; color:#fff; border:none; padding:10px 20px; border-radius:8px; cursor:pointer;}
    button:hover {background:#1e40af;}
    .error {background:#fee2e2; color:#991b1b; padding:10px 15px; border-radius:8px; margin-bottom:20px; text-align:center;}
    .card {background:#f3f4f6; padding:20px; border-radius:10px; margin-top:20px;}
    .label {font-weight:600; color:#374151;}
    .value {color:#111827;}
    .timeline {margin-top:30px;}
    .timeline-step {display:flex; align-items:center; margin-bottom:15px;}
    .circle {width:20px; height:20px; border-radius:50%; background:#d1d5db; margin-right:10px;}
    .active .circle {background:#2563eb;}
    .status {font-weight:500;}
    .delivered {color:green;}
    .pending {color:orange;}
    .in-transit {color:#2563eb;}
    #loading {display:none; text-align:center; margin-top:20px; color:#2563eb; font-weight:500;}
    .loader {border:3px solid #f3f3f3; border-top:3px solid #2563eb; border-radius:50%; width:20px; height:20px; animation: spin 1s linear infinite; display:inline-block;}
    @keyframes spin {100%{transform:rotate(360deg);}}
  </style>
</head>
<body>
  <div class="container">
    <h2>Track Your Shipment</h2>
    <form id="trackingForm">
      <input type="text" id="tracking_number" name="tracking_number" placeholder="Enter tracking number (e.g. KRA-TRK9472)" required>
      <button type="submit"><i class="fa fa-search"></i> Track</button>
     </form>
    <div id="loading"><span class="loader"></span> Fetching latest updates...</div>
    <div id="trackingResult"></div>
  </div>
    <?php include 'layout/cfooter.php'; ?>

<script>
  const form = document.getElementById('trackingForm');
  const resultDiv = document.getElementById('trackingResult');
  const loader = document.getElementById('loading');
  let trackingNumber = '';

  form.addEventListener('submit', e => {
    e.preventDefault();
    trackingNumber = document.getElementById('tracking_number').value.trim();
    if (trackingNumber) fetchTracking();
  });
  setInterval(() => {
    if (trackingNumber !== '') fetchTracking();
  }, 30000);

  function fetchTracking() {
    loader.style.display = 'block';
    fetch('fetch_tracking.php?tracking_number=' + encodeURIComponent(trackingNumber))
      .then(res => res.text())
      .then(data => {
        resultDiv.innerHTML = data;
        loader.style.display = 'none';
      })
      .catch(() => {
        resultDiv.innerHTML = "<div class='error'>Unable to fetch tracking details. Please try again.</div>";
        loader.style.display = 'none';
      });
  }
</script>
</body>
</html>
