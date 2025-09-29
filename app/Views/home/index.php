<?php include __DIR__ . '/../layout/header.php'; ?>

<!-- Hero Section with Carousel -->
<section id="heroCarousel" class="carousel slide carousel-fade" data-bs-ride="carousel" data-bs-interval="6000">
  <!-- Indicators -->
  <div class="carousel-indicators">
    <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="0" class="active"></button>
    <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="1"></button>
    <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="2"></button>
  </div>

  <div class="carousel-inner">
    <?php
      $slides = [
        [
          "img" => "truck4.jpg",
          "title" => "Delivering Beyond Borders",
          "text"  => "Fast, Secure & Reliable Logistics Across Kenya & The Globe"
        ],
        [
          "img" => "truck2.jpg",
          "title" => "Your Cargo, Our Priority",
          "text"  => "Tailored Express Freight Solutions Backed by Innovation"
        ],
        [
          "img" => "truck3.jpg",
          "title" => "Global Reach, Local Touch",
          "text"  => "Seamless International Shipping with Trusted Local Expertise"
        ]
      ];
      $imageWebPath = 'public/assets/images/';
      foreach ($slides as $i => $slide): ?>
        <div class="carousel-item hero-slide <?= $i === 0 ? 'active' : '' ?>">
          <div class="hero-bg" style="background-image: url('<?= $imageWebPath . $slide['img'] ?>');">
            <div class="hero-overlay"></div>
          </div>
          <div class="carousel-caption d-flex flex-column justify-content-center align-items-center text-center px-3">
            <h1 class="fw-bold display-4 text-white text-shadow"><?= htmlspecialchars($slide['title']) ?></h1>
            <p class="lead text-light mb-4"><?= htmlspecialchars($slide['text']) ?></p>
            <!-- Tracking Form -->
            <form class="tracking-form d-flex justify-content-center w-100" action="index.php" method="get" style="max-width:600px;">
              <input type="hidden" name="controller" value="customer">
              <input type="hidden" name="action" value="tracking">
              <input type="text" name="tracking_number" class="form-control rounded-pill me-2 shadow-sm" placeholder="Enter Tracking Number" required>
              <button class="btn btn-warning rounded-pill px-4 fw-bold text-dark shadow-sm" type="submit">Track</button>
            </form>
            <small class="text-light mt-2">Trusted by 500+ businesses worldwide 🌍</small>
          </div>
        </div>
    <?php endforeach; ?>
  </div>

  <!-- Controls -->
  <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
    <span class="carousel-control-prev-icon"></span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
    <span class="carousel-control-next-icon"></span>
  </button>
</section>

<!-- Service Highlights -->
<section class="py-5 bg-light text-center">
  <div class="container">
    <div class="row g-4">
      <div class="col-md-4">
        <div class="p-4 bg-white shadow-sm rounded hover-card">
          <i class="fas fa-shipping-fast fa-3x text-primary mb-3"></i>
          <h5 class="fw-bold">Lightning-Fast Delivery</h5>
          <p>Express solutions across Kenya & East Africa — always on time.</p>
        </div>
      </div>
      <div class="col-md-4">
        <div class="p-4 bg-white shadow-sm rounded hover-card">
          <i class="fas fa-globe-africa fa-3x text-primary mb-3"></i>
          <h5 class="fw-bold">Global Reach</h5>
          <p>Seamless worldwide connections powered by local expertise.</p>
        </div>
      </div>
      <div class="col-md-4">
        <div class="p-4 bg-white shadow-sm rounded hover-card">
          <i class="fas fa-lock fa-3x text-primary mb-3"></i>
          <h5 class="fw-bold">Unmatched Security</h5>
          <p>Real-time tracking & safety-first logistics for your peace of mind.</p>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- About Us -->
<section class="py-5">
  <div class="container text-center">
    <h2 class="fw-bold mb-3">About TS Freighters</h2>
    <p class="lead">Based in Kenya, we redefine logistics with innovative freight, warehousing, and last-mile delivery solutions. Our mission is to empower businesses & individuals to connect with the world safely and efficiently.</p>
    <a href="index.php?controller=customer&action=about" class="btn btn-primary btn-lg rounded-pill mt-3">Learn More</a>
  </div>
</section>

<!-- Services -->
<section class="py-5 bg-light">
  <div class="container text-center">
    <h2 class="fw-bold mb-5">Our Core Services</h2>
    <div class="row g-4">
      <div class="col-md-3 col-6">
        <div class="p-4 bg-white shadow-sm rounded hover-card">
          <i class="fas fa-truck-loading fa-3x text-danger mb-3"></i>
          <h6>Freight Forwarding</h6>
        </div>
      </div>
      <div class="col-md-3 col-6">
        <div class="p-4 bg-white shadow-sm rounded hover-card">
          <i class="fas fa-warehouse fa-3x text-danger mb-3"></i>
          <h6>Warehousing</h6>
        </div>
      </div>
      <div class="col-md-3 col-6">
        <div class="p-4 bg-white shadow-sm rounded hover-card">
          <i class="fas fa-plane-departure fa-3x text-danger mb-3"></i>
          <h6>Air Cargo</h6>
        </div>
      </div>
      <div class="col-md-3 col-6">
        <div class="p-4 bg-white shadow-sm rounded hover-card">
          <i class="fas fa-truck-moving fa-3x text-danger mb-3"></i>
          <h6>Last-Mile Delivery</h6>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Quick Access (Improved) -->
<section class="py-5">
  <div class="container">
    <h2 class="fw-bold text-center mb-5">Instant Solutions</h2>
    <div class="row g-4 text-center">
      <div class="col-md-3 col-6">
        <div class="p-4 bg-white shadow-sm rounded hover-card h-100">
          <i class="fas fa-box-open fa-3x text-danger mb-3"></i>
          <h6 class="fw-bold">Ship Now</h6>
          <p>Choose the best service for your shipment in minutes.</p>
          <a href="#" class="btn btn-outline-danger btn-sm rounded-pill mt-2">Start Shipping</a>
        </div>
      </div>
      <div class="col-md-3 col-6">
        <div class="p-4 bg-white shadow-sm rounded hover-card h-100">
          <i class="fas fa-calculator fa-3x text-danger mb-3"></i>
          <h6 class="fw-bold">Get a Quote</h6>
          <p>Instantly estimate & compare costs with transparency.</p>
          <a href="#" class="btn btn-outline-danger btn-sm rounded-pill mt-2">Calculate</a>
        </div>
      </div>
      <div class="col-md-3 col-6">
        <div class="p-4 bg-white shadow-sm rounded hover-card h-100">
          <i class="fas fa-briefcase fa-3x text-danger mb-3"></i>
          <h6 class="fw-bold">For Business</h6>
          <p>Ship regularly? Get a business account with exclusive benefits.</p>
          <a href="#" class="btn btn-outline-danger btn-sm rounded-pill mt-2">Apply Now</a>
        </div>
      </div>
      <div class="col-md-3 col-6">
        <div class="p-4 bg-white shadow-sm rounded hover-card h-100">
          <i class="fas fa-file-contract fa-3x text-danger mb-3"></i>
          <h6 class="fw-bold">Tariff Updates</h6>
          <p>Stay ahead with the latest tariff & compliance developments.</p>
          <a href="#" class="btn btn-outline-danger btn-sm rounded-pill mt-2">View Updates</a>
        </div>
      </div>
    </div>
  </div>
</section>

<?php include __DIR__ . '/../layout/footer.php'; ?>

<!-- Scroll Effect -->
<script>
  window.addEventListener("scroll", function () {
    const navbar = document.querySelector(".custom-navbar");
    if (window.scrollY > 50) {
      navbar.classList.add("scrolled");
    } else {
      navbar.classList.remove("scrolled");
    }
  });
</script>