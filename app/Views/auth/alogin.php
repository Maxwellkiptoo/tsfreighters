<?php
// session_start();
// require '../../conn.php';
// require '../../vendor/autoload.php';

// use PHPMailer\PHPMailer\PHPMailer;
// use PHPMailer\PHPMailer\Exception;

// // === CSRF Token Generation ===
// if (empty($_SESSION['csrf_token'])) {
//     $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
// }

// // === CAPTCHA Generation (Only on GET Request) ===
// if ($_SERVER['REQUEST_METHOD'] === 'GET') {
//     $a = rand(1, 10);
//     $b = rand(1, 10);
//     $_SESSION['captcha_question'] = "What is $a + $b?";
//     $_SESSION['captcha_answer'] = $a + $b;
// }

// // === Login Attempt Tracker ===
// if (!isset($_SESSION['login_attempts'])) {
//     $_SESSION['login_attempts'] = 0;
//     $_SESSION['first_failed_time'] = time();
// }

// $timeElapsed = time() - $_SESSION['first_failed_time'];

// // === Lockout Handling ===
// if ($_SESSION['login_attempts'] >= 3) {
//     if ($timeElapsed >= 300) {
//         $_SESSION['login_attempts'] = 0;
//         $_SESSION['first_failed_time'] = time();
//         unset($_SESSION['unlock_email_sent'], $_SESSION['unlock_token']);
//     } else {
//         if (!isset($_SESSION['unlock_email_sent'])) {
//             $token = bin2hex(random_bytes(16));
//             $_SESSION['unlock_token'] = $token;
//             $link = "http://" . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . "/unlock.php?token=$token";

//             $mail = new PHPMailer(true);
//             try {
//                 $mail->isSMTP();
//                 $mail->Host = 'smtp.gmail.com';
//                 $mail->SMTPAuth = true;
//                 $mail->Username = 'nexbridge001@gmail.com';
//                 $mail->Password = 'ljxyijatkrivvwcy';
//                 $mail->SMTPSecure = 'tls';
//                 $mail->Port = 587;

//                 $mail->setFrom('nexbridge001@gmail.com', 'ARSA Admin');
//                 $mail->addAddress("sultanmaxwell2@gmail.com");
//                 $mail->isHTML(true);
//                 $mail->Subject = 'Unlock Admin Login';
//                 $mail->Body = "Click <a href='$link'>here</a> to unlock your login.";
//                 $mail->AltBody = "Visit this link: $link";
//                 $mail->send();

//                 $_SESSION['unlock_email_sent'] = true;
//                 echo "<h3 style='color:green;text-align:center;'>Unlock link sent to admin email.</h3>";
//             } catch (Exception $e) {
//                 echo "<h3 style='color:red;text-align:center;'>Mailer Error: {$mail->ErrorInfo}</h3>";
//             }
//         }

//         $remaining = ceil((300 - $timeElapsed) / 60);
//         die("<h2 style='color:red;text-align:center;'>Too many failed attempts. Try again in $remaining minute(s).</h2>");
//     }
// }

// === Handle Login ===
$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');
    $password = trim($_POST['password'] ?? '');
    $csrf = $_POST['csrf_token'] ?? '';
    $captcha = trim($_POST['captcha'] ?? '');

    if (empty($email) || empty($password) || $captcha === '') {
        $error = "Please fill all fields.";
    } elseif ($csrf !== $_SESSION['csrf_token']) {
        $error = "Invalid CSRF token.";
    } elseif ($captcha != $_SESSION['captcha_answer']) {
        $error = "Incorrect";
    } else {
        $stmt = $conn->prepare("SELECT id, email, username, password, role, is_active FROM code WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result && $result->num_rows === 1) {
            $user = $result->fetch_assoc();
            if (password_verify($password, $user['password'])) {
                if ($user['is_active'] != 1) {
                    $error = "Account is inactive. Contact support.";
                } else {
                    $_SESSION['admin_logged_in'] = true;
                    $_SESSION['admin_id'] = $user['id'];
                    $_SESSION['admin_email'] = $user['email'];
                    $_SESSION['admin_username'] = $user['username'];
                    $_SESSION['role'] = $user['role'];
                    $_SESSION['login_attempts'] = 0;

                    if ($user['role'] === 'super_admin') {
                        header("Location: ../vuka_details/vuka_control.php");
                    } else {
                        header("Location: ../dash.php");
                    }
                    exit;
                }
            } else {
                $_SESSION['login_attempts']++;
                $error = "Incorrect";
            }
        } else {
            $_SESSION['login_attempts']++;
            $error = "incorrect.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Admin Login</title>
  <style>
    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background: #ecf0f1;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      margin: 0;
    }
    .login-container {
      background: #fff;
      padding: 30px 40px;
      border-radius: 10px;
      box-shadow: 0 0 20px rgba(0,0,0,0.1);
      width: 100%;
      max-width: 360px;
    }
    .login-container h2 {
      text-align: center;
      color: #2c3e50;
      margin-bottom: 25px;
    }
    .login-container input {
      width: 100%;
      padding: 12px;
      margin: 10px 0;
      border: 1px solid #ccc;
      border-radius: 6px;
      font-size: 15px;
    }
    .login-container button {
      width: 100%;
      padding: 12px;
      background: #2ecc71;
      color: #fff;
      font-weight: bold;
      border: none;
      border-radius: 6px;
      font-size: 16px;
      cursor: pointer;
    }
    .login-container button:hover {
      background: #27ae60;
    }
    .error {
      color: red;
      text-align: center;
      font-size: 14px;
      margin-top: 10px;
    }
  </style>
</head>
<body>
  <div class="login-container">
    <h2>Admin Login</h2>
    <form method="POST">
      <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token']; ?>">
      <input type="email" name="email" placeholder="Email" required />
      <input type="password" name="password" placeholder="Password" required />
      <input type="text" name="captcha" placeholder="<?= $_SESSION['captcha_question']; ?>" required />
      <button type="submit">Login</button>
    </form>
    <?php if (!empty($error)): ?>
      <p class="error"><?= htmlspecialchars($error) ?></p>
    <?php endif; ?>
  </div>
  <script>
    document.addEventListener("contextmenu", e => e.preventDefault());
    document.addEventListener("keydown", e => {
      if (
        e.key === "F12" ||
        (e.ctrlKey && e.shiftKey && ["I", "J", "C"].includes(e.key)) ||
        (e.ctrlKey && e.key === "U")
      ) {
        e.preventDefault();
        alert("Action blocked for security.");
      }
    });
  </script>
</body>
</html>
