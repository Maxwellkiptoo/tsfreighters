<!-- ✅ Final Logistics Admin Dashboard (Fully Functional & Responsive) -->
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
  padding-top: 0;
  transition: all 0.3s ease;
  overflow-y: auto;
  z-index: 1000;
}

/* Sidebar collapsed */
.sidebar.collapsed {
  width: 80px;
}

/* Company Logo */
.logo-section {
  text-align: center;
  padding: 20px 0;
  border-bottom: 1px solid #1f2937;
}
.logo-section img {
  width: 50px;
  height: 50px;
  border-radius: 10px;
}
.logo-section h2 {
  color: #10b981;
  font-size: 1.3rem;
  margin-top: 10px;
  font-weight: 700;
}
.sidebar.collapsed .logo-section h2 { display: none; }

/* Mini Profile Card */
.profile-card {
  text-align: center;
  padding: 15px;
  border-bottom: 1px solid #1f2937;
}
.profile-card img {
  width: 60px;
  height: 60px;
  border-radius: 50%;
  margin-bottom: 10px;
  border: 2px solid #10b981;
}
.profile-card h4 {
  font-size: 16px;
  color: #fff;
  margin: 0;
}
.profile-card p {
  font-size: 13px;
  color: #9ca3af;
  margin: 2px 0 0;
}
.sidebar.collapsed .profile-card h4,
.sidebar.collapsed .profile-card p { display: none; }

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
.sidebar.collapsed a span { display: none; }
.sidebar a:hover, .sidebar a.active {
  background: #1f2937;
  border-left: 4px solid #10b981;
  color: #fff;
}
.sidebar a:hover i { color: #10b981; }

/* Scrollbar */
.sidebar::-webkit-scrollbar { width: 6px; }
.sidebar::-webkit-scrollbar-thumb { background-color: #10b981; border-radius: 10px; }

/* Toggle Button */
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

/* Sticky Header */
.top-header {
  position: fixed;
  top: 0;
  left: 260px;
  right: 0;
  height: 60px;
  background: #f9fafb;
  display: flex;
  align-items: center;
  justify-content: space-between;
  padding: 0 20px;
  border-bottom: 1px solid #e5e7eb;
  transition: left 0.3s;
  z-index: 900;
}
.sidebar.collapsed ~ .top-header { left: 80px; }

/* Header elements */
.search-box {
  display: flex;
  align-items: center;
  background: #fff;
  border: 1px solid #d1d5db;
  border-radius: 8px;
  padding: 5px 10px;
  width: 250px;
}
.search-box input {
  border: none;
  outline: none;
  background: none;
  padding: 5px;
  flex: 1;
}
.header-icons {
  display: flex;
  align-items: center;
}
.header-icons i {
  margin-left: 20px;
  font-size: 18px;
  color: #374151;
  cursor: pointer;
  transition: color 0.3s;
}
.header-icons i:hover { color: #10b981; }

/* Profile Dropdown */
.profile-menu {
  position: relative;
}
.profile-menu img {
  width: 35px;
  height: 35px;
  border-radius: 50%;
  cursor: pointer;
  border: 2px solid #10b981;
}
.dropdown {
  position: absolute;
  right: 0;
  top: 45px;
  background: #fff;
  border: 1px solid #e5e7eb;
  border-radius: 8px;
  width: 150px;
  box-shadow: 0 2px 10px rgba(0,0,0,0.1);
  display: none;
  z-index: 999;
}
.dropdown a {
  display: block;
  padding: 10px;
  text-decoration: none;
  color: #111827;
  transition: 0.2s;
}
.dropdown a:hover {
  background: #f3f4f6;
  color: #10b981;
}
.profile-menu.active .dropdown { display: block; }

/* Main content */
.main-content {
  margin-left: 260px;
  margin-top: 60px;
  padding: 20px;
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
  .top-header, .main-content { left: 80px; margin-left: 80px; }
}
@media (max-width: 768px) {
  .sidebar { left: -260px; width: 260px; }
  .sidebar.active { left: 0; }
  .top-header, .main-content { left: 0; margin-left: 0; }
}
</style>

<!-- Sidebar Toggle -->
<button class="toggle-btn" id="menuToggle">
  <i class="fa fa-bars"></i>
</button>

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

  <a href="#" class="active"><i class="fa fa-home"></i> <span>Dashboard</span></a>
  <a href="#"><i class="fa fa-truck"></i> <span>Shipments</span></a>
  <a href="#"><i class="fa fa-users"></i> <span>Clients</span></a>
  <a href="#"><i class="fa fa-chart-line"></i> <span>Reports</span></a>
  <a href="#"><i class="fa fa-cogs"></i> <span>Settings</span></a>
  <a href="#"><i class="fa fa-sign-out-alt"></i> <span>Logout</span></a>
</div>

<!-- Header -->
<div class="top-header">
  <div class="search-box">
    <i class="fa fa-search"></i>
    <input type="text" placeholder="Search...">
  </div>
  <div class="header-icons">
    <i class="fa fa-bell"></i>
    <i class="fa fa-envelope"></i>

    <div class="profile-menu" id="profileMenu">
      <i class="fa fa-user-circle"></i>
      <div class="dropdown">
        <a href="#"><i class="fa fa-user"></i> Profile</a>
        <a href="#"><i class="fa fa-cog"></i> Settings</a>
        <a href="#"><i class="fa fa-sign-out-alt"></i> Logout</a>
      </div>
    </div>
  </div>
</div>

<!-- JS -->
<script>
const toggleBtn = document.getElementById('menuToggle');
const sidebar = document.getElementById('sidebar');
const profileMenu = document.getElementById('profileMenu');

toggleBtn.addEventListener('click', () => {
  if (window.innerWidth <= 768) sidebar.classList.toggle('active');
  else sidebar.classList.toggle('collapsed');

  toggleBtn.innerHTML = sidebar.classList.contains('active')
    ? '<i class="fa fa-times"></i>'
    : sidebar.classList.contains('collapsed')
      ? '<i class="fa fa-angle-double-right"></i>'
      : '<i class="fa fa-angle-double-left"></i>';
});

profileMenu.addEventListener('click', () => {
  profileMenu.classList.toggle('active');
});
</script>
