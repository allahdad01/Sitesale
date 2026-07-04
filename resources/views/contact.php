<section class="page-hero">
  <div class="hero-ring hero-ring-1"></div>
  <div class="hero-ring hero-ring-2"></div>
  <div class="hero-ring hero-ring-3"></div>

  <div class="hero-badge"><i class="fas fa-headset"></i> We're Here To Help</div>

  <h1>Let's Plan Your<br><span class="orange">Next Journey</span></h1>

  <p class="hero-sub">Whether you need a full Umrah package, a flight ticket, or just some advice &mdash; reach out and our team will respond within 24 hours.</p>

  <div class="breadcrumb">
    <span>Home</span> <span>/</span> <span class="current">Contact Us</span>
  </div>
</section>

<section class="contact-cards">
  <span class="section-tag">Get In Touch</span>
  <h2 class="section-title">How To Reach Us</h2>
  <p class="section-desc">Choose the method that works best for you &mdash; we're available seven days a week.</p>

  <div class="contact-info-grid">
    <div class="contact-info-card">
      <div class="contact-info-icon"><i class="fas fa-phone"></i></div>
      <h4>Phone &amp; WhatsApp</h4>
      <p><span class="highlight">+93 700 000 000</span></p>
      <p>Call or message us anytime during business hours.</p>
    </div>
    <div class="contact-info-card">
      <div class="contact-info-icon"><i class="fas fa-envelope"></i></div>
      <h4>Email</h4>
      <p><span class="highlight">info@almoqadas.com</span></p>
      <p>Send us your inquiry and we'll reply within 24 hours.</p>
    </div>
    <div class="contact-info-card">
      <div class="contact-info-icon"><i class="fas fa-map-marker-alt"></i></div>
      <h4>Office Location</h4>
      <p><span class="highlight">Kabul, Afghanistan</span></p>
      <p>Visit us in person for a consultation.</p>
    </div>
    <div class="contact-info-card">
      <div class="contact-info-icon"><i class="fas fa-clock"></i></div>
      <h4>Business Hours</h4>
      <p><span class="highlight">Sat&ndash;Thu: 8 AM &ndash; 6 PM</span></p>
      <p>Friday: Closed</p>
    </div>
  </div>
</section>

<section class="contact-main">
  <div class="contact-side">
    <h3>Start Your Journey Here</h3>
    <p>Fill out the form and one of our travel consultants will get back to you with a personalized package.</p>

    <div class="contact-side-row">
      <div class="contact-side-icon"><i class="fas fa-phone"></i></div>
      <div>
        <h5>Phone / WhatsApp</h5>
        <p><a href="tel:+93700000000" style="color:rgba(255,255,255,0.5);text-decoration:none;">+93 700 000 000</a></p>
      </div>
    </div>
    <div class="contact-side-row">
      <div class="contact-side-icon"><i class="fas fa-envelope"></i></div>
      <div>
        <h5>Email</h5>
        <p><a href="mailto:info@almoqadas.com" style="color:rgba(255,255,255,0.5);text-decoration:none;">info@almoqadas.com</a></p>
      </div>
    </div>
    <div class="contact-side-row">
      <div class="contact-side-icon"><i class="fas fa-map-marker-alt"></i></div>
      <div>
        <h5>Office</h5>
        <p>Kabul, Afghanistan</p>
      </div>
    </div>

    <div class="contact-side-hours">
      <div class="hours-row"><span>Saturday &ndash; Thursday</span><span>8:00 AM &ndash; 6:00 PM</span></div>
      <div class="hours-row"><span>Friday</span><span>Closed</span></div>
    </div>
  </div>

  <div class="contact-form-card">
    <h3>Request a Package</h3>
    <p>Tell us about your travel plans and we'll create a custom quote.</p>

    <form id="contactForm" novalidate>
      <?= csrf_field() ?>
      <div class="form-row">
        <div class="form-group">
          <label for="fullName">Full Name</label>
          <input type="text" id="fullName" name="full_name" placeholder="Your full name" required>
        </div>
        <div class="form-group">
          <label for="phone">Phone / WhatsApp</label>
          <input type="tel" id="phone" name="phone" placeholder="+93 ..." required>
        </div>
      </div>
      <div class="form-group">
        <label for="email">Email (optional)</label>
        <input type="email" id="email" name="email" placeholder="your@email.com">
      </div>
      <div class="form-group">
        <label for="service">Service Required</label>
        <select id="service" name="service">
          <option value="">Select a service...</option>
          <option>Umrah Package</option>
          <option>Hajj Package</option>
          <option>Flight Booking</option>
          <option>Visa Services</option>
          <option>Hotel Reservation</option>
          <option>Custom Tour</option>
        </select>
      </div>
      <div class="form-group">
        <label for="message">Message</label>
        <textarea id="message" name="message" placeholder="Tell us about your travel plans, dates, group size, and any special requirements..." rows="4"></textarea>
      </div>
      <button type="submit" class="btn-primary" style="width:100%;">Send Enquiry <i class="fas fa-arrow-right"></i></button>
      <p class="form-status" id="formStatus" role="status"></p>
    </form>
  </div>
</section>

<section class="faq">
  <span class="section-tag">Common Questions</span>
  <h2 class="section-title">Frequently Asked Questions</h2>
  <p class="section-desc">Quick answers to the most common inquiries we receive.</p>

  <div class="faq-list">
    <div class="faq-item">
      <h4>What documents do I need for Umrah?</h4>
      <p>You need a valid passport (6+ months validity), passport-size photos, and a completed visa application form. We handle the rest.</p>
    </div>
    <div class="faq-item">
      <h4>How far in advance should I book?</h4>
      <p>We recommend booking at least 4&ndash;6 weeks before your desired travel date, especially during peak seasons like Ramadan.</p>
    </div>
    <div class="faq-item">
      <h4>Do you offer group discounts?</h4>
      <p>Yes! We offer special rates for groups of 5 or more travelers. Contact us for a custom group quote.</p>
    </div>
    <div class="faq-item">
      <h4>Can I customize my package?</h4>
      <p>Absolutely. Every package can be tailored to your preferences &mdash; hotel star rating, meal plans, extra city tours, and more.</p>
    </div>
    <div class="faq-item">
      <h4>What payment methods do you accept?</h4>
      <p>We accept bank transfers, cash payments at our office, and mobile money transfers. Contact us for details.</p>
    </div>
  </div>
</section>

<?php $page_scripts = <<<SCRIPT
<script>
document.getElementById('contactForm').addEventListener('submit', function (e) {
  e.preventDefault();
  var form = this;
  if (!form.checkValidity()) {
    form.reportValidity();
    return;
  }
  var formData = new FormData(form);
  var status = document.getElementById('formStatus');

  fetch('<?= base_url('contact/submit') ?>', {
    method: 'POST',
    body: formData,
  })
  .then(function (r) { return r.json(); })
  .then(function (data) {
    if (data.success) {
      status.textContent = 'Thank you! We have received your enquiry and will get back to you shortly.';
      status.className = 'form-status visible';
      form.reset();
    } else {
      status.textContent = data.error || 'Something went wrong. Please try again.';
      status.className = 'form-status visible error';
    }
  })
  .catch(function () {
    status.textContent = 'Network error. Please try again.';
    status.className = 'form-status visible error';
  });
});
</script>
SCRIPT;
?>
