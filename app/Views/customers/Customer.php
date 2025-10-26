<?php include 'layout/client_sidebar.php'; ?>
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
body {
  margin: 0;
  font-family: 'Poppins', sans-serif;
  background: #f9fafb;
  color: #333;
  overflow-x: hidden;
}
.main-content {
  /* margin-left: 260px; */
  padding: 30px;
}
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
  font-size: 28px;
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

/* Charts Section */
.charts-section {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(340px, 1fr));
  gap: 25px;
  margin-top: 40px;
}
.chart-card {
  background: white;
  border-radius: 16px;
  box-shadow: 0 4px 10px rgba(0,0,0,0.08);
  padding: 20px;
}
.chart-card h2 {
  font-size: 18px;
  margin-bottom: 10px;
  color: #111827;
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
}.status.delivered{background:#d1fae5;color:#047857;}
.status.transit{background:#fef3c7;color:#b45309;}
.status.pending{background:#e0f2fe;color:#0369a1;}


</style>
</head>
<body>

<div class="main-content">
  <!-- Overview Cards -->
  <div class="dashboard-cards">
    <div class="card"><i class="fa fa-truck"></i><h3>5</h3><p>Active Shipments</p></div>
    <div class="card"><i class="fa fa-check-circle"></i><h3>12</h3><p>Delivered Packages</p></div>
    <div class="card"><i class="fa fa-hourglass-half"></i><h3>2</h3><p>Pending Deliveries</p></div>
    <div class="card"><i class="fa fa-wallet"></i><h3>Ksh 124,000</h3><p>Total Payments</p></div>
    <div class="card"><i class="fa fa-map-marker-alt"></i><h3>14</h3><p>Total Destinations Covered</p></div>
  </div>

  <!-- Charts Section -->
  <div class="charts-section">
    <div class="chart-card">
      <h2>Shipment Status Overview</h2>
      <canvas id="shipmentChart"></canvas>
    </div>

    <div class="chart-card">
      <h2>Monthly Spending</h2>
      <canvas id="spendingChart"></canvas>
    </div>
  </div>

  <!-- Shipment History -->
  <div class="table-section">
    <h2>Recent Shipments</h2>
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
  <?php include 'layout/cfooter.php'; ?>
</div>

<!-- Chart.js Configuration -->
<script>
const shipmentCtx = document.getElementById('shipmentChart').getContext('2d');
new Chart(shipmentCtx, {
  type: 'doughnut',
  data: {
    labels: ['Delivered', 'In Transit', 'Pending'],
    datasets: [{
      data: [12, 5, 2],
      backgroundColor: ['#10b981', '#f59e0b', '#3b82f6'],
      borderWidth: 0
    }]
  },
  options: { plugins: { legend: { position: 'bottom' } } }
});

const spendingCtx = document.getElementById('spendingChart').getContext('2d');
new Chart(spendingCtx, {
  type: 'line',
  data: {
    labels: ['May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct'],
    datasets: [{
      label: 'Ksh Spent',
      data: [18000, 22000, 19500, 25000, 27000, 32000],
      borderColor: '#10b981',
      backgroundColor: 'rgba(16,185,129,0.1)',
      tension: 0.4,
      fill: true
    }]
  },
  options: {
    plugins: { legend: { display: false } },
    scales: {
      y: { beginAtZero: true, ticks: { stepSize: 5000 } }
    }
  }
});
</script>

</body>
</html>
