<?php
// app/Views/home/index.php
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>TS Freighters - Welcome</title>
<style>
    :root {
        --primary: #1e3a8a;   /* deep blue */
        --secondary: #2563eb; /* bright blue */
        --accent: #f59e0b;    /* amber */
        --light-bg: #f9fafb;
        --text-dark: #111827;
        --text-light: #ffffff;
    }

    body {
        margin: 0;
        font-family: 'Segoe UI', Tahoma, sans-serif;
        background: var(--light-bg);
        color: var(--text-dark);
        display: flex;
        flex-direction: column;
        min-height: 100vh;
    }

    /* Header */
    header {
        background: linear-gradient(to right, var(--primary), var(--secondary));
        color: var(--text-light);
        padding: 1rem 2rem;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    header h1 {
        margin: 0;
        font-size: 1.8rem;
    }

    nav a {
        color: var(--text-light);
        text-decoration: none;
        margin-left: 1.5rem;
        font-weight: 500;
    }

    nav a:hover {
        color: var(--accent);
    }

    /* Hero Section */
    .hero {
        position: relative;
        height: 60vh;
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
        color: var(--text-light);
        overflow: hidden;
    }

    /* Background slider layers */
    .hero-bg {
        position: absolute;
        inset: 0;
        background-size: cover;
        background-position: center;
        opacity: 0;
        transition: opacity 1.5s ease-in-out;
    }

    .hero-bg.active {
        opacity: 1;
    }

    .hero-overlay {
        position: absolute;
        inset: 0;
        background: rgba(0,0,0,0.45);
        z-index: 1;
    }

    .hero-content {
        position: relative;
        z-index: 2;
        max-width: 600px;
    }

    .hero-content h2 {
        font-size: 2.5rem;
        margin-bottom: 1rem;
    }

    .tracking-box {
        display: flex;
        background: var(--text-light);
        border-radius: 8px;
        overflow: hidden;
        margin-top: 1rem;
    }

    .tracking-box input {
        flex: 1;
        padding: 0.8rem;
        border: none;
        font-size: 1rem;
    }

    .tracking-box button {
        background: var(--accent);
        color: var(--text-dark);
        padding: 0 1.5rem;
        border: none;
        font-weight: bold;
        cursor: pointer;
    }

    .tracking-box button:hover {
        background: var(--secondary);
        color: var(--text-light);
    }

    /* Action Cards */
    .actions {
        display: flex;
        justify-content: center;
        gap: 2rem;
        margin: -50px auto 3rem;
        z-index: 3;
        position: relative;
    }

    .card {
        background: var(--text-light);
        padding: 1.5rem;
        border-radius: 10px;
        box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        text-align: center;
        flex: 1;
        max-width: 300px;
        transition: transform 0.3s ease;
    }

    .card:hover {
        transform: translateY(-5px);
    }

    .card h3 {
        margin-bottom: 0.5rem;
        color: var(--primary);
    }

    .card p {
        font-size: 0.95rem;
        color: #555;
    }

    /* Footer */
    footer {
        background: var(--primary);
        color: var(--text-light);
        padding: 1rem;
        text-align: center;
        font-size: 0.9rem;
        margin-top: auto;
    }
    /* Sections shared */
.container {
  max-width: 1200px;
  margin: 0 auto;
  padding: 3rem 1.5rem;
  text-align: center;
}

h2 {
  font-size: 2.2rem;
  margin-bottom: 2rem;
  color: var(--primary);
}

.services {
  padding: 60px 20px;
  background: #F5F7FA;
  text-align: center;
}

.services h2 {
  font-size: 2.5rem;
  color: #1C3144;
  margin-bottom: 40px;
  position: relative;
}

.service-cards {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
  gap: 25px;
  max-width: 1100px;
  margin: 0 auto;
}

.service-card {
  background: linear-gradient(135deg, #ffffff, #F5F7FA);
  border: 1px solid #e1e5ea;
  padding: 25px 20px;
  border-radius: 16px;
  box-shadow: 0 6px 18px rgba(0,0,0,0.08);
  transition: transform 0.3s ease, box-shadow 0.3s ease, background 0.4s ease, color 0.3s ease;
  cursor: pointer;
}

.service-card:hover {
  transform: translateY(-8px);
  box-shadow: 0 12px 24px rgba(0,0,0,0.15);
  background: linear-gradient(135deg, #1C3144, #2ECC71); /* dark blue → teal */
  color: #fff;
}

.service-card .icon {
  font-size: 3rem;
  margin-bottom: 15px;
  color: #2ECC71; /* Vibrant teal accent */
  transition: color 0.3s ease, transform 0.3s ease;
}

.service-card:hover .icon {
  color: #F5F7FA;
  transform: scale(1.2); /* subtle zoom effect */
}

.service-card h3 {
  font-size: 1.4rem;
  margin-bottom: 10px;
  color: #1C3144;
  transition: color 0.3s ease;
}

.service-card:hover h3 {
  color: #fff;
}

.service-card p {
  font-size: 1rem;
  color: #555;
  line-height: 1.5;
  transition: color 0.3s ease;
}

.service-card:hover p {
  color: #f5f7fa;
}


/* Solutions */
.solutions {
  background: linear-gradient(to right, #F5F7FA, #ffffff);
}
.solutions-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
  gap: 1.5rem;
}
.solution-card {
  background: #fff;
  border: 1px solid #eaeaea;
  border-radius: 12px;
  padding: 2rem;
  transition: all 0.3s ease;
}
.solution-card:hover {
  border-color: var(--secondary);
  transform: translateY(-6px);
  box-shadow: 0 6px 16px rgba(0,0,0,0.1);
}
.solution-card h3 {
  margin-bottom: 0.5rem;
  color: var(--secondary);
}

/* Footer */
.footer {
  background: var(--primary);
  color: #f5f5f5;
  padding: 3rem 1.5rem 1rem;
}
.footer-container {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(250px,1fr));
  gap: 2rem;
}
.footer-col h3 {
  margin-bottom: 1rem;
  color: var(--accent);
}
.footer-col ul {
  list-style: none;
  padding: 0;
  margin: 0;
}
.footer-col ul li {
  margin-bottom: 0.5rem;
}
.footer-col ul li a {
  color: #ddd;
  text-decoration: none;
  transition: color 0.3s ease;
}
.footer-col ul li a:hover {
  color: var(--accent);
}
.footer-bottom {
  text-align: center;
  margin-top: 2rem;
  font-size: 0.85rem;
  color: #bbb;
}
/* ===================== Responsive Design ===================== */

/* Tablets & small laptops (≤ 992px) */
@media (max-width: 992px) {
  header {
    flex-direction: column;
    text-align: center;
  }

  nav {
    margin-top: 0.5rem;
  }

  .hero {
    height: 50vh;
  }

  .hero-content h2 {
    font-size: 2rem;
  }

  .tracking-box {
    flex-direction: column;
  }

  .tracking-box input {
    border-bottom: 1px solid #ddd;
  }

  .tracking-box button {
    width: 100%;
    padding: 1rem;
  }

  .actions {
    flex-direction: column;
    gap: 1rem;
    margin-top: -20px;
  }
}

/* Mobile phones (≤ 600px) */
@media (max-width: 600px) {
  header {
    padding: 1rem;
  }

  header h1 {
    font-size: 1.4rem;
  }

  nav a {
    display: inline-block;
    margin: 0.3rem;
    font-size: 0.9rem;
  }

  .hero {
    height: 40vh;
    padding: 0 1rem;
  }

  .hero-content h2 {
    font-size: 1.6rem;
  }

  .tracking-box {
    flex-direction: column;
  }

  .tracking-box input {
    font-size: 0.9rem;
    padding: 0.6rem;
  }

  .tracking-box button {
    padding: 0.7rem;
    font-size: 0.9rem;
  }

  .card {
    max-width: 100%;
  }

  .service-cards,
  .solutions-grid {
    grid-template-columns: 1fr; /* stack all */
  }

  .service-card h3 {
    font-size: 1.2rem;
  }

  .service-card p {
    font-size: 0.9rem;
  }

  footer {
    text-align: center;
  }

  .footer-container {
    grid-template-columns: 1fr; /* stack footer cols */
  }
}


</style>
</head>
<body>

<header>
    <h1>TS Freighters</h1>
    <nav>
        <a href="?controller=home&action=index">Home</a>
        <a href="#">Track</a>
        <a href="#">Services</a>
        <a href="#">Contact</a>
        <a href="?controller=about&action=index">About Us</a>
    </nav>
</header>

<section class="hero">
    <!-- Background slides -->
    <div class="hero-bg active" style="background-image: url('../public/assets/images/truck 4.png');"></div>
    <div class="hero-bg" style="background-image: url('../public/assets/images/truck 2.png');"></div>
    <div class="hero-bg" style="background-image: url('../public/assets/images/truck 3.png');"></div>
    <div class="hero-bg" style="background-image: url('../public/assets/images/truck 5.png');"></div>

    <div class="hero-overlay"></div>
    <div class="hero-content">
        <h2>Track Your Shipment</h2>
        <form class="tracking-box" action="?controller=tracking&action=search" method="get">
            <input type="text" name="tracking_number" placeholder="Enter your tracking number">
            <button type="submit">Track</button>
        </form>
    </div>
</section>

<section class="actions">
    <div class="card">
        <h3>Ship Now</h3>
        <p>Book your shipment quickly and easily with our secure online system.</p>
    </div>
    <div class="card">
        <h3>Get a Quote</h3>
        <p>Estimate your shipping cost instantly and compare our competitive rates.</p>
    </div>
    <div class="card">
        <h3>Open an Account</h3>
        <p>Enjoy discounts and faster service by registering your business with us.</p>
    </div>
</section> <!-- ✅ properly close actions here -->
<!-- Our Services Section -->
<section class="services">
  <h2>Our Services</h2>
  <div class="service-cards">
    <!-- Cargo Shipping -->
    <div class="service-card">
      <div class="icon">🚚</div>
      <h3>Cargo Shipping</h3>
      <p>Reliable cargo shipping solutions designed for bulk freight across local and international routes.</p>
    </div>

    <!-- Express & Courier Services -->
    <div class="service-card">
      <div class="icon">⚡</div>
      <h3>Express & Courier</h3>
      <p>Fast and secure delivery of packages with real-time tracking for urgent shipments.</p>
    </div>

    <!-- Last-Mile Delivery -->
    <div class="service-card">
      <div class="icon">📦</div>
      <h3>Last-Mile Delivery</h3>
      <p>Efficient last-mile solutions to ensure timely deliveries to your customers’ doorsteps.</p>
    </div>

    <!-- Retailer or Volume Shipping -->
    <div class="service-card">
      <div class="icon">🏬</div>
      <h3>Retailer / Volume Shipping</h3>
      <p>Scalable solutions for retailers and wholesalers to manage large shipment volumes effectively.</p>
    </div>

    <!-- Document & Parcel Shipping -->
    <div class="service-card">
      <div class="icon">📄</div>
      <h3>Document & Parcel</h3>
      <p>Secure and affordable shipping for sensitive documents and small parcels.</p>
    </div>
  </div>
</section>


<!-- Explore Our Solutions -->
<section id="solutions" class="solutions">
  <div class="container">
    <h2>Explore Our Solutions</h2>
    <div class="solutions-grid">
      <div class="solution-card">
        <h3>Real-Time Tracking</h3>
        <p>Monitor your shipments with accurate live updates.</p>
      </div>
      <div class="solution-card">
        <h3>Route Optimization</h3>
        <p>Efficient routes to save time and reduce delivery costs.</p>
      </div>
      <div class="solution-card">
        <h3>Warehouse Solutions</h3>
        <p>Secure storage and smart inventory management.</p>
      </div>
    </div>
  </div>
</section>

<!-- Quick Links -->
<footer class="footer">
  <div class="footer-container">
    <div class="footer-col">
      <h3>TS Freighters</h3>
      <p>Reliable logistics solutions for businesses and individuals.</p>
    </div>
    <div class="footer-col">
      <h3>Quick Links</h3>
      <ul>
        <li><a href="#">Home</a></li>
        <li><a href="#services">Services</a></li>
        <li><a href="#solutions">Solutions</a></li>
        <li><a href="#">About Us</a></li>
        <li><a href="#">Contact</a></li>
      </ul>
    </div>
    <div class="footer-col">
      <h3>Get in Touch</h3>
      <p>Email: support@tsfreighters.com</p>
      <p>Phone: +254 700 123 456</p>
    </div>
  </div>
  <div class="footer-bottom">
    &copy; 2025 TS Freighters. All rights reserved.
  </div>
</footer>
<script>
    const slides = document.querySelectorAll('.hero-bg');
    let current = 0;

    setInterval(() => {
        slides[current].classList.remove('active');
        current = (current + 1) % slides.length;
        slides[current].classList.add('active');
    }, 5000); // 5 seconds per slide
</script>

</body>
</html>
