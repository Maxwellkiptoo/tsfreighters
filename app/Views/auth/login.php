<?php include __DIR__ . '/../layout/header.php'; ?>
<?php session_start(); ?>

<section class="login-hero d-flex align-items-center justify-content-center text-white position-relative" 
  style="background: url('public/assets/images/truck2.jpg') center/cover no-repeat; height: 50vh;">
  <div class="overlay position-absolute w-100 h-100" style="background: rgba(0,0,0,0.6);"></div>
  <div class="position-relative text-center">
    <h1 class="fw-bold display-5">Customer Login</h1>
    <p class="lead mb-0">Access your orders, track shipments, and manage your deliveries.</p>
  </div>
</section>

<section class="py-5 bg-light">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-6" data-aos="fade-up">
        <div class="card shadow border-0 rounded-4">
          <div class="card-body p-4 p-md-5">
            <h3 class="fw-bold text-center mb-4">Sign In to Your Account</h3>

            <form id="loginForm">
              <div class="mb-3">
                <label for="email" class="form-label fw-semibold">Email Address</label>
                <input type="email" class="form-control form-control-lg" id="email" name="email" placeholder="Enter your email" required>
              </div>

              <div class="mb-3 position-relative">
                <label for="password" class="form-label fw-semibold">Tracking Number (Password)</label>
                <div class="input-group">
                  <input type="password" class="form-control form-control-lg" id="password" name="password" placeholder="Enter tracking number" required>
                  <button class="btn btn-outline-secondary" type="button" id="togglePassword"><i class="fas fa-eye"></i></button>
                </div>
              </div>

              <button type="submit" id="loginBtn" class="btn btn-warning btn-lg w-100 rounded-pill shadow-glow">
                <span id="btnText"><i class="fas fa-sign-in-alt me-2"></i> Login</span>
                <span id="btnSpinner" class="spinner-border spinner-border-sm d-none"></span>
              </button>
            </form>

            <div id="loginAlert" class="alert mt-4 d-none"></div>

            <p class="text-center mt-4 mb-0 text-muted">
              Forgot your tracking number? <a href="track_order.php" class="text-warning fw-semibold">Track your order here</a>
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<?php include __DIR__ . '/../layout/footer.php'; ?>

<!-- AOS + JS -->
<link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
<script>
AOS.init({ once:true, duration:1000, easing:'ease-in-out' });

// Show/Hide Password
document.getElementById("togglePassword").addEventListener("click", function() {
  const input = document.getElementById("password");
  const icon = this.querySelector("i");
  if (input.type === "password") {
    input.type = "text";
    icon.classList.replace("fa-eye", "fa-eye-slash");
  } else {
    input.type = "password";
    icon.classList.replace("fa-eye-slash", "fa-eye");
  }
});

// Handle Login
document.getElementById("loginForm").addEventListener("submit", async function(e) {
  e.preventDefault();

  const loginBtn = document.getElementById("loginBtn");
  const btnText = document.getElementById("btnText");
  const btnSpinner = document.getElementById("btnSpinner");
  const alertBox = document.getElementById("loginAlert");

  loginBtn.disabled = true;
  btnText.classList.add("d-none");
  btnSpinner.classList.remove("d-none");
  alertBox.classList.add("d-none");

  const formData = new FormData(this);

  try {
    const response = await fetch("app/controllers/login_process.php", {
      method: "POST",
      body: formData
    });

    const result = await response.json();
    alertBox.classList.remove("d-none");

    if (result.status === "success") {
      alertBox.className = "alert alert-success";
      alertBox.innerHTML = "✅ " + result.message;
      setTimeout(() => {
        window.location.href = "order_status.php";
      }, 1500);
    } else {
      alertBox.className = "alert alert-danger";
      alertBox.innerHTML = "❌ " + result.message;
    }
  } catch (error) {
    alertBox.classList.remove("d-none");
    alertBox.className = "alert alert-danger";
    alertBox.innerHTML = "❌ Network error. Please try again.";
  } finally {
    loginBtn.disabled = false;
    btnText.classList.remove("d-none");
    btnSpinner.classList.add("d-none");
  }
});
</script>
