<?php include __DIR__ . '/../layout/header.php'; ?>

<!-- AOS CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css">
<section class="intro-section mt-header position-relative overflow-hidden" data-aos="fade-up">
  <div class="container">
    <div class="row align-items-center intro-box p-4 p-md-5 shadow-lg">
      
      <!-- Left: Image -->
      <div class="col-md-6 mb-4 mb-md-0">
        <img src="public/assets/images/log.jpg" alt="Logistics" class="img-fluid rounded hero-img">
      </div>

      <!-- Right: Content -->
      <div class="col-md-6 text-center text-md-start">
        <div class="intro-icon mb-3">
          <i class="fas fa-shipping-fast fa-3x gradient-icon"></i>
        </div>
        <h2 class="fw-bold text-uppercase mb-3 text-white display-5">
          Logistics that Move You Forward
        </h2>
        <p class="lead fw-medium mb-4 text-light">
          Discover our premium logistics services designed to make your shipping experience 
          <span class="highlight-fast">fast</span>, 
          <span class="highlight-secure">secure</span>, and 
          <span class="highlight-seamless">seamless</span>.
        </p>
        <a href="#services" class="btn btn-glow rounded-pill px-5 py-3 fw-bold mt-2">
          Explore Services
        </a>
      </div>

    </div>
  </div>
</section>


<!-- OUR PREMIUM SERVICES -->
<section class="services-section py-5">
  <div class="container">
    <h2 class="section-title text-center mb-5" data-aos="fade-up">Our Premium Services</h2>
    <div class="row g-4">
      <div class="col-md-4" data-aos="fade-right" data-aos-delay="100">
        <div class="service-card shadow rounded p-4 text-center blue-border">
          <i class="fas fa-shipping-fast fa-3x text-primary-blue mb-3"></i>
          <h5 class="fw-bold mb-3">Lightning-Fast Delivery</h5>
          <p>Express and reliable shipping solutions across Kenya and East Africa, always on schedule.</p>
        </div>
      </div>
      <div class="col-md-4" data-aos="fade-up" data-aos-delay="200">
        <div class="service-card shadow rounded p-4 text-center yellow-border">
          <i class="fas fa-globe-africa fa-3x text-warning-yellow mb-3"></i>
          <h5 class="fw-bold mb-3">Global Reach</h5>
          <p>Seamless worldwide logistics powered by local expertise and global networks.</p>
        </div>
      </div>
      <div class="col-md-4" data-aos="fade-left" data-aos-delay="300">
        <div class="service-card shadow rounded p-4 text-center red-border">
          <i class="fas fa-lock fa-3x text-danger-red mb-3"></i>
          <h5 class="fw-bold mb-3">Unmatched Security</h5>
          <p>Advanced real-time tracking and safety-first approach to secure your shipments.</p>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- CORE SERVICES -->
<section class="core-services-section py-5 bg-light">
  <div class="container text-center">
    <h2 class="section-title mb-5" data-aos="fade-up">Our Core Services</h2>
    <div class="row g-4 justify-content-center">
      <?php
        $services = [
          ["icon" => "fa-truck-loading", "name" => "Freight Forwarding", "desc" => "Shipping, customs clearance, and delivery coordination.", "color" => "text-primary-blue", "border" => "blue-border"],
          ["icon" => "fa-warehouse", "name" => "Warehousing", "desc" => "Secure storage and inventory management.", "color" => "text-warning-yellow", "border" => "yellow-border"],
          ["icon" => "fa-plane-departure", "name" => "Air Cargo", "desc" => "Fast and reliable air freight services.", "color" => "text-danger-red", "border" => "red-border"],
          ["icon" => "fa-truck-moving", "name" => "Last-Mile Delivery", "desc" => "Efficient door-to-door delivery.", "color" => "text-primary-blue", "border" => "blue-border"]
        ];
        foreach ($services as $index => $service):
      ?>
      <div class="col-md-3 col-sm-6" data-aos="zoom-in" data-aos-delay="<?= ($index+1)*150 ?>">
        <div class="service-card shadow rounded p-4 h-100 d-flex flex-column align-items-center <?= $service['border'] ?>">
          <i class="fas <?= htmlspecialchars($service['icon']) ?> fa-3x <?= htmlspecialchars($service['color']) ?> mb-3"></i>
          <h6 class="fw-bold"><?= htmlspecialchars($service['name']) ?></h6>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- INSTANT SOLUTIONS -->
<section class="instant-solutions-section py-5">
  <div class="container">
    <h2 class="section-title text-center mb-5" data-aos="fade-up">Instant Solutions</h2>
    <div class="row g-4 text-center">
      <?php
        $solutions = [
          ["icon" => "fa-box-open", "title" => "Ship Now", "desc" => "Choose the best service for your shipment in minutes.", "btnText" => "Start Shipping", "btnLink" => "#", "color" => "text-primary-blue"],
          ["icon" => "fa-calculator", "title" => "Get a Quote", "desc" => "Estimate & compare costs instantly.", "btnText" => "Calculate", "btnLink" => "#", "color" => "text-danger-red"],
          ["icon" => "fa-briefcase", "title" => "For Business", "desc" => "Regular shipping? Get a business account.", "btnText" => "Apply Now", "btnLink" => "#", "color" => "text-warning-yellow"],
          ["icon" => "fa-file-contract", "title" => "Tariff Updates", "desc" => "Latest tariffs and compliance updates.", "btnText" => "View Updates", "btnLink" => "#", "color" => "text-primary-blue"]
        ];
        foreach ($solutions as $i => $item):
      ?>
      <div class="col-md-3 col-sm-6" data-aos="fade-up" data-aos-delay="<?= ($i+1)*150 ?>">
        <div class="solution-card shadow rounded p-4 h-100 d-flex flex-column justify-content-between">
          <i class="fas <?= htmlspecialchars($item['icon']) ?> fa-3x <?= htmlspecialchars($item['color']) ?> mb-3"></i>
          <h6 class="fw-bold"><?= htmlspecialchars($item['title']) ?></h6>
          <p><?= htmlspecialchars($item['desc']) ?></p>
          <a href="<?= htmlspecialchars($item['btnLink']) ?>" class="btn btn-outline-danger rounded-pill mt-3"><?= htmlspecialchars($item['btnText']) ?></a>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- CALL TO ACTION -->
<section class="cta-section py-5 text-white text-center" data-aos="zoom-in">
  <div class="container">
    <h3 class="mb-3">Ready to Ship with <strong>TS Freighters</strong>?</h3>
    <p class="mb-4">Contact us or request a quote to begin your journey.</p>
    <a href="index.php?controller=customer&action=contact" class="btn btn-light btn-lg rounded-pill">Contact Us</a>
  </div>
</section>

<?php include __DIR__ . '/../layout/footer.php'; ?>

<!-- AOS JS -->
<script src="https://cdn.jsdeli
