<?php include __DIR__ . '/../layout/header.php'; ?>

<!-- Hero Section with Carousel -->
<section id="heroCarousel" class="carousel slide carousel-fade" data-bs-ride="carousel" data-bs-interval="5000">
  <div class="carousel-inner">
    <?php
      // Define exactly 3 online images
      $slides = [
        [
          "img" => "truck1.jpg",
          "title" => "Delivering Beyond Borders",
          "text"  => "Fast, Secure, and Reliable Logistics Solutions in Kenya & Across the Globe",
          "tracking" => true
        ],
        [
          "img" => "truck2.jpg",
          "title" => "Your Cargo, Our Priority",
          "text"  => "Reliable Express Freight Solutions Tailored for You"
        ],
        [
          "img" => "truck3.jpg",
          "title" => "Global Reach, Local Touch",
          "text"  => "Seamless International Freight & Cargo Handling Services"
        ]
      ];

      $imageWebPath = 'public/assets/images/';

      // Output the 3 slides
      foreach ($slides as $i => $slide): ?>
        <div class="carousel-item hero-slide <?= $i === 0 ? 'active' : '' ?>" 
             style="background-image: url('<?= $imageWebPath . $slide['img'] ?>');">
          <div class="carousel-caption d-flex flex-column justify-content-center align-items-center text-center px-3">
            <h1 class="fw-bold display-4"><?= htmlspecialchars($slide['title']) ?></h1>
            <p class="lead"><?= htmlspecialchars($slide['text']) ?></p>
            <?php if (!empty($slide['tracking'])): ?>
              <!-- Tracking Form -->
              <form class="d-flex justify-content-center mt-4 w-100" action="index.php" method="get" style="max-width:600px;">
                <input type="hidden" name="controller" value="customer">
                <input type="hidden" name="action" value="tracking">
                <input type="text" name="tracking_number" class="form-control rounded-pill me-2" placeholder="Enter Tracking Number" required>
                <button class="btn btn-warning rounded-pill px-4 fw-bold text-dark" type="submit">Track</button>
              </form>
            <?php endif; ?>
          </div>
        </div>
    <?php endforeach; ?>
  </div>

  <!-- Carousel Controls -->
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
      <div class="col-md-3 col-6">
        <div class="p-4 bg-white shadow-sm rounded">
          <i class="fas fa-truck-loading fa-3x text-primary mb-3"></i>
          <h6>Freight Forwarding</h6>
        </div>
      </div>
      <div class="col-md-3 col-6">
        <div class="p-4 bg-white shadow-sm rounded">
          <i class="fas fa-warehouse fa-3x text-primary mb-3"></i>
          <h6>Warehousing</h6>
        </div>
      </div>
      <div class="col-md-3 col-6">
        <div class="p-4 bg-white shadow-sm rounded">
          <i class="fas fa-plane-departure fa-3x text-primary mb-3"></i>
          <h6>Air Cargo</h6>
        </div>
      </div>
      <div class="col-md-3 col-6">
        <div class="p-4 bg-white shadow-sm rounded">
          <i class="fas fa-truck-moving fa-3x text-primary mb-3"></i>
          <h6>Last-Mile Delivery</h6>
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
