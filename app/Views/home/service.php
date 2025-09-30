<?php include __DIR__ . '/../layout/header.php'; ?>

<!-- AOS CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css">
<style>
  /* Color-coded badges for different services */
  .badge-freight { background-color: #0d6efd; color: #fff; padding: 0.5em 1em; border-radius: 0.5rem; }
  .badge-warehousing { background-color: #ffc107; color: #000; padding: 0.5em 1em; border-radius: 0.5rem; }
  .badge-aircargo { background-color: #dc3545; color: #fff; padding: 0.5em 1em; border-radius: 0.5rem; }
  .badge-lastmile { background-color: #198754; color: #fff; padding: 0.5em 1em; border-radius: 0.5rem; }

  /* Autocomplete styles */
  .autocomplete-suggestions {
      border: 1px solid #ccc;
      background: #fff;
      position: absolute;
      max-height: 150px;
      overflow-y: auto;
      z-index: 9999;
      width: 100%;
  }
  .autocomplete-suggestion {
      padding: 8px;
      cursor: pointer;
  }
  .autocomplete-suggestion:hover {
      background-color: #f0f0f0;
  }
</style>

<section class="intro-section mt-header position-relative overflow-hidden" data-aos="fade-up">
  <div class="container">
    <div class="row align-items-center intro-box p-4 p-md-5 shadow-lg">
      <div class="col-md-6 mb-4 mb-md-0">
        <img src="public/assets/images/log.jpg" alt="Logistics" class="img-fluid rounded hero-img">
      </div>
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
      </div>
    </div>
  </div>
</section>

<!-- Premium Services Section -->
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

<!-- Core Services Section -->
<section class="core-services-section py-5 bg-light">
  <div class="container text-center">
    <h2 class="section-title mb-5" data-aos="fade-up">Our Core Services</h2>
    <div class="row g-4 justify-content-center">
      <?php
      $services = [
          ["icon"=>"fa-truck-loading","name"=>"Freight Forwarding","border"=>"blue-border","color"=>"text-primary-blue"],
          ["icon"=>"fa-warehouse","name"=>"Warehousing","border"=>"yellow-border","color"=>"text-warning-yellow"],
          ["icon"=>"fa-plane-departure","name"=>"Air Cargo","border"=>"red-border","color"=>"text-danger-red"],
          ["icon"=>"fa-truck-moving","name"=>"Last-Mile Delivery","border"=>"blue-border","color"=>"text-primary-blue"]
      ];
      foreach ($services as $i => $service): ?>
      <div class="col-md-3 col-sm-6" data-aos="zoom-in" data-aos-delay="<?= ($i+1)*150 ?>">
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
      foreach ($solutions as $i => $item): ?>
      <div class="col-md-3 col-sm-6" data-aos="fade-up" data-aos-delay="<?= ($i+1)*150 ?>">
        <div class="solution-card shadow rounded p-4 h-100 d-flex flex-column justify-content-between">
          <i class="fas <?= htmlspecialchars($item['icon']) ?> fa-3x <?= htmlspecialchars($item['color']) ?> mb-3"></i>
          <h6 class="fw-bold"><?= htmlspecialchars($item['title']) ?></h6>
          <p><?= htmlspecialchars($item['desc']) ?></p>
          <a href="<?= htmlspecialchars($item['btnLink']) ?>" class="btn btn-outline-danger rounded-pill mt-3 ship-now-btn"><?= htmlspecialchars($item['btnText']) ?></a>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- Ship Now Modal -->
<div class="modal fade" id="shipNowModal" tabindex="-1" aria-labelledby="shipNowModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title" id="shipNowModalLabel"><i class="fas fa-box-open me-2"></i>Ship Now</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="shipNowForm">
          <div class="row g-3">
            <div class="col-md-6">
              <label class="form-label">Product Name</label>
              <input type="text" class="form-control" name="product_name" placeholder="Enter product name" required>
            </div>
            <div class="col-md-6">
              <label class="form-label">Service Type</label>
              <select class="form-select" name="service_type" required>
                <option value="">Select service</option>
                <option value="freight">Freight Forwarding</option>
                <option value="warehousing">Warehousing</option>
                <option value="aircargo">Air Cargo</option>
                <option value="lastmile">Last-Mile Delivery</option>
              </select>
            </div>
            <div class="col-md-4">
              <label class="form-label">Weight (kg)</label>
              <input type="number" class="form-control" name="weight" min="1" value="1" required>
            </div>
            <div class="col-md-4">
              <label class="form-label">Dimensions (cm)</label>
              <div class="d-flex gap-2">
                <input type="number" class="form-control" name="length" placeholder="L" step="0.01" required>
                <input type="number" class="form-control" name="width" placeholder="W" step="0.01" required>
                <input type="number" class="form-control" name="height" placeholder="H" step="0.01" required>
              </div>
            </div>
            <div class="col-md-4">
              <label class="form-label">Delivery Type</label>
              <select class="form-select" name="delivery_type" required>
                <option value="">Choose type</option>
                <option value="delivery">Delivery</option>
                <option value="store">Store / Warehousing</option>
              </select>
            </div>
            <div class="col-12">
              <label class="form-label">Additional Notes</label>
              <textarea class="form-control" name="notes" rows="3" placeholder="Any extra instructions..."></textarea>
            </div>
          </div>
          <div class="text-end mt-4">
            <button type="submit" class="btn btn-outline-danger rounded-pill">Submit Request</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- CALL TO ACTION --> 
<section class="cta-section py-5 text-white text-center" data-aos="zoom-in">
  <div class="container">
    <h3 class="mb-3">Ready to Ship with <strong>TS Freighters</strong>?</h3>
    <p class="mb-4">Contact us or request a quote to begin your journey.</p>
    <a href="index.php?controller=customer&action=contact" class="btn btn-light btn-lg rounded-pill">Contact Us</a>
  </div>
</section>

<?php include __DIR__ . '/../layout/footer.php'; ?>

<script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
<script>
AOS.init();

// Open Ship Now modal when clicking Start Shipping
document.querySelectorAll('.ship-now-btn').forEach(btn=>{
    btn.setAttribute('data-bs-toggle','modal');
    btn.setAttribute('data-bs-target','#shipNowModal');
});

// Optional: handle form submission
document.getElementById('shipNowForm').addEventListener('submit', function(e){
    e.preventDefault();
    alert('Your shipping request has been submitted!');
    var modal = bootstrap.Modal.getInstance(document.getElementById('shipNowModal'));
    modal.hide();
});
</script>
