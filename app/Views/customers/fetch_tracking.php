<?php
include 'config.php';
header('Content-Type: text/html; charset=utf-8');

$tracking_number = mysqli_real_escape_string($conn, $_GET['tracking_number'] ?? '');

if (!$tracking_number) {
  echo "<div class='error'>Please enter a valid tracking number.</div>";
  exit;
}

// 1️⃣ Check local database first
$query = mysqli_query($conn, "SELECT * FROM shipments WHERE tracking_number='$tracking_number'");
if (mysqli_num_rows($query) > 0) {
  $shipment = mysqli_fetch_assoc($query);
} else {
  // 2️⃣ Optional KRA Integration (mock simulation)
  if (str_starts_with($tracking_number, 'KRA-')) {
      // Simulated response for demo purposes
$apiUrl = "https://api.kra.go.ke/tracking?number=" . urlencode($tracking_number);
$response = file_get_contents($apiUrl);
$data = json_decode($response, true);
$shipment = $data['shipment'] ?? null;

      $shipment = $mockData;
      $fromKRA = true;
  } else {
      echo "<div class='error'>No shipment found for tracking number: <b>$tracking_number</b></div>";
      exit;
  }
}

$status = strtolower(str_replace(' ', '-', $shipment['status']));
?>
<div class="card">
  <h3><?= isset($fromKRA) ? 'KRA-Linked Shipment Details' : 'Shipment Details'; ?></h3>
  <p><span class="label">Tracking Number:</span> <?= htmlspecialchars($shipment['tracking_number']); ?></p>
  <p><span class="label">Origin:</span> <?= htmlspecialchars($shipment['origin']); ?></p>
  <p><span class="label">Destination:</span> <?= htmlspecialchars($shipment['destination']); ?></p>
  <p><span class="label">Package:</span> <?= htmlspecialchars($shipment['package_details']); ?></p>
  <p><span class="label">Status:</span> <span class="<?= $status; ?>"><?= htmlspecialchars($shipment['status']); ?></span></p>
  <p><span class="label">Expected Delivery:</span> <?= htmlspecialchars($shipment['expected_delivery']); ?></p>

  <div class="timeline">
    <h4>Delivery Progress</h4>
    <?php
    $steps = ['Pending Pickup', 'In Transit', 'Out for Delivery', 'Delivered'];
    $currentStep = array_search($shipment['status'], $steps);
    if ($currentStep === false) $currentStep = 0;

    foreach ($steps as $i => $step):
        $active = $i <= $currentStep ? 'active' : '';
    ?>
      <div class="timeline-step <?= $active; ?>">
        <div class="circle"></div>
        <span class="status"><?= htmlspecialchars($step); ?></span>
      </div>
    <?php endforeach; ?>
  </div>

  <?php if (isset($fromKRA)): ?>
  <p style="margin-top:15px; font-size:13px; color:#6b7280;">
    <i class="fa fa-info-circle"></i> This data is retrieved from KRA’s customs system.
  </p>
  <?php endif; ?>
</div>
