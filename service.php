<?php 
include 'header.php';
include 'config.php'; // ensure this has $conn = mysqli_connect(...);

// Get slug from URL safely (prepared statement used below - still validate input)
$slug = isset($_GET['slug']) ? $_GET['slug'] : '';

// Fetch service details using prepared statement
$service = null;
if ($stmt = mysqli_prepare($conn, "SELECT * FROM services WHERE slug = ? AND status = 'active' LIMIT 1")) {
    mysqli_stmt_bind_param($stmt, "s", $slug);
    mysqli_stmt_execute($stmt);
    $res = mysqli_stmt_get_result($stmt);
    $service = mysqli_fetch_assoc($res);
    mysqli_stmt_close($stmt);
}
?>

<!-- Small inline CSS to ensure paragraph spacing looks professional.
     You can move these rules into your main stylesheet later. -->
<style>
.service-content p {
  margin-bottom: 16px;
  line-height: 1.8;
  color: #333;
  font-size: 16px;
  text-align: justify;
}
.service-content h2.title {
  font-weight: 700;
  font-size: 32px;
  margin-bottom: 18px;
  color: #0b0b3b;
}
.features-box p, .propose-box p {
  line-height: 1.7;
  margin-bottom: 14px;
  font-size: 15px;
  color: #444;
  text-align: left;
}
</style>

<!-- Breadcume Section -->
<section class="breadcume-section">
  <div class="outer-box">
    <div class="auto-container">
      <div class="row">
        <div class="col-lg-12">
          <div class="breadcumb-content">
            <div class="breadcumb-title">
              <h1 class="title">
                Our Services
              </h1>
            </div>
            <ul class="breadcume-pull">
              <li><a class="title-line" href="index.php">Home 
                <span><i class="fas fa-angle-right"></i></span></a>
              </li>
              <li><?= htmlspecialchars($service['service_name'] ?? 'Service'); ?></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>   
</section>
<!-- End Breadcume Section -->


<!-- Service Details Section -->
<section class="service-details-section py-5">
  <div class="auto-container">
    <?php if ($service): ?>
      <div class="row justify-content-center">
        <div class="col-lg-10">

          <!-- Title & Description FIRST -->
          <div class="service-content text-center">
            <h2 class="title mb-3"><?= htmlspecialchars($service['service_name']); ?></h2>

            <?php
            /**
             * Render description as proper paragraphs:
             * - We treat double newlines (\n\n) as paragraph breaks.
             * - Single newlines are converted to spaces.
             * - All output is escaped with htmlspecialchars.
             */
            if (!empty($service['description'])) {
                // Normalize newlines
                $text = str_replace(["\r\n", "\r"], "\n", $service['description']);
                // Split paragraphs by two or more newlines
                $parts = preg_split('/\n{2,}/', trim($text));
                foreach ($parts as $part) {
                    // Collapse single newlines into spaces inside a paragraph
                    $para = preg_replace('/\n+/', ' ', trim($part));
                    echo '<p class="service-desc mb-4">' . htmlspecialchars($para) . '</p>';
                }
            } else {
                echo '<p class="service-desc mb-4">No description available for this service.</p>';
            }
            ?>
          </div>

          <!-- Image SECOND -->
          <?php if (!empty($service['image'])): ?>
          <div class="image-box mb-4 text-center">
            <img src="images/service/<?= htmlspecialchars($service['image']); ?>" 
                 alt="<?= htmlspecialchars($service['service_name']); ?>" 
                 class="img-fluid rounded shadow" style="max-width: 100%; height: auto;">
          </div>
          <?php endif; ?>

          <!-- Features Section -->
          <?php if (!empty($service['features'])): ?>
          <div class="features-box mb-4">
            <h3 class="subtitle mb-3 text-primary">Key Features</h3>
            <?php
            // Render features as paragraphs (keep existing line breaks)
            $features_text = str_replace(["\r\n", "\r"], "\n", $service['features']);
            $features_parts = preg_split('/\n{2,}/', trim($features_text));
            foreach ($features_parts as $fpart) {
                $fpara = preg_replace('/\n+/', ' ', trim($fpart));
                echo '<p>' . htmlspecialchars($fpara) . '</p>';
            }
            ?>
          </div>
          <?php endif; ?>

          <!-- Purpose Section -->
          <?php if (!empty($service['propose'])): ?>
          <div class="propose-box mb-5">
            <h3 class="subtitle mb-3 text-primary">Our Purpose</h3>
            <?php
            $prop_text = str_replace(["\r\n", "\r"], "\n", $service['propose']);
            $prop_parts = preg_split('/\n{2,}/', trim($prop_text));
            foreach ($prop_parts as $ppart) {
                $ppara = preg_replace('/\n+/', ' ', trim($ppart));
                echo '<p>' . htmlspecialchars($ppara) . '</p>';
            }
            ?>
          </div>
          <?php endif; ?>

        </div>
      </div>
    <?php else: ?>
      <div class="text-center py-5">
        <h3 class="text-danger">Service not found!</h3>
      </div>
    <?php endif; ?>
  </div>
</section>


<?php
include 'config.php'; // connect to database

$successMsg = '';
$errorMsg = '';
$services = [];

// Fetch all active services from your DB
$result = $conn->query("SELECT service_name FROM services WHERE status='active' ORDER BY service_name ASC");
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $services[] = $row['service_name'];
    }
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = htmlspecialchars(trim($_POST['name']));
    $email = htmlspecialchars(trim($_POST['email']));
    $phone = htmlspecialchars(trim($_POST['phone']));
    $service = htmlspecialchars(trim($_POST['service']));
    $message = htmlspecialchars(trim($_POST['message']));

    $stmt = $conn->prepare("INSERT INTO services_contact (name, email, subject, phone, message, service) VALUES (?, ?, 'Service Enquiry', ?, ?, ?)");
    if (!$stmt) {
        $errorMsg = "Database error: " . $conn->error;
    } else {
        $stmt->bind_param("sssss", $name, $email, $phone, $message, $service);
        if ($stmt->execute()) {
            $successMsg = "✅ Thank you, <b>$name</b>! Your enquiry for <b>$service</b> was successfully submitted.";
        } else {
            $errorMsg = "❌ Submission failed: " . $stmt->error;
        }
        $stmt->close();
    }
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Service Enquiry | Bharat Election</title>
<style>
    body {
        font-family: 'Poppins', sans-serif;
        background: #f7f9fc;
        margin: 0;
        padding: 0;
    }

    .contact-section {
        background: #fff;
        max-width: 1100px;
        margin: 60px auto;
        border-radius: 12px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.08);
        padding: 40px 50px;
    }

    .contact-section h2 {
        text-align: center;
        margin-bottom: 25px;
        font-size: 28px;
        color: #1a1a1a;
        font-weight: 700;
    }

    form {
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
        align-items: flex-start;
        justify-content: space-between;
    }

    .form-group {
        flex: 1 1 calc(33% - 20px);
        display: flex;
        flex-direction: column;
    }

    .form-group.full {
        flex: 1 1 100%;
    }

    label {
        font-weight: 600;
        margin-bottom: 5px;
        color: #333;
    }

    input, select, textarea {
        padding: 10px 12px;
        border: 1px solid #ccc;
        border-radius: 6px;
        font-size: 15px;
        font-family: inherit;
    }

    textarea {
        height: 80px;
        resize: none;
    }

    .btn-main {
        background: #0066ff;
        color: white;
        border: none;
        border-radius: 6px;
        padding: 12px 25px;
        font-size: 16px;
        cursor: pointer;
        transition: 0.3s;
    }

    .btn-main:hover {
        background: #004fc4;
    }

    .cta-box {
        text-align: center;
        margin-top: 30px;
        padding-top: 20px;
        border-top: 1px dashed #ccc;
    }

    .cta-box p {
        font-size: 16px;
        margin-bottom: 10px;
        color: #333;
    }

    .cta-btn {
        display: inline-block;
        background: #ff6600;
        color: white;
        padding: 10px 20px;
        border-radius: 6px;
        font-weight: 500;
        text-decoration: none;
        transition: 0.3s;
    }

    .cta-btn:hover {
        background: #e65c00;
    }

    .success, .error {
        padding: 12px 15px;
        border-radius: 6px;
        margin-bottom: 20px;
        font-size: 15px;
    }

    .success {
        background: #d4edda;
        color: #155724;
        border: 1px solid #c3e6cb;
    }

    .error {
        background: #f8d7da;
        color: #721c24;
        border: 1px solid #f5c6cb;
    }

    @media (max-width: 768px) {
        .form-group {
            flex: 1 1 100%;
        }
    }
</style>
</head>
<body>

<section class="contact-section">
    <h2>Request a Service</h2>

    <?php if ($successMsg): ?>
        <div class="success"><?= $successMsg ?></div>
    <?php elseif ($errorMsg): ?>
        <div class="error"><?= $errorMsg ?></div>
    <?php endif; ?>

    <form method="POST" action="">
        <div class="form-group">
            <label for="service">Select Service</label>
            <select name="service" id="service" required>
                <option value="">-- Choose a Service --</option>
                <?php foreach ($services as $srv): ?>
                    <option value="<?= htmlspecialchars($srv) ?>"><?= htmlspecialchars($srv) ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form-group">
            <label for="name">Full Name</label>
            <input type="text" name="name" id="name" placeholder="Enter your name" required>
        </div>

        <div class="form-group">
            <label for="email">Email Address</label>
            <input type="email" name="email" id="email" placeholder="Enter your email" required>
        </div>

        <div class="form-group">
            <label for="phone">Phone Number</label>
            <input type="tel" name="phone" id="phone" placeholder="Enter your phone number" required>
        </div>

        <div class="form-group full">
            <label for="message">Message / Requirements</label>
            <textarea name="message" id="message" placeholder="Write your requirements..." required></textarea>
        </div>

        <div class="form-group full" style="text-align:center;">
            <button type="submit" class="btn-main">Submit Request</button>
        </div>
    </form>

    <div class="cta-box">
        <p>Not finding your needed service?</p>
        <a href="contact.php" class="cta-btn">Contact Us</a>
    </div>
</section>

</body>
</html>


<!-- End Contact Section -->



</div>


<script data-cfasync="false" src="https://html.kodesolution.com/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script><script src="js/jquery.js"></script> 
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery.fancybox.js"></script>
<script src="js/wow.js"></script>
<script src="js/appear.js"></script>
<script src="js/swiper.min.js"></script>
<script src="js/gsap.min.js"></script>
<script src="js/ScrollTrigger.min.js"></script>
<script src="js/SplitText.min.js"></script>
<script src="js/splitType.js"></script>
<script src="js/script.js"></script>
<script src="js/script-gsap.js"></script>
</body>

<!-- Mirrored from html.kodesolution.com/2025/onicx-html/service-details.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 29 Oct 2025 09:38:10 GMT -->
</html>
<?php 
include 'footer.php';
?>