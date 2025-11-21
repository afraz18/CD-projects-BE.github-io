<?php
include 'config.php';

if (!function_exists('e')) {
    function e($v) { return htmlspecialchars($v ?? '', ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8'); }
}

$slug = isset($_GET['slug']) ? trim($_GET['slug']) : '';

$sideStmt = $conn->prepare("SELECT id, service_name, slug FROM services WHERE status = 'active' ORDER BY service_name ASC");
$sideStmt->execute();
$sideRes = $sideStmt->get_result();
$service = null;
if ($slug !== '') {
    $sql = "SELECT * FROM services WHERE slug = ? AND status = 'active' LIMIT 1";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $slug);
    $stmt->execute();
    $result = $stmt->get_result();
    $service = $result->fetch_assoc();
    $stmt->close();

    if (!$service) {
        header("HTTP/1.0 404 Not Found");
        include 'header.php';
        echo '<div class="auto-container" style="padding:40px;"><h2>Service not found</h2><p>The service you requested does not exist.</p></div>';
        include 'footer.php';
        exit;
    }
} else {
    $gridStmt = $conn->prepare("SELECT id, category, service_name, description, image, slug FROM services WHERE status = 'active' ORDER BY created_at DESC");
    $gridStmt->execute();
    $gridRes = $gridStmt->get_result();
}

include 'header.php';
?>

    <!-- Breadcume Section -->
      <section class="breadcume-section">
        <div class="outer-box">
           <div class="auto-container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="breadcumb-content">
                            <div class="breadcumb-title">
                                <h1 class="title"><?= $service ? e($service['service_name']) : 'Service Details' ?></h1>
                            </div>
                            <ul class="breadcume-pull">
                                <li><a class="title-line" href="index.php">Home <span><i class="fas fa-angle-right"></i></span></a></li>
                                <li><?= $service ? e($service['service_name']) : 'Services' ?></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
      </section>
    <!-- End Breadcume Section -->


    <!-- Team / Service Section -->
    <section class="service-details-section">
    <div class="auto-container">
        <div class="row">
            <div class="sidebar-column col-lg-4">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="widget-sidber">
                            <h4 class="title">Service List</h4>
                            <div class="widget-category">
                                <ul>
                                    <?php while ($r = $sideRes->fetch_assoc()) : ?>
                                        <li><a href="service.php?slug=<?= e($r['slug']) ?>"><?= e($r['service_name']) ?><i class="icon fas fa-angle-right"></i></a></li>
                                    <?php endwhile; ?>
                                </ul>
                            </div>
                        </div>  
                        <div class="widget-sidber-box">
                            <div class="inner-contact-box">
                                <h4 class="title">Contact Sales</h4>
                                <h6 class="title2">Call / WhatsApp</h6>
                                <p class="contact-text">+91 97145 84578</p>
                                <h6 class="title2">Address</h6>
                                <p class="contact-text">Vapi, Gujarat, India</p>
                            </div>
                            
                            <div class="inner-contact-box">
                                <h6 class="title2">Email</h6>
                                <p class="contact-text"><a href="mailto:info@mohphret.com">info@mohphret.com</a></p>
                            </div>
                            <ul class="social-icon-four upper2">
                                <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                                <li><a href="#"><i class="fab fa-x-twitter"></i></a></li>
                                <li><a href="#"><i class="fab fa-pinterest-p"></i></a></li>
                                <li><a href="#"><i class="fab fa-youtube"></i></a></li>
                         </ul>                                                        
                        </div>                      
                    </div>
                </div>
            </div>  
            <div class="contents-column col-lg-8">
                <div class="row">
                    <div class="col-lg-12">
                        <?php if ($service): // DETAIL VIEW ?>
                            <div class="service-content">
                                <h3 class="title"><?= e($service['service_name']) ?></h3>
                                <p class="small"><strong>Category:</strong> <?= e($service['category']) ?> &nbsp; | &nbsp; <strong>Type:</strong> <?= e($service['type']) ?></p>

                                <?php if (!empty($service['image']) && file_exists(__DIR__ . '/uploads/' . $service['image'])): ?>
                                  <div class="image-box" style="margin-top:12px;">
                                    <figure class="image"><a href="#"><img src="uploads/<?= e($service['image']) ?>" alt="<?= e($service['service_name']) ?>"></a></figure>
                                  </div>
                                <?php endif; ?>

                                <div class="service-desc" style="margin-top:12px;">
                                    <?= nl2br(e($service['description'])) ?>
                                </div>

                                <div class="expert-title" style="margin-top:18px;">
                                    <h3 class="title">What We Provide</h3>
                                </div>
                                <div class="expert-desc">
                                    <p>Secure, auditable and India-focused election management modules — voter registry, polling logistics, result tabulation, audit trails, and training/support.</p>
                                </div>

                                <div class="row">
                                    <div class="col-lg-6 col-md-6">
                                        <ul class="list-style-two">
                                            <li><i class="fa fa-check-circle"></i> Secure Voter Database</li>
                                            <li><i class="fa fa-check-circle"></i> Real-time Poll Monitoring</li>
                                            <li><i class="fa fa-check-circle"></i> Transparent Result Management</li>
                                        </ul>
                                    </div>
                                    <div class="col-lg-6 col-md-6">
                                        <ul class="list-style-two">
                                            <li><i class="fa fa-check-circle"></i> AI-based Anomaly Detection</li>
                                            <li><i class="fa fa-check-circle"></i> Central Dashboard & Reports</li>
                                            <li><i class="fa fa-check-circle"></i> Deployment & Field Support</li>
                                        </ul>
                                    </div>
                                </div>

                                <div style="margin-top:18px;">
                                  <a href="contact.php?service=<?= urlencode($service['slug']) ?>" class="theme-btn header-style-btn"><span class="btn-title">Request Demo <i class="fa fa-arrow-right"></i></span></a>
                                  <a href="contact.php?service=<?= urlencode($service['slug']) ?>&inquiry=pricing" class="btn" style="margin-left:10px;">Get Pricing</a>
                                </div>

                                <!-- FAQ (static) -->
                                <div class="content-column col-lg-12 col-md-12 col-sm-12" style="margin-top:30px;">
                                    <div class="inner-column">
                                        <div class="sec-title pt-40">
                                            <h2 class="text-reveal-anim">Frequently Asked Question</h2>
                                        </div>                              
                                        <ul class="accordion-box-three">                  
                                            <li class="accordion block active-block">
                                                <div class="acc-btn active">Is this system compliant with Indian election norms?
                                                    <i class="icon fas fa-angle-right"></i>
                                                </div>
                                                <div class="acc-content current">
                                                    <div class="content">
                                                        <div class="text">Yes — Bharat Election software is designed to support compliance and auditability. We work closely with clients to meet local regulations.</div>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="accordion block">
                                                <div class="acc-btn">Do you provide training and deployment support?
                                                    <i class="icon fas fa-angle-right"></i>
                                                </div>
                                                <div class="acc-content">
                                                    <div class="content">
                                                        <div class="text">We provide full deployment, training, and on-site support packages tailored to your needs.</div>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>

                            </div>
                        <?php else: // GRID / LISTING VIEW ?>
                            <div class="service-content">
                                <h3 class="title">Bharat Election Software — Our Services</h3>
                                <p class="service-desc">Secure, auditable, India-focused election software modules. Click a service to view details.</p>
                            </div>

                            <div class="row" style="margin-top:18px;">
                                <?php
                                if (isset($gridRes) && $gridRes->num_rows > 0) {
                                    while ($s = $gridRes->fetch_assoc()) {
                                        $imgPath = (!empty($s['image']) && file_exists(__DIR__ . '/uploads/' . $s['image'])) ? 'uploads/' . $s['image'] : 'images/resource/ser-details.jpg';
                                        ?>
                                        <div class="col-lg-6 col-md-6 mb-4">
                                          <div class="card" style="padding:12px;">
                                            <img src="<?= e($imgPath) ?>" alt="<?= e($s['service_name']) ?>" style="width:100%;height:170px;object-fit:cover;border-radius:6px;">
                                            <h4 style="margin-top:10px;"><a href="service.php?slug=<?= e($s['slug']) ?>"><?= e($s['service_name']) ?></a></h4>
                                            <p class="small"><?= e(mb_substr($s['description'], 0, 140)) ?><?= (mb_strlen($s['description']) > 140) ? '...' : '' ?></p>
                                            <p><strong>Category:</strong> <?= e($s['category']) ?></p>
                                            <a class="btn btn-primary" href="service.php?slug=<?= e($s['slug']) ?>">View Details</a>
                                          </div>
                                        </div>
                                        <?php
                                    }
                                } else {
                                    echo '<p>No services found.</p>';
                                }
                                ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>                      
        </div>
    </div>
    </section>
    <!-- End Team / Service Section -->
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

<?php
include 'footer.php';

$sideStmt->close();
if (isset($gridStmt)) $gridStmt->close();
$conn->close();
?>
