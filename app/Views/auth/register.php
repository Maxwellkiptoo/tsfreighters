<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Generate CSRF token
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

// Simple math captcha
$num1 = rand(1, 9);
$num2 = rand(1, 9);
$_SESSION['math_answer'] = $num1 + $num2;
?>

<?php include __DIR__ . '/../layout/header.php'; ?>

<section class="py-5 bg-light min-vh-100 d-flex align-items-center">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-6 col-md-8" data-aos="fade-up">
        <div class="card shadow-lg border-0 rounded-4 overflow-hidden">
          <div class="card-body p-4 p-md-5 bg-white">
            <div class="text-center mb-4">
              <i class="fas fa-user-plus fa-3x text-warning mb-2"></i>
              <h3 class="fw-bold">Create Your Account</h3>
              <p class="text-muted small">Sign up to access your shipments and support.</p>
            </div>

            <form id="registerForm" novalidate>
              <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($_SESSION['csrf_token']); ?>">

              <div class="mb-3">
                <label for="full_name" class="form-label fw-semibold">Full Name</label>
                <input type="text" id="full_name" name="full_name" class="form-control form-control-lg rounded-pill px-4" placeholder="Full name" required>
              </div>

              <div class="mb-3">
                <label for="email" class="form-label fw-semibold">Email Address</label>
                <input type="email" id="email" name="email" class="form-control form-control-lg rounded-pill px-4" placeholder="you@example.com" required>
              </div>

              <div class="mb-3">
                <label for="phone" class="form-label fw-semibold">Phone Number</label>
                <input type="text" id="phone" name="phone" class="form-control form-control-lg rounded-pill px-4" placeholder="+2547XXXXXXXX">
              </div>

              <div class="mb-3">
                <label for="password" class="form-label fw-semibold">Password</label>
                <div class="input-group">
                  <input type="password" id="password" name="password" class="form-control form-control-lg rounded-start-pill px-4" placeholder="********" minlength="8" required>
                  <button class="btn btn-outline-secondary rounded-end-pill" type="button" id="togglePassword" aria-label="Show password">
                    <i class="fas fa-eye"></i>
                  </button>
                </div>
              </div>

              <div class="mb-3">
                <label for="confirm" class="form-label fw-semibold">Confirm Password</label>
                <input type="password" id="confirm" name="confirm" class="form-control form-control-lg rounded-pill px-4" placeholder="********" required>
              </div>

              <!-- Math Captcha -->
              <div class="mb-3">
                <label for="captcha" class="form-label fw-semibold">
                  Prove you’re human: What is <strong><?php echo "$num1 + $num2"; ?></strong>?
                </label>
                <input type="number" id="captcha" name="captcha" class="form-control form-control-lg rounded-pill px-4" placeholder="Your answer" required>
              </div>

              <div class="d-grid">
                <button id="registerBtn" type="submit" class="btn btn-warning btn-lg rounded-pill shadow-sm">
                  <span id="btnText"><i class="fas fa-user-plus me-2"></i> Register</span>
                  <span id="btnSpinner" class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
                </button>
              </div>
            </form>

            <div id="registerAlert" class="alert mt-4 d-none" role="alert"></div>

            <div class="text-center mt-4">
              <p class="small text-muted mb-2">Already have an account?</p>
              <!-- ✅ Updated Login Link -->
              <a href="http://localhost/tsfreighters/public/index.php?controller=customer&action=login"
                 class="btn btn-outline-warning rounded-pill px-4 py-2">
                <i class="fas fa-sign-in-alt me-2"></i> Login
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<?php include __DIR__ . '/../layout/footer.php'; ?>

<!-- JS: AOS + Behavior -->
<link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
<script>
AOS.init({ once:true, duration:800 });

// Toggle password visibility
document.getElementById('togglePassword').addEventListener('click', function() {
  const input = document.getElementById('password');
  const icon = this.querySelector('i');
  if (input.type === 'password') {
    input.type = 'text';
    icon.classList.replace('fa-eye', 'fa-eye-slash');
  } else {
    input.type = 'password';
    icon.classList.replace('fa-eye-slash', 'fa-eye');
  }
});

// Handle registration form submission
document.getElementById('registerForm').addEventListener('submit', async function(e) {
  e.preventDefault();

  const form = this;
  const btn = document.getElementById('registerBtn');
  const btnText = document.getElementById('btnText');
  const btnSpinner = document.getElementById('btnSpinner');
  const alertBox = document.getElementById('registerAlert');

  btn.disabled = true;
  btnText.classList.add('d-none');
  btnSpinner.classList.remove('d-none');
  alertBox.classList.add('d-none');

  const fd = new FormData(form);

  try {
    const res = await fetch('http://localhost/tsfreighters/public/index.php?controller=customer&action=register_process', {
      method: 'POST',
      body: fd
    });
    const json = await res.json();

    if (json.status === 'success') {
      showAlert(json.message || 'Registration successful! Redirecting...', 'success');
      setTimeout(() => {
        window.location.href = 'http://localhost/tsfreighters/public/index.php?controller=customer&action=login';
      }, 1500);
    } else {
      showAlert(json.message || 'Registration failed.', 'danger');
    }
  } catch (err) {
    showAlert('Network error. Please try again later.', 'danger');
  } finally {
    btn.disabled = false;
    btnText.classList.remove('d-none');
    btnSpinner.classList.add('d-none');
  }

  function showAlert(message, type) {
    alertBox.className = `alert alert-${type} mt-3`;
    alertBox.textContent = message;
    alertBox.classList.remove('d-none');
  }
});
</script>
