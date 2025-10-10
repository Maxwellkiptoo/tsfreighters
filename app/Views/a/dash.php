<?php include 'layout/sidebar.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Logistics Admin Dashboard</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<style>
body {
  margin: 0;
  font-family: 'Poppins', sans-serif;
  background-color: #f5f6fa;
  color: #333;
  overflow-x: hidden;
}
.main-content { margin-left:250px; padding:30px; }
header { background:linear-gradient(90deg,#10b981,#047857); padding:18px 30px; border-radius:12px; display:flex; justify-content:space-between; align-items:center; color:white; box-shadow:0 4px 12px rgba(0,0,0,0.1); position:sticky; top:0; z-index:50; }
header h1 { font-size:22px; font-weight:600; margin:0; }
header .user { display:flex; align-items:center; font-weight:500; background:rgba(255,255,255,0.15); padding:8px 15px; border-radius:30px; cursor:pointer; position:relative; }
header .user i { margin-right:10px; font-size:20px; }
.profile-dropdown { display:none; position:absolute; top:50px; right:0; background:#fff; border-radius:8px; box-shadow:0 4px 10px rgba(0,0,0,0.1); overflow:hidden; }
.profile-dropdown a { display:block; padding:10px 20px; color:#111827; text-decoration:none; transition:0.3s; }
.profile-dropdown a:hover { background:#f3f4f6; }
.user.active .profile-dropdown { display:block; }

/* Dashboard Cards */
.dashboard-cards { display:grid; grid-template-columns:repeat(auto-fit,minmax(230px,1fr)); gap:25px; margin-top:30px; }
.card { background:white; padding:25px 20px; border-radius:16px; box-shadow:0 4px 10px rgba(0,0,0,0.08); text-align:center; transition:all 0.3s ease; cursor:pointer; }
.card:hover { transform:translateY(-6px); box-shadow:0 8px 18px rgba(0,0,0,0.12); }
.card i { font-size:28px; color:#10b981; margin-bottom:10px; }
.card h3 { margin:5px 0; font-size:24px; color:#111827; }
.card p { font-size:14px; color:#6b7280; }
.progress { height:6px; background:#e5e7eb; border-radius:10px; overflow:hidden; margin-top:12px; }
.progress-bar { height:6px; background:linear-gradient(90deg,#10b981,#059669); width:0%; transition:width 1s ease-in-out; }

/* Chart */
.chart-container { margin-top:40px; background:white; border-radius:16px; box-shadow:0 4px 10px rgba(0,0,0,0.06); padding:20px; height:350px; }
canvas { width:100%; height:100%; }

/* Table */
.table-section { background:white; margin-top:40px; border-radius:16px; box-shadow:0 4px 10px rgba(0,0,0,0.08); padding:25px; }
.table-section h2 { margin-bottom:15px; color:#111827; }
table { width:100%; border-collapse:collapse; font-size:15px; }
table th, table td { text-align:left; padding:12px 15px; }
table th { background:#10b981; color:white; font-weight:600; }
table tr:nth-child(even){background:#f9fafb;}
.status { padding:5px 10px; border-radius:8px; font-weight:500; font-size:13px; display:inline-block; }
.status.delivered{background:#d1fae5;color:#047857;} 
.status.transit{background:#fef3c7;color:#b45309;} 
.status.delayed{background:#fee2e2;color:#b91c1c;}
footer{margin-top:40px;text-align:center;font-size:14px;color:#6b7280;}
</style>
</head>
<body>

<div class="main-content">

  <!-- Overview Metrics -->
  <div class="dashboard-cards">
    <div class="card"><i class="fa fa-sack-dollar"></i><h3 class="counter" data-target="2400000">0</h3><p>Total Revenue</p><div class="progress"><div class="progress-bar" data-width="95%"></div></div></div>
    <div class="card"><i class="fa fa-chart-line"></i><h3 class="counter" data-target="12">0</h3><p>Growth Rate (%)</p><div class="progress"><div class="progress-bar" data-width="70%"></div></div></div>
    <div class="card"><i class="fa fa-users"></i><h3 class="counter" data-target="1850">0</h3><p>Total Users</p><div class="progress"><div class="progress-bar" data-width="80%"></div></div></div>
    <div class="card"><i class="fa fa-file-alt"></i><h3 class="counter" data-target="328">0</h3><p>Reports Generated</p><div class="progress"><div class="progress-bar" data-width="60%"></div></div></div>
  </div>

  <!-- Shipment Stats -->
  <div class="dashboard-cards">
    <div class="card"><i class="fa fa-truck"></i><h3 class="counter" data-target="1248">0</h3><p>Total Shipments</p><div class="progress"><div class="progress-bar" data-width="90%"></div></div></div>
    <div class="card"><i class="fa fa-box"></i><h3 class="counter" data-target="326">0</h3><p>In Transit</p><div class="progress"><div class="progress-bar" data-width="65%"></div></div></div>
    <div class="card"><i class="fa fa-check-circle"></i><h3 class="counter" data-target="899">0</h3><p>Delivered</p><div class="progress"><div class="progress-bar" data-width="85%"></div></div></div>
    <div class="card"><i class="fa fa-exclamation-triangle"></i><h3 class="counter" data-target="23">0</h3><p>Delayed</p><div class="progress"><div class="progress-bar" data-width="30%"></div></div></div>
  </div>

  <!-- Chart -->
  <div class="chart-container">
    <canvas id="shipmentChart"></canvas>
  </div>

  <!-- Table -->
  <div class="table-section">
    <h2>Recent Shipments</h2>
    <table>
      <thead>
        <tr><th>Tracking ID</th><th>Client</th><th>Origin</th><th>Destination</th><th>Status</th><th>Expected Delivery</th></tr>
      </thead>
      <tbody>
        <tr><td>#TRK9472</td><td>John Doe</td><td>Nairobi</td><td>Mombasa</td><td><span class="status transit">In Transit</span></td><td>12 Oct 2025</td></tr>
        <tr><td>#TRK3289</td><td>Mary Atieno</td><td>Kisumu</td><td>Nakuru</td><td><span class="status delivered">Delivered</span></td><td>9 Oct 2025</td></tr>
        <tr><td>#TRK6645</td><td>Peter Kariuki</td><td>Nairobi</td><td>Eldoret</td><td><span class="status delayed">Delayed</span></td><td>Pending</td></tr>
        <tr><td>#TRK5567</td><td>Jane Mwangi</td><td>Malindi</td><td>Kisii</td><td><span class="status delivered">Delivered</span></td><td>8 Oct 2025</td></tr>
      </tbody>
    </table>
  </div>
  

  <footer>© 2025 Nexbridge Logistics Admin Panel</footer>
</div>

<script>
// Counter animation
document.querySelectorAll('.counter').forEach(counter => {
  const updateCount = () => {
    const target = +counter.getAttribute('data-target');
    const count = +counter.innerText;
    const increment = target / 80;
    if (count < target) {
      counter.innerText = Math.ceil(count + increment);
      setTimeout(updateCount, 20);
    } else {
      counter.innerText = target.toLocaleString();
    }
  };
  updateCount();
});

// Progress bars animation
document.querySelectorAll('.progress-bar').forEach(bar => {
  setTimeout(() => bar.style.width = bar.getAttribute('data-width'), 400);
});

// Chart.js
const ctx = document.getElementById('shipmentChart');
new Chart(ctx, {
  type: 'line',
  data: {
    labels: ['Mon','Tue','Wed','Thu','Fri','Sat','Sun'],
    datasets: [{
      label:'Shipments This Week',
      data:[120,150,180,220,200,250,300],
      borderColor:'#10b981',
      backgroundColor:'rgba(16,185,129,0.2)',
      fill:true,
      tension:0.4,
      borderWidth:3
    }]
  },
  options:{
    responsive:true,
    maintainAspectRatio:false,
    plugins:{ legend:{display:true,position:'bottom'} },
    scales:{ y:{beginAtZero:true,grid:{color:'#e5e7eb'}}, x:{grid:{color:'transparent'}} }
  }
});

// Profile dropdown
const userMenu = document.getElementById('userMenu');
userMenu.addEventListener('click',()=>userMenu.classList.toggle('active'));
</script>
</body>
</html>
