<?php
include __DIR__ . '/../layout/header.php';
session_start();
?>

<!-- Hero Section -->
<section class="contact-hero text-center text-white position-relative d-flex align-items-center justify-content-center" 
  data-aos="fade-down" 
  style="
    background: url('public/assets/images/truck2.jpg') center/cover no-repeat;
    height: 60vh;
    margin-top: 0;
    padding-top: 120px !important;
  ">
  <div class="overlay position-absolute top-0 start-0 w-100 h-100" style="background: rgba(0, 0, 0, 0.6);"></div>
  <div class="container position-relative z-2">
    <h1 class="fw-bold display-6 mb-3">Get in Touch with TS Freighters</h1>
    <p class="lead mb-0">Let’s move your business forward with fast, secure, and reliable logistics solutions.</p>
  </div>
</section>

<!-- Contact Information + Form -->
<section class="contact-section py-5 bg-light">
  <div class="container">
    <div class="row g-5">
      
      <!-- Contact Info -->
      <div class="col-lg-5" data-aos="fade-right">
        <h2 class="fw-bold mb-4">Reach Us</h2>
        <p class="mb-4 text-muted">Have questions about shipping, warehousing, or delivery? Our support team is available 24/7 to assist you.</p>
        
        <div class="d-flex align-items-start mb-3">
          <i class="fas fa-map-marker-alt fa-lg text-warning me-3"></i>
          <div>
            <h6 class="fw-bold mb-1">Office Address</h6>
            <p class="mb-0">TS Freighters HQ, Nairobi, Kenya</p>
          </div>
        </div>

        <div class="d-flex align-items-start mb-3">
          <i class="fas fa-phone-alt fa-lg text-warning me-3"></i>
          <div>
            <h6 class="fw-bold mb-1">Phone</h6>
            <p class="mb-0">+254 700 123 456</p>
          </div>
        </div>

        <div class="d-flex align-items-start mb-4">
          <i class="fas fa-envelope fa-lg text-warning me-3"></i>
          <div>
            <h6 class="fw-bold mb-1">Email</h6>
            <p class="mb-0">info@tsfreighters.com</p>
          </div>
        </div>

        <div class="social-icons mt-4">
          <h6 class="fw-bold mb-2">Connect With Us</h6>
          <a href="#" class="text-dark me-3"><i class="fab fa-facebook fa-lg"></i></a>
          <a href="#" class="text-dark me-3"><i class="fab fa-twitter fa-lg"></i></a>
          <a href="#" class="text-dark me-3"><i class="fab fa-linkedin fa-lg"></i></a>
          <a href="#" class="text-dark"><i class="fab fa-instagram fa-lg"></i></a>
        </div>

        <!-- Map -->
        <div class="map rounded overflow-hidden shadow-sm mt-4">
          <iframe src="https://www.google.com/maps?q=Nairobi,Kenya&output=embed" 
            width="100%" height="250" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
        </div>
      </div>

      <!-- Contact Form -->
      <div class="col-lg-7" data-aos="fade-left">
        <div class="card border-0 shadow-sm rounded-4">
          <div class="card-body p-4">
            <h4 class="fw-bold mb-4">Send Us a Message</h4>
            <form id="contactForm">
              <div class="row g-3">
                <div class="col-md-6">
                  <input type="text" id="name" name="name" class="form-control form-control-lg" placeholder="Your Name" required>
                </div>
                <div class="col-md-6">
                  <input type="email" id="email" name="email" class="form-control form-control-lg" placeholder="Your Email" required>
                </div>
                <div class="col-12">
                  <input type="text" id="subject" name="subject" class="form-control form-control-lg" placeholder="Subject" required>
                </div>
                <div class="col-12">
                  <textarea id="message" name="message" rows="5" class="form-control form-control-lg" placeholder="Your Message" required></textarea>
                </div>

                <!-- Math CAPTCHA -->
                <?php 
                  $num1 = rand(1,9);
                  $num2 = rand(1,9);
                  $sum = $num1 + $num2;
                  $_SESSION['captcha_sum'] = $sum;
                ?>
                <div class="col-md-6">
                  <label for="captcha" class="form-label">What is <?php echo $num1 . " + " . $num2; ?> ?</label>
                  <input type="number" id="captcha" name="captcha" class="form-control form-control-lg" required>
                </div>

                <div class="col-12 text-end">
                  <button type="submit" id="submitBtn" class="btn btn-warning btn-lg rounded-pill px-4 shadow-glow">
                    <span id="btnText"><i class="fas fa-paper-plane me-2"></i>Send Message</span>
                    <span id="btnSpinner" class="spinner-border spinner-border-sm d-none"></span>
                  </button>
                </div>
              </div>
            </form>
            <div id="formAlert" class="alert mt-3 d-none"></div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- FAQ Section -->
<section class="faq-section py-5 bg-white">
  <div class="container" data-aos="fade-up">
    <h2 class="fw-bold text-center mb-5">Frequently Asked Questions</h2>
    <div class="accordion accordion-flush" id="faqAccordion">
      <div class="accordion-item">
        <h2 class="accordion-header"><button class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#faq1">How do I track my shipment?</button></h2>
        <div id="faq1" class="accordion-collapse collapse"><div class="accordion-body">Track your shipment in real-time using your tracking number on our “Track Order” page.</div></div>
      </div>
      <div class="accordion-item">
        <h2 class="accordion-header"><button class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#faq2">Do you handle international shipping?</button></h2>
        <div id="faq2" class="accordion-collapse collapse"><div class="accordion-body">Yes, we provide international freight forwarding, customs clearance, and door-to-door delivery services.</div></div>
      </div>
      <div class="accordion-item">
        <h2 class="accordion-header"><button class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#faq3">What are your delivery timelines?</button></h2>
        <div id="faq3" class="accordion-collapse collapse"><div class="accordion-body">Same-day local, 1-3 days nationwide, and 5-10 days internationally.</div></div>
      </div>
      <div class="accordion-item">
        <h2 class="accordion-header"><button class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#faq4">Do you provide warehousing services?</button></h2>
        <div id="faq4" class="accordion-collapse collapse"><div class="accordion-body">Yes, we offer secure, temperature-controlled warehousing and inventory management.</div></div>
      </div>
      <div class="accordion-item">
        <h2 class="accordion-header"><button class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#faq5">What if my shipment is delayed or damaged?</button></h2>
        <div id="faq5" class="accordion-collapse collapse"><div class="accordion-body">Contact our 24/7 support to file a claim for a fast and transparent resolution.</div></div>
      </div>
    </div>
  </div>
</section>

<?php include __DIR__ . '/../layout/footer.php'; ?>

<!-- AOS + Contact Form JS -->
<link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
<script>
AOS.init({ once: true, duration: 1000, easing: 'ease-in-out' });

document.getElementById("contactForm").addEventListener("submit", async function(e) {
  e.preventDefault();
  const alertBox = document.getElementById("formAlert");
  const submitBtn = document.getElementById("submitBtn");
  const btnText = document.getElementById("btnText");
  const btnSpinner = document.getElementById("btnSpinner");

  // Show spinner and disable button
  alertBox.classList.add("d-none");
  submitBtn.disabled = true;
  btnText.classList.add("d-none");
  btnSpinner.classList.remove("d-none");

  const formData = new FormData(this);

  try {
    const response = await fetch("app/controllers/send_contact.php", {
      method: "POST",
      body: formData
    });
    const result = await response.json();
    alertBox.classList.remove("d-none");

    if (result.status === "success") {
      alertBox.className = "alert alert-success mt-3";
      alertBox.textContent = result.message;
      this.reset();
    } else {
      alertBox.className = "alert alert-danger mt-3";
      alertBox.textContent = result.message;
    }
  } catch (error) {
    alertBox.classList.remove("d-none");
    alertBox.className = "alert alert-danger mt-3";
    alertBox.textContent = "❌ Network or server error: " + error.message;
  } finally {
    // Reset button
    submitBtn.disabled = false;
    btnText.classList.remove("d-none");
    btnSpinner.classList.add("d-none");
  }
});
</script>
