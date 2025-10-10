<?php include 'layout/header.php'; ?>
<?php include 'layout/sidebar.php'; ?>

<div class="main-content" style="margin-left:250px; background-color:#f8f9fa; min-height:100vh;">

  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg px-3 py-2 bg-white shadow-sm sticky-top" style="border-bottom:1px solid #ddd;">
    <div class="container-fluid">
      <span class="navbar-brand fw-semibold text-primary" style="font-weight:600;">TSFreighters Admin</span>
      <div class="d-flex align-items-center">
        <i class="bi bi-bell me-3 fs-5 text-secondary" style="cursor:pointer;"></i>
        <div class="dropdown">
          <a href="#" class="d-flex align-items-center text-dark text-decoration-none dropdown-toggle" data-bs-toggle="dropdown">
            <i class="bi bi-person-circle fs-4 me-2 text-primary"></i>
            <span>Admin</span>
          </a>
          <ul class="dropdown-menu dropdown-menu-end shadow-sm">
            <li><a class="dropdown-item" href="#"><i class="bi bi-gear me-2"></i>Settings</a></li>
            <li><a class="dropdown-item" href="#"><i class="bi bi-box-arrow-right me-2"></i>Logout</a></li>
          </ul>
        </div>
      </div>
    </div>
  </nav>

  <!-- Dashboard Content -->
  <div class="container-fluid mt-4">
    <h4 class="fw-bold text-secondary mb-4" style="font-weight:700; color:#555;">Dashboard Overview</h4>

    <!-- Stats Cards -->
    <div class="row g-3">
      <!-- Total Shipments -->
      <div class="col-md-3">
        <div class="card border-0 shadow-sm p-3 text-center" style="border-radius:12px; background:white; transition:0.3s;">
          <div class="icon bg-primary bg-opacity-10 text-primary rounded-circle mx-auto p-3 mb-2" style="background:#e7f1ff;">
            <i class="bi bi-box-seam fs-2"></i>
          </div>
          <h6 class="text-muted">Total Shipments</h6>
          <h3 class="fw-bold">120</h3>
          <small class="text-success"><i class="bi bi-graph-up"></i> +5% this week</small>
        </div>
      </div>

      <!-- Active Deliveries -->
      <div class="col-md-3">
        <div class="card border-0 shadow-sm p-3 text-center" style="border-radius:12px; background:white; transition:0.3s;">
          <div class="icon bg-success bg-opacity-10 text-success rounded-circle mx-auto p-3 mb-2" style="background:#e9f8ef;">
            <i class="bi bi-truck fs-2"></i>
          </div>
          <h6 class="text-muted">Active Deliveries</h6>
          <h3 class="fw-bold">85</h3>
          <small class="text-success"><i class="bi bi-arrow-up-right"></i> +3 ongoing</small>
        </div>
      </div>

      <!-- Registered Customers -->
      <div class="col-md-3">
        <div class="card border-0 shadow-sm p-3 text-center" style="border-radius:12px; background:white; transition:0.3s;">
          <div class="icon bg-warning bg-opacity-10 text-warning rounded-circle mx-auto p-3 mb-2" style="background:#fff8e1;">
            <i class="bi bi-people fs-2"></i>
          </div>
          <h6 class="text-muted">Registered Customers</h6>
          <h3 class="fw-bold">230</h3>
          <small class="text-secondary"><i class="bi bi-person-plus"></i> +8 new today</small>
        </div>
      </div>

      <!-- Total Revenue -->
      <div class="col-md-3">
        <div class="card border-0 shadow-sm p-3 text-center" style="border-radius:12px; background:white; transition:0.3s;">
          <div class="icon bg-danger bg-opacity-10 text-danger rounded-circle mx-auto p-3 mb-2" style="background:#fdeaea;">
            <i class="bi bi-cash-stack fs-2"></i>
          </div>
          <h6 class="text-muted">Total Revenue</h6>
          <h3 class="fw-bold">$45,000</h3>
          <small class="text-success"><i class="bi bi-graph-up-arrow"></i> +12% growth</small>
        </div>
      </div>
    </div>

    <!-- Recent Shipments and Map -->
    <div class="mt-5 row">
      <div class="col-md-8">
        <div class="card shadow-sm border-0" style="border-radius:12px;">
          <div class="card-header bg-white fw-semibold" style="font-weight:600;">
            <i class="bi bi-clock-history me-2 text-primary"></i> Recent Shipments
          </div>
          <div class="card-body">
            <table class="table align-middle">
              <thead class="table-light">
                <tr>
                  <th>Tracking #</th>
                  <th>Customer</th>
                  <th>Status</th>
                  <th>Location</th>
                  <th>Date</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>TSF-98423</td>
                  <td>John Doe</td>
                  <td><span class="badge bg-success">Delivered</span></td>
                  <td>Nairobi</td>
                  <td>10 Oct 2025</td>
                </tr>
                <tr>
                  <td>TSF-98422</td>
                  <td>Mary Ann</td>
                  <td><span class="badge bg-warning text-dark">In Transit</span></td>
                  <td>Mombasa</td>
                  <td>09 Oct 2025</td>
                </tr>
                <tr>
                  <td>TSF-98421</td>
                  <td>Alex Kim</td>
                  <td><span class="badge bg-danger">Delayed</span></td>
                  <td>Kisumu</td>
                  <td>08 Oct 2025</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>

      <!-- Map Section -->
      <div class="col-md-4">
        <div class="card shadow-sm border-0" style="border-radius:12px;">
          <div class="card-header bg-white fw-semibold" style="font-weight:600;">
            <i class="bi bi-geo-alt me-2 text-danger"></i> Active Routes
          </div>
          <div class="card-body text-center">
            <img src="https://www.google.com/maps/d/thumbnail?mid=1d-FakeMapExample&hl=en"
                 class="img-fluid rounded shadow-sm" alt="Map overview" 
                 style="border-radius:10px;">
            <p class="mt-2 small text-muted">Live tracking map of ongoing deliveries.</p>
          </div>
        </div>
      </div>
    </div>

    <!-- System Activity -->
    <div class="mt-5">
      <div class="card shadow-sm border-0" style="border-radius:12px;">
        <div class="card-header bg-white fw-semibold" style="font-weight:600;">
          <i class="bi bi-activity me-2 text-info"></i> System Activity
        </div>
        <div class="card-body">
          <ul class="list-group list-group-flush">
            <li class="list-group-item"><i class="bi bi-check-circle text-success me-2"></i> New shipment created for <strong>TSF-98500</strong></li>
            <li class="list-group-item"><i class="bi bi-truck text-primary me-2"></i> Driver <strong>Daniel</strong> departed for Mombasa delivery</li>
            <li class="list-group-item"><i class="bi bi-person-plus text-warning me-2"></i> New customer <strong>Jane Mwangi</strong> registered</li>
            <li class="list-group-item"><i class="bi bi-cash text-success me-2"></i> Payment received for <strong>TSF-98415</strong></li>
          </ul>
        </div>
      </div>
    </div>

  </div>
</div>

<style>
  .card:hover {
    transform: translateY(-3px);
    box-shadow: 0 4px 12px rgba(0,0,0,0.1);
  }
</style>

<?php include 'layout/footer.php'; ?>
