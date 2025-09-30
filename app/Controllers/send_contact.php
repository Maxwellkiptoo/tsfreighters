<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

header('Content-Type: application/json');

error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once __DIR__ . '/../../private/vendor/autoload.php';

// ✅ Allow only POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method.']);
    exit;
}

// ✅ Sanitize inputs
function clean_input($data) {
    return htmlspecialchars(trim($data), ENT_QUOTES, 'UTF-8');
}

$name = clean_input($_POST['name'] ?? '');
$email = clean_input($_POST['email'] ?? '');
$subject = clean_input($_POST['subject'] ?? '');
$message = clean_input($_POST['message'] ?? '');

// ✅ Validate
if (empty($name) || empty($email) || empty($subject) || empty($message)) {
    echo json_encode(['status' => 'error', 'message' => '⚠️ All fields are required.']);
    exit;
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo json_encode(['status' => 'error', 'message' => '⚠️ Invalid email address.']);
    exit;
}

// ✅ Gmail Credentials
$gmail_user = 'nexbridge001@gmail.com';
$gmail_pass = 'vdqvpnlkfesoyqfs';

try {
    // ✅ STEP 1: Send Message to Company
    $mail = new PHPMailer(true);
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = $gmail_user;
    $mail->Password   = $gmail_pass;
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port       = 587;

    $mail->setFrom($gmail_user, 'TS Freighters');
    $mail->addReplyTo($email, $name);
    $mail->addAddress($gmail_user, 'TS Freighters');

    $mail->isHTML(true);
    $mail->Subject = "📩 New Contact Form Submission: {$subject}";
    $mail->Body = "
        <div style='font-family: Arial, sans-serif;'>
            <h3 style='color:#f0ad4e;'>New Contact Message</h3>
            <p><b>Name:</b> {$name}</p>
            <p><b>Email:</b> {$email}</p>
            <p><b>Subject:</b> {$subject}</p>
            <p><b>Message:</b><br>" . nl2br($message) . "</p>
            <hr>
            <p style='font-size:12px;color:#999;'>Sent from TS Freighters Contact Page</p>
        </div>
    ";

    $mail->send();

    // ✅ STEP 2: Send Confirmation to Client
    $confirm = new PHPMailer(true);
    $confirm->isSMTP();
    $confirm->Host       = 'smtp.gmail.com';
    $confirm->SMTPAuth   = true;
    $confirm->Username   = $gmail_user;
    $confirm->Password   = $gmail_pass;
    $confirm->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $confirm->Port       = 587;

    $confirm->setFrom($gmail_user, 'TS Freighters');
    $confirm->addAddress($email, $name);

    $confirm->isHTML(true);
    $confirm->Subject = "✅ We Received Your Message - TS Freighters";
    $confirm->Body = "
        <div style='font-family: Arial, sans-serif;'>
            <h3 style='color:#f0ad4e;'>Thank you, {$name}!</h3>
            <p>We’ve received your message regarding <b>{$subject}</b>.</p>
            <p>Our support team will get back to you shortly.</p>
            <br>
            <p><b>Your Message:</b></p>
            <blockquote style='border-left:4px solid #f0ad4e;padding-left:10px;color:#555;'>" . nl2br($message) . "</blockquote>
            <hr>
            <p style='font-size:12px;color:#999;'>This is an automated confirmation from TS Freighters.</p>
        </div>
    ";

    $confirm->send();

    echo json_encode([
        'status' => 'success',
        'message' => '✅ Thank you! Your message has been sent successfully. A confirmation email has been sent to you.'
    ]);

} catch (Exception $e) {
    echo json_encode([
        'status' => 'error',
        'message' => '❌ Message could not be sent. Please try again later.',
        'error_info' => $e->getMessage()
    ]);
}
