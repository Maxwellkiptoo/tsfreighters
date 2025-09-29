<?php include __DIR__ . '/../layout/header.php'; ?>

<style>
  /* Custom Colors */
  .text-primary-blue { color: #0d6efd !important; } /* Bootstrap blue */
  .text-danger-red { color: #dc3545 !important; }    /* Bootstrap red */
  .text-warning-yellow { color: #ffc107 !important; } /* Bootstrap yellow */

  .btn-primary-blue {
    background-color: #0d6efd;
    border-color: #0d6efd;
  }
  .btn-primary-blue:hover, .btn-primary-blue:focus {
    background-color: #0842c9;
    border-color: #0842c9;
  }

  /* Service Cards - Accent Borders */
  .service-card {
    border-top: 4px solid transparent;
    transition: border-color 0.3s ease, box-shadow 0.3s ease;
  }
  .service-card.blue-border:hover {
    border-color: #0d6efd;
    box-shadow: 0 0 20px rgba(13, 110, 253, 0.4);
  }
  .service-card.red-border:hover {
    border-color: #dc3545;
    box-shadow: 0 0 20px rgba(220, 53, 69, 0.4);
  }
  .service-card.yellow-border:hover {
    border-color: #ffc107;
    box-shadow: 0 0 20px rgba(255, 193, 7, 0.4);
  }

  /* Instant Solutions buttons */
  .btn-outline-danger:hover {
    background-color: #dc3545;
    color: white;
  }

  /* Responsive tweaks */
  @media (max-width: 576px) {
    .section-title {
      font-size: 1.8rem;
    }
    .service-card h5, .service-card h6 {
      font-size: 1.1rem;
    }
    .solution-card h6 {
      font-size: 1rem;
    }
  }
</style>

<!-- Intro Section -->
<section class="intro-section py-4 text-center">
  <div class="container">
    <p class="lead">Discover our premium logistics services designed to make your shipping experience <span class="text-primary-blue fw-bold">fast</span>, <span class="text-danger-red fw-bold">secure</span>, and <span class="text-warning-yellow fw-bold">seamless</span>.</p>
  </div>
</section>

<section class="services-section py-5">
  <div class="container">
    <h2 class="section-title text-center mb-5" data-aos="fade-up" data-aos-duration="800">Our Premium Services</h2>
    <div class="row g-4">
      <div class="col-md-4" data-aos="fade-right" data-aos-delay="100" data-aos-duration="1000">
        <div class="service-card shadow rounded p-4 text-center blue-border" tabindex="0" aria-label="Lightning-Fast Delivery: Express and reliable shipping solutions across Kenya and East Africa, always on schedule.">
          <i class="fas fa-shipping-fast fa-3x text-primary-blue mb-3" aria-hidden="true"></i>
          <h5 class="fw-bold mb-3">Lightning-Fast Delivery</h5>
          <p>Express and reliable shipping solutions across Kenya and East Africa, always on schedule.</p>
        </div>
      </div>
      <div class="col-md-4" data-aos="fade-up" data-aos-delay="200" data-aos-duration="1000">
        <div class="service-card shadow rounded p-4 text-center yellow-border" tabindex="0" aria-label="Global Reach: Seamless worldwide logistics powered by local expertise and global networks.">
          <i class="fas fa-globe-africa fa-3x text-warning-yellow mb-3" aria-hidden="true"></i>
          <h5 class="fw-bold mb-3">Global Reach</h5>
          <p>Seamless worldwide logistics powered by local expertise and global networks.</p>
        </div>
      </div>
      <div class="col-md-4" data-aos="fade-left" data-aos-delay="300" data-aos-duration="1000">
        <div class="service-card shadow rounded p-4 text-center red-border" tabindex="0" aria-label="Unmatched Security: Advanced real-time tracking and safety-first approach to secure your shipments.">
          <i class="fas fa-lock fa-3x text-danger-red mb-3" aria-hidden="true"></i>
          <h5 class="fw-bold mb-3">Unmatched Security</h5>
          <p>Advanced real-time tracking and safety-first approach to secure your shipments.</p>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="core-services-section py-5 bg-light">
  <div class="container text-center">
    <h2 class="section-title mb-5" data-aos="fade-up" data-aos-duration="800">Our Core Services</h2>
    <div class="row g-4 justify-content-center">
      <?php
        $services = [
          ["icon" => "fa-truck-loading", "name" => "Freight Forwarding", "desc" => "Shipping, customs clearance, and delivery coordination.", "color" => "text-primary-blue", "border" => "blue-border"],
          ["icon" => "fa-warehouse", "name" => "Warehousing", "desc" => "Secure storage and inventory management solutions.", "color" => "text-warning-yellow", "border" => "yellow-border"],
          ["icon" => "fa-plane-departure", "name" => "Air Cargo", "desc" => "Fast and reliable air freight services worldwide.", "color" => "text-danger-red", "border" => "red-border"],
          ["icon" => "fa-truck-moving", "name" => "Last-Mile Delivery", "desc" => "Efficient delivery to the final destination.", "color" => "text-primary-blue", "border" => "blue-border"]
        ];
        foreach ($services as $index => $service):
      ?>
      <div class="col-md-3 col-sm-6" data-aos="zoom-in" data-aos-delay="<?= ($index+1)*150 ?>" data-aos-duration="900">
        <div class="service-card shadow rounded p-4 h-100 d-flex flex-column align-items-center <?= $service['border'] ?>" tabindex="0" title="<?= htmlspecialchars($service['desc']) ?>" aria-label="<?= htmlspecialchars($service['name'] . ': ' . $service['desc']) ?>">
          <i class="fas <?= htmlspecialchars($service['icon']) ?> fa-3x <?= htmlspecialchars($service['color']) ?> mb-3" aria-hidden="true"></i>
          <h6 class="fw-bold mb-0"><?= htmlspecialchars($service['name']) ?></h6>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<section class="instant-solutions-section py-5">
  <div class="container">
    <h2 class="section-title text-center mb-5" data-aos="fade-up" data-aos-duration="800">Instant Solutions</h2>
    <div class="row g-4 text-center">
      <?php
        $solutions = [
          ["icon" => "fa-box-open", "title" => "Ship Now", "desc" => "Choose the best service for your shipment in minutes.", "btnText" => "Start Shipping", "btnLink" => "#", "color" => "text-primary-blue"],
          ["icon" => "fa-calculator", "title" => "Get a Quote", "desc" => "Instantly estimate & compare costs with transparency.", "btnText" => "Calculate", "btnLink" => "#", "color" => "text-danger-red"],
          ["icon" => "fa-briefcase", "title" => "For Business", "desc" => "Ship regularly? Get a business account with exclusive benefits.", "btnText" => "Apply Now", "btnLink" => "#", "color" => "text-warning-yellow"],
          ["icon" => "fa-file-contract", "title" => "Tariff Updates", "desc" => "Stay ahead with the latest tariff & compliance developments.", "btnText" => "View Updates", "btnLink" => "#", "color" => "text-primary-blue"]
        ];
        foreach ($solutions as $i => $item):
      ?>
      <div class="col-md-3 col-sm-6" data-aos="fade-up" data-aos-delay="<?= ($i+1)*150 ?>" data-aos-duration="900">
        <div class="solution-card shadow rounded p-4 h-100 d-flex flex-column justify-content-between" tabindex="0" aria-label="<?= htmlspecialchars($item['title'] . ': ' . $item['desc']) ?>">
          <i class="fas <?= htmlspecialchars($item['icon']) ?> fa-3x <?= htmlspecialchars($item['color']) ?> mb-3" aria-hidden="true"></i>
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
<section class="cta-section py-5 bg-primary text-white text-center" data-aos="zoom-in" data-aos-duration="1000">
  <div class="container">
    <h3 class="mb-3">Ready to Ship with <span class="fw-bold">TS Freighters</span>?</h3>
    <p class="mb-4">Contact us today or get a free quote to get started!</p>
    <a href="index.php?controller=customer&action=contact" class="btn btn-light btn-lg rounded-pill" aria-label="Contact Us">Contact Us</a>
  </div>
</section>

<?php include __DIR__ . '/../layout/footer.php'; ?>

<!-- Initialize AOS Animations -->
<script>
  document.addEventListener('DOMContentLoaded', () => {
    if(typeof AOS !== 'undefined') {
      AOS.init({
        once: true,
        easing: 'ease-in-out',
        duration: 800,
        offset: 120,
      });
    }
  });
</script>
