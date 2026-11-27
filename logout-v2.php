<?php
session_name("dentease_v2");
session_start();
session_unset();
session_destroy();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>DentEase | Logged Out</title>

<link rel="icon" href="denteaselogo.png">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Space+Grotesk:wght@500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="styles-v2.css">
</head>
<body>

<main class="logout-shell" id="logoutAction">
  <div class="logout-card">
    <div class="logout-icon">✓</div>
    <h2 style="font-size:1.4rem;">You've been logged out</h2>
    <p>Your session has ended. Thanks for using DentEase — come back any time to manage your appointments.</p>
    <div class="d-flex gap-3 justify-content-center mt-3 flex-wrap">
      <a href="signin-login-v2.php" class="btn-navy">Log In Again</a>
    </div>
  </div>
</main>

<footer class="de-footer text-center" style="margin-top:0;">
  <div class="container-narrow">
    <div class="de-footer-bottom text-center" style="border-top:none; margin-top:0; padding-top:0;">
   <span>© 2026 DentEase. Webdev project by Rodriguez, Athea — PUP Biñan.</span>
      <span>Made by BSIT student · Polytechnic University of the Philippines</span>
    </div>
  </div>
</footer>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="script-v2.js"></script>
</body>
</html>
