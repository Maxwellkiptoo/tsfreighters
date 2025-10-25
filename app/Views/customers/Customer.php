<?php include 'layout/client_sidebar.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Client Dashboard </title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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

/* Dashboard Header */
.dashboard-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
}
.dashboard-header h1 {
  font-size: 22px;
  font-weight: 600;
  color: #111827;
}
.notifications {
  position: relative;
  cursor: pointer;
}
.notifications i {
  font-size: 22px;
  color: #10b981;
}
.badge {
  position: absolute;
  top: -6px;
  right: -6px;
  background: #ef4444;
  color: #fff;
  font-size: 11px;
  padding: 2px 6px;
  border-radius: 50%;
}

/* Cards */
.dashboard-cards {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(230px, 1fr));
  gap: 25px;
  margin-top: 30px;
}
.card {
  background: white;
  padding: 25px 20px;
  border-radius: 16px;
  box-shadow: 0 4px 10px rgba(0,0,0,0.08);
  text-align: center;
  transition: all 0.3s ease;
}
.card:hover {
  transform: translateY(-6px);
  box-shadow: 0 8px 18px rgba(0,0,0,0.12);
}
.card i {
  font-size: 26px;
  color: #10b981;
  margin-bottom: 10px;
}
.card h3 {
  margin: 5px 0;
  font-size: 22px;
  color: #111827;
}
.card p {
  font-size: 14px;
  color: #6b7280;
}

/* Shipment Table */
.table-section {
  background: white;
  margin-top: 40px;
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
.status {
  padding: 5px 10px;
  border-radius: 8px;
  font-weight: 500;
  font-size: 13px;
  display: inline-block;
}
.status.delivered{background:#d1fae5;color:#047857;}
.status.transit{background:#fef3c7;color:#b45309;}
.status.pending{background:#e0f2fe;color:#0369a1;}

/* Order Form */
.order-form {
  background: white;
  border-radius: 16px;
  padding: 25px;
  margin-top: 40px;
  box-shadow: 0 4px 10px rgba(0,0,0,0.08);
}
.order-form h2 { margin-bottom: 15px; }
.order-form form {
  display: grid;
  gap: 15px;
}
.order-form input, .order-form select {
  padding: 10px 12px;
  border: 1px solid #d1d5db;
  border-radius: 10px;
  font-size: 14px;
  width: 100%;
}
.order-form button {
  background: #10b981;
  border: none;
  color: #fff;
  padding: 10px 15px;
  border-radius: 10px;
  cursor: pointer;
  transition: background 0.3s;
}
.order-form button:hover { background: #059669; }

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

  <!-- Header -->
  <div class="dashboard-header">
    <h1>Welcome, Client</h1>
    <div class="notifications">
      <i class="fa fa-bell"></i>
      <span class="badge">3</span>
    </div>
  </div>

  <!-- Overview Cards -->
  <div class="dashboard-cards">
    <div class="card"><i class="fa fa-truck"></i><h3>5</h3><p>Active Shipments</p></div>
    <div class="card"><i class="fa fa-check-circle"></i><h3>12</h3><p>Delivered</p></div>
    <div class="card"><i class="fa fa-hourglass-half"></i><h3>2</h3><p>Pending</p></div>
    <div class="card"><i class="fa fa-wallet"></i><h3>Ksh 124,000</h3><p>Total Spent</p></div>
  </div>

  <!-- Shipment History Table -->
  <div class="table-section">
    <h2>My Shipments</h2>
    <table>
      <thead>
        <tr><th>Tracking ID</th><th>Origin</th><th>Destination</th><th>Status</th><th>Expected Delivery</th></tr>
      </thead>
      <tbody>
        <tr><td>#TRK9472</td><td>Nairobi</td><td>Mombasa</td><td><span class="status transit">In Transit</span></td><td>29 Oct 2025</td></tr>
        <tr><td>#TRK3289</td><td>Kisumu</td><td>Nakuru</td><td><span class="status delivered">Delivered</span></td><td>21 Oct 2025</td></tr>
        <tr><td>#TRK1123</td><td>Thika</td><td>Eldoret</td><td><span class="status pending">Pending Pickup</span></td><td>Pending</td></tr>
      </tbody>
    </table>
  </div>

  <!-- Place Order -->
  <div class="order-form">
    <h2>Place a New Shipment Order</h2>
    <form action="place_order.php" method="POST">
      <input type="text" name="origin" placeholder="Pickup Location" required>
      <input type="text" name="destination" placeholder="Destination" required>
      <input type="text" name="package_details" placeholder="Package Details" required>
      <select name="delivery_type" required>
        <option value="">Select Delivery Type</option>
        <option value="standard">Standard Delivery</option>
        <option value="express">Express Delivery</option>
      </select>
      <button type="submit"><i class="fa fa-paper-plane"></i> Submit Order</button>
    </form>
  </div>

  <footer>© 2025 Nexbridge Logistics Client Dashboard</footer>
</div>

</body>
</html>
