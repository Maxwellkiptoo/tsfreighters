
<style>
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
</style>
<div class="sidebar">
  <h2>Admin Panel</h2>
  <a href="#" class="active"><i class="fa fa-home"></i> Dashboard</a>
  <a href="#"><i class="fa fa-truck"></i> Shipments</a>
  <a href="#"><i class="fa fa-users"></i> Clients</a>
  <a href="#"><i class="fa fa-chart-line"></i> Reports</a>
  <a href="#"><i class="fa fa-cogs"></i> Settings</a>
  <a href="#"><i class="fa fa-sign-out-alt"></i> Logout</a>
</div>