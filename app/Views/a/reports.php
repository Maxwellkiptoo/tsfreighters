<?php include 'layout/sidebar.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Company Reports | Admin Dashboard</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<style>
body {
  margin: 0;
  font-family: 'Poppins', sans-serif;
  background-color: #f4f5f7;
  color: #333;
}
.main-content { margin-left: 250px; padding: 30px; }
@media(max-width:768px){ .main-content{margin-left:0;} .sidebar{display:none;} }
header {
  background: #fff;
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
.filter-form {
  background: #fff;
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
  transition: 0.3s;
}
.filter-form button:hover { background: #0d946c; }

.report-card-group {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
  gap: 20px;
  margin-top: 30px;
}
.card {
  background: #fff;
  padding: 25px 20px;
  border-radius: 12px;
  box-shadow: 0 3px 10px rgba(0,0,0,0.06);
  text-align: center;
}
.card i {
  font-size: 28px;
  color: #10b981;
  margin-bottom: 8px;
}
.card h3 { font-size: 24px; margin: 5px 0; color: #111827; }
.card p { font-size: 14px; color: #6b7280; }

.section {
  background: white;
  margin-top: 40px;
  border-radius: 12px;
  box-shadow: 0 2px 6px rgba(0,0,0,0.08);
  padding: 20px;
}
.section h2 {
  display: flex;
  justify-content: space-between;
  align-items: center;
  color: #111827;
}
.section .tools button {
  margin-left: 8px;
  padding: 6px 12px;
  border: none;
  border-radius: 6px;
  color: white;
  cursor: pointer;
  font-size: 13px;
}
.btn-print { background: #2563eb; }
.btn-csv { background: #10b981; }
.btn-pdf { background: #f59e0b; }

table { width: 100%; border-collapse: collapse; margin-top: 15px; }
table th, table td { text-align: left; padding: 10px 15px; }
table th { background: #10b981; color: white; font-weight: 600; }
table tr:nth-child(even) { background: #f9fafb; }

footer { margin-top: 40px; text-align: center; font-size: 14px; color: #6b7280; }
canvas { width: 100%; height: 300px; margin-top: 25px; }
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
    <div><i class="fa fa-user-circle"></i> Admin</div>
  </header>

  <form class="filter-form" method="GET">
    <select name="month">
      <option value="">Select Month</option>
      <?php
      $months = ['January','February','March','April','May','June','July','August','September','October','November','December'];
      foreach($months as $m){
        $selected = ($m == $month) ? 'selected' : '';
        echo "<option $selected>$m</option>";
      } ?>
    </select>
    <select name="year">
      <option value="">Select Year</option>
      <?php for($y=date('Y');$y>=2020;$y--){ 
        $selected = ($y == $year) ? 'selected' : '';
        echo "<option $selected>$y</option>"; 
      } ?>
    </select>
    <button type="submit"><i class="fa fa-filter"></i> Filter</button>
  </form>

  <div class="report-card-group">
    <div class="card"><i class="fa fa-truck"></i><h3>1,245</h3><p>Total Shipments</p></div>
    <div class="card"><i class="fa fa-box"></i><h3>980</h3><p>Delivered</p></div>
    <div class="card"><i class="fa fa-clock"></i><h3>2.3 hrs</h3><p>Avg. Delivery Time</p></div>
    <div class="card"><i class="fa fa-percent"></i><h3>96%</h3><p>On-Time Rate</p></div>
    <div class="card"><i class="fa fa-sack-dollar"></i><h3>Ksh 320,000</h3><p>Total Revenue</p></div>
  </div>

  <!-- Shipments Chart -->
  <div class="section" id="shipmentsReport">
    <h2>
      Shipments Report (<?= htmlspecialchars($filterLabel) ?>)
      <div class="tools">
        <button class="btn-print" onclick="printSection('shipmentsReport')"><i class="fa fa-print"></i></button>
        <button class="btn-csv" onclick="exportSectionCSV('shipmentsReport')"><i class="fa fa-file-csv"></i></button>
        <button class="btn-pdf" onclick="exportSectionPDF('shipmentsReport')"><i class="fa fa-file-pdf"></i></button>
      </div>
    </h2>
    <canvas id="shipmentsChart"></canvas>
  </div>

  <!-- Client Table -->
  <div class="section" id="clientReport">
    <h2>
      Top Clients
      <div class="tools">
        <button class="btn-print" onclick="printSection('clientReport')"><i class="fa fa-print"></i></button>
        <button class="btn-csv" onclick="exportSectionCSV('clientReport')"><i class="fa fa-file-csv"></i></button>
        <button class="btn-pdf" onclick="exportSectionPDF('clientReport')"><i class="fa fa-file-pdf"></i></button>
      </div>
    </h2>
    <table>
      <thead><tr><th>Client</th><th>Shipments</th><th>Revenue (Ksh)</th></tr></thead>
      <tbody>
        <tr><td>John Doe Ltd</td><td>45</td><td>75,000</td></tr>
        <tr><td>Global Freight Co.</td><td>38</td><td>60,000</td></tr>
        <tr><td>FastTrack Ltd</td><td>32</td><td>55,500</td></tr>
      </tbody>
    </table>
  </div>

  <footer>© <?= date('Y') ?> Nexbridge Logistics | Reports Dashboard</footer>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>

<script>
// Chart.js
const ctx = document.getElementById('shipmentsChart').getContext('2d');
new Chart(ctx, {
  type: 'bar',
  data: {
    labels: ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct'],
    datasets: [{
      label: 'Shipments',
      data: [820,950,1100,1175,1280,1410,1550,1620,1500,1325],
      backgroundColor: '#10b981'
    }]
  },
  options: { responsive: true, plugins: { legend: { display: false } } }
});

// ✅ Print only section
function printSection(sectionId) {
  const content = document.getElementById(sectionId).innerHTML;
  const printWindow = window.open('', '', 'width=900,height=600');
  printWindow.document.write('<html><head><title>Print Report</title>');
  printWindow.document.write('</head><body>');
  printWindow.document.write(content);
  printWindow.document.write('</body></html>');
  printWindow.document.close();
  printWindow.print();
}

// ✅ Export section as CSV
function exportSectionCSV(sectionId) {
  const rows = document.querySelectorAll(`#${sectionId} table tr`);
  if (rows.length === 0) return alert("No table found to export!");
  let csv = [];
  rows.forEach(row => {
    const cols = row.querySelectorAll('th, td');
    const data = Array.from(cols).map(td => `"${td.innerText}"`);
    csv.push(data.join(','));
  });
  const blob = new Blob([csv.join('\n')], { type: 'text/csv' });
  const link = document.createElement('a');
  link.href = URL.createObjectURL(blob);
  link.download = `${sectionId}.csv`;
  link.click();
}

// ✅ Export section as PDF
async function exportSectionPDF(sectionId) {
  const { jsPDF } = window.jspdf;
  const pdf = new jsPDF('p', 'pt', 'a4');
  const section = document.getElementById(sectionId);
  pdf.text("Report Section: " + sectionId, 40, 40);
  pdf.html(section, { x: 30, y: 60, callback: () => pdf.save(`${sectionId}.pdf`) });
}
</script>
</body>
</html>
