<?php include 'layout/client_sidebar.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Create Shipment</title>
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

/* Page Header */
.page-header {
  display: flex;
  align-items: center;
  justify-content: space-between;
}
.page-header h1 {
  font-size: 22px;
  font-weight: 600;
  color: #111827;
}

/* Form Container */
.form-container {
  background: white;
  border-radius: 16px;
  padding: 30px;
  margin-top: 30px;
  box-shadow: 0 4px 12px rgba(0,0,0,0.08);
  max-width: 750px;
}
.form-container h2 {
  color: #10b981;
  margin-bottom: 20px;
  font-size: 20px;
}

/* Form Styling */
form {
  display: grid;
  gap: 18px;
}
label {
  font-weight: 500;
  color: #374151;
}
input, select, textarea {
  padding: 10px 12px;
  border: 1px solid #d1d5db;
  border-radius: 10px;
  font-size: 14px;
  width: 100%;
}
textarea {
  resize: vertical;
  height: 80px;
}
button {
  background: #10b981;
  border: none;
  color: #fff;
  padding: 12px 16px;
  border-radius: 10px;
  font-size: 15px;
  font-weight: 500;
  cursor: pointer;
  transition: background 0.3s;
}
button:hover { background: #059669; }

.back-btn {
  display: inline-flex;
  align-items: center;
  gap: 6px;
  background: #e5e7eb;
  color: #374151;
  padding: 8px 12px;
  border-radius: 8px;
  text-decoration: none;
  font-size: 14px;
  transition: background 0.3s;
}
.back-btn:hover { background: #d1d5db; }

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
    <h1><i class="fa fa-paper-plane"></i> Create New Shipment</h1>
    <a href="customer_shipments.php" class="back-btn"><i class="fa fa-arrow-left"></i> Back to Shipments</a>
  </div>

  <div class="form-container">
    <h2>Shipment Details</h2>
    <form action="process_shipment.php" method="POST">
      <div>
        <label for="origin">Pickup Location</label>
        <input type="text" id="origin" name="origin" placeholder="e.g. Nairobi, Kenya" required>
      </div>

      <div>
        <label for="destination">Destination</label>
        <input type="text" id="destination" name="destination" placeholder="e.g. Mombasa, Kenya" required>
      </div>

      <div>
        <label for="package_details">Package Description</label>
        <textarea id="package_details" name="package_details" placeholder="Describe the package (e.g., documents, electronics, etc.)" required></textarea>
      </div>

      <div>
        <label for="weight">Package Weight (kg)</label>
        <input type="number" id="weight" name="weight" step="0.1" placeholder="e.g. 2.5" required>
      </div>

      <div>
        <label for="delivery_type">Delivery Type</label>
        <select id="delivery_type" name="delivery_type" required>
          <option value="">Select delivery option</option>
          <option value="standard">Standard (2–3 days)</option>
          <option value="express">Express (1 day)</option>
        </select>
      </div>

      <div>
        <label for="insurance">Add Insurance?</label>
        <select id="insurance" name="insurance">
          <option value="no">No</option>
          <option value="yes">Yes</option>
        </select>
      </div>

      <div>
        <label for="estimated_cost">Estimated Cost (Ksh)</label>
        <input type="text" id="estimated_cost" name="estimated_cost" readonly placeholder="Auto-calculated" style="background:#f3f4f6;">
      </div>

      <button type="submit"><i class="fa fa-check"></i> Submit Shipment</button>
    </form>
  </div>

  <footer>© 2025 Nexbridge Logistics | Create Shipment</footer>
</div>

<script>
// Simple cost estimation logic
document.getElementById('delivery_type').addEventListener('change', calculateCost);
document.getElementById('weight').addEventListener('input', calculateCost);

function calculateCost() {
  const weight = parseFloat(document.getElementById('weight').value) || 0;
  const type = document.getElementById('delivery_type').value;
  let cost = 0;

  if (weight > 0) {
    cost = weight * (type === 'express' ? 500 : 300);
  }

  document.getElementById('estimated_cost').value = cost > 0 ? cost.toLocaleString() : '';
}
</script>

</body>
</html>
