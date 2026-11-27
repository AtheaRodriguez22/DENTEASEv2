<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_name("dentease_v2");
session_start();
if (!isset($_SESSION["user_id"])) {
    header("Location: signin-login-v2.php");
    exit;
}
header("Cache-Control: no-store, no-cache, must-revalidate");
require_once "db-v2.php";

$userId = $_SESSION["user_id"] ?? null;

$fullName           = trim($_POST["txtFullName"] ?? "");
$dob                = $_POST["txtDOB"] ?? null;
$gender             = $_POST["ddlGender"] ?? "";
$phone              = trim($_POST["txtPhone"] ?? "");
$email              = trim($_POST["txtEmail"] ?? "");
$address            = trim($_POST["taAddress"] ?? "");
$preferredDateTime  = $_POST["txtPreferredDateTime"] ?? null;
$reason             = $_POST["ddlReason"] ?? "";
$dentist            = trim($_POST["txtDentist"] ?? "");
$medicalConditions  = trim($_POST["taMedicalConditions"] ?? "");
$allergies          = trim($_POST["taAllergies"] ?? "");
$medications        = trim($_POST["taMedications"] ?? "");
$pastTreatments     = trim($_POST["taPastTreatments"] ?? "");

$missing = [];
if ($fullName === "")          $missing[] = "Full Name";
if (!$dob)                     $missing[] = "Date of Birth";
if ($gender === "")            $missing[] = "Gender";
if ($phone === "")             $missing[] = "Phone Number";
if ($email === "")             $missing[] = "Email Address";
if ($address === "")           $missing[] = "Address";
if (!$preferredDateTime)       $missing[] = "Preferred Date & Time";
if ($reason === "")            $missing[] = "Reason for Visit";

if (!empty($missing)) {
    $conn->close();
    echo "<h1>Missing required fields</h1>";
    echo "<p>Please go back and fill out: " . htmlspecialchars(implode(", ", $missing)) . "</p>";
    echo '<p><a href="contact-info-v2.php">&larr; Back to the form</a></p>';
    exit;
}

$preferredDateTimeSql = str_replace("T", " ", $preferredDateTime);

$stmt = $conn->prepare(
    "INSERT INTO appointments
        (user_id, full_name, date_of_birth, gender, phone, email, address,
         preferred_datetime, reason, dentist_requested,
         medical_conditions, allergies, medications, past_treatments)
     VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)"
);


if ($stmt === false) {
    echo "<h1>Database error</h1>";
    echo "<p>Could not prepare the query. This usually means the <code>appointments</code> table doesn't exist yet, or a column name doesn't match.</p>";
    echo "<p><strong>MySQL says:</strong> " . htmlspecialchars($conn->error) . "</p>";
    echo '<p><a href="contact-info-v2.php">&larr; Back to the form</a></p>';
    $conn->close();
    exit;
}

$stmt->bind_param(
    "isssssssssssss",
    $userId,
    $fullName,
    $dob,
    $gender,
    $phone,
    $email,
    $address,
    $preferredDateTimeSql,
    $reason,
    $dentist,
    $medicalConditions,
    $allergies,
    $medications,
    $pastTreatments
);

if ($stmt->execute()) {
    $stmt->close();
    $conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>DentEase | Appointment Received</title>
<link rel="icon" href="denteaselogo.png">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Space+Grotesk:wght@500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="styles-v2.css">
</head>
<body>

<main class="logout-shell">
  <div class="logout-card" style="max-width:520px;">
    <div class="logout-icon">✓</div>
    <h2 style="font-size:1.4rem;">Appointment request received</h2>
    <p>Thank you, <strong><?php echo htmlspecialchars($fullName); ?></strong>. We've recorded your request — the clinic will reach out to confirm your slot.</p>

    <ul class="info-list text-start mt-3">
      <li><span class="ico">🗓️</span> <?php echo htmlspecialchars(str_replace("T", " ", $preferredDateTime)); ?></li>
      <li><span class="ico">🦷</span> <?php echo htmlspecialchars($reason); ?></li>
      <li><span class="ico">📞</span> <?php echo htmlspecialchars($phone); ?></li>
      <li><span class="ico">📧</span> <?php echo htmlspecialchars($email); ?></li>
    </ul>

    <div class="d-flex gap-3 justify-content-center mt-4 flex-wrap">
      <a href="index.php" class="btn-navy">Back to Home</a>
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
<?php
    exit;
} else {
    $errorMsg = $stmt->error;
    $stmt->close();
    $conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>DentEase | Something Went Wrong</title>
<link rel="icon" href="denteaselogo.png">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Space+Grotesk:wght@500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="styles-v2.css">
</head>
<body>

<main class="logout-shell">
  <div class="logout-card" style="max-width:520px;">
    <div class="logout-icon" style="background:#f8d7da; color:#842029;">!</div>
    <h2 style="font-size:1.4rem;">Something went wrong</h2>
    <p><?php echo htmlspecialchars($errorMsg); ?></p>
    <div class="d-flex gap-3 justify-content-center mt-3 flex-wrap">
      <a href="contact-info-v2.php" class="btn-navy">Back to the Form</a>
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
<?php
    exit;
}
