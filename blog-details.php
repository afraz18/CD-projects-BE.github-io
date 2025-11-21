<?php
// blog-details.php
// Dynamic blog details page — integrated with your template.

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include 'header.php';
require_once 'config.php';

if (!isset($conn) || !($conn instanceof mysqli)) {
    die('Database connection ($conn) not found. Edit config.php to set $conn = mysqli_connect(...);');
}

// Helpers
function e($v) { return htmlspecialchars((string)$v, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8'); }
function blog_image_src($imgVal) {
    if (empty($imgVal)) return 'images/resource/b1.jpg';
    if (filter_var($imgVal, FILTER_VALIDATE_URL)) return $imgVal;
    return 'uploads/' . basename($imgVal);
}

// Get blog ID
$post_id = isset($_GET['id']) && is_numeric($_GET['id']) ? (int)$_GET['id'] : 0;
if (!$post_id) {
    $res = mysqli_query($conn, "SELECT id FROM blogs ORDER BY created_at DESC LIMIT 1");
    if ($res && $r = mysqli_fetch_assoc($res)) $post_id = (int)$r['id'];
}

// Fetch post
$post = null;
if ($post_id) {
    $sql = "SELECT id, tittle AS title, description, image, author, created_at FROM blogs WHERE id = ? LIMIT 1";
    if ($stmt = mysqli_prepare($conn, $sql)) {
        mysqli_stmt_bind_param($stmt, 'i', $post_id);
        mysqli_stmt_execute($stmt);
        $res = mysqli_stmt_get_result($stmt);
        if ($res) $post = mysqli_fetch_assoc($res);
        mysqli_stmt_close($stmt);
    } else {
        die('Prepare failed: ' . mysqli_error($conn));
    }
}

// Fetch recent posts
$recent_posts = [];
$q = "SELECT id, tittle AS title, created_at FROM blogs ORDER BY created_at DESC LIMIT 5";
if ($rs = mysqli_query($conn, $q)) {
    while ($r = mysqli_fetch_assoc($rs)) $recent_posts[] = $r;
}
?>

<!-- Breadcume Section -->
<section class="breadcume-section">
    <div class="outer-box">
        <div class="auto-container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcumb-content">
                        <div class="breadcumb-title">
                            <h1 class="title">Blogs Details</h1>
                        </div>
                        <ul class="breadcume-pull">
                            <li><a class="title-line" href="index.html">Home <span><i class="fas fa-angle-right"></i></span></a></li>
                            <li>Blogs Details</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End Breadcume Section -->


<!-- Blog Details Section -->
<section class="blog-details-section">
    <div class="auto-container">
        <div class="row">

            <!-- Blog Content Column -->
            <div class="contents-column col-lg-8 col-md-12 col-sm-12">
                <div class="blog-content">

                    <!-- Title & Meta -->
                    <h2 class="title">
                        <?php echo $post ? e($post['title']) : 'Post not found'; ?>
                    </h2>

                    <ul class="blog-author">
                        <li class="autor-date">
                            <?php echo ($post && !empty($post['created_at'])) ? e(date('F j, Y', strtotime($post['created_at']))) : ''; ?>
                        </li>
                        <li class="author-name">
                            By <?php echo $post && !empty($post['author']) ? e($post['author']) : 'Admin'; ?>
                        </li>
                        <li class="author-comment">Do it yourself</li>
                        <?php if ($post): ?>
                            <li class="author-credit">ID: <?php echo (int)$post['id']; ?></li>
                        <?php endif; ?>
                    </ul>

                    <!-- Image -->
                    <div class="image-box">
                        <figure class="image">
                            <?php $imgSrc = $post && !empty($post['image']) ? blog_image_src($post['image']) : 'images/resource/b1.jpg'; ?>
                            <img src="<?php echo e($imgSrc); ?>" alt="<?php echo $post ? e($post['title']) : 'Image'; ?>">
                        </figure>
                    </div>

                    <!-- Likes / Comments -->
                    <ul class="blog-author-coment">
                        <li class="autor-like"><i class="icon far fa-heart"></i> 0 Likes</li>
                        <li class="author-coment"><i class="icon far fa-comments"></i> Comments (0)</li>
                    </ul>

                    <!-- Blog Description -->
                    <div class="expert-desc mt-4">
                        <?php 
                        if ($post && isset($post['description']) && $post['description'] !== '') {
                            if ($post['description'] !== strip_tags($post['description'])) {
                                echo $post['description'];
                            } else {
                                echo '<p>' . nl2br(e($post['description'])) . '</p>';
                            }
                        } else {
                            echo '<p>Content not available for this post.</p>';
                        }
                        ?>
                    </div>

                    <?php
// Handle comment form submission
$successMsg = '';
$errorMsg = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['name'])) {
    $name    = htmlspecialchars(trim($_POST['name']));
    $email   = htmlspecialchars(trim($_POST['email']));
    $subject = htmlspecialchars(trim($_POST['subject']));
    $message = htmlspecialchars(trim($_POST['message']));

    if (!empty($name) && !empty($email) && !empty($message)) {
        $stmt = $conn->prepare("INSERT INTO blog_messages (blog_id, name, email, subject, message) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("issss", $post_id, $name, $email, $subject, $message);
        if ($stmt->execute()) {
            $successMsg = "✅ Thank you! Your comment has been submitted successfully.";
        } else {
            $errorMsg = "❌ Something went wrong. Please try again.";
        }
        $stmt->close();
    } else {
        $errorMsg = "⚠️ Please fill in all required fields.";
    }
}
?>


                    <!-- Contact Form -->
                    <div class="contact-form-four mt-5">
                        <h4 class="mb-3">Leave a Comment</h4>
                        <form method="post" action="#" id="contact-form">
                            <div class="row">
                                <div class="form-group col-lg-12">
                                    <textarea name="message" placeholder="Write a Message" required></textarea>
                                </div>
                                <div class="form-group col-lg-6">
                                    <input type="text" name="name" placeholder="Your Name" required>
                                </div>
                                <div class="form-group col-lg-6">
                                    <input type="email" name="email" placeholder="Email Address" required>
                                </div>
                                <div class="form-group col-lg-12">
                                    <input type="text" name="subject" placeholder="Subject" required>
                                </div>
                                <div class="form-group col-lg-12">
                                    <div class="btn-box">
                                        <button class="theme-btn btn-style-five"><span class="btn-title">Send Message</span></button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- End Contact Form -->
                </div>
            </div>

            <!-- Sidebar Column -->
            <div class="col-lg-4 col-md-12 col-sm-12">
                <aside class="blog-sidebar">

                    <!-- Search Widget -->
                    <div class="widget widget_search">
                        <div class="search">
                            <form action="#" method="POST">
                                <input type="text" name="s" placeholder="Search here..." required>
                                <button type="submit" class="icons">Search</button>
                            </form>
                        </div>
                    </div>

                    <!-- Recent Posts -->
                    <div class="blog-post mt-4">
                        <h3 class="title">Recent Posts</h3>
                        <div class="recent-post-wrap">
                            <?php if (empty($recent_posts)): ?>
                                <p>No recent posts.</p>
                            <?php else: ?>
                                <?php foreach ($recent_posts as $rp): ?>
                                    <div class="recent-post mb-3 d-flex">
                                        <div class="post-img me-3">
                                            <a href="blog-details.php?id=<?php echo (int)$rp['id']; ?>">
                                                <img src="images/resource/sidebar.jpg" alt="post img" style="width: 70px; height: 70px; object-fit: cover;">
                                            </a>
                                        </div>
                                        <div class="post-content">
                                            <h4 class="post-title mb-1">
                                                <a href="blog-details.php?id=<?php echo (int)$rp['id']; ?>"><?php echo e($rp['title']); ?></a>
                                            </h4>
                                            <div class="post-date text-muted">
                                                <i class="icon far fa-calendar"></i>
                                                <?php echo e(date('M j, Y', strtotime($rp['created_at']))); ?>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </div>
                    </div>

                    <!-- Archive -->
                    <div class="blog-categories mt-4">
                        <h3 class="title">Archive</h3>
                        <ul>
                            <li><a href="#">January 2025</a> <span>(16)</span></li>
                            <li><a href="#">February 2025</a> <span>(12)</span></li>
                            <li><a href="#">March 2025</a> <span>(8)</span></li>
                        </ul>
                    </div>

                    <!-- Tags -->
                    <div class="widget_tag_cloud mt-4">
                        <h3 class="title">Tags</h3>
                        <div class="tagcloud">
                            <a href="#">Election</a>
                            <a href="#">Survey</a>
                            <a href="#">Politics</a>
                            <a href="#">Research</a>
                            <a href="#">Analysis</a>
                        </div>
                    </div>
                </aside>
            </div>

        </div>
    </div>
</section>
<!-- End Blog Details Section -->

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