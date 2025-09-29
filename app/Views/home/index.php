<?php include __DIR__ . '/../layout/header.php'; ?>

<section id="heroCarousel" class="carousel slide carousel-fade" data-bs-ride="carousel" data-bs-interval="6000"> <!-- Indicators --> <div class="carousel-indicators"> 
  <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="0" class="active"></button> 
  <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="1"></button> <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="2"></button> 
</div> <div class="carousel-inner"> <?php $slides = [ [ "img" => "truck4.jpg", "title" => "Delivering Beyond Borders", "text" => "Fast, Secure & Reliable Logistics Across Kenya & The Globe" ], [ "img" => "truck2.jpg", "title" => "Your Cargo, Our Priority", "text" => "Tailored Express Freight Solutions Backed by Innovation" ], [ "img" => "truck3.jpg", "title" => "Global Reach, Local Touch", "text" => "Seamless International Shipping with Trusted Local Expertise" ] ]; $imageWebPath = 'public/assets/images/'; foreach ($slides as $i => $slide): ?>
   <div class="carousel-item hero-slide <?= $i === 0 ? 'active' : '' ?>"> <div class="hero-bg" style="background-image: url('<?= $imageWebPath . $slide['img'] ?>');"> <div class="hero-overlay"></div> </div> <div class="carousel-caption d-flex flex-column justify-content-center align-items-center text-center px-3"> <h1 class="fw-bold display-4 text-white text-shadow"><?= htmlspecialchars($slide['title']) ?></h1> <p class="lead text-light mb-4"><?= htmlspecialchars($slide['text']) ?></p>
    <!-- Tracking Form --> <form class="tracking-form d-flex justify-content-center w-100" action="index.php" method="get" style="max-width:600px;"> <input type="hidden" name="controller" value="customer"> <input type="hidden" name="action" value="tracking"> <input type="text" name="tracking_number" class="form-control rounded-pill me-2 shadow-sm" placeholder="Enter Tracking Number" required> <button class="btn btn-warning rounded-pill px-4 fw-bold text-dark shadow-sm" type="submit">Track</button> </form> 
  <small class="text-light mt-2">Trusted by 500+ businesses worldwide 🌍</small> </div> </div> <?php endforeach; ?> </div> <!-- Controls --> <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev"> <span class="carousel-control-prev-icon"></span> </button> <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next"> <span class="carousel-control-next-icon"></span> </button> </section>
<!-- Service Highlights -->
<section class="py-5 bg-light text-center">
  <div class="container">
    <div class="row g-4">
      <div class="col-md-4" data-aos="fade-up" data-aos-delay="100">
        <div class="p-4 bg-white shadow-lg rounded hover-card">
          <i class="fas fa-shipping-fast fa-3x text-primary mb-3"></i>
          <h5 class="fw-bold">Lightning-Fast Delivery</h5>
          <p>Express solutions across Kenya & East Africa — always on time.</p>
        </div>
      </div>
      <div class="col-md-4" data-aos="fade-up" data-aos-delay="200">
        <div class="p-4 bg-white shadow-lg rounded hover-card">
          <i class="fas fa-globe-africa fa-3x text-primary mb-3"></i>
          <h5 class="fw-bold">Global Reach</h5>
          <p>Seamless worldwide connections powered by local expertise.</p>
        </div>
      </div>
      <div class="col-md-4" data-aos="fade-up" data-aos-delay="300">
        <div class="p-4 bg-white shadow-lg rounded hover-card">
          <i class="fas fa-lock fa-3x text-primary mb-3"></i>
          <h5 class="fw-bold">Unmatched Security</h5>
          <p>Real-time tracking & safety-first logistics for your peace of mind.</p>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- About TS Freighters - Premium Split Layout -->
<section id="aboutPremium" class="py-5 bg-white">
  <div class="container">
    <div class="row align-items-center g-5">
      <div class="col-lg-6" data-aos="fade-right">
        <div class="about-image position-relative overflow-hidden rounded shadow-lg">
          <img src="public/assets/images/truck3.jpg" alt="About TS Freighters" class="img-fluid rounded">
          <div class="overlay position-absolute inset-0 bg-dark opacity-25"></div>
        </div>
      </div>
      <div class="col-lg-6" data-aos="fade-left">
        <h2 class="fw-bold display-5 mb-3">About TS Freighters</h2>
        <p class="lead mb-4">Based in Kenya, we redefine logistics with innovative freight, warehousing, and last-mile delivery solutions. Our mission is to empower businesses & individuals to connect with the world safely and efficiently.</p>
        <ul class="list-unstyled mb-4">
          <li class="mb-2"><i class="fas fa-check-circle text-primary me-2"></i>Fast & Reliable Delivery Across Kenya & Globally</li>
          <li class="mb-2"><i class="fas fa-check-circle text-primary me-2"></i>Real-Time Tracking for Peace of Mind</li>
          <li class="mb-2"><i class="fas fa-check-circle text-primary me-2"></i>Secure & Innovative Freight Solutions</li>
          <li class="mb-2"><i class="fas fa-check-circle text-primary me-2"></i>Dedicated Customer Support for Every Shipment</li>
        </ul>
        <a href="index.php?controller=customer&action=about" class="btn btn-warning btn-lg rounded-pill shadow-glow">Learn More</a>
      </div>
    </div>
  </div>
</section>

<!-- Our Core Services -->
<section class="py-5 bg-light text-center">
  <div class="container">
    <h2 class="fw-bold mb-5" data-aos="fade-up">Our Core Services</h2>
    <div class="row g-4">
      <?php
        $services = [
          ["icon"=>"fa-truck-loading","name"=>"Freight Forwarding"],
          ["icon"=>"fa-warehouse","name"=>"Warehousing"],
          ["icon"=>"fa-plane-departure","name"=>"Air Cargo"],
          ["icon"=>"fa-truck-moving","name"=>"Last-Mile Delivery"]
        ];
        foreach ($services as $index => $service):
      ?>
      <div class="col-md-3 col-6" data-aos="zoom-in" data-aos-delay="<?= ($index+1)*100 ?>">
        <div class="p-4 bg-white shadow-lg rounded hover-card">
          <i class="fas <?= $service['icon'] ?> fa-3x text-danger mb-3"></i>
          <h6 class="fw-bold"><?= $service['name'] ?></h6>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- Quick Access / Instant Solutions -->
<section class="py-5">
  <div class="container">
    <h2 class="fw-bold text-center mb-5" data-aos="fade-up">Instant Solutions</h2>
    <div class="row g-4 text-center">
      <?php
        $quick = [
          ["icon"=>"fa-box-open","title"=>"Ship Now","text"=>"Choose the best service for your shipment in minutes.","btn"=>"Start Shipping"],
          ["icon"=>"fa-calculator","title"=>"Get a Quote","text"=>"Instantly estimate & compare costs with transparency.","btn"=>"Calculate"],
          ["icon"=>"fa-briefcase","title"=>"For Business","text"=>"Ship regularly? Get a business account with exclusive benefits.","btn"=>"Apply Now"],
          ["icon"=>"fa-file-contract","title"=>"Tariff Updates","text"=>"Stay ahead with the latest tariff & compliance developments.","btn"=>"View Updates"]
        ];
        foreach ($quick as $index => $item):
      ?>
      <div class="col-md-3 col-6" data-aos="fade-up" data-aos-delay="<?= ($index+1)*100 ?>">
        <div class="p-4 bg-white shadow-lg rounded hover-card h-100">
          <i class="fas <?= $item['icon'] ?> fa-3x text-danger mb-3"></i>
          <h6 class="fw-bold"><?= $item['title'] ?></h6>
          <p><?= $item['text'] ?></p>
          <a href="#" class="btn btn-outline-danger btn-sm rounded-pill mt-2"><?= $item['btn'] ?></a>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<?php include __DIR__ . '/../layout/footer.php'; ?>

<!-- Scroll Effects & AOS -->
<link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
<script>
  AOS.init({ once:true, duration:1000, easing:'ease-in-out' });

  window.addEventListener("scroll", function () {
    const navbar = document.querySelector(".custom-navbar");
    if (window.scrollY > 50) navbar.classList.add("scrolled");
    else navbar.classList.remove("scrolled");
  });
</script>
