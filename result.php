<?php include 'header.php'; ?>

 <!-- Breadcume Section -->
      <section class="breadcume-section">
        <div class="outer-box">
           <div class="auto-container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="breadcumb-content">
                            <div class="breadcumb-title">
                                <h1 class="title">Result </h1>
                            </div>
                            <ul class="breadcume-pull">
                                <li><a class="title-line" href="index.php">Home <span><i class="fas fa-angle-right"></i></span></a></li>
                                <li>Bharat Election — Election Results</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>   
      </section>
    <!-- End Breadcume Section -->
   


<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Election Results 2025 | Bharat Election Commission</title>

<style>
/* ---------- RESET ---------- */
* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}
body {
  font-family: "Poppins", sans-serif;
  background-color: #f8fafc;
  color: #222;
  line-height: 1.6;
}

/* ---------- HERO SECTION ---------- */
.hero {
  background: linear-gradient(135deg, #0b3d91, #1a73e8);
  color: white;
  text-align: center;
  padding: 100px 20px;
  position: relative;
}
.hero h1 {
  font-size: 3rem;
  font-weight: 700;
  margin-bottom: 15px;
}
.hero p {
  font-size: 1.2rem;
  opacity: 0.9;
  margin-bottom: 30px;
}
.hero .status {
  display: inline-flex;
  align-items: center;
  background: rgba(255, 255, 255, 0.1);
  border: 1px solid rgba(255, 255, 255, 0.25);
  padding: 10px 20px;
  border-radius: 30px;
  font-size: 1rem;
  font-weight: 500;
  backdrop-filter: blur(5px);
}
.status-dot {
  width: 10px;
  height: 10px;
  background: #facc15;
  border-radius: 50%;
  margin-right: 10px;
  animation: blink 1.2s infinite;
}
@keyframes blink {
  50% { opacity: 0.3; }
}

/* ---------- SECTION: SUMMARY ---------- */
.summary {
  max-width: 1200px;
  margin: 80px auto;
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
  gap: 30px;
  padding: 0 20px;
}
.card {
  background: #fff;
  border-radius: 12px;
  padding: 30px;
  box-shadow: 0 3px 10px rgba(0,0,0,0.08);
  text-align: center;
  transition: 0.3s;
}
.card:hover {
  transform: translateY(-5px);
  box-shadow: 0 5px 20px rgba(0,0,0,0.1);
}
.card h3 {
  color: #0b3d91;
  margin-bottom: 10px;
  font-size: 1.5rem;
}
.card p {
  color: #555;
  font-size: 1rem;
}

/* ---------- SECTION: REGION-WISE ---------- */
.results {
  max-width: 1100px;
  margin: 60px auto;
  padding: 20px;
}
.results h2 {
  font-size: 2rem;
  color: #0b3d91;
  margin-bottom: 25px;
  border-left: 5px solid #1a73e8;
  padding-left: 15px;
}
.region {
  background: #fff;
  border-radius: 10px;
  padding: 25px;
  margin-bottom: 40px;
  box-shadow: 0 3px 10px rgba(0,0,0,0.05);
}
.region h3 {
  color: #1a73e8;
  font-size: 1.3rem;
  margin-bottom: 15px;
}
.region ul {
  list-style: none;
}
.region ul li {
  padding: 8px 0;
  border-bottom: 1px solid #eee;
}
.region ul li:last-child {
  border-bottom: none;
}
.region ul li span {
  float: right;
  color: #999;
  font-style: italic;
}

/* ---------- SECTION: NOTICE ---------- */
.notice {
  text-align: center;
  background: #e9f1ff;
  border: 1px solid #cdd9f7;
  padding: 30px;
  border-radius: 10px;
  margin: 60px auto;
  max-width: 800px;
}
.notice h3 {
  color: #0b3d91;
  font-size: 1.5rem;
  margin-bottom: 10px;
}
.notice p {
  color: #444;
}

/* ---------- FOOTER ---------- */
footer {
  background: #0b3d91;
  color: white;
  text-align: center;
  padding: 30px 20px;
  margin-top: 80px;
}
footer p {
  font-size: 0.95rem;
  opacity: 0.8;
}
footer a {
  color: #facc15;
}

/* ---------- RESPONSIVE ---------- */
@media (max-width: 768px) {
  .hero h1 { font-size: 2.2rem; }
  .summary { grid-template-columns: 1fr; }
}
</style>
</head>

<body>

<!-- ===== HERO SECTION ===== -->
<section class="hero">
  <h1>Election Results 2025</h1>
  <p>Official Results by Bharat Election Commission</p>
  <div class="status">
    <div class="status-dot"></div>
    Results Not Declared Yet
  </div>
</section>

<!-- ===== SUMMARY CARDS ===== -->
<div class="summary">
  <div class="card">
    <h3>National Voter Turnout</h3>
    <p>Awaiting official data from Election Commission.</p>
  </div>
  <div class="card">
    <h3>Counting Progress</h3>
    <p>Counting process will begin soon after polls conclude.</p>
  </div>
  <div class="card">
    <h3>Leading Parties</h3>
    <p>Results to be updated live once counting begins.</p>
  </div>
  <div class="card">
    <h3>Live Coverage</h3>
    <p>Stay tuned for verified updates across all states.</p>
  </div>
</div>

<!-- ===== REGION-WISE PLACEHOLDERS ===== -->
<div class="results">
  <h2>State-wise Election Updates</h2>

  <div class="region">
    <h3>North India</h3>
    <ul>
      <li>Uttar Pradesh <span>Result Not Declared</span></li>
      <li>Punjab <span>Result Not Declared</span></li>
      <li>Haryana <span>Result Not Declared</span></li>
      <li>Delhi (NCT) <span>Result Not Declared</span></li>
    </ul>
  </div>

  <div class="region">
    <h3>South India</h3>
    <ul>
      <li>Tamil Nadu <span>Result Not Declared</span></li>
      <li>Karnataka <span>Result Not Declared</span></li>
      <li>Kerala <span>Result Not Declared</span></li>
      <li>Andhra Pradesh <span>Result Not Declared</span></li>
    </ul>
  </div>

  <div class="region">
    <h3>West India</h3>
    <ul>
      <li>Gujarat <span>Result Not Declared</span></li>
      <li>Maharashtra <span>Result Not Declared</span></li>
      <li>Rajasthan <span>Result Not Declared</span></li>
      <li>Goa <span>Result Not Declared</span></li>
    </ul>
  </div>

  <div class="region">
    <h3>East & Central India</h3>
    <ul>
      <li>Bihar <span>Result Not Declared</span></li>
      <li>Jharkhand <span>Result Not Declared</span></li>
      <li>Madhya Pradesh <span>Result Not Declared</span></li>
      <li>Chhattisgarh <span>Result Not Declared</span></li>
    </ul>
  </div>

  <div class="region">
    <h3>North-East India</h3>
    <ul>
      <li>Assam <span>Result Not Declared</span></li>
      <li>Manipur <span>Result Not Declared</span></li>
      <li>Meghalaya <span>Result Not Declared</span></li>
      <li>Tripura <span>Result Not Declared</span></li>
    </ul>
  </div>
</div>

<!-- ===== NOTICE ===== -->
<div class="notice">
  <h3>⚠️ Official Announcement Pending</h3>
  <p>Election results will be displayed live on this page as soon as counting begins. Please refresh this page or visit the official Election Commission portal for verified updates.</p>
</div>


</body>
</html>

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

<!-- Mirrored from html.kodesolution.com/2025/onicx-html/about.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 29 Oct 2025 09:37:45 GMT -->
</html>

<?php include 'footer.php'; ?>
