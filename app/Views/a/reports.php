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
  background: #f3f4f6;
  color: #111827;
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
header .admin-info {
  font-size: 15px;
  color: #4b5563;
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
.btn-client { background: #9333ea; }

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
$month = $_GET['month'] ?? date('F');
$year = $_GET['year'] ?? date('Y');
$filterLabel = "$month $year";
?>

<div class="main-content">
  <header>
    <h1><i class="fa fa-chart-line"></i> Company Reports - <?= htmlspecialchars($filterLabel) ?></h1>
    <div class="admin-info"><i class="fa fa-user-circle"></i> Admin</div>
  </header>

  <form class="filter-form" method="GET" onsubmit="return applyFilter(event)">
    <select id="month" name="month">
      <?php
      $months = ['January','February','March','April','May','June','July','August','September','October','November','December'];
      foreach($months as $m){
        $selected = ($m == $month) ? 'selected' : '';
        echo "<option $selected>$m</option>";
      } ?>
    </select>
    <select id="year" name="year">
      <?php for($y=date('Y');$y>=2020;$y--){ 
        $selected = ($y == $year) ? 'selected' : '';
        echo "<option $selected>$y</option>"; 
      } ?>
    </select>
    <button type="submit"><i class="fa fa-filter"></i> Filter</button>
  </form>

  <div class="report-card-group" id="summaryCards"></div>

  <!-- Shipments Chart -->
  <div class="section" id="shipmentsReport">
    <h2>
      Shipments Summary (<span id="filterLabel"><?= htmlspecialchars($filterLabel) ?></span>)
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
    <table id="clientTable">
      <thead><tr><th>Client</th><th>Shipments</th><th>Revenue (Ksh)</th><th>Actions</th></tr></thead>
      <tbody></tbody>
    </table>
  </div>

  <footer>© <?= date('Y') ?> Nexbridge Logistics | Admin Reports Dashboard</footer>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>

<script>
// --- DUMMY DATA ---
const reportData = {
  January: { shipments: 1200, delivered: 980, time: 2.4, rate: 96, revenue: 300000, clients:[
    ["John Doe Ltd", 45, 75000],
    ["Global Freight Co.", 38, 60000],
    ["FastTrack Ltd", 32, 55500]
  ]},
  February: { shipments: 1320, delivered: 1100, time: 2.2, rate: 97, revenue: 320000, clients:[
    ["Swift Logistics", 40, 70000],
    ["EastTrans", 35, 56000],
    ["CargoPro", 30, 50000]
  ]},
  March: { shipments: 1410, delivered: 1300, time: 2.1, rate: 98, revenue: 350000, clients:[
    ["MegaTrans", 48, 80000],
    ["FastCargo", 42, 72000],
    ["TransAir", 39, 67000]
  ]}
};

// --- FUNCTIONS ---
let chart;
function updateDashboard(month) {
  const data = reportData[month] || reportData['January'];
  document.getElementById("summaryCards").innerHTML = `
    <div class="card"><i class="fa fa-truck"></i><h3>${data.shipments}</h3><p>Total Shipments</p></div>
    <div class="card"><i class="fa fa-box"></i><h3>${data.delivered}</h3><p>Delivered</p></div>
    <div class="card"><i class="fa fa-clock"></i><h3>${data.time} hrs</h3><p>Avg. Delivery Time</p></div>
    <div class="card"><i class="fa fa-percent"></i><h3>${data.rate}%</h3><p>On-Time Rate</p></div>
    <div class="card"><i class="fa fa-sack-dollar"></i><h3>Ksh ${data.revenue.toLocaleString()}</h3><p>Total Revenue</p></div>
  `;

  const tbody = document.querySelector("#clientTable tbody");
  tbody.innerHTML = "";
  data.clients.forEach(c => {
    tbody.innerHTML += `<tr>
      <td>${c[0]}</td><td>${c[1]}</td><td>${c[2].toLocaleString()}</td>
      <td><button class="btn-client" onclick="printClientReport('${c[0]}',${c[1]},${c[2]})">Print</button></td>
    </tr>`;
  });

  const ctx = document.getElementById('shipmentsChart').getContext('2d');
  if(chart) chart.destroy();
  chart = new Chart(ctx, {
    type: 'bar',
    data: {
      labels: ['Week 1','Week 2','Week 3','Week 4'],
      datasets: [{
        label: 'Shipments',
        data: [
          data.shipments * 0.2,
          data.shipments * 0.25,
          data.shipments * 0.3,
          data.shipments * 0.25
        ],
        backgroundColor: '#10b981'
      }]
    },
    options: { responsive: true, plugins: { legend: { display: false } } }
  });
}

function applyFilter(e){
  e.preventDefault();
  const month = document.getElementById("month").value;
  const year = document.getElementById("year").value;
  document.getElementById("filterLabel").innerText = `${month} ${year}`;
  updateDashboard(month);
}

// --- UTILITIES ---
function printSection(id){ const w=window.open('');w.document.write(document.getElementById(id).innerHTML);w.print();}
function exportSectionCSV(id){const rows=document.querySelectorAll(`#${id} table tr`);if(!rows.length)return alert('No table!');let csv=[];rows.forEach(r=>{const cols=r.querySelectorAll('th,td');csv.push(Array.from(cols).map(td=>`"${td.innerText}"`).join(','));});const blob=new Blob([csv.join('\n')],{type:'text/csv'});const link=document.createElement('a');link.href=URL.createObjectURL(blob);link.download=`${id}.csv`;link.click();}
async function exportSectionPDF(id){const { jsPDF }=window.jspdf;const pdf=new jsPDF('p','pt','a4');const el=document.getElementById(id);pdf.text(`Report Section: ${id}`,40,40);pdf.html(el,{x:30,y:60,callback:()=>pdf.save(`${id}.pdf`)});}
function printClientReport(name,shipments,revenue){const w=window.open('');w.document.write(`<h2>${name} - Report</h2><p><strong>Shipments:</strong> ${shipments}</p><p><strong>Revenue:</strong> Ksh ${revenue.toLocaleString()}</p><p>Generated on ${new Date().toLocaleDateString()}</p>`);w.print();}

// --- INIT ---
updateDashboard("<?= $month ?>");
</script>
</body>
</html>
