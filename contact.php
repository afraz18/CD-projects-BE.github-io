<?php 
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
                                <h1 class="title">Contact Us</h1>
                            </div>
                            <ul class="breadcume-pull">
                                <li><a class="title-line" href="index.html">Home <span><i class="fas fa-angle-right"></i></span></a></li>
                                <li>Contact Us</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>   
      </section>
    <!-- End Breadcume Section -->


                        <!-- Contact Form -->
                        <section style="min-height: 100vh; display: flex; align-items: center; justify-content: center; background-color: #f5f5f5; padding: 60px 20px;">
  <div style="background: #fff; border-radius: 20px; box-shadow: 0 10px 40px rgba(0,0,0,0.1); width: 100%; max-width: 900px; padding: 60px;">
    <h2 style="text-align: center; font-size: 2.5rem; font-weight: 700; margin-bottom: 10px;">Contact Us</h2>
    <p style="text-align: center; color: #666; margin-bottom: 50px; font-size: 1.1rem;">
      Tell us about your project — we’ll get in touch with you shortly.
    </p>

    <form action="submit_contact.php" method="POST" style="display: grid; grid-template-columns: 1fr 1fr; gap: 25px;">
      <!-- Full Name -->
      <div class="form-group">
        <label for="fullname">Full Name</label>
        <input type="text" id="fullname" name="fullname" placeholder="Enter your full name" required>
      </div>

      <!-- Phone -->
      <div class="form-group">
        <label for="phone">Phone Number</label>
        <input type="tel" id="phone" name="phone" placeholder="Enter your phone number" required>
      </div>

      <!-- Email -->
      <div class="form-group">
        <label for="email">Email Address</label>
        <input type="email" id="email" name="email" placeholder="Enter your email address" required>
      </div>

      <!-- Party Name -->
      <div class="form-group">
        <label for="partyname">Party / Company Name</label>
        <input type="text" id="partyname" name="partyname" placeholder="Enter your company or party name">
      </div>

      <!-- Location -->
      <div class="form-group">
        <label for="location">Location</label>
        <input type="text" id="location" name="location" placeholder="Enter your location">
      </div>

      <!-- Project Name -->
      <div class="form-group">
        <label for="projectname">Project Name</label>
        <input type="text" id="projectname" name="projectname" placeholder="Enter your project name" required>
      </div>

      <!-- Budget -->
      <div class="form-group">
        <label for="budget">Estimated Budget</label>
        <select id="budget" name="budget" required>
          <option value="" disabled selected>Select budget</option>
          <option value="below_10k">Below ₹10,000</option>
          <option value="10k_50k">₹10,000 – ₹50,000</option>
          <option value="50k_1lakh">₹50,000 – ₹1,00,000</option>
          <option value="above_1lakh">Above ₹1,00,000</option>
        </select>
      </div>

      <!-- Timeline -->
      <div class="form-group">
        <label for="timeline">Project Timeline</label>
        <select id="timeline" name="timeline" required>
          <option value="" disabled selected>Select timeline</option>
          <option value="1month">Within 1 Month</option>
          <option value="3months">1–3 Months</option>
          <option value="6months">3–6 Months</option>
          <option value="flexible">Flexible</option>
        </select>
      </div>

      <!-- Message -->
      <div class="form-group" style="grid-column: span 2;">
        <label for="message">Tell Us About Your Project</label>
        <textarea id="message" name="message" rows="5" placeholder="Describe your project..." required></textarea>
      </div>

      <!-- Submit -->
      <div style="grid-column: span 2; text-align: center; margin-top: 20px;">
        <button type="submit" class="submit-btn">Send Message</button>
      </div>
    </form>
  </div>
</section>

<!-- Inline CSS -->
<style>
  .form-group {
    display: flex;
    flex-direction: column;
  }

  label {
    font-weight: 600;
    color: #333;
    margin-bottom: 8px;
    font-size: 1.05rem;
  }

  input, select, textarea {
    padding: 14px 16px;
    border: 1px solid #ccc;
    border-radius: 10px;
    font-size: 1rem;
    color: #333;
    background: #fdfdfd;
    transition: all 0.3s ease;
  }

  input::placeholder,
  textarea::placeholder {
    color: #aaa;
  }

  input:focus,
  select:focus,
  textarea:focus {
    border-color: #007bff;
    outline: none;
    box-shadow: 0 0 10px rgba(0, 123, 255, 0.15);
  }

  select {
    cursor: pointer;
  }

  .submit-btn {
    background: #000;
    color: #fff;
    border: none;
    padding: 16px 60px;
    font-size: 1.2rem;
    border-radius: 50px;
    cursor: pointer;
    transition: all 0.3s ease;
  }

  .submit-btn:hover {
    background: linear-gradient(90deg, #000, #333);
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(0,0,0,0.2);
  }
</style>

     <!-- End Contact Section -->


        <!-- Map Section -->
    <section class="map-section-three">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3719.764545224075!2d72.90531737457565!3d20.37242261087273!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3be0f7b39db83089%3A0x2b423a9f92a83e89!2sVapi%2C%20Gujarat!5e0!3m2!1sen!2sin!4v1730446200000!5m2!1sen!2sin" allowfullscreen=""></iframe>
    </section>
    <!-- End Map Section --> 

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

<!-- Mirrored from html.kodesolution.com/2025/onicx-html/page-contact.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 29 Oct 2025 09:37:45 GMT -->
</html>

<?php 
include 'footer.php';
?>