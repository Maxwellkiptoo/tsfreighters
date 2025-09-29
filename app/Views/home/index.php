<?php include __DIR__ . '/../layout/header.php'; ?>

<!-- Hero Section -->
<section class="hero d-flex align-items-center text-white">
  <div class="container text-center">
    <h1 class="fw-bold display-4">Delivering Beyond Borders</h1>
    <p class="lead">Fast, Secure, and Reliable Logistics Solutions in Kenya & Across the Globe</p>
    
    <!-- Tracking Form -->
    <form class="d-flex justify-content-center mt-4" action="index.php" method="get">
      <input type="hidden" name="controller" value="customer">
      <input type="hidden" name="action" value="tracking">
      <input type="text" name="tracking_number" class="form-control w-50 rounded-pill me-2" placeholder="Enter Tracking Number" required>
      <button class="btn btn-warning rounded-pill px-4 fw-bold text-dark" type="submit">Track</button>
    </form>
  </div>
</section>

<!-- Service Highlights -->
<section class="py-5 bg-light text-center">
  <div class="container">
    <div class="row g-4">
      <div class="col-md-4">
        <div class="p-4 bg-white shadow-sm rounded">
          <i class="fas fa-shipping-fast fa-3x text-primary mb-3"></i>
          <h5 class="fw-bold">Fast Delivery</h5>
          <p>Reliable express delivery across Kenya and East Africa.</p>
        </div>
      </div>
      <div class="col-md-4">
        <div class="p-4 bg-white shadow-sm rounded">
          <i class="fas fa-globe-africa fa-3x text-primary mb-3"></i>
          <h5 class="fw-bold">Global Reach</h5>
          <p>Seamless international freight and cargo handling services.</p>
        </div>
      </div>
      <div class="col-md-4">
        <div class="p-4 bg-white shadow-sm rounded">
          <i class="fas fa-lock fa-3x text-primary mb-3"></i>
          <h5 class="fw-bold">Secure Shipping</h5>
          <p>End-to-end security and tracking for all shipments.</p>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- About Us -->
<section class="py-5">
  <div class="container text-center">
    <h2 class="fw-bold mb-3">About TS Freighters</h2>
    <p class="lead">We are a trusted logistics company based in Kenya, offering innovative freight, warehousing, and last-mile delivery solutions. Our mission is to connect businesses and individuals with the world, ensuring efficiency and safety at every stage.</p>
    <a href="index.php?controller=customer&action=about" class="btn btn-primary btn-lg rounded-pill mt-3">Learn More</a>
  </div>
</section>

<!-- Services -->
<section class="py-5 bg-light">
  <div class="container text-center">
    <h2 class="fw-bold mb-5">Our Services</h2>
    <div class="row g-4">
      <div class="col-md-3">
        <div class="p-4 bg-white shadow-sm rounded">
          <i class="fas fa-truck-loading fa-3x text-primary mb-3"></i>
          <h6>Freight Forwarding</h6>
        </div>
      </div>
      <div class="col-md-3">
        <div class="p-4 bg-white shadow-sm rounded">
          <i class="fas fa-warehouse fa-3x text-primary mb-3"></i>
          <h6>Warehousing</h6>
        </div>
      </div>
      <div class="col-md-3">
        <div class="p-4 bg-white shadow-sm rounded">
          <i class="fas fa-plane-departure fa-3x text-primary mb-3"></i>
          <h6>Air Cargo</h6>
        </div>
      </div>
      <div class="col-md-3">
        <div class="p-4 bg-white shadow-sm rounded">
          <i class="fas fa-truck-moving fa-3x text-primary mb-3"></i>
          <h6>Last-Mile Delivery</h6>
        </div>
      </div>
    </div>
  </div>
</section>

<?php include __DIR__ . '/../layout/footer.php'; ?>
