<?php include __DIR__ . '/../layout/header.php'; ?>

<section class="services-section py-5">
  <div class="container">
    <h2 class="section-title text-center mb-5" data-aos="fade-up">Our Premium Services</h2>
    <div class="row g-4">
      <div class="col-md-4" data-aos="fade-up" data-aos-delay="100">
        <div class="service-card shadow rounded p-4 text-center">
          <i class="fas fa-shipping-fast fa-3x text-primary mb-3"></i>
          <h5 class="fw-bold mb-3">Lightning-Fast Delivery</h5>
          <p>Express and reliable shipping solutions across Kenya and East Africa, always on schedule.</p>
        </div>
      </div>
      <div class="col-md-4" data-aos="fade-up" data-aos-delay="200">
        <div class="service-card shadow rounded p-4 text-center">
          <i class="fas fa-globe-africa fa-3x text-primary mb-3"></i>
          <h5 class="fw-bold mb-3">Global Reach</h5>
          <p>Seamless worldwide logistics powered by local expertise and global networks.</p>
        </div>
      </div>
      <div class="col-md-4" data-aos="fade-up" data-aos-delay="300">
        <div class="service-card shadow rounded p-4 text-center">
          <i class="fas fa-lock fa-3x text-primary mb-3"></i>
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
          ["icon" => "fa-truck-loading", "name" => "Freight Forwarding"],
          ["icon" => "fa-warehouse", "name" => "Warehousing"],
          ["icon" => "fa-plane-departure", "name" => "Air Cargo"],
          ["icon" => "fa-truck-moving", "name" => "Last-Mile Delivery"]
        ];
        foreach ($services as $index => $service):
      ?>
      <div class="col-md-3 col-sm-6" data-aos="zoom-in" data-aos-delay="<?= ($index+1)*100 ?>">
        <div class="service-card shadow rounded p-4 h-100 d-flex flex-column align-items-center">
          <i class="fas <?= htmlspecialchars($service['icon']) ?> fa-3x text-danger mb-3"></i>
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
        <div class="solution-card shadow rounded p-4 h-100 d-flex flex-column justify-content-between">
          <i class="fas <?= htmlspecialchars($item['icon']) ?> fa-3x text-danger mb-3"></i>
          <h6 class="fw-bold"><?= htmlspecialchars($item['title']) ?></h6>
          <p><?= htmlspecialchars($item['desc']) ?></p>
          <a href="<?= htmlspecialchars($item['btnLink']) ?>" class="btn btn-outline-danger rounded-pill mt-3"><?= htmlspecialchars($item['btnText']) ?></a>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<?php include __DIR__ . '/../layout/footer.php'; ?>
