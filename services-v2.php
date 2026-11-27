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
<title>DentEase | Services</title>

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
    <span class="de-hero-eyebrow">What we offer</span>
    <h1>Dental services, organized by what you actually need done.</h1>
    <p class="lead" style="max-width:60ch;">From routine cleanings to oral surgery, browse every service category our partner clinics provide.</p>
  </div>
</header>

<main class="de-main">
  <div class="container-narrow">

    <div class="section-head">
      <span class="kicker">Preventive & general care</span>
      <h2>Keeping small problems from becoming big ones</h2>
    </div>
    <div class="card-grid">
      <div class="feature-card">
        <div class="thumb"><img src="https://images.unsplash.com/photo-1606811856475-5e6fcdc6e509?auto=format&fit=crop&w=700&q=80" alt="Dental cleaning tools"></div>
        <div class="body">
          <span class="category-tag">Preventive</span>
          <h4>Oral Prophylaxis</h4>
          <p style="font-size:.94rem;">Professional teeth cleaning to remove plaque and tartar — recommended every 6 months.</p>
        </div>
      </div>
      <div class="feature-card">
        <div class="thumb"><img src="https://images.unsplash.com/photo-1606811971618-4486d14f3f99?auto=format&fit=crop&w=700&q=80" alt="Dentist performing a routine check-up"></div>
        <div class="body">
          <span class="category-tag">Preventive</span>
          <h4>Routine Check-ups</h4>
          <p style="font-size:.94rem;">Regular exams that catch cavities, gum disease, and other issues early.</p>
        </div>
      </div>
      <div class="feature-card">
        <div class="thumb"><img src="https://images.unsplash.com/photo-1588776814546-1ffcf47267a5?auto=format&fit=crop&w=700&q=80" alt="Dentist reviewing a dental x-ray"></div>
        <div class="body">
          <span class="category-tag">Preventive</span>
          <h4>Dental X-Rays</h4>
          <p style="font-size:.94rem;">Imaging that reveals hidden problems, like impacted teeth or bone loss.</p>
        </div>
      </div>
    </div>

    <div class="section-head" style="margin-top:3.2rem;">
      <span class="kicker">Restorative treatments</span>
      <h2>Repairing and replacing damaged teeth</h2>
    </div>
    <div class="card-grid">
      <div class="feature-card">
        <div class="thumb"><img src="https://images.unsplash.com/photo-1598256989800-fe5f95da9787?auto=format&fit=crop&w=700&q=80" alt="Dental chair set up for a filling procedure"></div>
        <div class="body">
          <span class="category-tag">Restorative</span>
          <h4>Fillings & Crowns</h4>
          <ul>
            <li><b>Fillings</b> — repair cavities with composite resin or amalgam</li>
            <li><b>Crowns</b> — caps placed over damaged teeth</li>
          </ul>
        </div>
      </div>
      <div class="feature-card">
        <div class="thumb"><img src="https://images.unsplash.com/photo-1593022356769-11f762e25ed9?auto=format&fit=crop&w=700&q=80" alt="Dental implant model"></div>
        <div class="body">
          <span class="category-tag">Restorative</span>
          <h4>Implants & Dentures</h4>
          <ul>
            <li><b>Dentures</b> — removable prosthetics for missing teeth</li>
            <li><b>Implants</b> — permanent titanium-post replacements</li>
          </ul>
        </div>
      </div>
      <div class="feature-card">
        <div class="thumb"><img src="https://images.unsplash.com/photo-1667133295315-820bb6481730?auto=format&fit=crop&w=700&q=80" alt="Root canal treatment in progress"></div>
        <div class="body">
          <span class="category-tag">Restorative</span>
          <h4>Root Canal Treatment</h4>
          <p style="font-size:.94rem;">Removes infected pulp from inside a tooth to save it from extraction.</p>
        </div>
      </div>
    </div>

    <div class="section-head" style="margin-top:3.2rem;">
      <span class="kicker">Cosmetic dentistry</span>
      <h2>For a brighter, more confident smile</h2>
    </div>
    <div class="card-grid">
      <div class="feature-card">
        <div class="thumb"><img src="https://images.unsplash.com/photo-1677026010083-78ec7f1b84ed?auto=format&fit=crop&w=700&q=80" alt="Close-up of whitened teeth"></div>
        <div class="body">
          <span class="category-tag">Cosmetic</span>
          <h4>Teeth Whitening</h4>
          <p style="font-size:.94rem;">In-clinic bleaching treatment for a noticeably brighter smile.</p>
        </div>
      </div>
      <div class="feature-card">
        <div class="thumb"><img src="https://images.unsplash.com/photo-1489278353717-f64c6ee8a4d2?auto=format&fit=crop&w=700&q=80" alt="Patient with a natural, confident smile"></div>
        <div class="body">
          <span class="category-tag">Cosmetic</span>
          <h4>Veneers & Bonding</h4>
          <ul>
            <li><b>Veneers</b> — thin shells placed over teeth</li>
            <li><b>Bonding</b> — resin used to repair chips or gaps</li>
          </ul>
        </div>
      </div>
      <div class="feature-card">
        <div class="thumb"><img src="https://images.unsplash.com/photo-1564420228450-d9a5bc8d6565?auto=format&fit=crop&w=700&q=80" alt="Clear dental aligners"></div>
        <div class="body">
          <span class="category-tag">Orthodontics</span>
          <h4>Braces & Clear Aligners</h4>
          <ul>
            <li><b>Braces</b> — correct misaligned teeth and bite issues</li>
            <li><b>Clear aligners</b> — a discreet alternative to braces</li>
            <li><b>Retainers</b> — maintain alignment after treatment</li>
          </ul>
        </div>
      </div>
    </div>

    <div class="section-head" style="margin-top:3.2rem;">
      <span class="kicker">Oral surgery</span>
      <h2>For more advanced procedures</h2>
    </div>
    <div class="card-grid">
      <div class="feature-card">
        <div class="thumb"><img src="https://images.unsplash.com/photo-1588776814546-daab30f310ce?auto=format&fit=crop&w=700&q=80" alt="Two clinicians performing an oral surgery procedure"></div>
        <div class="body">
          <span class="category-tag">Surgery</span>
          <h4>Tooth Extraction & Odontectomy</h4>
          <ul>
            <li><b>Extraction</b> — removal of severely decayed teeth</li>
            <li><b>Odontectomy</b> — surgical removal of impacted wisdom teeth</li>
          </ul>
        </div>
      </div>
      <div class="feature-card">
        <div class="thumb"><img src="https://images.unsplash.com/photo-1600170311833-c2cf5280ce49?auto=format&fit=crop&w=700&q=80" alt="Clinician reviewing gum health on a scan"></div>
        <div class="body">
          <span class="category-tag">Surgery</span>
          <h4>Periodontal Treatment</h4>
          <p style="font-size:.94rem;">Scaling, root planing, and gum disease care to protect the tissue supporting your teeth.</p>
        </div>
      </div>
    </div>

    <!-- HMO strip -->
    <div class="hmo-strip">
      <h5>ACCREDITED HMOs</h5>
      <div class="hmo-logos">
        <img src="DENTEASE__1_-hmoremovebg.png" alt="Accredited HMO partner 1">
        <img src="DENTEASE__2_-hmoremovebg.png" alt="Accredited HMO partner 2">
        <img src="DENTEASE__3_-hmoremovebg.png" alt="Accredited HMO partner 3">
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
       <span>© 2026 DentEase. Capstone project by Rodriguez, Athea — PUP Biñan.</span>
      <span>Made by BSIT student · Polytechnic University of the Philippines</span>
    </div>
  </div>
</footer>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="script-v2.js"></script>
</body>
</html>

