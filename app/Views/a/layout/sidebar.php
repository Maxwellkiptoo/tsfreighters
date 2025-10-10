<!-- ✅ Updated Sidebar -->
<style>
/* Sidebar container */
.sidebar {
  width: 260px;
  background: #111827;
  height: 100vh;
  position: fixed;
  top: 0;
  left: 0;
  color: white;
  padding: 20px 0;
  transition: all 0.3s ease;
  overflow-y: auto;
}

/* Logo / Title */
.sidebar h2 {
  text-align: center;
  color: #10b981;
  margin-bottom: 40px;
  font-weight: 700;
  font-size: 1.4rem;
  letter-spacing: 1px;
}

/* Sidebar links */
.sidebar a {
  display: flex;
  align-items: center;
  color: #d1d5db;
  text-decoration: none;
  padding: 12px 25px;
  margin: 5px 0;
  border-left: 4px solid transparent;
  transition: all 0.3s ease;
  font-size: 15px;
}

.sidebar a i {
  width: 22px;
  text-align: center;
  margin-right: 12px;
  font-size: 18px;
  transition: 0.3s;
}

/* Hover & Active */
.sidebar a:hover,
.sidebar a.active {
  background: #1f2937;
  border-left: 4px solid #10b981;
  color: #fff;
}

.sidebar a:hover i {
  color: #10b981;
}

/* Scrollbar (hidden style) */
.sidebar::-webkit-scrollbar {
  width: 6px;
}
.sidebar::-webkit-scrollbar-thumb {
  background-color: #10b981;
  border-radius: 10px;
}

/* Mobile toggle */
.toggle-btn {
  display: none;
  position: fixed;
  top: 15px;
  left: 15px;
  background: #10b981;
  color: white;
  border: none;
  padding: 8px 10px;
  font-size: 20px;
  border-radius: 6px;
  cursor: pointer;
  z-index: 1001;
}

@media (max-width: 768px) {
  .sidebar {
    left: -260px;
  }

  .sidebar.active {
    left: 0;
  }

  .toggle-btn {
    display: block;
  }
}
</style>

<!-- Toggle Button -->
<button class="toggle-btn" onclick="document.querySelector('.sidebar').classList.toggle('active')">
  <i class="fa fa-bars"></i>
</button>

<!-- Sidebar -->
<div class="sidebar">
  <h2>Admin Panel</h2>
  <a href="#" class="active"><i class="fa fa-home"></i> Dashboard</a>
  <a href="#"><i class="fa fa-truck"></i> Shipments</a>
  <a href="#"><i class="fa fa-users"></i> Clients</a>
  <a href="#"><i class="fa fa-chart-line"></i> Reports</a>
  <a href="#"><i class="fa fa-cogs"></i> Settings</a>
  <a href="#"><i class="fa fa-sign-out-alt"></i> Logout</a>
</div>
