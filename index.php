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
<title>DentEase | Real-Time Dentist Availability & Booking</title>

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
  <div class="container-narrow">
    <div class="de-hero-grid">
      <div>
        <span class="de-hero-eyebrow">Biñan City · Laguna</span>
        <h1>Find an available dentist and book your visit in minutes.</h1>
        <p class="lead">DentEase brings real-time dentist availability, appointment booking, and clinic information into one simple dashboard — no more calling around or guessing office hours.</p>
        <div class="d-flex gap-3 flex-wrap">
          <a href="contact-info-v2.php" class="btn-cta">Book an appointment</a>
          <a href="services-v2.php" class="btn-cta-ghost">View services</a>
        </div>
      </div>
      <div class="de-hero-media">
        <img src="https://images.unsplash.com/photo-1629909613654-28e377c37b09?auto=format&fit=crop&w=1000&q=80" alt="Modern dental clinic treatment room">
      </div>
    </div>
  </div>
</header>

<main class="de-main">
  <div class="container-narrow">
    <div class="finder-card">
      <h3>Find a dentist near you</h3>
      <div class="finder-row">
        <input type="text" id="docName" class="form-control" placeholder="Doctor's name (optional)">
        <select id="docSpec" class="form-select">
          <option value="">Select specialization</option>
          <option>General Dentistry</option>
          <option>Orthodontics</option>
          <option>Pediatric Dentistry</option>
          <option>Oral Surgery</option>
          <option>Periodontics</option>
        </select>
        <select id="docArea" class="form-select">
          <option value="">Select area</option>
          <option>Biñan</option>
          <option>Santa Rosa</option>
          <option>San Pedro</option>
          <option>Carmona</option>
        </select>
        <button id="searchBtn" class="btn-cta">Search</button>
      </div>
    </div>

    <!-- Quick stats -->
    <div class="quick-stats">
      <div class="stat-card">
        <div class="num">6</div>
        <div class="label">Service categories, from cleanings to oral surgery</div>
      </div>
      <div class="stat-card">
        <div class="num">3</div>
        <div class="label">Accredited HMOs accepted at partner clinics</div>
      </div>
      <div class="stat-card">
        <div class="num">7 days</div>
        <div class="label">A week of clinic hours, Mon–Sat coverage</div>
      </div>
    </div>

    <div class="section-head" style="margin-top:3.2rem;">
      <span class="kicker">Why DentEase</span>
      <h2>Built to remove the friction of booking dental care</h2>
    </div>
    <div class="card-grid">
      <div class="feature-card">
        <div class="thumb"><img src="https://images.unsplash.com/photo-1667133295315-820bb6481730?auto=format&fit=crop&w=700&q=80" alt="Dentist checking a real-time appointment schedule"></div>
        <div class="body">
          <h4>Real-time availability</h4>
          <p style="font-size:.94rem;">See which dentists are open before you travel, instead of arriving to a fully booked clinic.</p>
        </div>
      </div>
      <div class="feature-card">
        <div class="thumb"><img src="https://images.unsplash.com/photo-1600170311833-c2cf5280ce49?auto=format&fit=crop&w=700&q=80" alt="Staff reviewing a patient's dental record on a tablet"></div>
        <div class="body">
          <h4>One patient record</h4>
          <p style="font-size:.94rem;">Fill out your medical and dental history once — clinic staff get everything they need, upfront.</p>
        </div>
      </div>
      <div class="feature-card">
        <div class="thumb"><img src="https://images.unsplash.com/photo-1489278353717-f64c6ee8a4d2?auto=format&fit=crop&w=700&q=80" alt="Patient smiling after a dental visit"></div>
        <div class="body">
          <h4>HMO-friendly</h4>
          <p style="font-size:.94rem;">Check which clinics accept your HMO before booking, so there are no surprises at check-in.</p>
        </div>
      </div>
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
      <span>Made by BSIT student· Polytechnic University of the Philippines</span>
    </div>
  </div>
</footer>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="script-v2.js"></script>
</body>
</html>


