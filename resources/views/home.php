<?php if (in_array('hero', $activeSections)): ?><section class="hero" id="home">
  <div class="hero-ring hero-ring-1"></div>
  <div class="hero-ring hero-ring-2"></div>
  <div class="hero-ring hero-ring-3"></div>

  <div class="hero-badge"><i class="fas fa-star"></i> <?= e(setting('hero_badge', 'Trusted Since 2010 · Hajj & Umrah Specialists')) ?></div>

  <h1><?= setting('hero_title', 'Your Sacred Journey<br><span class="orange">Begins Here</span>') ?></h1>

  <p class="hero-sub"><?= e(setting('hero_subtitle', 'Premium Hajj & Umrah packages, worldwide flights, visa services, and curated travel experiences tailored for you.')) ?></p>

  <div class="hero-buttons">
    <a href="<?= e(setting('hero_btn1_url', base_url('services'))) ?>" class="btn-primary"><?= e(setting('hero_btn1_text', 'Explore Packages')) ?></a>
    <a href="<?= e(setting('hero_btn2_url', base_url('destinations'))) ?>" class="btn-outline"><?= e(setting('hero_btn2_text', 'View Destinations')) ?></a>
  </div>

  <div class="stats-bar">
    <?php for ($i = 1; $i <= 4; $i++): ?>
    <div class="stat">
      <div class="stat-num"><?= e(setting("hero_stat{$i}_num", ['20+','50K+','30+','100%'][$i-1])) ?></div>
      <div class="stat-label"><?= e(setting("hero_stat{$i}_label", ['Years Experience','Happy Pilgrims','Destinations','Visa Success'][$i-1])) ?></div>
    </div>
    <?php endfor; ?>
  </div>

  <div class="scene">
    <div class="carousel">
      <?php foreach ($heroSlides as $i => $slide):
        $img = $slide['image'];
        $slideImg = str_starts_with($img, 'http') ? $img : asset('storage/uploads/hero/' . $img);
      ?>
      <div class="item" style="--position:<?= $i ?>">
        <img src="<?= e($slideImg) ?>" alt="<?= locale_val_e($slide, 'label') ?>" loading="lazy">
        <div class="item-label"><?= locale_val_e($slide, 'label') ?></div>
      </div>
      <?php endforeach;
        $kaabaImg = setting('hero_kaaba_img', '');
        $kaabaUrl = $kaabaImg ? (str_starts_with($kaabaImg, 'http') ? $kaabaImg : asset('storage/uploads/hero/' . $kaabaImg)) : '';
      ?>
      <div class="kaaba-center" style="width:950px;height:950px;">
        <div class="kaaba-glow" style="width:950px;height:950px;"></div>
        <img src="<?= e($kaabaUrl ?: 'https://commons.wikimedia.org/wiki/Special:FilePath/Kaaba_Mecca.jpg?width=950') ?>" alt="The Kaaba, Mecca" loading="lazy">
      </div>
    </div>
  </div>

  <div class="divider">
    <div class="divider-line"></div>
    <div class="divider-icon"><i class="fas fa-star"></i></div>
    <div class="divider-line"></div>
  </div>
</section>
<?php endif; ?>

<?php if (in_array('services', $activeSections)): ?><section class="services" id="services">
  <div class="services-header">
    <span class="services-tag"><i class="fas fa-mosque"></i> <?= __('services.tag') ?></span>
    <h2 class="services-title"><?= __('services.title') ?></h2>
    <p class="services-desc"><?= __('services.desc') ?></p>
  </div>

  <div class="service-stage">
    <?php foreach ($services as $si => $sv):
      $sImg = str_starts_with($sv['image'], 'http') ? $sv['image'] : asset('storage/uploads/services/' . $sv['image']);
      $sLink = $sv['link'] ? base_url(ltrim($sv['link'], '/')) : base_url('contact');
    ?>
    <div class="service-card<?= $si === 0 ? ' active' : '' ?>">
        <img src="<?= e($sImg) ?>" alt="<?= locale_val_e($sv, 'title') ?>" loading="lazy">
      <div class="service-overlay"></div>
      <div class="service-content">
        <div class="service-tag"><?= locale_val_e($sv, 'tag') ?></div>
        <h2><?= locale_val_e($sv, 'title') ?></h2>
        <p><?= locale_val($sv, 'description') ?></p>
        <a href="<?= e($sLink) ?>" class="service-btn"><?= __('services.learn_more') ?></a>
      </div>
    </div>
    <?php endforeach; ?>

    <div class="service-hint">
      <?= __('services.scroll') ?>
      <div class="service-arrow">↓</div>
    </div>
    <div class="service-dots"></div>
  </div>
</section>
<?php endif; ?>

<?php if (in_array('packages', $activeSections) && !empty($featuredPackages)): ?>
<?php
  $pkgInclusions = function($desc) {
    preg_match_all('/<li>(.*?)<\/li>/s', $desc, $matches);
    return array_slice($matches[1] ?? [], 0, 4);
  };
?>
<section class="packages-section" id="packages">
  <div class="packages-header">
    <div>
      <span class="eyebrow"><?= __('packages.eyebrow') ?></span>
      <h2 class="section-title"><?= __('packages.title') ?></h2>
      <p class="section-intro"><?= __('packages.desc') ?></p>
    </div>
  </div>

  <div class="packages-grid">
    <?php foreach ($featuredPackages as $i => $p):
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
</section>
<?php endif; ?>

<?php if (in_array('destinations', $activeSections)): ?><section class="destinations" id="destinations">
  <div class="destinations-inner">
    <div class="destinations-left">
      <span class="section-tag"><?= __('destinations.tag') ?></span>
      <h2 class="section-title"><?= __('destinations.title') ?></h2>
      <p class="section-desc"><?= __('destinations.desc') ?></p>
      <div class="dest-progress">
        <span class="dot active"></span>
        <span class="dot"></span>
        <span class="dot"></span>
        <span class="dot"></span>
        <span class="dot"></span>
        <span class="dot"></span>
      </div>
    </div>
    <div class="destinations-track-wrap"<?= locale_dir() === 'rtl' ? ' dir="ltr"' : '' ?>>
      <div class="destinations-track">
        <div class="dest-card">
          <img class="dest-card-img" src="https://commons.wikimedia.org/wiki/Special:FilePath/Kaaba_Mecca.jpg?width=900" alt="The Kaaba in Mecca" loading="lazy">
          <div class="dest-card-overlay"></div>
          <div class="dest-card-info">
            <span class="dest-card-tag"><?= __('destinations.mecca_tag') ?></span>
            <h3><?= __('destinations.mecca') ?></h3>
            <p><?= __('destinations.mecca_desc') ?></p>
            <a href="<?= base_url('contact') ?>" class="dest-card-btn"><?= __('destinations.explore') ?> <i class="fas fa-arrow-right"></i></a>
          </div>
        </div>
        <div class="dest-card">
          <img class="dest-card-img" src="https://commons.wikimedia.org/wiki/Special:FilePath/Dubai_Skyline_2016.jpg?width=900" alt="Dubai skyline" loading="lazy">
          <div class="dest-card-overlay"></div>
          <div class="dest-card-info">
            <span class="dest-card-tag"><?= __('destinations.dubai_tag') ?></span>
            <h3><?= __('destinations.dubai') ?></h3>
            <p><?= __('destinations.dubai_desc') ?></p>
            <a href="<?= base_url('contact') ?>" class="dest-card-btn"><?= __('destinations.explore') ?> <i class="fas fa-arrow-right"></i></a>
          </div>
        </div>
        <div class="dest-card">
          <img class="dest-card-img" src="https://commons.wikimedia.org/wiki/Special:FilePath/Hagia_Sophia_and_Blue_Mosque.jpg?width=900" alt="Hagia Sophia and Blue Mosque, Istanbul" loading="lazy">
          <div class="dest-card-overlay"></div>
          <div class="dest-card-info">
            <span class="dest-card-tag"><?= __('destinations.istanbul_tag') ?></span>
            <h3><?= __('destinations.istanbul') ?></h3>
            <p><?= __('destinations.istanbul_desc') ?></p>
            <a href="<?= base_url('contact') ?>" class="dest-card-btn"><?= __('destinations.explore') ?> <i class="fas fa-arrow-right"></i></a>
          </div>
        </div>
        <div class="dest-card">
          <img class="dest-card-img" src="https://commons.wikimedia.org/wiki/Special:FilePath/View_on_Petronas_Towers.JPG?width=900" alt="Petronas Towers, Malaysia" loading="lazy">
          <div class="dest-card-overlay"></div>
          <div class="dest-card-info">
            <span class="dest-card-tag"><?= __('destinations.malaysia_tag') ?></span>
            <h3><?= __('destinations.malaysia') ?></h3>
            <p><?= __('destinations.malaysia_desc') ?></p>
            <a href="<?= base_url('contact') ?>" class="dest-card-btn"><?= __('destinations.explore') ?> <i class="fas fa-arrow-right"></i></a>
          </div>
        </div>
        <div class="dest-card">
          <img class="dest-card-img" src="https://commons.wikimedia.org/wiki/Special:FilePath/Tower_Bridge.JPG?width=900" alt="Tower Bridge, London" loading="lazy">
          <div class="dest-card-overlay"></div>
          <div class="dest-card-info">
            <span class="dest-card-tag"><?= __('destinations.london_tag') ?></span>
            <h3><?= __('destinations.london') ?></h3>
            <p><?= __('destinations.london_desc') ?></p>
            <a href="<?= base_url('contact') ?>" class="dest-card-btn"><?= __('destinations.explore') ?> <i class="fas fa-arrow-right"></i></a>
          </div>
        </div>
        <div class="dest-card">
          <img class="dest-card-img" src="https://commons.wikimedia.org/wiki/Special:FilePath/Kabul_Downtown_(Afghanistan).jpg?width=900" alt="Kabul downtown, Afghanistan" loading="lazy">
          <div class="dest-card-overlay"></div>
          <div class="dest-card-info">
            <span class="dest-card-tag"><?= __('destinations.afghanistan_tag') ?></span>
            <h3><?= __('destinations.afghanistan') ?></h3>
            <p><?= __('destinations.afghanistan_desc') ?></p>
            <a href="<?= base_url('contact') ?>" class="dest-card-btn"><?= __('destinations.explore') ?> <i class="fas fa-arrow-right"></i></a>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<?php endif; ?>

<?php if (in_array('awards', $activeSections)): ?><section class="awards">
  <div class="hero-ring"></div>
  <div class="hero-ring"></div>
  <div class="hero-ring"></div>

  <div class="hero-badge"><i class="fas fa-award"></i> <?= e(setting('awards_badge', 'Recognition & Trust')) ?></div>
  <h1><?= setting('awards_title', 'Honors & <span class="orange">Accolades</span>') ?></h1>
  <p class="hero-sub"><?= e(setting('awards_subtitle', 'Recognized by leading industry organizations for our trusted service and excellence.')) ?></p>

  <div class="scene">
    <div class="carousel" style="--quantity:<?= max(count($awards), 1) ?>">
      <?php foreach ($awards as $i => $a):
        $img = $a['image'];
        $src = str_starts_with($img, 'http') ? $img : asset('storage/uploads/awards/' . $img);
      ?>
      <div class="item" style="--position:<?= $i ?>">
        <img src="<?= e($src) ?>" alt="<?= locale_val_e($a, 'label') ?>" loading="lazy">
        <div class="item-label"><?= locale_val_e($a, 'label') ?></div>
      </div>
      <?php endforeach; ?>
      <div class="center-emblem">
        <div class="center-glow"></div>
        <div class="center-emblem-inner"><i class="fas fa-award"></i></div>
      </div>
    </div>
  </div>

  <div class="divider">
    <div class="divider-line"></div>
    <div class="divider-icon"><i class="fas fa-award"></i></div>
    <div class="divider-line"></div>
  </div>
</section>

<div class="awards-modal" id="awardsModal">
  <div class="awards-modal-inner">
    <button class="awards-modal-close" id="awardsModalClose">&times;</button>
    <img id="awardsModalImg" src="" alt="">
    <div class="awards-modal-label" id="awardsModalLabel"></div>
  </div>
</div>
<?php endif; ?>

<?php if (in_array('testimonials', $activeSections)): ?><section class="testimonials-section" id="about">
  <div class="testimonials-title"><?= __('testimonials.title') ?></div>
  <div class="testimonials-subtitle"><?= __('testimonials.subtitle') ?></div>

  <div class="testimonials-track-wrap">
    <div class="testimonials-track">
      <?php foreach ($testimonials as $t):
        $tag = locale_val($t, 'position') ? explode('·', locale_val($t, 'position'))[0] : 'Client';
        $initials = '';
        foreach (explode(' ', locale_val($t, 'name')) as $part) { if ($part !== '') $initials .= strtoupper(mb_substr($part, 0, 1)); }
      ?>
      <div class="testimonials-card">
        <div class="testimonials-card-avatar"><?php if (!empty($t['avatar'])): ?><img src="<?= asset('storage/uploads/testimonials/' . e($t['avatar'])) ?>" alt=""><?php else: ?><span class="testimonials-card-initials"><?= e($initials) ?></span><?php endif; ?></div>
        <div class="testimonials-card-tag"><?= e(strtoupper($tag)) ?></div>
        <div class="testimonials-card-name"><?= locale_val_e($t, 'name') ?></div>
        <div class="testimonials-card-text"><?= locale_val_e($t, 'content') ?></div>
      </div>
      <?php endforeach; ?>
      <?php foreach ($testimonials as $t):
        $tag = locale_val($t, 'position') ? explode('·', locale_val($t, 'position'))[0] : 'Client';
        $initials = '';
        foreach (explode(' ', locale_val($t, 'name')) as $part) { if ($part !== '') $initials .= strtoupper(mb_substr($part, 0, 1)); }
      ?>
      <div class="testimonials-card">
        <div class="testimonials-card-avatar"><?php if (!empty($t['avatar'])): ?><img src="<?= asset('storage/uploads/testimonials/' . e($t['avatar'])) ?>" alt=""><?php else: ?><span class="testimonials-card-initials"><?= e($initials) ?></span><?php endif; ?></div>
        <div class="testimonials-card-tag"><?= e(strtoupper($tag)) ?></div>
        <div class="testimonials-card-name"><?= locale_val_e($t, 'name') ?></div>
        <div class="testimonials-card-text"><?= locale_val_e($t, 'content') ?></div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>
<?php endif; ?>

<?php if (in_array('blog', $activeSections) && !empty($recentPosts)):
  $featuredIdx = null;
  foreach ($recentPosts as $idx => $rp) { if ($rp['featured']) { $featuredIdx = $idx; break; } }
  if ($featuredIdx === null) $featuredIdx = 0;
  $featuredPost = $recentPosts[$featuredIdx];
  $otherPosts = array_values(array_filter($recentPosts, fn($rp, $i) => $i !== $featuredIdx, ARRAY_FILTER_USE_BOTH));
?>
<section class="blog-section" id="blog">
  <div class="blog-header">
    <span class="eyebrow"><?= __('blog.eyebrow') ?></span>
    <h2 class="section-title"><?= __('blog.title') ?></h2>
    <p class="section-intro"><?= __('blog.desc') ?></p>
  </div>

  <div class="blog-wrap">
    <a href="<?= base_url('blog/' . e($featuredPost['slug'])) ?>" class="blog-featured<?= !empty($featuredPost['image']) ? ' has-img' : '' ?>"<?php if (!empty($featuredPost['image'])): ?> style="background-image:url('<?= asset('storage/uploads/' . e($featuredPost['image'])) ?>')"<?php endif; ?>>
      <span class="eyebrow"><?= e($featuredPost['category'] ?: __('blog.featured')) ?></span>
      <h3><?= locale_val_e($featuredPost, 'title') ?></h3>
      <p><?= locale_val_e($featuredPost, 'excerpt', mb_substr(strip_tags(locale_val($featuredPost, 'content')), 0, 150)) ?></p>
      <span class="read-link"><?= __('blog.read_guide') ?></span>
    </a>

    <div class="blog-list">
      <?php foreach ($otherPosts as $pi => $op): ?>
      <a href="<?= base_url('blog/' . e($op['slug'])) ?>" class="blog-item">
        <div class="blog-item-arch"><span><?= str_pad($pi + 1, 2, '0', STR_PAD_LEFT) ?></span></div>
        <div>
          <h4 class="blog-item-title"><?= locale_val_e($op, 'title') ?></h4>
          <span class="blog-item-meta"><?= e($op['category'] ?: __('blog.article')) . ($op['published_at'] ? ' · ' . date('j M Y', strtotime($op['published_at'])) : '') ?></span>
        </div>
      </a>
      <?php endforeach; ?>
    </div>
  </div>
</section>
<?php endif; ?>

<?php if (in_array('contact', $activeSections)): ?><div class="contact-wrap" id="contact">
  <div class="contact">
    <div class="contact-info">
      <span class="section-tag"><?= __('contact.tag') ?></span>
      <h2 class="section-title"><?= __('contact.title') ?></h2>
      <p class="section-desc"><?= __('contact.desc') ?></p>
      <div class="contact-details">
      <div class="contact-detail">
        <div class="contact-detail-icon"><i class="fas fa-phone"></i></div>
        <div class="contact-detail-text">
          <h5><?= __('contact.phone') ?></h5>
          <p><a href="tel:<?= e(setting('contact_phone', '+93 700 000 000')) ?>"><?= e(setting('contact_phone', '+93 700 000 000')) ?></a></p>
        </div>
      </div>
      <div class="contact-detail">
        <div class="contact-detail-icon"><i class="fas fa-envelope"></i></div>
        <div class="contact-detail-text">
          <h5><?= __('contact.email') ?></h5>
          <p><a href="mailto:<?= e(setting('contact_email', 'info@almoqadas.com')) ?>"><?= e(setting('contact_email', 'info@almoqadas.com')) ?></a></p>
        </div>
      </div>
      <div class="contact-detail">
        <div class="contact-detail-icon"><i class="fas fa-location-dot"></i></div>
        <div class="contact-detail-text">
          <h5><?= __('contact.office') ?></h5>
          <p><?= e(setting('contact_address', 'Kabul, Afghanistan')) ?></p>
        </div>
      </div>
    </div>
    </div>
    <div class="contact-form">
      <h3><?= __('contact.form_title') ?></h3>
      <form id="enquiryForm" novalidate>
        <?= csrf_field() ?>
        <div class="form-group">
          <label for="fullName"><?= __('contact.form_name') ?></label>
          <input type="text" id="fullName" name="full_name" placeholder="<?= __('contact.form_placeholder_name') ?>" required>
        </div>
        <div class="form-group">
          <label for="phone"><?= __('contact.form_phone') ?></label>
          <input type="tel" id="phone" name="phone" placeholder="<?= __('contact.form_placeholder_phone') ?>" required>
        </div>
        <div class="form-group">
          <label for="service"><?= __('contact.form_service') ?></label>
          <select id="service" name="service">
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
          <textarea id="message" name="message" placeholder="<?= __('contact.form_placeholder_message') ?>"></textarea>
        </div>
        <button type="submit" class="btn-primary" style="width:100%;"><?= __('contact.form_submit') ?> <i class="fas fa-arrow-right"></i></button>
        <p class="form-status" id="formStatus" role="status"></p>
      </form>
    </div>
  </div>
</div>
<?php endif; ?>

<?php foreach ($customSections as $cs): ?>
<section class="custom-section custom-<?= e($cs['section_key']) ?>">
  <?= locale_val($cs, 'content') ?>
</section>
<?php endforeach; ?>

<?php
$contactSubmitUrl = base_url('contact/submit');
$sendingText = __('contact.form_sending');
$successText = __('contact.form_success');
$errorText = __('contact.form_error');
$networkErrorText = __('contact.form_network_error');
$page_scripts = <<<SCRIPT
<script>
gsap.registerPlugin(ScrollTrigger);

const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
const isNarrowViewport = window.matchMedia('(max-width: 900px)').matches;
const enableHeavyScrollFX = !prefersReducedMotion && !isNarrowViewport;
const isRTL = document.documentElement.dir === 'rtl';

const SERVICE_CARDS = document.querySelectorAll('.service-card');
const SERVICE_STAGE = document.querySelector('.service-stage');
const SERVICE_DOTS = document.querySelector('.service-dots');
let serviceIndex = 0;
let serviceTimer = null;

function renderService(newIndex) {
  SERVICE_CARDS.forEach(function (c, i) {
    c.classList.remove('active', 'prev');
    if (i === newIndex) {
      c.classList.add('active');
    } else if (i === (newIndex - 1 + SERVICE_CARDS.length) % SERVICE_CARDS.length) {
      c.classList.add('prev');
    }
  });
  if (SERVICE_DOTS) {
    var dots = SERVICE_DOTS.querySelectorAll('.sdot');
    dots.forEach(function (d, i) { d.classList.toggle('active', i === newIndex); });
  }
}

function startServiceTimer() {
  stopServiceTimer();
  if (SERVICE_CARDS.length > 1 && isNarrowViewport) {
    serviceTimer = setInterval(function () {
      serviceIndex = (serviceIndex + 1) % SERVICE_CARDS.length;
      renderService(serviceIndex);
    }, 5000);
  }
}

function stopServiceTimer() { clearInterval(serviceTimer); }

// build dots
if (SERVICE_DOTS && SERVICE_CARDS.length > 1) {
  for (var di = 0; di < SERVICE_CARDS.length; di++) {
    var dEl = document.createElement('span');
    dEl.className = 'sdot' + (di === 0 ? ' active' : '');
    SERVICE_DOTS.appendChild(dEl);
  }
}

// touch swipe
if (SERVICE_STAGE && SERVICE_CARDS.length > 1) {
  var touchSX = 0;
  SERVICE_STAGE.addEventListener('touchstart', function (e) {
    touchSX = e.changedTouches[0].screenX;
    stopServiceTimer();
  }, { passive: true });
  SERVICE_STAGE.addEventListener('touchend', function (e) {
    var diff = touchSX - e.changedTouches[0].screenX;
    if (Math.abs(diff) > 50) {
      serviceIndex = diff > 0
        ? (serviceIndex + 1) % SERVICE_CARDS.length
        : (serviceIndex - 1 + SERVICE_CARDS.length) % SERVICE_CARDS.length;
      renderService(serviceIndex);
    }
    startServiceTimer();
  }, { passive: true });
}

if (SERVICE_CARDS.length && typeof ScrollTrigger !== 'undefined' && enableHeavyScrollFX) {
  ScrollTrigger.create({
    trigger: '.services',
    pin: true,
    anticipatePin: 1,
    scrub: 1.2,
    start: 'top top',
    end: function () { return '+=' + (SERVICE_CARDS.length * 80) + '%'; },
    invalidateOnRefresh: true,
    onUpdate: function(self) {
      var idx = Math.min(Math.floor(self.progress * SERVICE_CARDS.length), SERVICE_CARDS.length - 1);
      if (idx !== serviceIndex) {
        serviceIndex = idx;
        renderService(serviceIndex);
      }
    },
  });
} else if (SERVICE_CARDS.length) {
  renderService(0);
  startServiceTimer();
}

const DEST_SECTION = document.querySelector('.destinations');
const DEST_TRACK = document.querySelector('.destinations-track');
const DEST_DOTS = document.querySelectorAll('.dest-progress .dot');
const NUM_DEST = DEST_DOTS.length;
let destCurrent = 0;

if (DEST_SECTION && DEST_TRACK) {
function getDestOverflow() {
  return DEST_TRACK.scrollWidth - DEST_TRACK.parentElement.clientWidth;
}

if (enableHeavyScrollFX) {
  const destTl = gsap.timeline({
    scrollTrigger: {
      trigger: DEST_SECTION, pin: true, anticipatePin: 1, scrub: 1,
      start: 'top top', end: function () { return '+=' + getDestOverflow(); },
      invalidateOnRefresh: true,
    },
    defaults: { ease: 'none' },
  });

  destTl.to(DEST_TRACK, { x: function () { return -getDestOverflow(); }, ease: 'none' });

  ScrollTrigger.create({
    trigger: DEST_SECTION,
    start: 'top top', end: function () { return '+=' + getDestOverflow(); },
    scrub: 0.5,
    onUpdate: function (self) {
      const idx = Math.min(Math.round(self.progress * (NUM_DEST - 1)), NUM_DEST - 1);
      if (idx !== destCurrent) {
        destCurrent = idx;
        DEST_DOTS.forEach(function (dot, d) { dot.classList.toggle('active', d === idx); });
      }
    },
  });
} else {
  DEST_TRACK.parentElement.style.overflowX = 'auto';
  DEST_SECTION.style.minHeight = 'auto';
  // mobile scroll-sync dots
  if (isNarrowViewport) {
    var destWrap = document.querySelector('.destinations-track-wrap');
    if (destWrap && DEST_DOTS.length) {
      destWrap.addEventListener('scroll', function () {
        var cardEls = document.querySelectorAll('.dest-card');
        if (!cardEls.length) return;
        var cardW = cardEls[0].offsetWidth + 16;
        var idx = Math.round(destWrap.scrollLeft / cardW);
        idx = Math.max(0, Math.min(idx, NUM_DEST - 1));
        if (idx !== destCurrent) {
          destCurrent = idx;
          DEST_DOTS.forEach(function (dot, d) { dot.classList.toggle('active', d === idx); });
        }
      }, { passive: true });
    }
  }
}
}



window.addEventListener('load', function () { ScrollTrigger.refresh(); });
window.addEventListener('resize', function () {
  setTimeout(ScrollTrigger.refresh, 200);
});

var enqForm = document.getElementById('enquiryForm');
if (enqForm) {
var enqBtn = enqForm.querySelector('.btn-primary');
enqForm.addEventListener('submit', function (e) {
  e.preventDefault();
  var form = this;
  if (!form.checkValidity()) {
    form.reportValidity();
    return;
  }
  var formData = new FormData(form);
  var status = document.getElementById('formStatus');
  var origHtml = enqBtn.innerHTML;

  enqBtn.innerHTML = '<i class="fas fa-spinner"></i> $sendingText';
  enqBtn.classList.add('form-btn-loading');

  fetch('$contactSubmitUrl', {
    method: 'POST',
    body: formData,
  })
  .then(function (r) { return r.json(); })
  .then(function (data) {
    enqBtn.classList.remove('form-btn-loading');
    enqBtn.innerHTML = origHtml;
    if (data.success) {
      status.innerHTML = '<i class="fas fa-check-circle"></i> $successText';
      status.className = 'form-status visible success';
      form.reset();
    } else {
      status.textContent = data.error || '$errorText';
      status.className = 'form-status visible error';
    }
  })
  .catch(function () {
    enqBtn.classList.remove('form-btn-loading');
    enqBtn.innerHTML = origHtml;
    status.textContent = '$networkErrorText';
    status.className = 'form-status visible error';
  });
});
}
</script>
SCRIPT;
?>
