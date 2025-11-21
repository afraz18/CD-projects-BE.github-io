<?php 
include 'header.php';
?>

<!-- ==============================
      Page Hero Section
============================== -->
<section class="breadcume-section">
  <div class="outer-box">
    <div class="auto-container">
      <div class="row">
        <div class="col-lg-12">
          <div class="breadcumb-content text-center">
            <div class="breadcumb-title">
              <h1 class="title">Contact Bharat Election</h1>
              <p class="text-light mt-2">
                We’d love to connect with you. Whether you’re a political party, candidate, or campaign manager — we’re here to empower your election journey.
              </p>
            </div>
            <ul class="breadcume-pull justify-content-center">
              <li><a class="title-line" href="index.php">Home <span><i class="fas fa-angle-right"></i></span></a></li>
              <li>Contact Us</li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>   
</section>

<!-- ==============================
      Contact Section
============================== -->
<section class="contact-section bg-light py-5">
  <div class="auto-container">
    <div class="row align-items-center">

      <!-- Contact Info -->
      <div class="col-lg-5 mb-5 mb-lg-0">
        <div class="contact-info-box">
          <h3 class="mb-4 fw-bold text-primary">Get in Touch</h3>
          <p class="text-muted mb-4">
            Reach out to Bharat Election for custom digital election management, voter engagement, and campaign strategy services.
          </p>

          <div class="info-item mb-3">
            <h6><i class="fas fa-phone-alt me-2 text-primary"></i>Phone</h6>
            <p>+91 98765 43210</p>
          </div>

          <div class="info-item mb-3">
            <h6><i class="fas fa-envelope me-2 text-primary"></i>Email</h6>
            <p><a href="mailto:info@bharatelection.in">info@bharatelection.in</a></p>
          </div>

          <div class="info-item mb-3">
            <h6><i class="fas fa-map-marker-alt me-2 text-primary"></i>Office</h6>
            <p>Charaniya Development, Ahmedabad, Gujarat, India</p>
          </div>

          <ul class="social-icon list-inline mt-4">
            <li class="list-inline-item"><a href="#"><i class="fab fa-facebook-f"></i></a></li>
            <li class="list-inline-item"><a href="#"><i class="fab fa-x-twitter"></i></a></li>
            <li class="list-inline-item"><a href="#"><i class="fab fa-instagram"></i></a></li>
            <li class="list-inline-item"><a href="#"><i class="fab fa-linkedin-in"></i></a></li>
          </ul>
        </div>
      </div>

      <!-- Contact Form -->
      <div class="col-lg-7">
        <div class="contact-form bg-white p-4 shadow rounded">
          <h4 class="fw-bold mb-3 text-center">Let's Discuss Your Election Project</h4>

          <form method="post" action="contact-form.php" id="contact-form">
            <div class="row">
              <div class="form-group col-md-6 mb-3">
                <input type="text" name="name" class="form-control" placeholder="Full Name" required>
              </div>
              <div class="form-group col-md-6 mb-3">
                <input type="email" name="email" class="form-control" placeholder="Email Address" required>
              </div>
              <div class="form-group col-md-6 mb-3">
                <input type="text" name="phone" class="form-control" placeholder="Phone Number" required>
              </div>
              <div class="form-group col-md-6 mb-3">
                <input type="text" name="party_name" class="form-control" placeholder="Party / Organization Name" required>
              </div>
              <div class="form-group col-md-6 mb-3">
                <input type="text" name="location" class="form-control" placeholder="Location" required>
              </div>
              <div class="form-group col-md-6 mb-3">
                <select name="budget" class="form-select" required>
                  <option value="">Select Budget Range</option>
                  <option value="Below ₹25,000">Below ₹25,000</option>
                  <option value="₹25,000 - ₹50,000">₹25,000 - ₹50,000</option>
                  <option value="₹50,000 - ₹1,00,000">₹50,000 - ₹1,00,000</option>
                  <option value="₹1,00,000+">₹1,00,000+</option>
                </select>
              </div>
              <div class="form-group col-md-6 mb-3">
                <select name="timeline" class="form-select" required>
                  <option value="">Select Project Timeline</option>
                  <option value="Within 1 Week">Within 1 Week</option>
                  <option value="Within 2 Weeks">Within 2 Weeks</option>
                  <option value="Within 1 Month">Within 1 Month</option>
                  <option value="More than 1 Month">More than 1 Month</option>
                </select>
              </div>
              <div class="form-group col-12 mb-3">
                <input type="text" name="subject" class="form-control" placeholder="Subject" required>
              </div>
              <div class="form-group col-12 mb-3">
                <textarea name="message" class="form-control" rows="5" placeholder="Describe your election project..." required></textarea>
              </div>
              <div class="form-group col-12 text-center">
                <button type="submit" class="btn btn-primary px-5 py-2 rounded-pill">
                  Send Message
                </button>
              </div>
            </div>
          </form>
        </div>
      </div>

    </div>
  </div>
</section>

<!-- ==============================
      Map Section
============================== -->
<section class="map-section mt-5">
  <div class="auto-container">
    <iframe
      class="w-100 rounded shadow"
      height="400"
      src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3673.1456999999996!2d72.57136267433818!3d23.033585116481243!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x395e848a9b4e9b4d%3A0x8e23c84b7ecb5cf8!2sAhmedabad%2C%20Gujarat!5e0!3m2!1sen!2sin!4v1709056202568"
      style="border:0;"
      allowfullscreen=""
      loading="lazy"
      referrerpolicy="no-referrer-when-downgrade">
    </iframe>
  </div>
</section>

<?php include 'footer.php'; ?>
