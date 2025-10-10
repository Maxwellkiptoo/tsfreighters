<!-- ✅ Final Responsive Collapsible Sidebar (Single Icon) -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

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
  z-index: 1000;
}

/* Sidebar collapsed */
.sidebar.collapsed {
  width: 80px;
}

/* Logo / Title */
.sidebar h2 {
  text-align: center;
  color: #10b981;
  margin-bottom: 40px;
  font-weight: 700;
  font-size: 1.4rem;
  letter-spacing: 1px;
  transition: opacity 0.3s, margin 0.3s;
}

.sidebar.collapsed h2 {
  opacity: 0;
  height: 0;
  margin: 0;
  overflow: hidden;
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
  white-space: nowrap;
}

.sidebar a i {
  width: 22px;
  text-align: center;
  margin-right: 12px;
  font-size: 18px;
  transition: 0.3s;
}

/* Hide text when collapsed */
.sidebar.collapsed a span {
  display: none;
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

/* Toggle button (single use for both modes) */
.toggle-btn {
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
  z-index: 1100;
  transition: all 0.3s ease;
}

/* Smooth page content shift */
.main-content {
  margin-left: 260px;
  padding: 20px;
  transition: margin-left 0.3s;
}

.sidebar.collapsed ~ .main-content {
  margin-left: 80px;
}

/* Responsive behavior */
@media (max-width: 992px) {
  .sidebar {
    width: 80px;
  }
  .sidebar a span,
  .sidebar h2 {
    display: none;
  }
  .main-content {
    margin-left: 80px;
  }
}

@media (max-width: 768px) {
  .sidebar {
    left: -260px;
    width: 260px;
  }

  .sidebar.active {
    left: 0;
  }

  .main-content {
    margin-left: 0;
  }
}
</style>

<!-- Single Toggle Button -->
<button class="toggle-btn" id="menuToggle">
  <i class="fa fa-bars"></i>
</button>

<!-- Sidebar -->
<div class="sidebar" id="sidebar">
  <h2>Admin Panel</h2>
  <a href="#" class="active"><i class="fa fa-home"></i> <span>Dashboard</span></a>
  <a href="#"><i class="fa fa-truck"></i> <span>Shipments</span></a>
  <a href="#"><i class="fa fa-users"></i> <span>Clients</span></a>
  <a href="#"><i class="fa fa-chart-line"></i> <span>Reports</span></a>
  <a href="#"><i class="fa fa-cogs"></i> <span>Settings</span></a>
  <a href="#"><i class="fa fa-sign-out-alt"></i> <span>Logout</span></a>
</div>

<!-- JavaScript -->
<script>
const toggleBtn = document.getElementById('menuToggle');
const sidebar = document.getElementById('sidebar');

toggleBtn.addEventListener('click', () => {
  // On desktop, collapse; on mobile, slide toggle
  if (window.innerWidth <= 768) {
    sidebar.classList.toggle('active');
  } else {
    sidebar.classList.toggle('collapsed');
  }

  // Change icon depending on state
  if (window.innerWidth <= 768) {
    toggleBtn.innerHTML = sidebar.classList.contains('active')
      ? '<i class="fa fa-times"></i>'
      : '<i class="fa fa-bars"></i>';
  } else {
    toggleBtn.innerHTML = sidebar.classList.contains('collapsed')
      ? '<i class="fa fa-angle-double-right"></i>'
      : '<i class="fa fa-angle-double-left"></i>';
  }
});
</script>
