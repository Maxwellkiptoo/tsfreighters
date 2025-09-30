<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
// generate CSRF token
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}
?>
<?php include __DIR__ . '/../layout/header.php'; ?>

<section class="login-hero d-flex align-items-center justify-content-center text-white position-relative" 
         style="background: url('public/assets/images/truck2.jpg') center/cover no-repeat; height: 50vh;">
  <div class="overlay position-absolute w-100 h-100" style="background: rgba(0,0,0,0.55);"></div>
  <div class="position-relative text-center z-2">
    <h1 class="fw-bold display-5">Welcome to TS Freighters Portal</h1>
    <p class="lead mb-0">Access Orders, Inventory, Shipments, Warehouses & Reports.</p>
  </div>
</section>

<section class="py-5 bg-light">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-6" data-aos="fade-up">
        <div class="card shadow border-0 rounded-4">
          <div class="card-body p-4 p-md-5">
            <h3 class="fw-bold text-center mb-3">Sign In</h3>
            <p class="text-muted text-center mb-4">Use your email and tracking number / password to sign in.</p>

            <form id="loginForm" novalidate>
              <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($_SESSION['csrf_token']); ?>">
              
              <div class="mb-3">
                <label for="email" class="form-label">Email address</label>
                <input type="email" id="email" name="email" class="form-control form-control-lg" required>
              </div>

              <div class="mb-3 position-relative">
                <label for="password" class="form-label">Password / Tracking Number</label>
                <div class="input-group">
                  <input type="password" id="password" name="password" class="form-control form-control-lg" required>
                  <button class="btn btn-outline-secondary" type="button" id="togglePassword" aria-label="Show password">
                    <i class="fas fa-eye"></i>
                  </button>
                </div>
              </div>

              <div class="d-flex justify-content-between align-items-center mb-3">
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" id="remember" name="remember">
                  <label class="form-check-label" for="remember">Remember me</label>
                </div>
                <a href="forgot_password.php" class="small">Forgot password?</a>
              </div>

              <div class="d-grid">
                <button id="loginBtn" type="submit" class="btn btn-warning btn-lg rounded-pill">
                  <span id="btnText"><i class="fas fa-sign-in-alt me-2"></i> Login</span>
                  <span id="btnSpinner" class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
                </button>
              </div>
            </form>

            <div id="loginAlert" class="alert mt-4 d-none" role="alert"></div>

            <hr class="my-4">

            <div class="text-center small text-muted">
              By logging in you agree to our <a href="/terms.php">Terms</a> and <a href="/privacy.php">Privacy Policy</a>.
            </div>
          </div>
        </div>

        <!-- Info cards showing modules (for motivation) -->
        <div class="mt-4 d-none d-md-flex gap-3">
          <div class="p-3 bg-white shadow-sm rounded flex-fill text-center">
            <i class="fas fa-box-open fa-2x mb-2 text-primary"></i>
            <div class="fw-bold">Orders</div>
            <small class="text-muted">Create / Track / Update</small>
          </div>
          <div class="p-3 bg-white shadow-sm rounded flex-fill text-center">
            <i class="fas fa-warehouse fa-2x mb-2 text-warning"></i>
            <div class="fw-bold">Inventory</div>
            <small class="text-muted">Stock & Low-stock Alerts</small>
          </div>
          <div class="p-3 bg-white shadow-sm rounded flex-fill text-center">
            <i class="fas fa-route fa-2x mb-2 text-success"></i>
            <div class="fw-bold">Route Optimizer</div>
            <small class="text-muted">ETA & Cost-efficient Routes</small>
          </div>
        </div>

      </div>
    </div>
  </div>
</section>

<?php include __DIR__ . '/../layout/footer.php'; ?>

<!-- JS: AOS + UI behaviour -->
<link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
<script>
AOS.init({ once:true, duration:800 });

// toggle password visibility
document.getElementById('togglePassword').addEventListener('click', function() {
  const input = document.getElementById('password');
  const icon = this.querySelector('i');
  if (input.type === 'password') { input.type = 'text'; icon.classList.replace('fa-eye','fa-eye-slash'); }
  else { input.type = 'password'; icon.classList.replace('fa-eye-slash','fa-eye'); }
});

// handle submit with UX improvements and client validation
document.getElementById('loginForm').addEventListener('submit', async function(e){
  e.preventDefault();
  const form = this;
  const btn = document.getElementById('loginBtn');
  const btnText = document.getElementById('btnText');
  const btnSpinner = document.getElementById('btnSpinner');
  const alertBox = document.getElementById('loginAlert');

  // minimal client validation
  const email = form.email.value.trim();
  const password = form.password.value.trim();
  if (!email || !password) {
    alertBox.className = 'alert alert-danger mt-3';
    alertBox.textContent = 'Please enter both email and password.';
    alertBox.classList.remove('d-none');
    return;
  }

  // disable UI
  btn.disabled = true;
  btnText.classList.add('d-none');
  btnSpinner.classList.remove('d-none');
  alertBox.classList.add('d-none');

  const fd = new FormData(form);

  try {
    const res = await fetch('app/controllers/login_process.php', {
      method: 'POST',
      body: fd
    });
    const json = await res.json();

    alertBox.classList.remove('d-none');
    if (json.status === 'success') {
      alertBox.className = 'alert alert-success mt-3';
      alertBox.textContent = json.message || 'Login successful. Redirecting...';

      // small pause for UX then redirect based on role returned
      setTimeout(() => {
        const redirect = json.redirect || (json.role === 'admin' ? '/admin/dashboard.php' : '/dashboard.php');
        window.location.href = redirect;
      }, 900);
    } else if (json.status === 'mfa_required') {
      // handle second-factor if implemented
      alertBox.className = 'alert alert-info mt-3';
      alertBox.innerHTML = json.message || '2FA required. Please complete verification.';
      // optionally redirect to 2FA flow
    } else {
      alertBox.className = 'alert alert-danger mt-3';
      alertBox.textContent = json.message || 'Authentication failed.';
    }
  } catch (err) {
    alertBox.className = 'alert alert-danger mt-3';
    alertBox.textContent = 'Network error. Please try again later.';
  } finally {
    btn.disabled = false;
    btnText.classList.remove('d-none');
    btnSpinner.classList.add('d-none');
  }
});
</script>
