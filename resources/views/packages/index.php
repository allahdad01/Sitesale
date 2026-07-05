<?php
  $pkgInclusions = function($desc) {
    preg_match_all('/<li>(.*?)<\/li>/s', $desc, $matches);
    return array_slice($matches[1] ?? [], 0, 4);
  };
  $catLabels = [
    'umrah' => __('packages.filter_umrah'),
    'hajj' => __('packages.filter_hajj'),
    'tour' => __('packages.filter_tour'),
    'flight' => __('packages.filter_flight'),
    'visa' => __('packages.filter_visa'),
    'hotel' => __('packages.filter_hotel'),
  ];
  $catLabel = $category ? ($catLabels[$category] ?? ucfirst($category)) : '';
?>
<section class="page-hero">
  <div class="hero-ring hero-ring-1"></div>
  <div class="hero-ring hero-ring-2"></div>
  <div class="hero-ring hero-ring-3"></div>

  <div class="hero-badge"><i class="fas fa-mosque"></i> <?= $category ? $catLabel . ' ' . __('nav.packages') : __('packages.filter_all') ?></div>

  <h1><?= $category ? $catLabel : __('packages.filter_all') ?><br><span class="orange"><?= $category ? __('nav.packages') : __('packages.price_from') ?></span></h1>

  <p class="hero-sub"><?= __('packages.desc') ?></p>

  <div class="breadcrumb">
    <span><?= __('contact_page.breadcrumb_home') ?></span> <span>/</span> <span class="current"><?= $category ? $catLabel . ' ' . __('nav.packages') : __('nav.packages') ?></span>
  </div>
</section>

<section class="packages-section">
  <div class="packages-header">
    <div>
      <span class="eyebrow"><?= $category ? $catLabel . ' ' . __('nav.packages') : __('nav.packages') ?></span>
      <h2 class="section-title"><?= $category ? __('packages.filter_all') . ' ' . $catLabel . ' ' . __('nav.packages') : __('packages.price_from') ?></h2>
      <p class="section-intro"><?= __('packages.desc') ?></p>
    </div>
  </div>

  <div class="dest-filters" style="max-width:1180px;margin:0 auto 48px;justify-content:flex-start;">
    <a href="<?= base_url('packages') ?>" class="filter-pill <?= !$category ? 'active' : '' ?>"><?= __('packages.filter_all') ?></a>
    <?php foreach (['umrah','hajj','tour','flight','visa','hotel'] as $cat): ?>
      <a href="<?= base_url('packages?category=' . $cat) ?>" class="filter-pill <?= $category === $cat ? 'active' : '' ?>"><?= $catLabels[$cat] ?></a>
    <?php endforeach; ?>
  </div>

  <?php if (empty($packages)): ?>
    <p style="text-align:center;color:var(--muted);max-width:1180px;margin:0 auto;"><?= __('packages.no_packages') ?></p>
  <?php else: ?>
    <div class="packages-grid">
      <?php foreach ($packages as $i => $p):
        $inclusions = $pkgInclusions(locale_val($p, 'description'));
      ?>
      <article class="package-card<?= $i === 0 ? ' featured' : '' ?>">
        <?php if ($p['image']): ?>
        <div class="package-image"><img src="<?= asset('storage/uploads/' . e($p['image'])) ?>" alt="<?= locale_val_e($p, 'title') ?>"></div>
        <?php else: ?>
        <div class="package-arch-frame">
          <div class="arch">
            <svg class="rings" viewBox="0 0 46 46" fill="none">
              <circle cx="23" cy="23" r="21" stroke="var(--primary)" stroke-width="1" opacity="0.35"/>
              <circle cx="23" cy="23" r="13" stroke="var(--primary)" stroke-width="1" opacity="0.6"/>
              <circle cx="23" cy="23" r="3" fill="var(--primary)"/>
            </svg>
          </div>
        </div>
        <?php endif; ?>
        <div class="package-body">
          <span class="package-kind"><?= e(ucfirst($p['category'])) ?> — <?= e(mb_substr(locale_val($p, 'title'), 0, str_contains(locale_val($p, 'title'), ',') ? strpos(locale_val($p, 'title'), ',') : 20)) ?></span>
          <h3 class="package-title"><?= locale_val_e($p, 'title') ?></h3>
          <div class="package-meta-row">
            <div class="meta-item">
              <span class="meta-value"><?= (int) $p['duration_days'] ?></span>
              <span class="meta-label"><?= (int) $p['duration_days'] === 1 ? __('packages.day') : __('packages.days') ?></span>
            </div>
            <div class="meta-item">
              <span class="meta-value"><?= locale_val_e($p, 'destination', '—') ?></span>
              <span class="meta-label"><?= __('packages.destination') ?></span>
            </div>
            <div class="meta-item">
              <span class="meta-value"><?= (int) $p['max_people'] ?> pax</span>
              <span class="meta-label"><?= __('packages.max_group') ?></span>
            </div>
          </div>
          <ul class="package-inclusions">
            <?php foreach ($inclusions as $inc): ?>
              <li><?= e(strip_tags($inc)) ?></li>
            <?php endforeach; ?>
          </ul>
          <div class="package-footer">
          <div class="package-price">$<?= number_format($p['price']) ?><span><?= __('packages.per_person') ?></span></div>
          <a href="<?= base_url('packages/' . e($p['slug'])) ?>" class="btn-view"><?= __('packages.view_details') ?> <i class="fas fa-arrow-right"></i></a>
          </div>
        </div>
      </article>
      <?php endforeach; ?>
    </div>
  <?php endif; ?>
</section>

<style>
.packages-section {
  background: var(--white);
  background-image: none;
}
.packages-section .eyebrow { color: var(--primary); }
.packages-section h2.section-title { color: var(--navy); }
.packages-section .section-intro { color: var(--muted); }
</style>
