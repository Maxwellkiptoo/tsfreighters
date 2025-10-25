<?php
// Log file path
$log_file = __DIR__ . '/error_log.txt';

// Handle "Clear Log" request if confirmed
if (isset($_GET['clear_log'])) {
    if ($_GET['clear_log'] === 'confirm') {
        file_put_contents($log_file, ""); // Clear log
        $cleared = true;
    }
}

// Ensure the file exists
if (!file_exists($log_file)) {
    file_put_contents($log_file, "=== Error Log Initialized ===\n");
}

// Log the 404 error
$requested_url = $_SERVER['REQUEST_URI'];
$timestamp = date("Y-m-d H:i:s");
$error_message = "[$timestamp] 404 Error: Page not found. Requested URL: $requested_url\n";

// Read existing log
$existing_logs = file($log_file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

// Keep only the last 4 (so after adding new one it becomes 5)
if (count($existing_logs) >= 5) {
    $existing_logs = array_slice($existing_logs, -4);
}

// Add the new entry
$existing_logs[] = trim($error_message);
file_put_contents($log_file, implode("\n", $existing_logs) . "\n");

// Send 404 header
http_response_code(404);

// HTML Output
echo <<<HTML
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>404 - Page Not Found</title>
    <meta http-equiv="refresh" content="5; url=/tsfreighters/public/index.php">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            color: #333;
            text-align: center;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 700px;
            margin: 100px auto;
            padding: 40px 30px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            position: relative;
            overflow: hidden;
        }

        .runner {
            position: absolute;
            bottom: 20px;
            right: -100px;
            width: 100px;
            animation: runInside 4s ease-in-out forwards;
        }

        .runner img {
            width: 100%;
            animation: fadeOut 4s ease-out forwards;
        }

        @keyframes runInside {
            0% { right: -100px; }
            90% { right: 60%; }
            100% { right: 60%; opacity: 0; }
        }

        @keyframes fadeOut {
            0% { opacity: 1; }
            90% { opacity: 1; }
            100% { opacity: 0; }
        }

        h1 {
            font-size: 58px;
            color: #e74c3c;
            margin-bottom: 10px;
        }

        p {
            font-size: 18px;
            color: #555;
            margin: 10px 0;
        }

        .button {
            margin-top: 20px;
            padding: 12px 24px;
            font-size: 16px;
            background-color: #1abc9c;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            display: inline-block;
        }

        .button:hover {
            background-color: #16a085;
        }

        .small {
            font-size: 14px;
            color: #888;
            margin-top: 20px;
        }
    </style>
    <script>
        setTimeout(function () {
            window.location.replace('/tsfreighters/public/index.php');
        }, 5000);

        function confirmClear() {
            if (confirm("Are you sure you want to clear the error log?")) {
                window.location.href = "?clear_log=confirm";
            }
        }
    </script>
</head>
<body>
    <div class="container">
        <h1>404 - Page Not Found</h1>
        <p>Oops! This page took off running and got lost...</p>
        <div class="runner">
           <img src="https://media.giphy.com/media/3oEjI6SIIHBdRxXI40/giphy.gif" alt="Running GIF">
        </div>
        <p>Redirecting to homepage shortly.</p>
        <a href="/tsfreighters/public/index.php" class="button">Go to Homepage</a>
        <br>
        <button class="button" style="background-color:#e74c3c;" onclick="confirmClear()">Clear Error Log</button>
        <p class="small">You’ll be redirected automatically in 5 seconds.</p>
HTML;

if (isset($cleared)) {
    echo "<p style='color:green;'>✅ Error log cleared successfully!</p>";
}

echo <<<HTML
    </div>
</body>
</html>
HTML;
exit;
?>
