<?php
// dashboard.php (Frontend mockup)
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Logistics Admin Dashboard</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<style>
/* ===== Inline Dashboard CSS ===== */
body {
  margin: 0;
  font-family: 'Poppins', sans-serif;
  background-color: #f5f6fa;
  color: #333;
}

.sidebar {
  width: 250px;
  background: #111827;
  height: 100vh;
  position: fixed;
  top: 0;
  left: 0;
  color: white;
  padding: 20px 0;
}

.sidebar h2 {
  text-align: center;
  color: #10b981;
  margin-bottom: 40px;
}

.sidebar a {
  display: block;
  color: #d1d5db;
  text-decoration: none;
  padding: 12px 25px;
  margin: 5px 0;
  border-left: 4px solid transparent;
  transition: 0.3s;
}

.sidebar a:hover, .sidebar a.active {
  background: #1f2937;
  border-left: 4px solid #10b981;
  color: #fff;
}

.main-content {
  margin-left: 250px;
  padding: 30px;
}

header {
  background: white;
  padding: 15px 25px;
  border-radius: 10px;
  display: flex;
  justify-content: space-between;
  align-items: center;
}

header h1 {
  margin: 0;
  font-size: 20px;
}

header .user {
  display: flex;
  align-items: center;
}

header .user i {
  margin-right: 10px;
  color: #10b981;
}

/* Cards */
.dashboard-cards {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
  gap: 20px;
  margin-top: 30px;
}

.card {
  background: white;
  padding: 20px;
  border-radius: 12px;
  box-shadow: 0 2px 6px rgba(0,0,0,0.08);
  transition: 0.3s;
}

.card:hover {
  transform: translateY(-5px);
}

.card i {
  font-size: 25px;
  color: #10b981;
  margin-bottom: 10px;
}

.card h3 {
  margin: 5px 0;
  font-size: 18px;
}

.card p {
  font-size: 14px;
  color: #6b7280;
}

/* Table */
.table-section {
  background: white;
  margin-top: 30px;
  border-radius: 12px;
  box-shadow: 0 2px 6px rgba(0,0,0,0.08);
  padding: 20px;
}

.table-section h2 {
  margin-bottom: 15px;
}

table {
  width: 100%;
  border-collapse: collapse;
}

table th, table td {
  text-align: left;
  padding: 12px;
}

table th {
  background: #10b981;
  color: white;
}

table tr:nth-child(even) {
  background: #f9fafb;
}

/* Footer */
footer {
  margin-top: 30px;
  text-align: center;
  font-size: 14px;
  color: #6b7280;
}
</style>
</head>
<body>

<!-- Sidebar -->
<div class="sidebar">
  <h2>Admin Panel</h2>
  <a href="#" class="active"><i class="fa fa-home"></i> Dashboard</a>
  <a href="#"><i class="fa fa-truck"></i> Shipments</a>
  <a href="#"><i class="fa fa-users"></i> Clients</a>
  <a href="#"><i class="fa fa-chart-line"></i> Reports</a>
  <a href="#"><i class="fa fa-cogs"></i> Settings</a>
  <a href="#"><i class="fa fa-sign-out-alt"></i> Logout</a>
</div>

<!-- Main Content -->
<div class="main-content">
  <header>
    <h1>Dashboard Overview</h1>
    <div class="user">
      <i class="fa fa-user-circle"></i> Admin
    </div>
  </header>

  <!-- Cards -->
  <div class="dashboard-cards">
    <div class="card">
      <i class="fa fa-truck"></i>
      <h3>1,248</h3>
      <p>Total Shipments</p>
    </div>
    <div class="card">
      <i class="fa fa-box"></i>
      <h3>326</h3>
      <p>In Transit</p>
    </div>
    <div class="card">
      <i class="fa fa-check-circle"></i>
      <h3>899</h3>
      <p>Delivered</p>
    </div>
    <div class="card">
      <i class="fa fa-exclamation-triangle"></i>
      <h3>23</h3>
      <p>Delayed</p>
    </div>
  </div>

  <!-- Table Section -->
  <div class="table-section">
    <h2>Recent Shipments</h2>
    <table>
      <thead>
        <tr>
          <th>Tracking ID</th>
          <th>Client</th>
          <th>Origin</th>
          <th>Destination</th>
          <th>Status</th>
          <th>Expected Delivery</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>#TRK9472</td>
          <td>John Doe</td>
          <td>Nairobi</td>
          <td>Mombasa</td>
          <td><span style="color:orange;">In Transit</span></td>
          <td>12 Oct 2025</td>
        </tr>
        <tr>
          <td>#TRK3289</td>
          <td>Mary Atieno</td>
          <td>Kisumu</td>
          <td>Nakuru</td>
          <td><span style="color:green;">Delivered</span></td>
          <td>9 Oct 2025</td>
        </tr>
        <tr>
          <td>#TRK6645</td>
          <td>Peter Kariuki</td>
          <td>Nairobi</td>
          <td>Eldoret</td>
          <td><span style="color:red;">Delayed</span></td>
          <td>Pending</td>
        </tr>
        <tr>
          <td>#TRK5567</td>
          <td>Jane Mwangi</td>
          <td>Malindi</td>
          <td>Kisii</td>
          <td><span style="color:green;">Delivered</span></td>
          <td>8 Oct 2025</td>
        </tr>
      </tbody>
    </table>
  </div>

  <footer>© 2025 Nexbridge Logistics Admin Panel</footer>
</div>

</body>
</html>
