<?php include 'layout/sidebar.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Logistics Admin Dashboard</title>
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
  z-index: 10;
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

/* Main Content */
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
  text-align: center;
  transition: 0.3s;
  position: relative;
  overflow: hidden;
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

.progress {
  height: 6px;
  background: #e5e7eb;
  border-radius: 10px;
  overflow: hidden;
  margin-top: 10px;
}

.progress-bar {
  height: 6px;
  background: #10b981;
  width: 0%;
  transition: width 1s ease-in-out;
}

/* Table Section */
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

/* Footer */
footer {
  margin-top: 30px;
  text-align: center;
  font-size: 14px;
  color: #6b7280;
}

canvas {
  width: 100%;
  height: 300px;
  margin-top: 30px;
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
        <tr><td>#TRK9472</td><td>John Doe</td><td>Nairobi</td><td>Mombasa</td><td style="color:orange;">In Transit</td><td>12 Oct 2025</td></tr>
        <tr><td>#TRK3289</td><td>Mary Atieno</td><td>Kisumu</td><td>Nakuru</td><td style="color:green;">Delivered</td><td>9 Oct 2025</td></tr>
        <tr><td>#TRK6645</td><td>Peter Kariuki</td><td>Nairobi</td><td>Eldoret</td><td style="color:red;">Delayed</td><td>Pending</td></tr>
        <tr><td>#TRK5567</td><td>Jane Mwangi</td><td>Malindi</td><td>Kisii</td><td style="color:green;">Delivered</td><td>8 Oct 2025</td></tr>
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
    const speed = 30;
    const increment = target / 100;

    if (count < target) {
      counter.innerText = Math.ceil(count + increment);
      setTimeout(updateCount, speed);
    } else {
      counter.innerText = target.toLocaleString();
    }
  };
  updateCount();
});

// Progress Bars Animation
document.querySelectorAll('.progress-bar').forEach(bar => {
  setTimeout(() => {
    bar.style.width = bar.getAttribute('data-width');
  }, 500);
});

// Chart.js Mock Data
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
      tension: 0.4
    }]
  },
  options: {
    responsive: true,
    plugins: { legend: { display: true, position: 'bottom' } }
  }
});
</script>
</body>
</html>
