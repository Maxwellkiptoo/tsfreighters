<!-- Header -->
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
        transition: color 0.3s ease;
    }

    nav a:hover {
        color: var(--accent);
    }

    /* Mobile responsiveness */
    @media (max-width: 768px) {
        header {
            flex-direction: column;
            text-align: center;
        }
        nav {
            margin-top: 0.8rem;
        }
        nav a {
            margin: 0 0.8rem;
        }
    }
</style>

<header>
    <h1>TS Freighters</h1>
    <nav>
        <a href="../../../public/index.php">Home</a>
        <a href="/tracking/index">Track</a>
        <a href="/services/index">Services</a>
        <a href="/about/index">About Us</a>
        <a href="/contact/index">Contact</a>
    </nav>
</header>

