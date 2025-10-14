<?php include 'layout/sidebar.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Monthly Reports | Logistics Admin</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<style>
body {
  margin: 0;
  font-family: 'Poppins', sans-serif;
  background-color: #f5f6fa;
  color: #333;
  overflow-x: hidden;
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
  box-shadow: 0 2px 6px rgba(0,0,0,0.08);
}

header h1 {
  margin: 0;
  font-size: 20px;
  color: #111827;
}

header .user {
  display: flex;
  align-items: center;
}

header .user i {
  margin-right: 10px;
  color: #10b981;
}

/* Filter Form */
.filter-form {
  background: white;
  margin-top: 25px;
  padding: 20px;
  border-radius: 12px;
  box-shadow: 0 2px 6px rgba(0,0,0,0.08);
  display: flex;
  gap: 20px;
  align-items: center;
}

.filter-form select, .filter-form button {
  padding: 10px;
  font-size: 15px;
  border: 1px solid #ddd;
  border-radius: 6px;
}

.filter-form button {
  background: #10b981;
  color: white;
  cursor: pointer;
  border: none;
  transition: 0.3s;
}

.filter-form button:hover {
  background: #0d946c;
}

/* Cards */
.report-cards {
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
  text-align: center;
}

.card i {
  font-size: 25px;
  color: #10b981;
  margin-bottom: 10px;
}

.card h3 {
  margin: 5px 0;
  font-size: 22px;
}

.card p {
  font-size: 14px;
  color: #6b7280;
}

/* Table */
.table-section {
  background: white;
  margin-top: 40px;
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

footer {
  margin-top: 30px;
  text-align: center;
  font-size: 14px;
  color: #6b7280;
}

canvas {
  width: 100%;
  height: 320px;
  margin-top: 30px;
}
</style>
</head>
<body>

<div class="main-content">
  <header>
    <h1>Monthly Reports</h1>
    <div class="user"><i class="fa fa-user-circle"></i> Admin</div>
  </header>

  <!-- Filter Form -->
  <form class="filter-form">
    <select name="month">
      <option value="">Select Month</option>
      <option>January</option><option>February</option><option>March</option>
      <option>April</option><option>May</option><option>June</option>
      <option>July</option><option>August</option><option>September</option>
      <option>October</option><option>November</option><option>December</option>
    </select>

    <select name="year">
      <option value="">Select Year</option>
      <option>2023</option>
      <option>2024</option>
      <option selected>2025</option>
    </select>

    <button type="submit"><i class="fa fa-filter"></i> Filter</button>
  </form>

  <!-- Cards -->
  <div class="report-cards">
    <div class="card">
      <i class="fa fa-truck"></i>
      <h3>1,245</h3>
      <p>Total Shipments</p>
    </div>
    <div class="card">
      <i class="fa fa-box"></i>
      <h3>980</h3>
      <p>Delivered</p>
    </div>
    <div class="card">
      <i class="fa fa-exclamation-triangle"></i>
      <h3>45</h3>
      <p>Delayed</p>
    </div>
    <div class="card">
      <i class="fa fa-dollar-sign"></i>
      <h3>Ksh 320,000</h3>
      <p>Total Revenue</p>
    </div>
  </div>

  <!-- Chart -->
  <canvas id="reportChart"></canvas>

  <!-- Table -->
  <div class="table-section">
    <h2>Detailed Monthly Shipments</h2>
    <table>
      <thead>
        <tr>
          <th>Date</th>
          <th>Tracking ID</th>
          <th>Client</th>
          <th>Status</th>
          <th>Revenue (Ksh)</th>
        </tr>
      </thead>
      <tbody>
        <tr><td>02 Oct 2025</td><td>#TRK001</td><td>John Doe</td><td style="color:green;">Delivered</td><td>12,000</td></tr>
        <tr><td>05 Oct 2025</td><td>#TRK002</td><td>Mary Atieno</td><td style="color:orange;">In Transit</td><td>8,000</td></tr>
        <tr><td>07 Oct 2025</td><td>#TRK003</td><td>Peter Kariuki</td><td style="color:red;">Delayed</td><td>5,500</td></tr>
        <tr><td>09 Oct 2025</td><td>#TRK004</td><td>Jane Mwangi</td><td style="color:green;">Delivered</td><td>14,000</td></tr>
      </tbody>
    </table>
  </div>

  <footer>© 2025 Nexbridge Logistics Reports Dashboard</footer>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
// Line Chart
const ctx = document.getElementById('reportChart');
new Chart(ctx, {
  type: 'bar',
  data: {
    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct'],
    datasets: [
      {
        label: 'Total Shipments',
        data: [800, 950, 1020, 1100, 1250, 1400, 1550, 1600, 1450, 1300],
        backgroundColor: 'rgba(16,185,129,0.7)',
      },
      {
        label: 'Delivered',
        data: [700, 850, 950, 1000, 1150, 1300, 1450, 1500, 1380, 1200],
        backgroundColor: 'rgba(37,99,235,0.6)',
      }
    ]
  },
  options: {
    responsive: true,
    plugins: { legend: { position: 'bottom' } },
    scales: { y: { beginAtZero: true } }
  }
});
</script>

</body>
</html>
