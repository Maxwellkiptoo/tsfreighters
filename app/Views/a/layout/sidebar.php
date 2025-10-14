<!-- ✅ Professional Admin Dashboard Layout -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<style>
/* Sidebar */
.sidebar {
  width: 260px;
  background: #111827;
  height: 100vh;
  position: fixed;
  top: 0;
  left: 0;
  color: white;
  transition: all 0.3s ease;
  overflow-y: auto;
  z-index: 1000;
  box-shadow: 2px 0 8px rgba(0,0,0,0.2);
}
.sidebar.collapsed { width: 80px; }

/* Logo */
.logo-section {
  text-align: center;
  padding: 20px 0;
  border-bottom: 1px solid #1f2937;
}
.logo-section img { width: 50px; height: 50px; border-radius: 12px; }
.logo-section h2 {
  color: #10b981;
  font-size: 1.4rem;
  margin-top: 10px;
  font-weight: 700;
  letter-spacing: 1px;
}
.sidebar.collapsed .logo-section h2 { display: none; }

/* Profile Card */
.profile-card {
  text-align: center;
  padding: 15px;
  border-bottom: 1px solid #1f2937;
}
.profile-card img {
  width: 60px; height: 60px; border-radius: 50%;
  margin-bottom: 10px; border: 2px solid #10b981;
  transition: transform 0.3s;
}
.profile-card img:hover { transform: scale(1.05); }
.profile-card h4 { color: #fff; margin: 0; font-size: 16px; font-weight: 600; }
.profile-card p { color: #9ca3af; margin: 2px 0 0; font-size: 13px; }
.sidebar.collapsed .profile-card h4,
.sidebar.collapsed .profile-card p { display: none; }

/* Sidebar Links */
.sidebar a {
  display: flex;
  align-items: center;
  color: #d1d5db;
  text-decoration: none;
  padding: 12px 25px;
  margin: 5px 0;
  border-left: 4px solid transparent;
  transition: all 0.3s ease, background 0.2s;
  font-size: 15px;
  white-space: nowrap;
  border-radius: 0 10px 10px 0;
}
.sidebar a i { width: 22px; text-align: center; margin-right: 12px; font-size: 18px; transition: color 0.3s; }
.sidebar.collapsed a span { display: none; }
.sidebar a:hover, .sidebar a.active {
  background: #1f2937;
  border-left: 4px solid #10b981;
  color: #fff;
}
.sidebar a:hover i { color: #10b981; }

/* Scrollbar */
.sidebar::-webkit-scrollbar { width: 6px; }
.sidebar::-webkit-scrollbar-thumb {
  background-color: #10b981;
  border-radius: 10px;
}

/* Toggle Button */
.toggle-btn {
  position: fixed;
  top: 15px;
  left: 15px;
  background: #10b981;
  color: white;
  border: none;
  padding: 8px 12px;
  font-size: 20px;
  border-radius: 8px;
  cursor: pointer;
  z-index: 1100;
  box-shadow: 0 4px 8px rgba(0,0,0,0.2);
  transition: all 0.3s ease;
}

/* Top Header */
.top-header {
  position: fixed;
  top: 0;
  left: 260px;
  right: 0;
  background: #ffffff;
  transition: left 0.3s;
  z-index: 900;
  display: flex;
  flex-direction: column;
  border-bottom: 1px solid #e5e7eb;
  box-shadow: 0 2px 8px rgba(0,0,0,0.05);
}
.sidebar.collapsed ~ .top-header { left: 80px; }

/* Top Layer */
.header-top {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 12px 25px;
  border-bottom: 1px solid #e5e7eb;
}
.header-top h1 {
  margin: 0;
  font-size: 1.6rem;
  font-weight: 600;
  color: #111827;
}

/* Bottom Layer */
.header-bottom {
  display: flex;
  justify-content: flex-end;
  align-items: center;
  gap: 25px;
  padding: 10px 25px;
}

/* Search Box */
.search-box {
  display: flex;
  align-items: center;
  background: #f3f4f6;
  border: 1px solid #d1d5db;
  border-radius: 12px;
  padding: 6px 12px;
  width: 250px;
  transition: all 0.3s ease;
}
.search-box input {
  border: none;
  outline: none;
  background: none;
  padding: 5px;
  flex: 1;
  font-size: 14px;
}

/* Header Icons */
.header-icons i {
  font-size: 18px;
  color: #374151;
  cursor: pointer;
  transition: all 0.3s;
  padding: 6px;
  border-radius: 50%;
}
.header-icons i:hover {
  color: #10b981;
  background: #e5f4ef;
}

/* Profile Dropdown */
.profile-dropdown { position: relative; cursor: pointer; }
.profile-dropdown img {
  width: 40px;
  height: 40px;
  border-radius: 50%;
  border: 2px solid #10b981;
  transition: transform 0.2s;
}
.profile-dropdown img:hover { transform: scale(1.05); }
.dropdown-menu {
  display: none;
  position: absolute;
  right: 0;
  top: 50px;
  background: white;
  border: 1px solid #d1d5db;
  border-radius: 12px;
  box-shadow: 0 8px 16px rgba(0,0,0,0.15);
  width: 180px;
  z-index: 2000;
  overflow: hidden;
}
.dropdown-menu a {
  display: flex;
  align-items: center;
  gap: 10px;
  padding: 12px 20px;
  color: #111827;
  text-decoration: none;
  font-size: 14px;
  transition: all 0.2s ease;
}
.dropdown-menu a:hover { background: #10b981; color: #fff; }

/* Main Content */
.main-content {
  margin-left: 260px;
  margin-top: 110px;
  padding: 25px;
  transition: margin-left 0.3s;
}
.sidebar.collapsed ~ .main-content { margin-left: 80px; }

/* Responsive */
@media (max-width: 992px) {
  .sidebar { width: 80px; }
  .sidebar a span,
  .logo-section h2,
  .profile-card h4,
  .profile-card p { display: none; }
  .top-header, .main-content { margin-left: 80px; left: 80px; }
}
@media (max-width: 768px) {
  .sidebar { left: -260px; width: 260px; }
  .sidebar.active { left: 0; }
  .top-header, .main-content { margin-left: 0; left: 0; }
}
</style>

<!-- Toggle Button -->
<button class="toggle-btn" id="menuToggle"><i class="fa fa-bars"></i></button>

<!-- Sidebar -->
<div class="sidebar" id="sidebar">
  <div class="logo-section">
    <img src="https://upload.wikimedia.org/wikipedia/commons/a/ab/Logo_TV_2015.png" alt="Company Logo">
    <h2>LogiTrack</h2>
  </div>

  <div class="profile-card">
    <img src="https://i.pravatar.cc/60" alt="User">
    <h4>John Doe</h4>
    <p>Administrator</p>
  </div>

  <!-- ✅ Sidebar Links -->
  <a href="index.php?controller=customer&action=dash" class="<?php echo ($_GET['action'] ?? '') === 'dash' ? 'active' : ''; ?>">
    <i class="fa fa-home"></i> <span>Dashboard</span>
  </a>

  <a href="index.php?controller=customer&action=shipment" class="<?php echo ($_GET['controller'] ?? '') === 'shipment' ? 'active' : ''; ?>">
    <i class="fa fa-truck"></i> <span>Shipments</span>
  </a>

  <a href="index.php?controller=customer&action=clients" class="<?php echo ($_GET['action'] ?? '') === 'clients' ? 'active' : ''; ?>">
    <i class="fa fa-users"></i> <span>Clients</span>
  </a>

  <a href="index.php?controller=customer&action=reports" class="<?php echo ($_GET['controller'] ?? '') === 'reports' ? 'active' : ''; ?>">
    <i class="fa fa-chart-line"></i> <span>Reports</span>
  </a>

  <a href="index.php?controller=customer&action=invoices" class="<?php echo ($_GET['action'] ?? '') === 'invoices' ? 'active' : ''; ?>">
  <i class="fa fa-file-invoice"></i> <span>Invoices</span>
</a>
  <a href="index.php?controller=customer&action=settings" class="<?php echo ($_GET['action'] ?? '') === 'settings' ? 'active' : ''; ?>">
    <i class="fa fa-cogs"></i> <span>Settings</span>
  </a>
  <a href="index.php?controller=customer&action=logout" class="<?php echo ($_GET['action'] ?? '') === 'logout' ? 'active' : ''; ?>"><i class="fa fa-sign-out-alt"></i> Logout</a>

</div>

<!-- Header -->
<div class="top-header">
  <div class="header-top">
    <h1>Dashboard Overview</h1>
    <div class="search-box">
      <i class="fa fa-search"></i>
      <input type="text" placeholder="Search...">
    </div>
  </div>
  <div class="header-bottom">
    <i class="fa fa-bell header-icons"></i>
    <i class="fa fa-envelope header-icons"></i>

    <div class="profile-dropdown" id="profileDropdown">
      <img src="https://i.pravatar.cc/38" alt="Admin">
      <div class="dropdown-menu" id="dropdownMenu">
        <a href="#"><i class="fa fa-user"></i> Profile</a>
        <a href="index.php?controller=customer&action=settings" class="<?php echo ($_GET['action'] ?? '') === 'settings' ? 'active' : ''; ?>"><i class="fa fa-cogs"></i> <span>Settings</span></a>
        <a href="index.php?controller=customer&action=logout" class="<?php echo ($_GET['action'] ?? '') === 'logout' ? 'active' : ''; ?>"><i class="fa fa-sign-out-alt"></i> Logout</a>
      </div>
    </div>
  </div>
</div>

<!-- JavaScript -->
<script>
const toggleBtn = document.getElementById('menuToggle');
const sidebar = document.getElementById('sidebar');
const profileDropdown = document.getElementById('profileDropdown');
const dropdownMenu = document.getElementById('dropdownMenu');

// Sidebar toggle
toggleBtn.addEventListener('click', () => {
  if (window.innerWidth <= 768) sidebar.classList.toggle('active');
  else sidebar.classList.toggle('collapsed');

  toggleBtn.innerHTML = sidebar.classList.contains('active')
    ? '<i class="fa fa-times"></i>'
    : sidebar.classList.contains('collapsed')
      ? '<i class="fa fa-angle-double-right"></i>'
      : '<i class="fa fa-angle-double-left"></i>';
});

// Profile dropdown toggle
profileDropdown.addEventListener('click', (e) => {
  e.stopPropagation();
  dropdownMenu.style.display = dropdownMenu.style.display === "block" ? "none" : "block";
});

// Close dropdown when clicking outside
document.addEventListener('click', () => {
  dropdownMenu.style.display = "none";
});
</script>
