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
<title>DentEase | Contact & Info</title>

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
    <span class="de-hero-eyebrow">Book & connect</span>
    <h1>Book your appointment, or reach the clinic directly.</h1>
    <p class="lead" style="max-width:60ch;">Fill out the form below to request a visit, or use the contact details to reach us by phone or email.</p>
  </div>
</header>

<main class="de-main">
  <div class="container-narrow">

    <div class="panel">
      <div class="section-head" style="margin-bottom:1.6rem;">
        <span class="kicker">Appointment request</span>
        <h2>Book your appointment now</h2>
      </div>

      <form id="patientForm" method="POST" action="process-v2.php">
        <h4 style="font-size:1.1rem;">Personal Details</h4>
        <div class="row g-3 mb-3">
          <div class="col-md-6">
            <label class="form-label">Full Name</label>
            <input type="text" name="txtFullName" class="form-control required" placeholder="Enter full name">
          </div>
          <div class="col-md-3">
            <label class="form-label">Date of Birth</label>
            <input type="date" name="txtDOB" class="form-control required">
          </div>
          <div class="col-md-3">
            <label class="form-label">Gender</label>
            <select name="ddlGender" class="form-select required">
              <option value="">Select</option>
              <option>Male</option>
              <option>Female</option>
              <option>Other</option>
            </select>
          </div>
        </div>

        <div class="row g-3 mb-3">
          <div class="col-md-6">
            <label class="form-label">Phone Number</label>
            <input type="tel" name="txtPhone" class="form-control required" placeholder="Enter phone number">
          </div>
          <div class="col-md-6">
            <label class="form-label">Email Address</label>
            <input type="email" name="txtEmail" class="form-control required" placeholder="Enter email"
              value="<?php echo $isLoggedIn ? htmlspecialchars($_SESSION['user_email']) : ''; ?>">
          </div>
        </div>

        <div class="mb-3">
          <label class="form-label">Address</label>
          <textarea name="taAddress" class="form-control required" rows="2" placeholder="Enter address"></textarea>
        </div>

        <h4 style="font-size:1.1rem;">Appointment Details</h4>
        <div class="row g-3 mb-3">
          <div class="col-md-6">
            <label class="form-label">Preferred Date & Time</label>
            <input type="datetime-local" name="txtPreferredDateTime" class="form-control required">
          </div>
          <div class="col-md-6">
            <label class="form-label">Reason for Visit</label>
            <select name="ddlReason" class="form-select required">
              <option value="">Select</option>
              <option>Consultation</option>
              <option>Cleaning</option>
              <option>Toothache</option>
              <option>Follow-up</option>
            </select>
          </div>
        </div>

        <div class="mb-3">
          <label class="form-label">Dentist or Staff Requested</label>
          <input type="text" name="txtDentist" class="form-control" placeholder="Enter name (optional)">
        </div>

        <h4 style="font-size:1.1rem;">Medical & Dental History</h4>
        <div class="row g-3 mb-3">
          <div class="col-md-6">
            <label class="form-label">Current Medical Conditions</label>
            <textarea name="taMedicalConditions" class="form-control" rows="2" placeholder="e.g., diabetes, hypertension"></textarea>
          </div>
          <div class="col-md-6">
            <label class="form-label">Allergies</label>
            <textarea name="taAllergies" class="form-control" rows="2" placeholder="e.g., medications, anesthesia"></textarea>
          </div>
        </div>

        <div class="row g-3 mb-3">
          <div class="col-md-6">
            <label class="form-label">Current Medications</label>
            <textarea name="taMedications" class="form-control" rows="2" placeholder="List medications"></textarea>
          </div>
          <div class="col-md-6">
            <label class="form-label">Past Dental Treatments or Surgeries</label>
            <textarea name="taPastTreatments" class="form-control" rows="2" placeholder="Describe past treatments"></textarea>
          </div>
        </div>

        <div class="text-center mt-4">
          <button type="submit" name="btnSubmit" class="btn-navy">Submit Information</button>
        </div>
      </form>
    </div>

    <div class="panel">
      <div class="section-head" style="margin-bottom:1.2rem;">
        <span class="kicker">Reach us directly</span>
        <h2>Contact Information</h2>
      </div>
      <div class="split" style="gap:1.6rem;">
        <div>
          <h4 style="font-size:1.05rem;">Clinic Contact</h4>
          <ul class="info-list">
            <li><span class="ico">🦷</span> General Dentistry | Orthodontics</li>
            <li><span class="ico">📞</span> 0991-278-2217</li>
            <li><span class="ico">📍</span> Barangay Soro-Soro, Biñan City, Laguna</li>
            <li><span class="ico">🕒</span> 3 mins walk from Biñan–Carmona Arc</li>
          </ul>
        </div>
        <div>
          <h4 style="font-size:1.05rem;">Developer Contact</h4>
          <ul class="info-list">
            <li><span class="ico">🎓</span> Rodriguez, Athea Irish G.</li>
            <li><span class="ico">📧</span> <a href="mailto:denteaseclinicAi@gmail.com">denteaseclinicAi@gmail.com</a></li>
            <li><span class="ico">🏫</span> BSIT Student, PUP – Biñan Campus</li>
          </ul>
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
      <span>Made by BSIT student · Polytechnic University of the Philippines</span>
    </div>
  </div>
</footer>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="script-v2.js"></script>
</body>
</html>
