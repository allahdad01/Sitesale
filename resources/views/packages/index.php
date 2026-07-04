<?php
  $pkgInclusions = function($desc) {
    preg_match_all('/<li>(.*?)<\/li>/s', $desc, $matches);
    return array_slice($matches[1] ?? [], 0, 4);
  };
?>
<section class="page-hero">
  <div class="hero-ring hero-ring-1"></div>
  <div class="hero-ring hero-ring-2"></div>
  <div class="hero-ring hero-ring-3"></div>

  <div class="hero-badge"><i class="fas fa-mosque"></i> <?= $category ? ucfirst($category) . ' Packages' : 'Sacred Travel' ?></div>

  <h1><?= $category ? ucfirst($category) : 'Choose Your' ?><br><span class="orange"><?= $category ? 'Packages' : 'Sacred Journey' ?></span></h1>

  <p class="hero-sub">Tailored travel experiences for your spiritual journey — from Umrah and Hajj to flights, visas, and hotels.</p>

  <div class="breadcrumb">
    <span>Home</span> <span>/</span> <span class="current"><?= $category ? ucfirst($category) . ' Packages' : 'Packages' ?></span>
  </div>
</section>

<section class="packages-section">
  <div class="packages-header">
    <div>
      <span class="eyebrow"><?= $category ? ucfirst($category) . ' Packages' : 'Our Packages' ?></span>
      <h2 class="section-title"><?= $category ? 'All ' . ucfirst($category) . ' Packages' : 'Explore All Packages' ?></h2>
      <p class="section-intro">Every package is built around where you'll stay — the closer your room, the more of your day belongs to worship instead of walking.</p>
    </div>
  </div>

  <div class="dest-filters" style="max-width:1180px;margin:0 auto 48px;justify-content:flex-start;">
    <a href="<?= base_url('packages') ?>" class="filter-pill <?= !$category ? 'active' : '' ?>">All</a>
    <?php foreach (['umrah','hajj','tour','flight','visa','hotel'] as $cat): ?>
      <a href="<?= base_url('packages?category=' . $cat) ?>" class="filter-pill <?= $category === $cat ? 'active' : '' ?>"><?= ucfirst($cat) ?></a>
    <?php endforeach; ?>
  </div>

  <?php if (empty($packages)): ?>
    <p style="text-align:center;color:var(--muted);max-width:1180px;margin:0 auto;">No packages found in this category.</p>
  <?php else: ?>
    <div class="packages-grid">
      <?php foreach ($packages as $i => $p):
        $inclusions = $pkgInclusions($p['description']);
      ?>
      <article class="package-card<?= $i === 0 ? ' featured' : '' ?>">
        <?php if ($p['image']): ?>
        <div class="package-image"><img src="<?= asset('storage/uploads/' . e($p['image'])) ?>" alt="<?= e($p['title']) ?>"></div>
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
          <span class="package-kind"><?= e(ucfirst($p['category'])) ?> — <?= e(mb_substr($p['title'], 0, str_contains($p['title'], ',') ? strpos($p['title'], ',') : 20)) ?></span>
          <h3 class="package-title"><?= e($p['title']) ?></h3>
          <div class="package-meta-row">
            <div class="meta-item">
              <span class="meta-value"><?= (int) $p['duration_days'] ?></span>
              <span class="meta-label"><?= (int) $p['duration_days'] === 1 ? 'day' : 'days' ?></span>
            </div>
            <div class="meta-item">
              <span class="meta-value"><?= e($p['destination'] ?: '—') ?></span>
              <span class="meta-label">destination</span>
            </div>
            <div class="meta-item">
              <span class="meta-value"><?= (int) $p['max_people'] ?> pax</span>
              <span class="meta-label">max group</span>
            </div>
          </div>
          <ul class="package-inclusions">
            <?php foreach ($inclusions as $inc): ?>
              <li><?= e(strip_tags($inc)) ?></li>
            <?php endforeach; ?>
          </ul>
          <div class="package-footer">
            <div class="package-price">$<?= number_format($p['price']) ?><span>per person</span></div>
            <a href="<?= base_url('packages/' . e($p['slug'])) ?>" class="btn-view">View Details <i class="fas fa-arrow-right"></i></a>
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
