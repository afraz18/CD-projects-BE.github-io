<?php
// campaign-details.php (robust debug-friendly version)
// Save as UTF-8 without BOM.

ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(E_ALL);

include 'header.php';
require_once 'config.php';

// Quick validation for $conn
if (!isset($conn) || !($conn instanceof mysqli)) {
    echo '<div style="padding:20px;background:#fee;border:1px solid #f99;margin:20px;">';
    echo '<strong>Database connection ($conn) not found.</strong><br>';
    echo 'Open <code>config.php</code> and ensure it sets <code>$conn = mysqli_connect(...)</code>.';
    echo '</div>';
    include 'footer.php';
    exit;
}

// Helper to safely echo HTML attributes
function h($v){ return htmlspecialchars($v, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8'); }

// Get slug from URL
$slug = isset($_GET['page']) ? trim($_GET['page']) : '';

// If no slug provided, pick the first active campaign by position
if ($slug === '') {
    $q0 = "SELECT slug FROM campaign_pages WHERE status='active' ORDER BY position ASC, id ASC LIMIT 1";
    $r0 = mysqli_query($conn, $q0);
    if ($r0 && $row0 = mysqli_fetch_assoc($r0)) {
        $slug = $row0['slug'];
    } else {
        // nothing found — show a friendly message
        echo '<section class="error-section"><div class="auto-container"><h2>No campaign pages found</h2><p>Please add rows to <code>campaign_pages</code> table.</p></div></section>';
        include 'footer.php';
        exit;
    }
}

// Prepare and fetch the page row safely
$page = null;
$sql = "SELECT id, title, slug, banner_image, short_description, full_content, created_at FROM campaign_pages WHERE slug = ? AND status = 'active' LIMIT 1";
if ($stmt = mysqli_prepare($conn, $sql)) {
    mysqli_stmt_bind_param($stmt, 's', $slug);
    mysqli_stmt_execute($stmt);

    // Try to use mysqli_stmt_get_result if available
    if (function_exists('mysqli_stmt_get_result')) {
        $res = mysqli_stmt_get_result($stmt);
        if ($res) $page = mysqli_fetch_assoc($res);
    } else {
        // fallback for installations without mysqlnd
        mysqli_stmt_bind_result($stmt, $id, $title, $fslug, $banner_image, $short_description, $full_content, $created_at);
        if (mysqli_stmt_fetch($stmt)) {
            $page = [
                'id' => $id,
                'title' => $title,
                'slug' => $fslug,
                'banner_image' => $banner_image,
                'short_description' => $short_description,
                'full_content' => $full_content,
                'created_at' => $created_at
            ];
        }
    }
    mysqli_stmt_close($stmt);
} else {
    echo '<div style="padding:16px;background:#fee;border:1px solid #f99;margin:20px;">';
    echo '<strong>SQL prepare failed:</strong> ' . h(mysqli_error($conn));
    echo '</div>';
    include 'footer.php';
    exit;
}

// If still no page found
if (!$page) {
    echo '<section class="error-section"><div class="auto-container"><h2>Page not found</h2><p>The requested campaign page does not exist or is inactive.</p></div></section>';
    include 'footer.php';
    exit;
}

// At this point $page contains campaign data — render it
?>
<!-- Breadcumb Section -->
<section class="breadcume-section">
  <div class="outer-box">
    <div class="auto-container">
      <div class="row">
        <div class="col-lg-12">
          <div class="breadcumb-content">
            <div class="breadcumb-title">
              <h1 class="title"><?php echo h($page['title']); ?></h1>
            </div>
            <ul class="breadcume-pull">
              <li><a class="title-line" href="index.php">Home <span><i class="fas fa-angle-right"></i></span></a></li>
              <li><?php echo h($page['title']); ?></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- End Breadcumb Section -->

<!-- Campaign Details Section -->
<section class="blog-details-section">
  <div class="auto-container">
    <div class="row">
      <div class="contents-column col-lg-8">
        <div class="row">
          <div class="col-lg-12">
            <div class="blog-content">
              <h2 class="title"><?php echo h($page['title']); ?></h2>
              <ul class="blog-author">
                <li class="autor-date"><?php echo !empty($page['created_at']) ? h(date('F j, Y', strtotime($page['created_at']))) : ''; ?></li>
                <li class="author-name">By Election Care Team</li>
              </ul>
            </div>

            <?php if (!empty($page['banner_image'])): ?>
              <div class="image-box">
                <figure class="image">
                  <img src="uploads/<?php echo h($page['banner_image']); ?>" alt="<?php echo h($page['title']); ?>">
                </figure>
              </div>
            <?php endif; ?>

            <div class="expert-desc">
              <?php 
                // full_content is stored as HTML. If you didn't store HTML, wrap with nl2br(h(...))
                echo $page['full_content'];
              ?>
            </div>
          </div>
        </div>
      </div>

      <!-- Sidebar -->
      <div class="col-lg-4">
        <aside class="blog-sidebar-area">
          <div class="blog-post">
            <h3 class="title">All Campaigns</h3>
            <div class="recent-post-wrap">
              <?php
              $q = "SELECT title, slug FROM campaign_pages WHERE status='active' ORDER BY position ASC, id ASC";
              $r = mysqli_query($conn, $q);
              if ($r && mysqli_num_rows($r) > 0):
                while ($row = mysqli_fetch_assoc($r)): ?>
                  <div class="recent-post">
                    <div class="post-content">
                      <h4 class="post-title">
                        <a href="campaign-details.php?page=<?php echo h($row['slug']); ?>">
                          <?php echo h($row['title']); ?>
                        </a>
                      </h4>
                    </div>
                  </div>
                <?php endwhile;
              else: ?>
                <p>No other campaigns available.</p>
              <?php endif; ?>
            </div>
          </div>

          <div class="blog-categories mt-4">
            <h3 class="title">Quick Links</h3>
            <ul>
              <li><a href="about.php">About Us</a></li>
              <li><a href="contact.php">Contact</a></li>
              <li><a href="blog.php">Blog</a></li>
            </ul>
          </div>
        </aside>
      </div>
    </div>
  </div>
</section>
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

<!-- Mirrored from html.kodesolution.com/2025/onicx-html/blog-details.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 29 Oct 2025 09:38:17 GMT -->
</html>
<?php 
include 'footer.php';
?>
