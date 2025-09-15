<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>About Us | TS Freighters</title>
  <style>
    :root {
      --primary: #1C3144;   /* Dark Blue */
      --secondary: #2ECC71; /* Accent for gradient */
      --light-bg: #F5F7FA; /* Off-White / Light Gray */
      --accent: #2ECC71;   /* Vibrant Teal */
      --warning: #F39C12;  /* Warning Yellow */
      --danger: #E74C3C;   /* Alert Red */
      --success: #27AE60;  /* Success Green */
      --text-dark: #333;
      --text-light: #fff;
    }

    body {
      margin: 0;
      font-family: 'Segoe UI', Tahoma, sans-serif;
      background: var(--light-bg);
      color: var(--text-dark);
      display: flex;
      flex-direction: column;
      min-height: 100vh;
      line-height: 1.6;
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

    /* About Section */
    .about-section {
      max-width: 1100px;
      margin: 60px auto;
      padding: 0 20px;
    }

    .about-section h2 {
      text-align: center;
      font-size: 2.2rem;
      color: var(--primary);
      margin-bottom: 30px;
      position: relative;
    }

    .about-section h2::after {
      content: '';
      width: 80px;
      height: 4px;
      background: var(--accent);
      display: block;
      margin: 10px auto 0;
      border-radius: 2px;
    }

    .about-content {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 40px;
      align-items: center;
    }

    .about-text {
      background: #fff;
      padding: 30px;
      border-radius: 16px;
      box-shadow: 0 6px 18px rgba(0,0,0,0.08);
    }

    .about-text h3 {
      color: var(--accent);
      margin-bottom: 15px;
    }

    .about-text p {
      color: #555;
      margin-bottom: 15px;
    }

    .about-image img {
      width: 100%;
      border-radius: 16px;
      box-shadow: 0 6px 18px rgba(0,0,0,0.1);
    }

    /* Values Section */
    .values-section {
      margin: 60px auto;
      text-align: center;
      padding: 0 20px;
    }

    .values-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
      gap: 25px;
      margin-top: 40px;
    }

    .value-card {
      background: linear-gradient(135deg, #ffffff, var(--light-bg));
      border: 1px solid #e1e5ea;
      padding: 25px 20px;
      border-radius: 16px;
      box-shadow: 0 6px 18px rgba(0,0,0,0.08);
      transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .value-card:hover {
      transform: translateY(-8px);
      box-shadow: 0 12px 24px rgba(0,0,0,0.15);
      background: linear-gradient(135deg, var(--primary), var(--accent));
      color: #fff;
    }

    .value-card h4 {
      margin-bottom: 10px;
      color: var(--primary);
    }

    .value-card p {
      color: #555;
    }

    .value-card:hover h4,
    .value-card:hover p {
      color: #fff;
    }

    /* Footer */
    footer {
      background: linear-gradient(to right, var(--primary), var(--secondary));
      color: #fff;
      text-align: center;
      padding: 20px;
      margin-top: auto;
    }

    @media (max-width: 768px) {
      .about-content {
        grid-template-columns: 1fr;
      }
    }
  </style>
</head>
<body>

 <?php include __DIR__ . '/../layout/header.php'; ?>

<section class="about-section">
  <h2>Who We Are</h2>
  <div class="about-content">
    <div class="about-text">
      <h3>Reliable Logistics Partner</h3>
      <p>At <strong>TS Freighters</strong>, we pride ourselves on providing efficient, reliable, and customer-focused logistics solutions. From cargo shipping to last-mile delivery, we are committed to moving goods quickly and securely across regions.</p>
      <p>With a dedicated team and cutting-edge technology, we ensure that our clients—whether individuals or businesses—experience seamless shipping every step of the way.</p>
    </div>
    <div class="about-image">
      <img src="https://images.unsplash.com/photo-1544025162-d76694265947?auto=format&fit=crop&w=800&q=80" alt="Logistics Team">
    </div>
  </div>
</section>

<section class="values-section">
  <h2>Our Core Values</h2>
  <div class="values-grid">
    <div class="value-card">
      <h4>Trust</h4>
      <p>We believe in transparency and building long-lasting relationships with our clients.</p>
    </div>
    <div class="value-card">
      <h4>Efficiency</h4>
      <p>We optimize every step to deliver goods faster, safer, and more reliably.</p>
    </div>
    <div class="value-card">
      <h4>Innovation</h4>
      <p>We leverage modern technology to bring smarter logistics solutions to your doorstep.</p>
    </div>
    <div class="value-card">
      <h4>Customer Focus</h4>
      <p>Your satisfaction is our priority—we tailor our services to meet your unique needs.</p>
    </div>
  </div>
</section>

<?php include __DIR__ . '/../layout/footer.php'; ?>


</body>
</html>
