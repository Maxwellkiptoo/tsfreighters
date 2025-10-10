<?php include 'layout/sidebar.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Logistics Admin Dashboard</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

<style>
body {
  margin: 0;
  font-family: 'Poppins', sans-serif;
  background-color: #f5f6fa;
  color: #333;
  overflow-x: hidden;
}

/* --- Header --- */
header {
  background: linear-gradient(90deg, #10b981, #047857);
  padding: 18px 30px;
  border-radius: 12px;
  display: flex;
  justify-content: space-between;
  align-items: center;
  color: white;
  box-shadow: 0 4px 12px rgba(0,0,0,0.1);
}
header h1 {
  font-size: 22px;
  font-weight: 600;
  margin: 0;
}
header .user {
  display: flex;
  align-items: center;
  font-weight: 500;
  background: rgba(255,255,255,0.15);
  padding: 8px 15px;
  border-radius: 30px;
  transition: 0.3s;
}
header .user i {
  margin-right: 10px;
  font-size: 20px;
}
header .user:hover {
  background: rgba(255,255,255,0.3);
}

/* --- Sidebar --- */
.sidebar {
  width: 250px;
  background: #111827;
  height: 100vh;
  position: fixed;
  top: 0;
  left: 0;
  color: white;
  padding: 20px 0;
  z-index: 10;
}
.sidebar h2 {
  text-align: center;
  color: #10b981;
  margin-bottom: 40px;
  font-size: 1.4rem;
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

/* --- Main Content --- */
.main-content {
  margin-left: 250px;
  padding: 30px;
}

/* --- Dashboard Cards --- */
.dashboard-cards {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(230px, 1fr));
  gap: 25px;
  margin-top: 30px;
}
.card {
  background: rgba(255,255,255,0.95);
  backdrop-filter: blur(8px);
  padding: 25px 20px;
  border-radius: 16px;
  box-shadow: 0 4px 10px rgba(0,0,0,0.08);
  text-align: center;
  transition: all 0.3s ease;
  position: relative;
  overflow: hidden;
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
  font-size: 24px;
  color: #111827;
}
.card p {
  font-size: 14px;
  color: #6b7280;
}
.progress {
  height: 6px;
  background: #e5e7eb;
  border-radius: 10px;
  overflow: hidden;
  margin-top: 12px;
}
.progress-bar {
  height: 6px;
  background: linear-gradient(90deg, #10b981, #059669);
  width: 0%;
  transition: width 1s ease-in-out;
}

/* --- Chart --- */
canvas {
  width: 100%;
  height: 300px;
  margin-top: 40px;
  background: white;
  border-radius: 16px;
  box-shadow: 0 4px 10px rgba(0,0,0,0.06);
  padding: 20px;
}

/* --- Table Section --- */
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
table tr:nth-child(even) {
  background: #f9fafb;
}
.status {
  padding: 5px 10px;
  border-radius: 8px;
  font-weight: 500;
  font-size: 13px;
  text-align: center;
  display: inline-block;
}
.status.delivered { background: #d1fae5; color: #047857; }
.status.transit { background: #fef3c7; color: #b45309; }
.status.delayed { background: #fee2e2; color: #b91c1c; }

/* --- Footer --- */
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
  <header>
    <h1>Dashboard Overview</h1>
    <div class="user"><i class="fa fa-user-circle"></i> Admin</div>
  </header>

  <!-- Cards -->
  <div class="dashboard-cards">
    <div class="card">
      <i class="fa fa-truck"></i>
      <h3 class="counter" data-target="1248">0</h3>
      <p>Total Shipments</p>
      <div class="progress"><div class="progress-bar" data-width="90%"></div></div>
    </div>
    <div class="card">
      <i class="fa fa-box"></i>
      <h3 class="counter" data-target="326">0</h3>
      <p>In Transit</p>
      <div class="progress"><div class="progress-bar" data-width="65%"></div></div>
    </div>
    <div class="card">
      <i class="fa fa-check-circle"></i>
      <h3 class="counter" data-target="899">0</h3>
      <p>Delivered</p>
      <div class="progress"><div class="progress-bar" data-width="85%"></div></div>
    </div>
    <div class="card">
      <i class="fa fa-exclamation-triangle"></i>
      <h3 class="counter" data-target="23">0</h3>
      <p>Delayed</p>
      <div class="progress"><div class="progress-bar" data-width="30%"></div></div>
    </div>
  </div>

  <!-- Chart Section -->
  <canvas id="shipmentChart"></canvas>

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
        <tr><td>#TRK9472</td><td>John Doe</td><td>Nairobi</td><td>Mombasa</td><td><span class="status transit">In Transit</span></td><td>12 Oct 2025</td></tr>
        <tr><td>#TRK3289</td><td>Mary Atieno</td><td>Kisumu</td><td>Nakuru</td><td><span class="status delivered">Delivered</span></td><td>9 Oct 2025</td></tr>
        <tr><td>#TRK6645</td><td>Peter Kariuki</td><td>Nairobi</td><td>Eldoret</td><td><span class="status delayed">Delayed</span></td><td>Pending</td></tr>
        <tr><td>#TRK5567</td><td>Jane Mwangi</td><td>Malindi</td><td>Kisii</td><td><span class="status delivered">Delivered</span></td><td>8 Oct 2025</td></tr>
      </tbody>
    </table>
  </div>

  <footer>© 2025 Nexbridge Logistics Admin Panel</footer>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
// Animate Counters
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

// Animate Progress Bars
document.querySelectorAll('.progress-bar').forEach(bar => {
  setTimeout(() => {
    bar.style.width = bar.getAttribute('data-width');
  }, 400);
});

// Chart.js Setup
const ctx = document.getElementById('shipmentChart');
new Chart(ctx, {
  type: 'line',
  data: {
    labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
    datasets: [{
      label: 'Shipments This Week',
      data: [120, 150, 180, 220, 200, 250, 300],
      borderColor: '#10b981',
      backgroundColor: 'rgba(16,185,129,0.2)',
      fill: true,
      tension: 0.4,
      borderWidth: 3,
      pointBackgroundColor: '#10b981'
    }]
  },
  options: {
    responsive: true,
    plugins: {
      legend: { display: true, position: 'bottom' }
    },
    scales: {
      y: { beginAtZero: true, grid: { color: '#e5e7eb' } },
      x: { grid: { color: 'transparent' } }
    }
  }
});
</script>
</body>
</html>
