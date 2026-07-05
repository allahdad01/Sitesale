<section class="page-hero" style="padding:80px 24px">
  <div class="hero-ring hero-ring-1"></div>
  <div class="hero-ring hero-ring-2"></div>
  <div class="hero-ring hero-ring-3"></div>

  <div class="hero-badge" style="background:rgba(46,204,113,0.15);color:#2ecc71">
    <i class="fas fa-check-circle"></i> <?= __('booking.confirm_heading') ?>
  </div>

  <h1>Thank You, <span class="orange"><?= e($booking['full_name']) ?></span></h1>

  <p class="hero-sub"><?= __('booking.confirm_desc') ?></p>
</section>

<section style="max-width:600px;margin:0 auto 80px;padding:0 24px">
  <div style="background:#fff;border-radius:16px;padding:40px;box-shadow:0 4px 24px rgba(0,0,0,0.06);text-align:center">
    <div style="font-size:64px;color:#2ecc71;margin-bottom:16px">
      <i class="fas fa-check-circle"></i>
    </div>

    <h2 style="margin:0 0 8px;font-size:24px"><?= __('booking.confirm_heading') ?></h2>

    <div style="font-size:28px;font-weight:700;font-family:monospace;color:var(--primary);letter-spacing:2px;margin:16px 0 24px;padding:16px;background:#faf8f0;border-radius:8px;display:inline-block">
      <?= e($booking['booking_ref']) ?>
    </div>

    <p style="opacity:0.7;margin:0 0 24px"><?= __('booking.confirm_desc') ?></p>

    <div style="text-align:left;border-top:1px solid #eee;padding-top:20px;margin-top:20px">
      <div style="display:grid;grid-template-columns:1fr 1fr;gap:12px;font-size:14px">
        <div><strong>Package:</strong><br><?= e($booking['package_title'] ?? '—') ?></div>
        <div><strong>Status:</strong><br><span style="color:var(--primary)"><?= __('booking.confirm_status') ?></span></div>
        <div><strong>Travel Date:</strong><br><?= e($booking['travel_date'] ?? '—') ?></div>
        <div><strong>Travelers:</strong><br><?= (int) $booking['group_size'] ?></div>
        <div><strong>Name:</strong><br><?= e($booking['full_name']) ?></div>
        <div><strong>Phone:</strong><br><?= e($booking['phone']) ?></div>
      </div>
    </div>

    <div style="margin-top:32px">
      <a href="<?= base_url() ?>" class="btn-primary" style="display:inline-flex;align-items:center;gap:8px;padding:14px 36px">
        <i class="fas fa-home"></i> <?= __('booking.confirm_back') ?>
      </a>
    </div>
  </div>
</section>
