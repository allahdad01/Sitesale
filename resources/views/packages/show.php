<?php
  $pkgInclusions = function($desc) {
    preg_match_all('/<li>(.*?)<\/li>/s', $desc, $matches);
    return $matches[1] ?? [];
  };
  $inclusions = $pkgInclusions($pkg['description']);
  $descText = strip_tags($pkg['description'], '<p><br><strong><em><b><i><u><a><ul><ol><li><h2><h3><h4><blockquote>');
?>
<section class="page-hero">
  <div class="hero-ring hero-ring-1"></div>
  <div class="hero-ring hero-ring-2"></div>
  <div class="hero-ring hero-ring-3"></div>

  <div class="hero-badge"><i class="fas fa-mosque"></i> <?= e(ucfirst($pkg['category'])) ?></div>

  <h1><?= e($pkg['title']) ?></h1>

  <p class="hero-sub"><?= e(mb_substr(strip_tags($pkg['description']), 0, 160)) ?>...</p>

  <div class="breadcrumb">
    <span><a href="<?= base_url('') ?>" style="color:inherit;text-decoration:none;">Home</a></span>
    <span>/</span>
    <span><a href="<?= base_url('packages') ?>" style="color:inherit;text-decoration:none;">Packages</a></span>
    <span>/</span>
    <span class="current"><?= e($pkg['title']) ?></span>
  </div>
</section>

<section class="package-detail">
  <div class="package-detail-layout">
    <div class="package-detail-main">
      <?php if ($pkg['image']): ?>
      <div class="package-detail-image">
        <img src="<?= asset('storage/uploads/' . e($pkg['image'])) ?>" alt="<?= e($pkg['title']) ?>">
      </div>
      <?php endif; ?>

      <?php if ($descText): ?>
      <div class="package-detail-desc">
        <?= $descText ?>
      </div>
      <?php endif; ?>
    </div>

    <aside class="package-detail-sidebar">
      <div class="pkg-sidebar-card">
        <div class="pkg-sidebar-price">
          $<?= number_format($pkg['price']) ?>
          <span>per person</span>
        </div>

        <div class="pkg-sidebar-stats">
          <div class="pkg-stat">
            <div class="pkg-stat-icon"><i class="fas fa-clock"></i></div>
            <div>
              <div class="pkg-stat-value"><?= (int) $pkg['duration_days'] ?> <?= (int) $pkg['duration_days'] === 1 ? 'day' : 'days' ?></div>
              <div class="pkg-stat-label">Duration</div>
            </div>
          </div>
          <div class="pkg-stat">
            <div class="pkg-stat-icon"><i class="fas fa-users"></i></div>
            <div>
              <div class="pkg-stat-value"><?= (int) $pkg['max_people'] ?> pax</div>
              <div class="pkg-stat-label">Max Group</div>
            </div>
          </div>
          <div class="pkg-stat">
            <div class="pkg-stat-icon"><i class="fas fa-location-dot"></i></div>
            <div>
              <div class="pkg-stat-value"><?= e($pkg['destination'] ?: '—') ?></div>
              <div class="pkg-stat-label">Destination</div>
            </div>
          </div>
          <div class="pkg-stat">
            <div class="pkg-stat-icon"><i class="fas fa-tag"></i></div>
            <div>
              <div class="pkg-stat-value"><?= e(ucfirst($pkg['category'])) ?></div>
              <div class="pkg-stat-label">Category</div>
            </div>
          </div>
        </div>

        <?php if (!empty($inclusions)): ?>
        <div class="pkg-sidebar-inclusions">
          <h4>What's Included</h4>
          <ul>
            <?php foreach ($inclusions as $inc): ?>
              <li><?= e(strip_tags($inc)) ?></li>
            <?php endforeach; ?>
          </ul>
        </div>
        <?php endif; ?>

        <a href="<?= base_url('packages/' . e($pkg['slug']) . '/book') ?>" class="btn-primary" style="display:flex;align-items:center;justify-content:center;gap:8px;width:100%;text-align:center;">
          Book This Package <i class="fas fa-arrow-right"></i>
        </a>

        <p style="font-size:12px;color:var(--muted);text-align:center;margin-top:12px;">
          <i class="fas fa-shield-halved"></i> Secure booking · No hidden fees
        </p>
      </div>

      <a href="<?= base_url('packages') ?>" class="pkg-back-link">
        <i class="fas fa-arrow-left"></i> Back to all packages
      </a>
    </aside>
  </div>
</section>

<style>
.package-detail {
  background: var(--bg);
  padding: 60px 24px 100px;
}
.package-detail-layout {
  max-width: 1180px;
  margin: 0 auto;
  display: grid;
  grid-template-columns: 1fr 380px;
  gap: 40px;
  align-items: start;
}
.package-detail-main {
  min-width: 0;
}
.package-detail-image {
  border-radius: 16px;
  overflow: hidden;
  margin-bottom: 36px;
  box-shadow: 0 8px 32px rgba(42,42,104,0.12);
}
.package-detail-image img {
  width: 100%;
  height: 420px;
  object-fit: cover;
  display: block;
}
.package-detail-desc {
  background: var(--white);
  border-radius: 16px;
  padding: 40px;
  box-shadow: 0 4px 20px rgba(42,42,104,0.06);
  font-size: 16px;
  line-height: 1.85;
  color: var(--text);
}
.package-detail-desc h2,
.package-detail-desc h3,
.package-detail-desc h4 {
  font-family: 'Amiri', serif;
  color: var(--navy);
  margin: 28px 0 12px;
}
.package-detail-desc h2 { font-size: 26px; }
.package-detail-desc h3 { font-size: 22px; }
.package-detail-desc p { margin-bottom: 16px; }
.package-detail-desc ul, .package-detail-desc ol { margin: 0 0 16px; padding-left: 24px; }
.package-detail-desc li { margin-bottom: 6px; }
.package-detail-desc blockquote {
  border-left: 4px solid var(--primary);
  padding: 16px 20px;
  margin: 24px 0;
  background: rgba(254,89,11,0.04);
  border-radius: 0 12px 12px 0;
  color: var(--muted);
  font-style: italic;
}

/* Sidebar */
.package-detail-sidebar {
  position: sticky;
  top: 96px;
}
.pkg-sidebar-card {
  background: var(--white);
  border-radius: 16px;
  padding: 32px;
  box-shadow: 0 4px 24px rgba(42,42,104,0.10);
}
.pkg-sidebar-price {
  font-family: 'Amiri', serif;
  font-size: 40px;
  font-weight: 700;
  color: var(--navy);
  text-align: center;
  padding-bottom: 24px;
  border-bottom: 1px solid rgba(0,0,0,0.06);
  margin-bottom: 24px;
}
.pkg-sidebar-price span {
  font-family: 'Inter', sans-serif;
  font-size: 14px;
  font-weight: 500;
  color: var(--muted);
  display: block;
  margin-top: 2px;
}
.pkg-sidebar-stats {
  display: flex;
  flex-direction: column;
  gap: 16px;
  margin-bottom: 24px;
}
.pkg-stat {
  display: flex;
  align-items: center;
  gap: 14px;
}
.pkg-stat-icon {
  width: 44px;
  height: 44px;
  background: rgba(254,89,11,0.1);
  border-radius: 12px;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 18px;
  color: var(--primary);
  flex-shrink: 0;
}
.pkg-stat-value {
  font-weight: 700;
  font-size: 15px;
  color: var(--navy);
}
.pkg-stat-label {
  font-size: 11px;
  color: var(--muted);
  text-transform: uppercase;
  letter-spacing: 0.06em;
}
.pkg-sidebar-inclusions {
  margin-bottom: 24px;
  padding: 20px;
  background: rgba(42,42,104,0.03);
  border-radius: 12px;
}
.pkg-sidebar-inclusions h4 {
  font-family: 'Amiri', serif;
  font-size: 17px;
  color: var(--navy);
  margin-bottom: 14px;
}
.pkg-sidebar-inclusions ul {
  list-style: none;
  padding: 0;
  margin: 0;
}
.pkg-sidebar-inclusions li {
  font-size: 14px;
  color: var(--text);
  padding: 6px 0 6px 22px;
  position: relative;
  line-height: 1.4;
}
.pkg-sidebar-inclusions li::before {
  content: "";
  position: absolute;
  left: 0;
  top: 12px;
  width: 8px;
  height: 8px;
  border: 1.5px solid var(--primary);
  border-radius: 999px 999px 0 0;
  border-bottom: none;
}
.pkg-back-link {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  margin-top: 20px;
  font-size: 14px;
  font-weight: 600;
  color: var(--muted);
  text-decoration: none;
  transition: color 0.2s;
}
.pkg-back-link:hover { color: var(--primary); }

@media (max-width: 900px) {
  .package-detail-layout { grid-template-columns: 1fr; }
  .package-detail-sidebar { position: static; }
  .package-detail-image img { height: 260px; }
  .package-detail-desc { padding: 28px; }
}
</style>
