<?php
session_name("dentease_v2");
session_start();
if (!isset($_SESSION["user_id"])) {
    header("Location: signin-login-v2.php");
    exit;
}
header("Cache-Control: no-store, no-cache, must-revalidate");
$isLoggedIn = isset($_SESSION["user_id"]);
$userFirstName = $isLoggedIn ? explode(" ", $_SESSION["user_name"])[0] : "";
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>DentEase | About</title>

<link rel="icon" href="denteaselogo.png">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Space+Grotesk:wght@500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="styles-v2.css">
</head>
<body>


<nav class="de-navbar navbar navbar-expand-lg">
  <div class="container-narrow d-flex align-items-center justify-content-between">
    <a class="navbar-brand" href="index.php">
      <img src="denteaselogo.png" alt="DentEase logo">
      DentEase
    </a>
    <button class="navbar-toggler d-lg-none" type="button" data-bs-toggle="collapse" data-bs-target="#deNav">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse flex-grow-0 d-lg-flex" id="deNav">
      <ul class="navbar-nav flex-row gap-1 me-4">
        <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
        <li class="nav-item"><a class="nav-link" href="services-v2.php">Services</a></li>
        <li class="nav-item"><a class="nav-link" href="about-v2.php">About</a></li>
        <li class="nav-item"><a class="nav-link" href="contact-info-v2.php">Contact & Info</a></li>
      </ul>
    </div>
    <div class="auth-area" id="authArea">
      <?php if ($isLoggedIn): ?>
        <span class="user-chip">Hi, <strong><?php echo htmlspecialchars($userFirstName); ?></strong></span>
        <a href="logout-v2.php" class="btn-cta-ghost">Log Out</a>
      <?php else: ?>
        <a href="signin-login-v2.php" class="btn-cta">Log In / Sign Up</a>
      <?php endif; ?>
    </div>
  </div>
</nav>

<header class="de-hero">
  <div class="container-narrow hero-sm">
    <span class="de-hero-eyebrow">About the project</span>
    <h1>A capstone built to fix a real scheduling problem.</h1>
    <p class="lead" style="max-width:60ch;">DentEase: A Real-Time Dentist Availability, Appointment, and HMO Access system — developed for the BSIT program at Polytechnic University of the Philippines, Biñan Campus.</p>
  </div>
</header>

<main class="de-main">
  <div class="container-narrow">

    <div class="split">
      <div class="split-media">
        <img src="https://images.unsplash.com/photo-1643660526741-094639fbe53a?auto=format&fit=crop&w=900&q=80" alt="Calm dental clinic interior">
      </div>
      <div>
        <div class="section-head" style="margin-bottom:1.2rem;">
          <span class="kicker">The problem</span>
          <h2>Booking a dental visit shouldn't be a guessing game</h2>
        </div>
        <p>Patients often struggle to know which dentists are available and end up wasting time and transportation costs traveling to a fully booked clinic. On the other side of the counter, clinic staff manage appointments by hand — which leads to double-bookings and missed requests.</p>
        <p>DentEase addresses both sides of that problem: a clear, real-time view of availability for patients, and a simpler intake process for staff.</p>
      </div>
    </div>

    <div class="section-head" style="margin-top:3.4rem;">
      <span class="kicker">How it works</span>
      <h2>From search to seat, in three steps</h2>
    </div>
    <div class="steps">
      <div class="step-card">
        <div class="step-num">1</div>
        <h4>Search</h4>
        <p style="font-size:.94rem;">Filter by specialization and area to see which dentists are currently available near you.</p>
      </div>
      <div class="step-card">
        <div class="step-num">2</div>
        <h4>Book</h4>
        <p style="font-size:.94rem;">Submit your personal, appointment, and medical history details in a single intake form.</p>
      </div>
      <div class="step-card">
        <div class="step-num">3</div>
        <h4>Visit</h4>
        <p style="font-size:.94rem;">Arrive at your scheduled time — the clinic already has what it needs to see you faster.</p>
      </div>
    </div>

    <div class="panel" style="margin-top:3.2rem;">
      <div class="section-head" style="margin-bottom:1rem;">
        <span class="kicker">Developer</span>
        <h2>Who built this</h2>
      </div>
      <ul class="info-list">
        <li><span class="ico">🎓</span> Rodriguez, Athea — BSIT Student</li>
        <li><span class="ico">🏫</span> Polytechnic University of the Philippines, Biñan Campus</li>
        <li><span class="ico">📧</span> <a href="mailto:denteaseclinicAi@gmail.com">denteaseclinicAi@gmail.com</a></li>
      </ul>
    </div>

  </div>
</main>

<footer class="de-footer">
  <div class="container-narrow">
    <div class="de-footer-grid">
      <div>
        <div class="brand"><img src="denteaselogo.png" alt="DentEase logo">DentEase</div>
        <p>A real-time dentist availability, appointment booking, and info reader — all in one place.</p>
      </div>
      <div>
        <h5>Navigate</h5>
        <ul>
          <li><a href="index.php">Home</a></li>
          <li><a href="services-v2.php">Services</a></li>
          <li><a href="about-v2.php">About Us</a></li>
          <li><a href="contact-info-v2.php">Contact & Info</a></li>
        </ul>
      </div>
      <div>
        <h5>Clinic Hours</h5>
        <ul>
          <li>Mon – Fri: 9:00 AM – 6:00 PM</li>
          <li>Saturday: 9:00 AM – 2:00 PM</li>
          <li>Sunday: Closed</li>
        </ul>
      </div>
      <div>
        <h5>Contact</h5>
        <ul>
          <li><a href="mailto:denteaseclinicAi@gmail.com">denteaseclinicAi@gmail.com</a></li>
          <li>0991-278-2217</li>
          <li>Barangay Soro-Soro, Biñan City, Laguna</li>
        </ul>
      </div>
    </div>
    <div class="de-footer-bottom">
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