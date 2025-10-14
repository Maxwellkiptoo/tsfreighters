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
.filter-form button:hover { background: #0d946c; }
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
.export-buttons {
  margin-top: 15px;
  text-align: right;
}
.export-buttons button {
  padding: 10px 15px;
  border: none;
  border-radius: 6px;
  color: white;
  cursor: pointer;
  margin-left: 10px;
  font-size: 14px;
}
.export-buttons .print { background: #2563eb; }
.export-buttons .csv { background: #10b981; }
.export-buttons .pdf { background: #f59e0b; }
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
table tr:nth-child(even) { background: #f9fafb; }
table td { color: #374151; }
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
.summary-box {
  background: white;
  margin-top: 30px;
  padding: 20px;
  border-radius: 10px;
  box-shadow: 0 2px 6px rgba(0,0,0,0.08);
}
.notes-section {
  background: white;
  padding: 20px;
  margin-top: 30px;
  border-radius: 10px;
  box-shadow: 0 2px 6px rgba(0,0,0,0.08);
}
.notes-section textarea {
  width: 100%;
  padding: 10px;
  border-radius: 6px;
  border: 1px solid #ddd;
}
.notes-section button {
  margin-top: 10px;
  background: #10b981;
  color: white;
  padding: 8px 16px;
  border: none;
  border-radius: 6px;
  cursor: pointer;
}
</style>
</head>
<body>

<?php
$month = $_GET['month'] ?? '';
$year = $_GET['year'] ?? '';
$filterLabel = ($month && $year) ? "$month $year" : "All Time";
?>

<div class="main-content">
  <header>
    <h1><i class="fa fa-chart-line"></i> Reports - <?= htmlspecialchars($filterLabel) ?></h1>
    <div class="user"><i class="fa fa-user-circle"></i> Admin</div>
  </header>

  <form class="filter-form" method="GET" id="reportFilter">
    <select name="month" id="month">
      <option value="">Select Month</option>
      <?php
      $months = ['January','February','March','April','May','June','July','August','September','October','November','December'];
      foreach($months as $m){
        $selected = ($m == $month) ? 'selected' : '';
        echo "<option $selected>$m</option>";
      } ?>
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

  <div class="export-buttons">
    <button class="print" onclick="window.print()"><i class="fa fa-print"></i> Print</button>
    <button class="csv"><i class="fa fa-file-csv"></i> Export CSV</button>
    <button class="pdf"><i class="fa fa-file-pdf"></i> Export PDF</button>
  </div>

  <div class="report-cards">
    <div class="card"><i class="fa fa-truck"></i><h3>1,245</h3><p>Total Shipments</p></div>
    <div class="card"><i class="fa fa-box"></i><h3>980</h3><p>Delivered</p></div>
    <div class="card"><i class="fa fa-clock"></i><h3>2.3 hrs</h3><p>Avg. Delivery Time</p></div>
    <div class="card"><i class="fa fa-percent"></i><h3>96%</h3><p>On-Time Rate</p></div>
    <div class="card"><i class="fa fa-sack-dollar"></i><h3>Ksh 320,000</h3><p>Total Revenue</p></div>
  </div>

  <canvas id="reportChart"></canvas>
  <canvas id="statusChart"></canvas>

  <div class="summary-box">
    <h2>Summary for <?= htmlspecialchars($filterLabel) ?></h2>
    <p>In <?= htmlspecialchars($filterLabel) ?>, the logistics team handled <strong>1,245 shipments</strong> generating 
    <strong>Ksh 320,000</strong> in revenue. Delivery efficiency was <strong>96%</strong> with 
    <strong>45</strong> delayed shipments and <strong>220</strong> still in transit.</p>
  </div>

  <div class="table-section">
    <h2>Top Performing Clients</h2>
    <table>
      <thead>
        <tr><th>Client</th><th>Shipments</th><th>Revenue (Ksh)</th></tr>
      </thead>
      <tbody>
        <tr><td>John Doe Ltd</td><td>45</td><td>75,000</td></tr>
        <tr><td>Global Freight Co.</td><td>38</td><td>60,000</td></tr>
        <tr><td>FastTrack Ltd</td><td>32</td><td>55,500</td></tr>
      </tbody>
    </table>
  </div>

  <div class="notes-section">
    <h2>Admin Notes</h2>
    <textarea rows="4" placeholder="Add notes or comments about this month's performance..."></textarea>
    <button>Save Notes</button>
  </div>

  <footer>© 2025 Nexbridge Logistics | Reports Dashboard</footer>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
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
      data: [820,950,1100,1175,1280,1410,1550,1620,1500,1325],
      backgroundColor: gradient,
      borderRadius: 6,
    },{
      label: 'Delivered',
      data: [720,880,1020,1100,1200,1350,1475,1550,1420,1260],
      backgroundColor: 'rgba(37,99,235,0.6)',
      borderRadius: 6,
    }]
  },
  options: {
    responsive: true,
    plugins: { legend: { position: 'bottom' } },
    scales: { y: { beginAtZero: true } }
  }
});

const ctx2 = document.getElementById('statusChart');
new Chart(ctx2, {
  type: 'pie',
  data: {
    labels: ['Delivered','Delayed','In Transit'],
    datasets: [{
      data: [980,45,220],
      backgroundColor: ['#10b981','#f59e0b','#3b82f6']
    }]
  },
  options: { plugins: { legend: { position: 'bottom' } } }
});
</script>
</body>
</html>
