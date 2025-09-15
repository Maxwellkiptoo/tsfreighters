<!-- Footer -->
<style>
    footer {
        background: var(--primary);
        color: var(--text-light);
        padding: 2rem 1.5rem 1rem;
        text-align: center;
    }

    .footer-container {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 2rem;
        max-width: 1100px;
        margin: 0 auto;
        text-align: left;
    }

    .footer-col h3 {
        margin-bottom: 1rem;
        color: var(--accent);
    }

    .footer-col p {
        font-size: 0.95rem;
        line-height: 1.5;
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

    /* Mobile responsiveness */
    @media (max-width: 768px) {
        .footer-container {
            text-align: center;
        }
    }
</style>

<footer>
    <div class="footer-container">
        <div class="footer-col">
            <h3>TS Freighters</h3>
            <p>Reliable logistics solutions for businesses and individuals. Delivering trust, speed, and security in every shipment.</p>
        </div>
        <div class="footer-col">
            <h3>Quick Links</h3>
            <ul>
                <li><a href="?controller=home&action=index">Home</a></li>
                <li><a href="?controller=services&action=index">Services</a></li>
                <li><a href="?controller=about&action=index">About Us</a></li>
                <li><a href="?controller=contact&action=index">Contact</a></li>
                <li><a href="?controller=tracking&action=index">Track Shipment</a></li>
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
