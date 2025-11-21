<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

include 'config.php';
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
                                <h1 class="title">Frequently Asked Questions</h1>
                            </div>
                            <ul class="breadcume-pull">
                                <li><a class="title-line" href="index.php">Home <span><i class="fas fa-angle-right"></i></span></a></li>
                                <li>Frequently Asked Questions</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
      </section>
    <!-- End Breadcume Section -->

    <!-- Faq Section -->
    <section class="faq-section style-faq">
        <div class="shape-2"></div>
        <div class="shape-3"></div>
        <div class="auto-container">
            <div class="row">
                <!-- Content Column -->
                 <div class="content-column col-lg-12 col-md-12 col-sm-12 wow fadeInLeft" data-wow-delay="200ms">
                    <div class="inner-column">

<?php
if (!isset($conn) || !$conn) {
    echo '<div class="alert alert-danger">Database connection not found. Please check config.php.</div>';
} else {

    $sql = "SELECT id, questions, answers, section FROM `faq` ORDER BY section ASC, id ASC";
    $res = mysqli_query($conn, $sql);

    if ($res === false) {
        echo '<div class="alert alert-danger">Query error: ' . htmlspecialchars(mysqli_error($conn)) . '</div>';
    } else {
    
        $faqs_by_section = [];
        while ($row = mysqli_fetch_assoc($res)) {
            $sec = $row['section'] ?: 'general';
            if (!isset($faqs_by_section[$sec])) $faqs_by_section[$sec] = [];
            $faqs_by_section[$sec][] = $row;
        }

        if (empty($faqs_by_section)) {
            echo '<p>No FAQs found.</p>';
        } else {
 
            foreach ($faqs_by_section as $section => $faqs) {
       
                $section_title = ucwords(str_replace(['-','_'], ' ', $section));
                echo "<div class=\"faq-section-block\" style=\"margin-bottom:40px;\">\n";
                echo "  <div class=\"sec-title\"><h3 class=\"sub-title\">".htmlspecialchars($section_title)."</h3></div>\n";
                echo "  <ul class=\"accordion-box-four\">\n";

                foreach ($faqs as $index => $f) {
                    $qid = (int)$f['id'];
                    $question = htmlspecialchars($f['questions'], ENT_QUOTES, 'UTF-8');
                    $answer = nl2br(htmlspecialchars($f['answers'], ENT_QUOTES, 'UTF-8'));
                    
                    $activeClass = ($index === 0) ? 'accordion block active-block' : 'accordion block';
                    $btnActive   = ($index === 0) ? 'acc-btn active' : 'acc-btn';
                    $contentAct  = ($index === 0) ? 'acc-content current' : 'acc-content';
                    $num = str_pad($index + 1, 2, '0', STR_PAD_LEFT);

                    echo "    <li class=\"{$activeClass}\">\n";
                    echo "      <div class=\"{$btnActive}\">{$num}. {$question}\n";
                    echo "        <i class=\"icon fa fa-plus\"></i>\n";
                    echo "      </div>\n";
                    echo "      <div class=\"{$contentAct}\">\n";
                    echo "        <div class=\"content\">\n";
                    echo "          <div class=\"text\">{$answer}</div>\n";
                    echo "        </div>\n";
                    echo "      </div>\n";
                    echo "    </li>\n";
                }

                echo "  </ul>\n";
                echo "</div>\n";
            }
        }
    }
}
?>

                    </div>
                 </div>
            </div>
        </div>
    </section>
    <!-- End Faq Section -->

 
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

<!-- Mirrored from html.kodesolution.com/2025/onicx-html/faq.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 29 Oct 2025 09:37:58 GMT -->
</html>


<?php 
include 'footer.php';
?>