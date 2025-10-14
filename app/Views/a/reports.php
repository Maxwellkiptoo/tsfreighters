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
  background-color: #f4f5f7;
  color: #333;
  overflow-x: hidden;
}
.main-content {
  margin-left: 250px;
  padding: 30px;
}
@media(max-width:768px){
  .main-content{margin-left:0;}
  .sidebar{display:none;}
}

/* Header */
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
  font-size: 22px;
  color: #111827;
  font-weight: 600;
  display: flex;
  align-items: center;
  gap: 10px;
}
header .user {
  display: flex;
  align-items: center;
  font-weight: 500;
  color: #374151;
}
header .user i {
  margin-right: 8px;
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
  flex-wrap: wrap;
}
.filter-form select, .filter-form button {
  padding: 10px 14px;
  font-size: 15px;
  border: 1px solid #d1d5db;
  border-radius: 6px;
}
.filter-form button {
  background: #10b981;
  color: white;
  cursor: pointer;
  border: none;
  transition: background 0.3s;
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
  padding: 25px 20px;
  border-radius: 12px;
  box-shadow: 0 3px 10px rgba(0,0,0,0.06);
  text-align: center;
  transition: transform 0.3s ease, box-shadow 0.3s ease;
}
.card:hover {
  transform: translateY(-5px);
  box-shadow: 0 5px 14px rgba(0,0,0,0.1);
}
.card i {
  font-size: 28px;
  color: #10b981;
  margin-bottom: 8px;
}
.card h3 {
  font-size: 24px;
  margin: 5px 0;
  color: #111827;
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
  color: #111827;
}
table {
  width: 100%;
  border-collapse: collapse;
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
table tr:nth-child(even) {
  background: #f9fafb;
}
table td {
  color: #374151;
}
footer {
  margin-top: 40px;
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

<?php
// === Sample Filter Logic ===
// (Replace with real DB query later)
$month = $_GET['month'] ?? '';
$year = $_GET['year'] ?? '';
$filterLabel = ($month && $year) ? "$month $year" : "All Time";
?>

<div class="main-content">
  <header>
    <h1><i class="fa fa-chart-line"></i> Reports - <?= htmlspecialchars($filterLabel) ?></h1>
    <div class="user"><i class="fa fa-user-circle"></i> Admin</div>
  </header>

  <!-- Filter Form -->
  <form class="filter-form" method="GET" id="reportFilter">
    <select name="month" id="month">
      <option value="">Select Month</option>
      <?php
        $months = ['January','February','March','April','May','June','July','August','September','October','November','December'];
        foreach($months as $m){
          $selected = ($m == $month) ? 'selected' : '';
          echo "<option $selected>$m</option>";
        }
      ?>
    </select>

    <select name="year" id="year">
      <option value="">Select Year</option>
      <?php for($y=date('Y');$y>=2020;$y--){ 
        $selected = ($y == $year) ? 'selected' : '';
        echo "<option $selected>$y</option>"; 
      } ?>
    </select>

    <button type="submit"><i class="fa fa-filter"></i> Filter</button>
  </form>

  <!-- Cards -->
  <div class="report-cards">
    <div class="card"><i class="fa fa-truck"></i><h3>1,245</h3><p>Total Shipments</p></div>
    <div class="card"><i class="fa fa-box"></i><h3>980</h3><p>Delivered</p></div>
    <div class="card"><i class="fa fa-exclamation-triangle" style="color:#f59e0b;"></i><h3>45</h3><p>Delayed</p></div>
    <div class="card"><i class="fa fa-sack-dollar" style="color:#2563eb;"></i><h3>Ksh 320,000</h3><p>Total Revenue</p></div>
  </div>

  <!-- Chart -->
  <canvas id="reportChart"></canvas>

  <!-- Table -->
  <div class="table-section">
    <h2><?= htmlspecialchars($filterLabel) ?> Shipments</h2>
    <table>
      <thead>
        <tr>
          <th>Date</th><th>Tracking ID</th><th>Client</th><th>Status</th><th>Revenue (Ksh)</th>
        </tr>
      </thead>
      <tbody id="reportTable">
        <tr><td>02 Oct 2025</td><td>#TRK001</td><td>John Doe</td><td style="color:green;">Delivered</td><td>12,000</td></tr>
        <tr><td>05 Oct 2025</td><td>#TRK002</td><td>Mary Atieno</td><td style="color:orange;">In Transit</td><td>8,000</td></tr>
        <tr><td>07 Oct 2025</td><td>#TRK003</td><td>Peter Kariuki</td><td style="color:red;">Delayed</td><td>5,500</td></tr>
        <tr><td>09 Oct 2025</td><td>#TRK004</td><td>Jane Mwangi</td><td style="color:green;">Delivered</td><td>14,000</td></tr>
      </tbody>
    </table>
  </div>

  <footer>© 2025 Nexbridge Logistics | Reports Dashboard</footer>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
// === Chart Setup ===
const ctx = document.getElementById('reportChart').getContext('2d');
const gradient = ctx.createLinearGradient(0, 0, 0, 400);
gradient.addColorStop(0, 'rgba(16,185,129,0.8)');
gradient.addColorStop(1, 'rgba(16,185,129,0.2)');

new Chart(ctx, {
  type: 'bar',
  data: {
    labels: ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct'],
    datasets: [{
      label: 'Total Shipments',
      data: [820, 950, 1100, 1175, 1280, 1410, 1550, 1620, 1500, 1325],
      backgroundColor: gradient,
      borderRadius: 6,
    },{
      label: 'Delivered',
      data: [720, 880, 1020, 1100, 1200, 1350, 1475, 1550, 1420, 1260],
      backgroundColor: 'rgba(37,99,235,0.6)',
      borderRadius: 6,
    }]
  },
  options: {
    responsive: true,
    plugins: {
      legend: { position: 'bottom', labels: { usePointStyle: true } },
      tooltip: { backgroundColor: '#111827', titleColor: '#fff', bodyColor: '#d1d5db' }
    },
    scales: { y: { beginAtZero: true, grid: { color:'#e5e7eb' } } }
  }
});
</script>
</body>
</html>
