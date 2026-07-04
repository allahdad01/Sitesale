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
        <img src="<?= e($slideImg) ?>" alt="<?= e($slide['label']) ?>" loading="lazy">
        <div class="item-label"><?= e($slide['label']) ?></div>
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
    <span class="services-tag"><i class="fas fa-mosque"></i> What We Offer</span>
    <h2 class="services-title">Premium <span class="services-title-accent">Services</span></h2>
    <p class="services-desc">From sacred pilgrimages to global adventures, we handle every detail with care and professionalism.</p>
  </div>

  <div class="service-stage">
    <?php foreach ($services as $si => $sv):
      $sImg = str_starts_with($sv['image'], 'http') ? $sv['image'] : asset('storage/uploads/services/' . $sv['image']);
      $sLink = $sv['link'] ? base_url(ltrim($sv['link'], '/')) : base_url('contact');
    ?>
    <div class="service-card<?= $si === 0 ? ' active' : '' ?>">
      <img src="<?= e($sImg) ?>" alt="<?= e($sv['title']) ?>" loading="lazy">
      <div class="service-overlay"></div>
      <div class="service-content">
        <div class="service-tag"><?= e($sv['tag']) ?></div>
        <h2><?= e($sv['title']) ?></h2>
        <p><?= $sv['description'] ?></p>
        <a href="<?= e($sLink) ?>" class="service-btn">Learn More</a>
      </div>
    </div>
    <?php endforeach; ?>

    <div class="service-hint">
      SCROLL
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
      <span class="eyebrow">Umrah &amp; Hajj Packages</span>
      <h2 class="section-title">Choose your distance to the Haram</h2>
      <p class="section-intro">Every package is built around where you'll stay — the closer your room, the more of your day belongs to worship instead of walking.</p>
    </div>
  </div>

  <div class="packages-grid">
    <?php foreach ($featuredPackages as $i => $p):
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
</section>
<?php endif; ?>

<?php if (in_array('destinations', $activeSections)): ?><section class="destinations" id="destinations">
  <div class="destinations-inner">
    <div class="destinations-left">
      <span class="section-tag">Explore The World</span>
      <h2 class="section-title">Popular Destinations</h2>
      <p class="section-desc">Sacred cities to breathtaking getaways &mdash; we take you where your heart calls.</p>
      <div class="dest-progress">
        <span class="dot active"></span>
        <span class="dot"></span>
        <span class="dot"></span>
        <span class="dot"></span>
        <span class="dot"></span>
        <span class="dot"></span>
      </div>
    </div>
    <div class="destinations-track-wrap">
      <div class="destinations-track">
        <div class="dest-card">
          <img class="dest-card-img" src="https://commons.wikimedia.org/wiki/Special:FilePath/Kaaba_Mecca.jpg?width=900" alt="The Kaaba in Mecca" loading="lazy">
          <div class="dest-card-overlay"></div>
          <div class="dest-card-info">
            <span class="dest-card-tag">Sacred Pilgrimage</span>
            <h3>Mecca</h3>
            <p>Umrah &amp; Hajj packages available</p>
            <a href="<?= base_url('contact') ?>" class="dest-card-btn">Explore <i class="fas fa-arrow-right"></i></a>
          </div>
        </div>
        <div class="dest-card">
          <img class="dest-card-img" src="https://commons.wikimedia.org/wiki/Special:FilePath/Dubai_Skyline_2016.jpg?width=900" alt="Dubai skyline" loading="lazy">
          <div class="dest-card-overlay"></div>
          <div class="dest-card-info">
            <span class="dest-card-tag">Luxury Travel</span>
            <h3>Dubai</h3>
            <p>City tours, desert safari &amp; more</p>
            <a href="<?= base_url('contact') ?>" class="dest-card-btn">Explore <i class="fas fa-arrow-right"></i></a>
          </div>
        </div>
        <div class="dest-card">
          <img class="dest-card-img" src="https://commons.wikimedia.org/wiki/Special:FilePath/Hagia_Sophia_and_Blue_Mosque.jpg?width=900" alt="Hagia Sophia and Blue Mosque, Istanbul" loading="lazy">
          <div class="dest-card-overlay"></div>
          <div class="dest-card-info">
            <span class="dest-card-tag">Cultural Heritage</span>
            <h3>Istanbul</h3>
            <p>History, mosques &amp; Bosphorus views</p>
            <a href="<?= base_url('contact') ?>" class="dest-card-btn">Explore <i class="fas fa-arrow-right"></i></a>
          </div>
        </div>
        <div class="dest-card">
          <img class="dest-card-img" src="https://commons.wikimedia.org/wiki/Special:FilePath/View_on_Petronas_Towers.JPG?width=900" alt="Petronas Towers, Malaysia" loading="lazy">
          <div class="dest-card-overlay"></div>
          <div class="dest-card-info">
            <span class="dest-card-tag">Southeast Asia</span>
            <h3>Malaysia</h3>
            <p>Halal-friendly, vibrant culture</p>
            <a href="<?= base_url('contact') ?>" class="dest-card-btn">Explore <i class="fas fa-arrow-right"></i></a>
          </div>
        </div>
        <div class="dest-card">
          <img class="dest-card-img" src="https://commons.wikimedia.org/wiki/Special:FilePath/Tower_Bridge.JPG?width=900" alt="Tower Bridge, London" loading="lazy">
          <div class="dest-card-overlay"></div>
          <div class="dest-card-info">
            <span class="dest-card-tag">Europe</span>
            <h3>London</h3>
            <p>Iconic landmarks &amp; world culture</p>
            <a href="<?= base_url('contact') ?>" class="dest-card-btn">Explore <i class="fas fa-arrow-right"></i></a>
          </div>
        </div>
        <div class="dest-card">
          <img class="dest-card-img" src="https://commons.wikimedia.org/wiki/Special:FilePath/Kabul_Downtown_(Afghanistan).jpg?width=900" alt="Kabul downtown, Afghanistan" loading="lazy">
          <div class="dest-card-overlay"></div>
          <div class="dest-card-info">
            <span class="dest-card-tag">Homeland</span>
            <h3>Afghanistan</h3>
            <p>Domestic &amp; regional connections</p>
            <a href="<?= base_url('contact') ?>" class="dest-card-btn">Explore <i class="fas fa-arrow-right"></i></a>
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
        <img src="<?= e($src) ?>" alt="<?= e($a['label']) ?>" loading="lazy">
        <div class="item-label"><?= e($a['label']) ?></div>
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
  <div class="testimonials-title">What Our Users Say</div>
  <div class="testimonials-subtitle">Continuous real-time trust stream</div>

  <div class="testimonials-track-wrap">
    <div class="testimonials-track">
      <?php foreach ($testimonials as $t):
        $tag = $t['position'] ? explode('·', $t['position'])[0] : 'Client';
        $initials = '';
        foreach (explode(' ', $t['name']) as $part) { if ($part !== '') $initials .= strtoupper(mb_substr($part, 0, 1)); }
      ?>
      <div class="testimonials-card">
        <div class="testimonials-card-avatar"><?php if (!empty($t['avatar'])): ?><img src="<?= asset('storage/uploads/testimonials/' . e($t['avatar'])) ?>" alt=""><?php else: ?><span class="testimonials-card-initials"><?= e($initials) ?></span><?php endif; ?></div>
        <div class="testimonials-card-tag"><?= e(strtoupper($tag)) ?></div>
        <div class="testimonials-card-name"><?= e($t['name']) ?></div>
        <div class="testimonials-card-text"><?= e($t['content']) ?></div>
      </div>
      <?php endforeach; ?>
      <?php foreach ($testimonials as $t):
        $tag = $t['position'] ? explode('·', $t['position'])[0] : 'Client';
        $initials = '';
        foreach (explode(' ', $t['name']) as $part) { if ($part !== '') $initials .= strtoupper(mb_substr($part, 0, 1)); }
      ?>
      <div class="testimonials-card">
        <div class="testimonials-card-avatar"><?php if (!empty($t['avatar'])): ?><img src="<?= asset('storage/uploads/testimonials/' . e($t['avatar'])) ?>" alt=""><?php else: ?><span class="testimonials-card-initials"><?= e($initials) ?></span><?php endif; ?></div>
        <div class="testimonials-card-tag"><?= e(strtoupper($tag)) ?></div>
        <div class="testimonials-card-name"><?= e($t['name']) ?></div>
        <div class="testimonials-card-text"><?= e($t['content']) ?></div>
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
    <span class="eyebrow">From the Journal</span>
    <h2 class="section-title">Notes for the journey ahead</h2>
    <p class="section-intro">Guidance, rituals, and practical checklists from pilgrims and scholars who've made the trip before you.</p>
  </div>

  <div class="blog-wrap">
    <a href="<?= base_url('blog/' . e($featuredPost['slug'])) ?>" class="blog-featured<?= !empty($featuredPost['image']) ? ' has-img' : '' ?>"<?php if (!empty($featuredPost['image'])): ?> style="background-image:url('<?= asset('storage/uploads/' . e($featuredPost['image'])) ?>')"<?php endif; ?>>
      <span class="eyebrow"><?= e($featuredPost['category'] ?: 'Featured') ?></span>
      <h3><?= e($featuredPost['title']) ?></h3>
      <p><?= e($featuredPost['excerpt'] ?: mb_substr(strip_tags($featuredPost['content']), 0, 150)) ?></p>
      <span class="read-link">Read the guide →</span>
    </a>

    <div class="blog-list">
      <?php foreach ($otherPosts as $pi => $op): ?>
      <a href="<?= base_url('blog/' . e($op['slug'])) ?>" class="blog-item">
        <div class="blog-item-arch"><span><?= str_pad($pi + 1, 2, '0', STR_PAD_LEFT) ?></span></div>
        <div>
          <h4 class="blog-item-title"><?= e($op['title']) ?></h4>
          <span class="blog-item-meta"><?= e($op['category'] ?: 'Article') . ($op['published_at'] ? ' · ' . date('j M Y', strtotime($op['published_at'])) : '') ?></span>
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
      <span class="section-tag">Get In Touch</span>
      <h2 class="section-title">Plan Your<br>Journey Today</h2>
      <p class="section-desc">Our travel consultants are here to guide you &mdash; whether it's your first Umrah or a family vacation.</p>
      <div class="contact-details">
      <div class="contact-detail">
        <div class="contact-detail-icon"><i class="fas fa-phone"></i></div>
        <div class="contact-detail-text">
          <h5>Phone &amp; WhatsApp</h5>
          <p><a href="tel:<?= e(setting('contact_phone', '+93 700 000 000')) ?>"><?= e(setting('contact_phone', '+93 700 000 000')) ?></a></p>
        </div>
      </div>
      <div class="contact-detail">
        <div class="contact-detail-icon"><i class="fas fa-envelope"></i></div>
        <div class="contact-detail-text">
          <h5>Email</h5>
          <p><a href="mailto:<?= e(setting('contact_email', 'info@almoqadas.com')) ?>"><?= e(setting('contact_email', 'info@almoqadas.com')) ?></a></p>
        </div>
      </div>
      <div class="contact-detail">
        <div class="contact-detail-icon"><i class="fas fa-location-dot"></i></div>
        <div class="contact-detail-text">
          <h5>Office</h5>
          <p><?= e(setting('contact_address', 'Kabul, Afghanistan')) ?></p>
        </div>
      </div>
    </div>
    </div>
    <div class="contact-form">
      <h3>Request a Package</h3>
      <form id="enquiryForm" novalidate>
        <?= csrf_field() ?>
        <div class="form-group">
          <label for="fullName">Full Name</label>
          <input type="text" id="fullName" name="full_name" placeholder="Your full name" required>
        </div>
        <div class="form-group">
          <label for="phone">Phone / WhatsApp</label>
          <input type="tel" id="phone" name="phone" placeholder="+93 ..." required>
        </div>
        <div class="form-group">
          <label for="service">Service Required</label>
          <select id="service" name="service">
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
          <textarea id="message" name="message" placeholder="Tell us about your travel plans, dates, group size..."></textarea>
        </div>
        <button type="submit" class="btn-primary" style="width:100%;">Send Enquiry <i class="fas fa-arrow-right"></i></button>
        <p class="form-status" id="formStatus" role="status"></p>
      </form>
    </div>
  </div>
</div>
<?php endif; ?>

<?php foreach ($customSections as $cs): ?>
<section class="custom-section custom-<?= e($cs['section_key']) ?>">
  <?= $cs['content'] ?>
</section>
<?php endforeach; ?>

<?php $contactSubmitUrl = base_url('contact/submit');
$page_scripts = <<<SCRIPT
<script>
gsap.registerPlugin(ScrollTrigger);

const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
const isNarrowViewport = window.matchMedia('(max-width: 900px)').matches;
const enableHeavyScrollFX = !prefersReducedMotion && !isNarrowViewport;

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

  enqBtn.innerHTML = '<i class="fas fa-spinner"></i> Sending...';
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
      status.innerHTML = '<i class="fas fa-check-circle"></i> Thank you! We have received your enquiry and will get back to you shortly.';
      status.className = 'form-status visible success';
      form.reset();
    } else {
      status.textContent = data.error || 'Something went wrong. Please try again.';
      status.className = 'form-status visible error';
    }
  })
  .catch(function () {
    enqBtn.classList.remove('form-btn-loading');
    enqBtn.innerHTML = origHtml;
    status.textContent = 'Network error. Please try again.';
    status.className = 'form-status visible error';
  });
});
}
</script>
SCRIPT;
?>
