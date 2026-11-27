<?php
session_name("dentease_v2");
session_start();
require_once "db-v2.php";

$loginError  = "";
$signupError = "";
$activeTab   = "login";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    if (isset($_POST["btnLogin"])) {
        $activeTab = "login";
        $email    = trim($_POST["loginEmail"] ?? "");
        $password = $_POST["loginPassword"] ?? "";

        if ($email === "" || $password === "") {
            $loginError = "Please enter email and password.";
        } else {
            $stmt = $conn->prepare("SELECT user_id, full_name, password FROM users WHERE email = ?");
            
            if ($stmt === false) {
                $loginError = "Database error: " . $conn->error;
            } else {
                $stmt->bind_param("s", $email);
                $stmt->execute();
                $passwordHash = "";
                $stmt->bind_result($id, $fullName, $passwordHash);

                if ($stmt->fetch() && password_verify((string) $password, (string) $passwordHash)) {
                    $stmt->close();
                    $_SESSION["user_id"]    = $id;
                    $_SESSION["user_name"]  = $fullName;
                    $_SESSION["user_email"] = $email;
                    $conn->close();
                    header("Location: index.php");
                    exit;
                } else {
                    $stmt->close();
                    $loginError = "Invalid email or password.";
                }
            }
        }
    }

    if (isset($_POST["btnSignup"])) {
        $activeTab = "signup";
        $name     = trim($_POST["signupName"] ?? "");
        $email    = trim($_POST["signupEmail"] ?? "");
        $password = $_POST["signupPassword"] ?? "";

        if ($name === "" || $email === "" || strlen($password) < 6) {
            $signupError = "Please fill out all fields (password min 6 characters).";
        } else {
            $stmt = $conn->prepare("SELECT user_id FROM users WHERE email = ?");

            if ($stmt === false) {
                $signupError = "Database error: " . $conn->error;
            } else {
                $stmt->bind_param("s", $email);
                $stmt->execute();
                $stmt->store_result();

                if ($stmt->num_rows > 0) {
                    $stmt->close();
                    $signupError = "That email is already registered.";
                } else {
                    $stmt->close();
                    $passwordHash = password_hash($password, PASSWORD_DEFAULT);
                    $stmt = $conn->prepare("INSERT INTO users (full_name, email, password) VALUES (?, ?, ?)");

                    if ($stmt === false) {
                        $signupError = "Database error: " . $conn->error;
                    } else {
                        $stmt->bind_param("sss", $name, $email, $passwordHash);

                        if ($stmt->execute()) {
                            $_SESSION["user_id"]    = $stmt->insert_id;
                            $_SESSION["user_name"]  = $name;
                            $_SESSION["user_email"] = $email;
                            $stmt->close();
                            $conn->close();
                            header("Location: index.php");
                            exit;
                        } else {
                            $signupError = "Signup failed: " . $stmt->error;
                            $stmt->close();
                        }
                    }
                }
            }
        }
    }
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>DentEase | Log In or Sign Up</title>

<link rel="icon" href="denteaselogo.png">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Space+Grotesk:wght@500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="styles-v2.css">
</head>
<body>

<main class="auth-shell">
  <div class="container-narrow">
    <div class="auth-card">

      <div class="text-center mb-4">
        <img src="denteaselogo.png" alt="DentEase logo" style="height:76px; margin:0 auto 10px;">
        <h2 style="font-size:1.4rem;">Welcome to DentEase</h2>
        <p style="font-size:.92rem; margin:0;">Log in to manage your appointments, or create a new account.</p>
      </div>

      <div class="auth-tabs">
        <button type="button" data-tab="login" class="<?php echo $activeTab === 'login' ? 'active' : ''; ?>">Log In</button>
        <button type="button" data-tab="signup" class="<?php echo $activeTab === 'signup' ? 'active' : ''; ?>">Sign Up</button>
      </div>

      <div class="auth-pane <?php echo $activeTab === 'login' ? 'active' : ''; ?>" id="pane-login">
        <div class="auth-alert" id="loginAlert">
          <?php if ($loginError): ?>
            <div class="alert alert-danger py-2 mb-3"><?php echo htmlspecialchars($loginError); ?></div>
          <?php endif; ?>
        </div>
        <form id="loginForm" method="POST" action="signin-login-v2.php">
          <div class="mb-3">
            <label class="form-label">Email address</label>
            <input type="email" name="loginEmail" id="loginEmail" class="form-control" placeholder="you@example.com" required
              value="<?php echo isset($_POST['loginEmail']) ? htmlspecialchars($_POST['loginEmail']) : ''; ?>">
          </div>
          <div class="mb-2">
            <label class="form-label">Password</label>
            <input type="password" name="loginPassword" id="loginPassword" class="form-control" placeholder="••••••••" required>
          </div>
          <p class="field-hint mb-3">Demo account: demo@dentease.com / dentease123</p>
          <button type="submit" name="btnLogin" class="btn-navy w-100">Log In</button>
        </form>
      </div>

      <div class="auth-pane <?php echo $activeTab === 'signup' ? 'active' : ''; ?>" id="pane-signup">
        <div class="auth-alert" id="signupAlert">
          <?php if ($signupError): ?>
            <div class="alert alert-danger py-2 mb-3"><?php echo htmlspecialchars($signupError); ?></div>
          <?php endif; ?>
        </div>
        <form id="signupForm" method="POST" action="signin-login-v2.php">
          <div class="mb-3">
            <label class="form-label">Full name</label>
            <input type="text" name="signupName" id="signupName" class="form-control" placeholder="Athea Rodriguez" required
              value="<?php echo isset($_POST['signupName']) ? htmlspecialchars($_POST['signupName']) : ''; ?>">
          </div>
          <div class="mb-3">
            <label class="form-label">Email address</label>
            <input type="email" name="signupEmail" id="signupEmail" class="form-control" placeholder="you@example.com" required
              value="<?php echo isset($_POST['signupEmail']) ? htmlspecialchars($_POST['signupEmail']) : ''; ?>">
          </div>
          <div class="mb-2">
            <label class="form-label">Password</label>
            <input type="password" name="signupPassword" id="signupPassword" class="form-control" placeholder="Create a password" minlength="6" required>
          </div>
          <p class="field-hint mb-3">This is a demo account.</p>
          <button type="submit" name="btnSignup" class="btn-navy w-100">Create Account</button>
        </form>
      </div>

    </div>
  </div>
</main>

<footer class="de-footer" style="margin-top:0; text-align:right;">
  <div class="container-narrow">
    <div class="de-footer-bottom" style="border-top:none; margin-top:0; padding-top:0; text-align:right;">
    <span>© 2026 DentEase. Webdev project by Rodriguez, Athea — PUP Biñan.</span>
      <span>Made by BSIT student· Polytechnic University of the Philippines</span>
    </div>
  </div>
</footer>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="script-v2.js"></script>
</body>
</html>
