<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>TS Freighters</title>
<link rel="icon" type="image/png" href="/tsfreighters/public/assets/images/favicon3.png">
<link rel="shortcut icon" href="/tsfreighters/public/assets/images/favicon3.png">
<link rel="apple-touch-icon" href="/tsfreighters/public/assets/images/favicon3.png">
<meta name="theme-color" content="blue">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
  <link href="/tsfreighters/assets/css/main.css" rel="stylesheet">
</head>
<body>
  <nav class="navbar navbar-expand-lg navbar-dark custom-navbar shadow sticky-top">
    <div class="container-fluid px-4">
      <!-- Brand -->
      <a class="navbar-brand fw-bold d-flex align-items-center" href="index.php">
        <img src="/tsfreighters/assets/images/logo.png" alt="TS Freighters" width="45" height="45" class="me-2 rounded-circle shadow-sm">
        <span class="brand-text">TS Freighters</span>
      </a>

      <!-- Mobile Toggle -->
      <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar" 
        aria-controls="mainNavbar" aria-expanded="false" aria-label="Toggle navigation">
        <i class="fas fa-bars fa-lg text-white"></i>
      </button>

      <!-- Navbar Content -->
      <div class="collapse navbar-collapse" id="mainNavbar">
        <!-- Menu Links -->
        <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active" href="index.php?controller=home&action=index">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="index.php?controller=customer&action=services">Services</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="index.php?controller=customer&action=about">About Us</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="index.php?controller=customer&action=contact">Contact</a>
          </li>
        </ul>

        <!-- Tracking Form -->
        <form class="d-flex my-2 my-lg-0 nav-form" action="index.php" method="get">
          <input type="hidden" name="controller" value="customer">
          <input type="hidden" name="action" value="tracking">
          <input class="form-control me-2 rounded-pill shadow-sm" type="text" name="tracking_number" placeholder="🔍 Track Shipment" required>
          <button class="btn btn-warning fw-bold text-dark rounded-pill px-4 shadow-sm" type="submit">Track</button>
        </form>

        <!-- Login & Signup -->
        <div class="d-flex ms-lg-3 mt-3 mt-lg-0">
          <a href="index.php?controller=customer&action=login" class="btn btn-outline-light rounded-pill me-2 px-4">Login</a>
          <a href="index.php?controller=customer&action=register" class="btn btn-warning text-dark fw-bold rounded-pill px-4">Sign Up</a>
        </div>
      </div>
    </div>
  </nav>

  <!-- Bootstrap JS (for toggle) -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
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