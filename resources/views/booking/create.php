<section class="page-hero" style="padding:60px 24px">
  <div class="hero-ring hero-ring-1"></div>
  <div class="hero-ring hero-ring-2"></div>
  <div class="hero-ring hero-ring-3"></div>

  <div class="hero-badge"><i class="fas fa-calendar-check"></i> <?= __('booking.hero_badge') ?></div>

  <h1>Book <span class="orange"><?= locale_val_e($pkg, 'title') ?></span></h1>

  <p class="hero-sub"><?= __('booking.form_desc') ?></p>

  <div class="breadcrumb">
    <span><?= __('booking.breadcrumb_home') ?></span> <span>/</span> <a href="<?= base_url('packages') ?>" style="color:var(--primary)"><?= __('booking.breadcrumb_packages') ?></a> <span>/</span> <span class="current"><?= __('booking.breadcrumb_current') ?></span>
  </div>
</section>

<section class="contact-main">
  <div class="contact-side">
    <h3><?= __('booking.package_summary') ?></h3>

    <div style="background:rgba(255,255,255,0.06);border-radius:12px;padding:20px;margin-top:16px">
      <?php if ($pkg['image']): ?>
        <img src="<?= asset('storage/uploads/' . e($pkg['image'])) ?>" alt="<?= locale_val_e($pkg, 'title') ?>" style="width:100%;border-radius:8px;margin-bottom:16px">
      <?php endif; ?>

      <h4 style="margin:0 0 8px"><?= locale_val_e($pkg, 'title') ?></h4>
      <p style="opacity:0.7;font-size:14px;margin:0 0 12px"><?= e($pkg['category']) ?></p>

      <div style="display:flex;gap:16px;font-size:14px;flex-wrap:wrap">
        <span><strong>$<?= number_format($pkg['price']) ?></strong></span>
        <span><i class="far fa-clock"></i> <?= (int) $pkg['duration_days'] ?> days</span>
        <?php if ($pkg['max_people'] > 1): ?>
          <span><i class="fas fa-users"></i> Up to <?= (int) $pkg['max_people'] ?> people</span>
        <?php endif; ?>
        <?php if ($pkg['destination']): ?>
          <span><i class="fas fa-location-dot"></i> <?= locale_val_e($pkg, 'destination') ?></span>
        <?php endif; ?>
      </div>
    </div>

    <div style="margin-top:24px;padding:16px;background:rgba(255,255,255,0.04);border-radius:12px;font-size:13px;opacity:0.7">
      <p style="margin:0"><i class="fas fa-shield-alt"></i> <?= __('booking.secure_text') ?></p>
    </div>
  </div>

  <div class="contact-form-card">
    <h3><?= __('booking.form_title') ?></h3>
    <p><?= __('booking.form_desc') ?></p>

    <form id="bookingForm" novalidate>
      <?= csrf_field() ?>
      <input type="hidden" name="package_id" value="<?= (int) $pkg['id'] ?>">
      <input type="hidden" name="package_title" value="<?= locale_val_e($pkg, 'title') ?>">
      <input type="hidden" name="service" value="<?= e($pkg['category']) ?>">

      <div class="form-row">
        <div class="form-group">
          <label for="fullName"><?= __('booking.form_name') ?></label>
          <input type="text" id="fullName" name="full_name" placeholder="<?= __('contact.form_placeholder_name') ?>" required>
        </div>
        <div class="form-group">
          <label for="phone"><?= __('booking.form_phone') ?></label>
          <input type="tel" id="phone" name="phone" placeholder="<?= __('contact.form_placeholder_phone') ?>" required>
        </div>
      </div>

      <div class="form-group">
        <label for="email"><?= __('booking.form_email') ?></label>
        <input type="email" id="email" name="email" placeholder="your@email.com">
      </div>

      <div class="form-row">
        <div class="form-group">
          <label for="travel_date"><?= __('booking.form_travel_date') ?></label>
          <input type="date" id="travel_date" name="travel_date" required>
        </div>
        <div class="form-group">
          <label for="group_size"><?= __('booking.form_group_size') ?></label>
          <input type="number" id="group_size" name="group_size" min="1" max="100" value="1" required>
        </div>
      </div>

      <div class="form-group">
        <label for="message"><?= __('booking.form_message') ?></label>
        <textarea id="message" name="message" placeholder="Any special requirements, dietary needs, room preferences..." rows="3"></textarea>
      </div>

      <button type="submit" class="btn-primary" style="width:100%;">
        <?= __('booking.form_submit') ?> <i class="fas fa-arrow-right"></i>
      </button>
      <p class="form-status" id="formStatus" role="status"></p>
    </form>
  </div>
</section>

<?php
$bookingStoreUrl = base_url('booking/store');
$processingText = __('booking.form_processing');
$successText = __('booking.form_success');
$errorText = __('booking.form_error');
$networkErrorText = __('booking.form_network_error');
$page_scripts = <<<SCRIPT
<script>
document.getElementById('bookingForm').addEventListener('submit', function (e) {
  e.preventDefault();
  var form = this;
  if (!form.checkValidity()) {
    form.reportValidity();
    return;
  }
  var formData = new FormData(form);
  var status = document.getElementById('formStatus');
  var btn = form.querySelector('.btn-primary');
  var origHtml = btn.innerHTML;

  btn.innerHTML = '<i class="fas fa-spinner"></i> $processingText';
  btn.disabled = true;

  fetch('$bookingStoreUrl', {
    method: 'POST',
    body: formData,
  })
  .then(function (r) { return r.json(); })
  .then(function (data) {
    btn.disabled = false;
    btn.innerHTML = origHtml;
    if (data.success) {
      status.innerHTML = '<i class="fas fa-check-circle"></i> $successText';
      status.className = 'form-status visible success';
      window.location.href = data.redirect;
    } else {
      status.textContent = data.error || '$errorText';
      status.className = 'form-status visible error';
    }
  })
  .catch(function () {
    btn.disabled = false;
    btn.innerHTML = origHtml;
    status.textContent = '$networkErrorText';
    status.className = 'form-status visible error';
  });
});
</script>
SCRIPT;
?>
