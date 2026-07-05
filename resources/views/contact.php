<section class="page-hero">
  <div class="hero-ring hero-ring-1"></div>
  <div class="hero-ring hero-ring-2"></div>
  <div class="hero-ring hero-ring-3"></div>

  <div class="hero-badge"><i class="fas fa-headset"></i> <?= e(setting('contact_hero_badge', "We're Here To Help")) ?></div>

  <h1><?= setting('contact_hero_title', "Let's Plan Your<br><span class=\"orange\">Next Journey</span>") ?></h1>

  <p class="hero-sub"><?= e(setting('contact_hero_subtitle', 'Whether you need a full Umrah package, a flight ticket, or just some advice — reach out and our team will respond within 24 hours.')) ?></p>

  <div class="breadcrumb">
    <span><?= __('contact_page.breadcrumb_home') ?></span> <span>/</span> <span class="current"><?= __('contact_page.breadcrumb_current') ?></span>
  </div>
</section>

<section class="contact-main">
  <div class="contact-side">
    <div class="contact-side-header">
      <span class="contact-side-badge"><i class="fas fa-comment-dots"></i> <?= e(setting('contact_sidebar_badge', 'Get In Touch')) ?></span>
      <h3><?= e(setting('contact_sidebar_heading', "We'd Love to Hear From You")) ?></h3>
      <p><?= e(setting('contact_sidebar_text', 'Our travel consultants are ready to help plan your perfect journey.')) ?></p>
    </div>

    <div class="contact-side-divider"></div>

    <div class="contact-side-row">
      <div class="contact-side-icon"><i class="fas fa-phone"></i></div>
      <div>
        <h5><?= __('contact_page.phone_label') ?></h5>
        <p><a href="tel:<?= e(preg_replace('/[^\d+]/', '', setting('contact_phone', '+93 700 000 000'))) ?>"><?= e(setting('contact_phone', '+93 700 000 000')) ?></a></p>
      </div>
    </div>
    <div class="contact-side-row">
      <div class="contact-side-icon"><i class="fas fa-envelope"></i></div>
      <div>
        <h5><?= __('contact_page.email_label') ?></h5>
        <p><a href="mailto:<?= e(setting('contact_email', 'info@almoqadas.com')) ?>"><?= e(setting('contact_email', 'info@almoqadas.com')) ?></a></p>
      </div>
    </div>
    <div class="contact-side-row">
      <div class="contact-side-icon"><i class="fas fa-map-marker-alt"></i></div>
      <div>
        <h5><?= __('contact_page.office_label') ?></h5>
        <p><?= e(setting('contact_address', 'Kabul, Afghanistan')) ?></p>
      </div>
    </div>

    <div class="contact-side-hours">
      <div class="hours-row"><span><?= __('contact_page.hours_sat_thu') ?></span><span><?= e(setting('contact_hours_week', '8:00 AM – 6:00 PM')) ?></span></div>
      <div class="hours-row"><span><?= __('contact_page.hours_friday') ?></span><span><?= e(setting('contact_hours_friday', 'Closed')) ?></span></div>
    </div>
  </div>

  <div class="contact-form-card">
    <div class="contact-form-card-header">
      <span class="form-badge"><i class="fas fa-paper-plane"></i> <?= e(setting('contact_form_badge', 'Send Us a Message')) ?></span>
      <h3><?= e(setting('contact_form_heading', 'Request a Package')) ?></h3>
      <p><?= e(setting('contact_form_text', "Tell us about your travel plans and we'll create a custom quote.")) ?></p>
    </div>

    <form id="contactForm" novalidate>
      <?= csrf_field() ?>
      <div class="form-row">
        <div class="form-group">
          <label for="fullName"><?= __('contact.form_name') ?></label>
          <input type="text" id="fullName" name="full_name" placeholder="<?= __('contact.form_placeholder_name') ?>" required>
        </div>
        <div class="form-group">
          <label for="phone"><?= __('contact.form_phone') ?></label>
          <input type="tel" id="phone" name="phone" placeholder="<?= __('contact.form_placeholder_phone') ?>" required>
        </div>
      </div>
      <div class="form-group">
        <label for="email"><?= __('booking.form_email') ?></label>
        <input type="email" id="email" name="email" placeholder="your@email.com">
      </div>
      <div class="form-group">
        <label for="service"><?= __('contact.form_service') ?></label>
        <select id="service" name="service">
          <option value=""><?= __('contact_page.form_select') ?></option>
          <option><?= __('contact.form_umrah') ?></option>
          <option><?= __('contact.form_hajj') ?></option>
          <option><?= __('contact.form_flight') ?></option>
          <option><?= __('contact.form_visa') ?></option>
          <option><?= __('contact.form_hotel') ?></option>
          <option><?= __('contact.form_tour') ?></option>
        </select>
      </div>
      <div class="form-group">
        <label for="message"><?= __('contact.form_message') ?></label>
        <textarea id="message" name="message" placeholder="<?= __('contact.form_placeholder_message') ?>" rows="4"></textarea>
      </div>
      <button type="submit" class="btn-primary" style="width:100%;"><?= __('contact.form_submit') ?> <i class="fas fa-arrow-right"></i></button>
      <p class="form-status" id="formStatus" role="status"></p>
    </form>
  </div>
</section>

<section class="faq">
  <span class="section-tag"><?= e(setting('contact_faq_tag', 'Common Questions')) ?></span>
  <h2 class="section-title"><?= e(setting('contact_faq_title', 'Frequently Asked Questions')) ?></h2>
  <p class="section-desc"><?= e(setting('contact_faq_desc', 'Quick answers to the most common inquiries we receive.')) ?></p>

  <div class="faq-list">
    <?php foreach ($faqs as $f): ?>
    <div class="faq-item">
      <button class="faq-question" onclick="toggleFaq(this)">
        <span><?= locale_val_e($f, 'question') ?></span>
        <i class="fas fa-chevron-down"></i>
      </button>
      <div class="faq-answer">
        <p><?= locale_val_e($f, 'answer') ?></p>
      </div>
    </div>
    <?php endforeach; ?>
  </div>
</section>

<?php
$contactSubmitUrl = base_url('contact/submit');
$successText = __('contact.form_success');
$errorText = __('contact.form_error');
$networkErrorText = __('contact.form_network_error');
$page_scripts = <<<SCRIPT
<script>
function toggleFaq(btn) {
  var item = btn.parentElement;
  var isOpen = item.classList.contains('faq-open');
  document.querySelectorAll('.faq-item.faq-open').forEach(function (el) {
    el.classList.remove('faq-open');
  });
  if (!isOpen) item.classList.add('faq-open');
}

document.getElementById('contactForm').addEventListener('submit', function (e) {
  e.preventDefault();
  var form = this;
  if (!form.checkValidity()) {
    form.reportValidity();
    return;
  }
  var formData = new FormData(form);
  var status = document.getElementById('formStatus');

  fetch('$contactSubmitUrl', {
    method: 'POST',
    body: formData,
  })
  .then(function (r) { return r.json(); })
  .then(function (data) {
    if (data.success) {
      status.textContent = '$successText';
      status.className = 'form-status visible';
      form.reset();
    } else {
      status.textContent = data.error || '$errorText';
      status.className = 'form-status visible error';
    }
  })
  .catch(function () {
    status.textContent = '$networkErrorText';
    status.className = 'form-status visible error';
  });
});
</script>
SCRIPT;
?>
