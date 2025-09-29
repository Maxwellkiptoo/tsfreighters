<?php include __DIR__ . '/../layout/header.php'; ?>

<!-- Intro Section -->
<section class="intro-section py-4 text-center">
  <div class="container">
    <p class="lead">Discover our premium logistics services designed to make your shipping experience fast, secure, and seamless.</p>
  </div>
</section>

<section class="services-section py-5">
  <div class="container">
    <h2 class="section-title text-center mb-5" data-aos="fade-up">Our Premium Services</h2>
    <div class="row g-4">
      <div class="col-md-4" data-aos="fade-up" data-aos-delay="100">
        <div class="service-card shadow rounded p-4 text-center" tabindex="0" aria-label="Lightning-Fast Delivery: Express and reliable shipping solutions across Kenya and East Africa, always on schedule.">
          <i class="fas fa-shipping-fast fa-3x text-primary mb-3" aria-hidden="true"></i>
          <h5 class="fw-bold mb-3">Lightning-Fast Delivery</h5>
          <p>Express and reliable shipping solutions across Kenya and East Africa, always on schedule.</p>
        </div>
      </div>
      <div class="col-md-4" data-aos="fade-up" data-aos-delay="200">
        <div class="service-card shadow rounded p-4 text-center" tabindex="0" aria-label="Global Reach: Seamless worldwide logistics powered by local expertise and global networks.">
          <i class="fas fa-globe-africa fa-3x text-primary mb-3" aria-hidden="true"></i>
          <h5 class="fw-bold mb-3">Global Reach</h5>
          <p>Seamless worldwide logistics powered by local expertise and global networks.</p>
        </div>
      </div>
      <div class="col-md-4" data-aos="fade-up" data-aos-delay="300">
        <div class="service-card shadow rounded p-4 text-center" tabindex="0" aria-label="Unmatched Security: Advanced real-time tracking and safety-first approach to secure your shipments.">
          <i class="fas fa-lock fa-3x text-primary mb-3" aria-hidden="true"></i>
          <h5 class="fw-bold mb-3">Unmatched Security</h5>
          <p>Advanced real-time tracking and safety-first approach to secure your shipments.</p>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="core-services-section py-5 bg-light">
  <div class="container text-center">
    <h2 class="section-title mb-5" data-aos="fade-up">Our Core Services</h2>
    <div class="row g-4 justify-content-center">
      <?php
        $services = [
          ["icon" => "fa-truck-loading", "name" => "Freight Forwarding", "desc" => "Shipping, customs clearance, and delivery coordination."],
          ["icon" => "fa-warehouse", "name" => "Warehousing", "desc" => "Secure storage and inventory management solutions."],
          ["icon" => "fa-plane-departure", "name" => "Air Cargo", "desc" => "Fast and reliable air freight services worldwide."],
          ["icon" => "fa-truck-moving", "name" => "Last-Mile Delivery", "desc" => "Efficient delivery to the final destination."]
        ];
        foreach ($services as $index => $service):
      ?>
      <div class="col-md-3 col-sm-6" data-aos="zoom-in" data-aos-delay="<?= ($index+1)*100 ?>">
        <div class="service-card shadow rounded p-4 h-100 d-flex flex-column align-items-center" tabindex="0" title="<?= htmlspecialchars($service['desc']) ?>" aria-label="<?= htmlspecialchars($service['name'] . ': ' . $service['desc']) ?>">
          <i class="fas <?= htmlspecialchars($service['icon']) ?> fa-3x text-danger mb-3" aria-hidden="true"></i>
          <h6 class="fw-bold mb-0"><?= htmlspecialchars($service['name']) ?></h6>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<section class="instant-solutions-section py-5">
  <div class="container">
    <h2 class="section-title text-center mb-5" data-aos="fade-up">Instant Solutions</h2>
    <div class="row g-4 text-center">
      <?php
        $solutions = [
          ["icon" => "fa-box-open", "title" => "Ship Now", "desc" => "Choose the best service for your shipment in minutes.", "btnText" => "Start Shipping", "btnLink" => "#"],
          ["icon" => "fa-calculator", "title" => "Get a Quote", "desc" => "Instantly estimate & compare costs with transparency.", "btnText" => "Calculate", "btnLink" => "#"],
          ["icon" => "fa-briefcase", "title" => "For Business", "desc" => "Ship regularly? Get a business account with exclusive benefits.", "btnText" => "Apply Now", "btnLink" => "#"],
          ["icon" => "fa-file-contract", "title" => "Tariff Updates", "desc" => "Stay ahead with the latest tariff & compliance developments.", "btnText" => "View Updates", "btnLink" => "#"]
        ];
        foreach ($solutions as $i => $item):
      ?>
      <div class="col-md-3 col-sm-6" data-aos="fade-up" data-aos-delay="<?= ($i+1)*100 ?>">
        <div class="solution-card shadow rounded p-4 h-100 d-flex flex-column justify-content-between" tabindex="0" aria-label="<?= htmlspecialchars($item['title'] . ': ' . $item['desc']) ?>">
          <i class="fas <?= htmlspecialchars($item['icon']) ?> fa-3x text-danger mb-3" aria-hidden="true"></i>
          <h6 class="fw-bold"><?= htmlspecialchars($item['title']) ?></h6>
          <p><?= htmlspecialchars($item['desc']) ?></p>
          <a href="<?= htmlspecialchars($item['btnLink']) ?>" class="btn btn-outline-danger rounded-pill mt-3" aria-label="<?= htmlspecialchars($item['btnText']) ?>">
            <?= htmlspecialchars($item['btnText']) ?>
          </a>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- CTA Section -->
<section class="cta-section py-5 bg-primary text-white text-center">
  <div class="container">
    <h3 class="mb-3">Ready to Ship with TS Freighters?</h3>
    <p class="mb-4">Contact us today or get a free quote to get started!</p>
    <a href="index.php?controller=customer&action=contact" class="btn btn-light btn-lg rounded-pill" aria-label="Contact Us">Contact Us</a>
  </div>
</section>

<?php include __DIR__ . '/../layout/footer.php'; ?>
